/** @type {import('tailwindcss').Config} */
export default {
  content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
  ],
  theme: {
    extend: {
        colors: {
            'primary': '#0d91b7',
            'secondary': '#c7eef8',
            'tertiary': '#ebf9ff'
        },
        backgroundSize: {
            'size-200': '200% 200%',
        },
        backgroundPosition: {
            'pos-0': '0% 0%',
            'pos-100': '100% 0%',
        },
    },
  },
  plugins: [
      require('daisyui'),
      require('tailwindcss-animated'),
  ],
}

