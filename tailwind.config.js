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
                    50: "#eff2fe",
                    100: "#e3e6fc",
                    200: "#ccd1f9",
                    300: "#adb3f4",
                    400: "#8b8bee",
                    500: "#766fe5",
                    600: "#6754d7",
                    700: "#5945bd",
                    800: "#42358c",
                    900: "#3e357a",
                    950: "#261f47",
                },
            },
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, typography, require("flowbite/plugin")],
};
