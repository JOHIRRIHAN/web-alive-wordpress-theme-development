/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.html',
    './*.php', // For WordPress or other PHP files
    './main.js/*.js',
  ],
    theme: {
      extend: {},
    },
    plugins: [
        require('daisyui'),
      ],
  }

  