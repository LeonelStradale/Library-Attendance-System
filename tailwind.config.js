import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./node_modules/flowbite/**/*.js",
    ],

    theme: {
        darkMode: "media",
        extend: {
            colors: {
                primary: {
                    50: "#eef6ff",
                    100: "#d9eaff",
                    200: "#bbdaff",
                    300: "#8dc4ff",
                    400: "#57a2ff",
                    500: "#307dff",
                    600: "#195df7",
                    700: "#1247e3",
                    800: "#1539b8",
                    900: "#19399a",
                    950: "#132258",
                },
            },
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, typography, require("flowbite/plugin")],
};
