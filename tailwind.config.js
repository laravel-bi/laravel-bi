const { colors, fontSize } = require("tailwindcss/defaultTheme");

module.exports = {
    theme: {
        extend: {
            fontFamily: {
                noto: "Noto Sans TC, sans-serif",
                condensed: "Open Sans Condensed, sans-serif"
            },
            fontSize: {
                ...fontSize,
                "big-number": "3rem"
            },
            colors: {
                gray: {
                    ...colors.gray,
                    700: "#333",
                    800: "#222",
                    900: "#111",
                    background: "#EAEAEA",
                    "nav-active": "#333",
                    nav: "#212121"
                }
            },
            height: {
                "widget-sm": 100,
                "widget-md": 250,
                "widget-lg": 400,
                header: 50
            },
            width: {
                nav: 200,
                "closed-nav": 50
            }
        }
    },
    variants: {
        display: ["responsive", "hover", "focus", "group-hover"],
        textColor: ["responsive", "hover", "focus", "group-hover"],
        backgroundColor: ["responsive", "hover", "focus", "group-hover"]
    },
    plugins: []
};
