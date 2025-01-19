/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.vue",
        "./resources/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                primary: "#325077",
                secondary: "#ffcc00",
            },
            fontFamily: {
                sans: ["Inter", "Arial", "sans-serif"],
            },
        },
    },
    plugins: [],
};
