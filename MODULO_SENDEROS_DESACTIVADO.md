# Copia del módulo de senderos desactivado

El módulo **Senderos Ecológicos y Rutas de Naturaleza** fue retirado temporalmente de la portada el 13 de noviembre de 2026 porque sus nombres, imágenes y recorridos todavía deben verificarse.

No se eliminó su contenido. La copia se conserva en:

- `resources/views/public/index.blade.php`, dentro del bloque `@if(false)` marcado como `MÓDULO: SENDEROS Y RUTAS INTERACTIVAS`.
- `public/js/routes-data.js`.
- `public/js/routes-module.js`.
- `public/img/rutas/`.

La versión completa anterior también permanece en el historial Git, commit `9b7cfba`.

## Restauración

1. Cambiar `@if(false)` por `@if(true)` en `resources/views/public/index.blade.php`.
2. Volver a incluir al final de esa vista:

```blade
<script src="{{ asset('js/routes-data.js') }}"></script>
<script src="{{ asset('js/routes-module.js') }}"></script>
```

Antes de restaurarlo, se deben sustituir los nombres, coordenadas, descripciones e imágenes por información local verificada.
