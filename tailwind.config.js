const defaultTheme = require('tailwindcss/defaultTheme');


module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
          

            fontSize: {
                'title': '3.125rem',
            }


        },

        //   colors: {
        //       'grey':'#54565b',
        //     maroon:'#800000',
        //   },
    },


    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
