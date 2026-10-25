import defaultTheme from 'tailwindcss/defaultTheme';
import colors from 'tailwindcss/colors';
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

    // accent-* is built from config/products.php ('accent' key), so Tailwind cannot see it in the views
    safelist: ['accent-brand', 'accent-saffron', 'accent-emerald', 'accent-tymelo', 'accent-terracotta'],

    theme: {
        extend: {
            fontFamily: {
                // sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
                // Small uppercase labels (400, 500)
                mono: ['"JetBrains Mono"', ...defaultTheme.fontFamily.mono],
                // Only for the "Tymelo" wordmark chip (700)
                jakarta: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Brand colors
                'brand-blue': {
                    DEFAULT: '#347dbe',
                    dark: '#357ABD',
                    light: '#4A90E2',
                },
                // LebaSouk POS product accent (matches lebasouk.build-syntax.com --color-accent)
                'lebasouk': '#e2673f',
                // Product accents (homepage product cards, showcase tabs)
                'saffron': '#E5A526', // CarteNex
                // Keep Tailwind's emerald scale and add the ShopNex accent as DEFAULT
                'emerald': { ...colors.emerald, DEFAULT: '#10B981' }, // ShopNex
                'tymelo': '#1D9E75', // Tymelo
                'terracotta': '#E2673F', // LebaSouk POS
                // Text on bright brand/WhatsApp surfaces
                'ink': '#06101C',
                'whatsapp': {
                    DEFAULT: '#25D366',
                    ink: '#04150A',
                },
                // Dark theme colors
                'dark': {
                    primary: '#0F0F23',
                    secondary: '#1A1A2E',
                    tertiary: '#16213E',
                    accent: '#F3F4F6',
                    muted: '#9CA3AF',
                    border: '#374151',
                    line: '#2C3050',
                }
            },
        },
    },

    plugins: [forms, typography],
};
