const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

// Configuración de Laravel Mix
mix.js('resources/js/app.js', 'public/js')       // Compila archivos JS
   .vue({ version: 3 })                          // Habilita la compilación de archivos Vue (Vue 3)
   .sass('resources/sass/app.scss', 'public/css')// Compila archivos SASS a CSS
   .options({
       processCssUrls: false,                     // Opcional: evitar la reescritura de URLs en CSS
       postCss: [
           tailwindcss('./tailwind.config.js'),   // Configura Tailwind CSS
           require('autoprefixer'),               // Autoprefixer para compatibilidad entre navegadores
       ],
   })
   .version();                                   // Añade un hash a los archivos para el versionado

// Modo de desarrollo
if (!mix.inProduction()) {
    mix.webpackConfig({
        devtool: 'source-map'
    }).sourceMaps();
}

// Modo de producción
if (mix.inProduction()) {
    mix.version();
}
