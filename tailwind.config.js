const defaultTheme = require("tailwindcss/defaultTheme");
module.exports = {
    purge: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue"
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        fontSize: {
            xs: ".6rem",
            sm: ".75rem",
            tiny: ".875rem",
            base: "1rem",
            lg: "1.125rem",
            xl: "1.25rem",
            "2xl": "1.5rem",
            "3xl": "1.875rem",
            "4xl": "2.25rem",
            "5xl": "3rem",
            "6xl": "4rem",
            "7xl": "5rem"
        },

        extend: {
            fontFamily: {
                sans: [
                    "Poppins",
                    "Libre Baskerville",
                    ...defaultTheme.fontFamily.sans
                ]
            },
            colors: {
                'bg-color': "#FFFAF0",
                // blue: "#407986",
                main: "#407986",
                lime: "#b7b063",
                secondary: "#6384a2",
                // cyan: "#6384a2",
                amber: "#d8c7bf"
            }
        }
    },
    variants: {
        extend: {}
    },
    plugins: [
        // require("@tailwindcss-plugins/pagination")({
        //     /* Customizations here */
        // })
    ]
};
