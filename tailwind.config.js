const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                'sans-Timenew': "Times New Roman",
            },
            backgroundImage: {
                'logo_background': "url('/images/Logo/logoGG.png')",

                'norepeat': 'norepeat',
            },
            backgroundSize: {
                'auto': 'auto',
                'cover': 'cover',
                'contain': 'contain',
                '10': '50%'
            }

        },

    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};