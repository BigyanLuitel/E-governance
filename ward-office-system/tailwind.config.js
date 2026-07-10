import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['"Source Sans 3"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                navy: {
                    900: '#14273F',
                    800: '#1B334F',
                    700: '#1F4E79',
                    50: '#EAF0F6',
                },
                govgreen: {
                    800: '#2F5D3A',
                    50: '#EAF3EC',
                },
                maroon: {
                    800: '#7A2530',
                    50: '#F7EAEB',
                },
                ink: {
                    900: '#1E2530',
                    600: '#4B5563',
                },
            },
        },
    },

    plugins: [forms],
};