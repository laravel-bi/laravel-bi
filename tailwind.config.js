const theme = require("tailwindcss/defaultTheme");

const generateRem = function(limit, extra = {}) {
    return Object.assign(
        {},
        [...Array(limit).keys()].reduce((o, n) => {
            o[n] = n / 10 + "rem";
            return o;
        }, {}),
        extra
    );
};
module.exports = {
    theme: {
        fontFamily: {
            muli: "Muli, sans-serif"
        },
        fontSize: generateRem(30, {
            "big-number": "5rem"
        }),
        borderRadius: generateRem(30, {
            none: "0px"
        }),
        colors: {
            background: "#FAFAFA",
            head: "rgb(45, 50, 62)",
            header: "#f5f5f5",
            widget: "white",
            "widget-border": "rgba(0, 0, 0, 0.12)",
            text: "rgba(0, 0, 0, 0.87)",
            icon: "rgba(0, 0, 0, 0.50)",
            "table-head": "rgba(0, 0, 0, 0.54)",
            btn: "#039be5",
            "btn-h": "#0288d1",
            white: "white",
            nav: 'rgb(45, 50, 62)',
            gray: {
                100: "#EAEAEA",
                "100-alpha": "rgba(234, 234, 234, .5)",
                200: "#DDD",
                300: "#BBB",
                400: "#888",
                500: "#666",
                600: "#444",
                700: "#333",
                800: "#222",
                900: "#111"
            }
        },
        height: {
            "head-box": "8rem",
            header: "4.8rem",
            "widget-sm": 150,
            "widget-md": 250,
            "widget-lg": 400,
            full: "100%"
        },
        spacing: generateRem(30, {
            'head-box': '8rem'
        }),

        extend: {
            width: generateRem(50, {
                "filter-dropdown": "30rem",
                "filter-dropdown-lg": "40rem",
                nav: "300px"
            })
        }
    },
    variants: {
        display: ["responsive", "hover", "focus", "group-hover"],
        textColor: ["responsive", "hover", "focus", "group-hover"],
        backgroundColor: ["responsive", "hover", "focus", "group-hover"]
    },
    plugins: []
};
