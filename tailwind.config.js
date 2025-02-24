import defaultTheme from 'tailwindcss/defaultTheme'

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

            width: {
                'amna-app': '78.125rem',
                'amna-content-lg': '41.875rem',
                'amna-app-content-md': '43.5rem',
            },
            height: {
                'amna-logo': '4.5rem',
            },
            colors: {
                amna: {
                    primary: {
                        100: '#010360',
                        200: '#011c60',
                    },

                    secondary: {
                        100: '#facfcf',
                        200: '#f69fa0',
                        300: '#f16e70',
                        400: '#ed3e41',
                        500: '#e80e11',
                        600: '#ba0b0e',
                        700: '#8b080a',
                        800: '#5d0607',
                        900: '#2e0303',
                    },

                    terciary: {
                        100: '#d3e7d2',
                        200: '#a6cea5',
                        300: '#7ab678',
                        400: '#4d9d4b',
                        500: '#21851e',
                        600: '#1a6a18',
                        700: '#145012',
                        800: '#0d350c',
                        900: '#071b06',
                    },

                    confirm: '#21851e',
                    cancel: '#fe0e26',
                    backgound: '#EAEAEA',
                },
            },
        },
    },
    plugins: [],
}
