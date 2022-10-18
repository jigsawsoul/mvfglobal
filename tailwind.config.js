const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    content: [
        './src/Resources/assets/js/**/*.js',
        './src/Resources/assets/js/**/*.vue',
        './src/Resources/assets/css/**/*.scss',
        './src/Resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                'sans': ['Open Sans', ...defaultTheme.fontFamily.sans],
            }
        },
    }
}
