/**
 * verify-files.js
 * Script de verificación de archivos esenciales e integridad de datos para BioAves Quilichao.
 */

const fs = require('fs');
const path = require('path');

const REQUIRED_FILES = [
  'index.html',
  'catalogo.html',
  'css/styles.css',
  'js/birds-data.js',
  'js/app.js',
  'js/catalogo.js',
  'package.json'
];

console.log('🔍 Iniciando verificación de archivos esenciales...\n');
let hasErrors = false;

REQUIRED_FILES.forEach((relPath) => {
  const fullPath = path.join(__dirname, '..', relPath);
  if (!fs.existsSync(fullPath)) {
    console.error(`❌ ERROR: Archivo esencial faltante: ${relPath}`);
    hasErrors = true;
    return;
  }

  const stats = fs.statSync(fullPath);
  if (stats.size === 0) {
    console.error(`❌ ERROR: El archivo ${relPath} está vacío (0 bytes).`);
    hasErrors = true;
    return;
  }

  console.log(`✅ [OK] ${relPath} (${stats.size} bytes)`);
});

// Validar que birds-data.js defina BIOAVES_DATA con estructura correcta
try {
  const birdsDataContent = fs.readFileSync(path.join(__dirname, '..', 'js', 'birds-data.js'), 'utf8');
  if (!birdsDataContent.includes('BIOAVES_DATA')) {
    console.error('❌ ERROR: js/birds-data.js no define la constante BIOAVES_DATA.');
    hasErrors = true;
  } else {
    console.log('✅ [OK] js/birds-data.js define correctamente la colección BIOAVES_DATA.');
  }
} catch (err) {
  console.error(`❌ ERROR al leer js/birds-data.js: ${err.message}`);
  hasErrors = true;
}

if (hasErrors) {
  console.error('\n❌ La verificación de integridad falló. Por favor corrige los errores antes de subir.');
  process.exit(1);
} else {
  console.log('\n✨ Todos los archivos esenciales están presentes y no vacíos.');
  process.exit(0);
}
