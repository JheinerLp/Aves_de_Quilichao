/**
 * verify-links.js
 * Verifica que todos los enlaces locales (href / src) referenciados en los archivos HTML existan en el repositorio.
 */

const fs = require('fs');
const path = require('path');

const HTML_FILES = ['index.html', 'catalogo.html'];
const rootDir = path.join(__dirname, '..');

console.log('🔗 Verificando enlaces y referencias locales en HTML...\n');
let hasErrors = false;

HTML_FILES.forEach((htmlFile) => {
  const filePath = path.join(rootDir, htmlFile);
  if (!fs.existsSync(filePath)) return;

  const content = fs.readFileSync(filePath, 'utf8');

  // Buscar href="..." y src="..."
  const regex = /(?:href|src)=["']([^"']+)["']/g;
  let match;

  while ((match = regex.exec(content)) !== null) {
    const rawTarget = match[1].trim();

    // Ignorar anclas internas (#), protocolos web (http://, https://, //, mailto:, tel:)
    if (
      rawTarget.startsWith('#') ||
      rawTarget.startsWith('http://') ||
      rawTarget.startsWith('https://') ||
      rawTarget.startsWith('//') ||
      rawTarget.startsWith('mailto:') ||
      rawTarget.startsWith('tel:')
    ) {
      continue;
    }

    // Remover posibles query strings (# o ?)
    const cleanTarget = rawTarget.split('#')[0].split('?')[0];
    if (!cleanTarget) continue;

    const targetFullPath = path.join(rootDir, cleanTarget);
    if (!fs.existsSync(targetFullPath)) {
      console.error(`❌ [ENLACE ROTO] En ${htmlFile}: La referencia "${rawTarget}" no existe en el disco.`);
      hasErrors = true;
    } else {
      console.log(`✅ [OK] ${htmlFile} -> ${rawTarget}`);
    }
  }
});

if (hasErrors) {
  console.error('\n❌ Se encontraron enlaces rotos en las páginas HTML.');
  process.exit(1);
} else {
  console.log('\n✨ Todas las referencias internas de archivos son válidas.');
  process.exit(0);
}
