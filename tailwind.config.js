/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: ["./resources/**/*.{html,js,php}"],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}

