/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      ringColor: {
        DEFAULT: '#000000', // This changes the default ring color to black
      }
    }
  },
  plugins: [],
  important: true,
}