# BioAves Quilichao 🦅🌿
**Plataforma Web de Observación, Identificación y Conservación de Aves de Santander de Quilichao, Cauca**

---

## 1. Visión del Proyecto y Directriz Visual

**BioAves Quilichao** es una plataforma orientada a la ciencia ciudadana, el aviturismo responsable y la conservación de la biodiversidad aviar en el municipio de Santander de Quilichao, departamento del Cauca, Colombia.

### 🎨 Regla Visual Estricta: Prototipo de Baja Fidelidad (Grayscale Wireframe)
Tanto la interfaz pública como el panel administrativo respetan con fidelidad la paleta monocromática de escala de grises aprobada:
- **Fondo:** `#FFFFFF` (Blanco)
- **Contenedores y superficies:** `#F2F2F2` (Gris claro)
- **Elementos secundarios:** `#D0D0D0` (Gris medio)
- **Bordes y divisores:** `#B0B0B0` (Gris línea)
- **Texto principal:** `#333333` (Gris oscuro)
- **Texto secundario:** `#777777` (Gris tenue)
- **Bordes rectos:** Estilo técnico wireframe (`rounded-sm`).
- **Placeholders textuales:** `[PLACEHOLDER DE FOTOGRAFÍA]`, `[PLACEHOLDER DE VIDEO]`, `[PLACEHOLDER DE AUDIO]`.

---

## 2. Arquitectura de Software

La aplicación sigue el patrón **Monolito Modular (MVC)** en **Laravel 12**, combinando velocidad de despliegue, seguridad por diseño y persistencia robusta.

```
AvesQuilichao/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/             # Dashboard, Especies, Avistamientos, Auditoría
│   │   │   ├── Api/               # GeoJSON avistamientos y API REST de especies
│   │   │   ├── Auth/              # Autenticación administrativa con rate-limiting
│   │   │   ├── CatalogController  # Catálogo general y ficha permalink
│   │   │   └── HomeController     # Portada interactiva
│   │   └── Requests/              # Validaciones de formularios
│   ├── Jobs/                      # Procesamiento asíncrono de variantes multimedia
│   ├── Models/                    # Eloquent Models (RBAC, Taxonomía, Avistamientos, etc.)
│   ├── Policies/                  # Políticas de autorización granulares
│   └── Services/                  # Servicio de carga multimedia y almacenamiento
├── config/                        # Configuraciones de filesystem (R2 S3-compatible, local)
├── database/
│   ├── migrations/                # 11 migraciones completas (PostgreSQL / SQLite)
│   └── seeders/                   # Semillas con 8 especies, avistamientos, roles y usuarios
├── docker/
│   └── nginx/default.conf         # Configuración Nginx optimizada
├── resources/views/
│   ├── admin/                     # Vistas del panel de administración (Wireframe)
│   ├── auth/                      # Login administrativo wireframe
│   └── public/                    # Portada, Catálogo y Ficha detallada
├── routes/
│   ├── api.php                    # Endpoints GeoJSON y REST v1
│   └── web.php                    # Rutas públicas y panel administrativo protegido
├── tests/
│   └── Feature/                   # Suite de pruebas automatizadas (18 tests)
├── compose.yaml                   # Orquestación con Docker Compose
├── Dockerfile                     # Contenedor PHP 8.2-FPM Alpine
└── .github/workflows/ci.yml       # Integración continua (CI/CD)
```

---

## 3. Credenciales de Prueba (Entorno de Demostración)

La base de datos incluye cuentas precargadas con diferentes roles y permisos:

| Rol | Correo Electrónico | Contraseña | Permisos |
| :--- | :--- | :--- | :--- |
| **Administrador** | `admin@bioavesquilichao.co` | `AdminBioAves2026!` | Acceso total al sistema, auditoría y configuración. |
| **Biólogo / Curador** | `biologo@bioavesquilichao.co` | `Biologo2026!` | Gestión del catálogo taxonómico y aprobación técnica de avistamientos. |
| **Revisor de Campo** | `revisor@bioavesquilichao.co` | `Revisor2026!` | Moderación y validación territorial de avistamientos comunitarios. |
| **Observador Comunitario**| `observador@bioavesquilichao.co` | `Observador2026!` | Registro de observaciones y consulta general. |

---

## 4. Instalación y Puesta en Marcha

### Opción A: Ejecución Local Rápida (PHP + SQLite)

1. **Instalar dependencias de Composer:**
   ```bash
   composer install
   ```

2. **Configurar el archivo `.env`:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Ejecutar migraciones y semillero de datos:**
   ```bash
   php artisan migrate:fresh --seed
   ```

4. **Iniciar el servidor local de desarrollo:**
   ```bash
   php artisan serve
   ```
   Acceder a: `http://localhost:8000`

---

### Opción B: Despliegue con Docker Compose (PostgreSQL 16 + PostGIS + Redis + Nginx)

1. **Copiar variables de entorno Docker:**
   ```bash
   cp .env.docker .env
   ```

2. **Construir y levantar contenedores:**
   ```bash
   docker compose up -d --build
   ```

3. **Ejecutar migraciones y semillero dentro del contenedor:**
   ```bash
   docker compose exec app php artisan migrate:fresh --seed
   ```

4. **Acceder a la aplicación:**
   - **Sitio Web:** `http://localhost:8080`
   - **Panel Administrativo:** `http://localhost:8080/login`
   - **PostgreSQL / PostGIS:** Puerto `54320`
   - **Redis:** Puerto `63790`

---

## 5. Endpoints de la API REST y GeoJSON

| Método | Endpoint | Descripción |
| :---: | :--- | :--- |
| `GET` | `/api/v1/species` | Listado completo de especies catalogadas en formato JSON. |
| `GET` | `/api/v1/species/{slug}` | Ficha biológica detallada de una especie por su identificador. |
| `GET` | `/api/v1/sightings/geojson` | **Colección GeoJSON (`FeatureCollection`)** con coordenadas de avistamientos para Leaflet/QGIS. |
| `GET` | `/api/v1/sightings/stats` | Métricas estadísticas de observaciones validadas en el municipio. |

---

## 6. Pruebas Automatizadas y Verificación de Integridad

Para verificar que todos los módulos funcionan correctamente:

```bash
# Ejecutar suite de pruebas unitarias y de integración (PHPUnit)
php artisan test

# Verificar integridad de archivos y prototipo estático
node scripts/verify-files.js
node scripts/verify-links.js
```

---

## 7. Licencia y Créditos
- **Proyecto:** BioAves Quilichao (2026).
- **Municipio:** Santander de Quilichao, Departamento del Cauca, Colombia.
- **Audios:** Colección Xeno-Canto y Wikimedia Commons bajo licencias libres Creative Commons. 
