/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './src/**/*.{html,js}', 
    './*.php',
    './**/*.php',
  ],
  theme: {
    colors: {
      'dark': '#201e50',
      'pink': '#ba2c73',
      'dark-lighter': '#4d4e7c',
      'dark-darker': '#1d1e42',
      'white': '#fff',
      'grey': '#f0f1f2',
    },
    extend: {
      maxWidth:{
        390: '390px !important',
      },
      maxHeight: {
        290: '290px !important',
      },
      minHeight: {
        312: '312px !important',
      },
      padding: {
        12: '12px',
      }
    },
  },
  plugins: [],
}