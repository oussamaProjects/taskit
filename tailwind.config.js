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
            xxs: ".5rem",
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
                    "Arimo",
                    "Poppins",
                    "Libre Baskerville",
                    ...defaultTheme.fontFamily.sans
                ]
            },
            colors: {
                lime: "#b7b063",
                amber: "#d8c7bf",
                // blue: "#407986",
                // cyan: "#6384a2",
                // main: "#1f2937",
                // secondary: "#0091D5",
                // "bg-color": "#FEFEFE",
                main: "#000000",
                secondary: "#2D1E8A",
                tertiary: "#FDC910",
                "bg-color": "#ECF3FE",
            },
            maxHeight: {
                "1/3": "33.333334%",
                "1/2": "50%",
                "2/3": "66.666667%"
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
