# BioAves Quilichao — proyecto nuevo (Laravel 12)

## Primera vez (Windows, en la carpeta del proyecto)
    php artisan optimize:clear
    php artisan migrate:fresh --seed
    php artisan serve
Abre http://127.0.0.1:8000

Si falla por la carpeta `vendor`: ejecuta `composer install` y repite.
Usa una carpeta FUERA de OneDrive (por ejemplo C:\proyectos\Aves_de_Quilichao): OneDrive bloquea los archivos de caché de Laravel.

## Dónde poner tus imágenes (carpeta public/)
- public/video/hero.mp4        video de fondo de la portada (sin texto, ~10-20 s, menos de 8 MB)
- public/img/hero-ave.jpg      foto de respaldo de la portada
- public/img/mision.jpg        foto de la sección "Conservar para el futuro"
- public/img/aves/<id>.jpg     una foto por ave (id de public/js/birds-data.js)

## Diseño
- Estilos: public/css/styles.css  · Vistas: resources/views/public/ y resources/views/partials/ (header y footer)
