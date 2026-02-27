import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                // sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Brand colors
                'brand-blue': {
                    DEFAULT: '#347dbe',
                    dark: '#357ABD',
                    light: '#4A90E2',
                },
                // Dark theme colors
                'dark': {
                    primary: '#0F0F23',
                    secondary: '#1A1A2E',
                    tertiary: '#16213E',
                    accent: '#F3F4F6',
                    muted: '#9CA3AF',
                    border: '#374151',
                }
            },
        },
    },

    plugins: [forms, typography],
};
