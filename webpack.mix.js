let mix = require('laravel-mix');

mix.setPublicPath(`public`);

mix.webpackConfig({
    externals: {
        // vue: 'Vue',
    },
});
mix
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/mounts-app.js', 'public/js')
    .browserSync({
        proxy: 'https://blog.finuras.io.test'
    })

mix
    .sourceMaps()
    .version()
