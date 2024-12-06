/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode:"class",
  content: [
		"./resources/**/*.blade.php",
		"./resources/**/*.js",
		'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
		"./vendor/developermithu/tallcraftui/src/View/Components/**/*.php",
	],
  theme: {
    extend: {
        colors: {
            primary: "#6d28d9",
            secondary: "#a21caf",
        }
    },
  },
  plugins: [],
}

