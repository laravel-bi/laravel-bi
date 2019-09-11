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
                    100: '#EAEAEA',
                    200: '#DDD',
                    300: '#BBB',
                    400: '#888',
                    500: '#666',
                    600: '#444',
                    700: "#333",
                    800: "#222",
                    900: "#111"
                },
                background: "#EAEAEA",
                "nav-active": "#333",
                nav: "#212121",
                primary: {
                    100: "#FFEEEE",
                    200: "#FFD5D5",
                    300: "#FFBBBB",
                    400: "#FF8888",
                    500: "#FF5555",
                    600: "#E64D4D",
                    700: "#993333",
                    800: "#732626",
                    900: "#4D1A1A",
                    default: "#FF5555"
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
