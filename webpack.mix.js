const mix = require('laravel-mix')
const tailwindcss = require('tailwindcss');

mix
    .setPublicPath('./dist')
    .browserSync({
        proxy: 'https://mvfglobal.test',
        injectChanges: true,
        open: true,
        files: [
            'dist/**/*.{css,js}',
            'src/Resources/views/**/*.php',
            'src/Resources/js/**/*.{vue,js}'
        ]
    })
    .js('src/Resources/assets/js/app.js', 'js').vue()
    .sass('src/Resources/assets/css/app.scss', 'css')
    .options({
        postCss: [
            tailwindcss('./tailwind.config.js')
        ]
    })
