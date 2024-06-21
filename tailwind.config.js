/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./assets/**/*.js",
        "./templates/**/*.html.twig",
    ],
    theme: {
        extend: {
            colors: {
                'lana': '#E7473C',
                'lana-fond':'#F0F0F0',
            }
        },
    },
    plugins: [],

}
