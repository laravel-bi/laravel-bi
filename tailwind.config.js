const generateRem = function (limit, extra = {}) {
    return Object.assign(
        {},
        [...Array(limit).keys()].reduce((o, n) => {
            o[n] = n / 10 + 'rem';
            return o;
        }, {}),
        extra
    );
};
module.exports = {
    theme: {
        fontFamily: {
            lato: 'Lato, sans-serif'
        },

        extend: {
            height: {
                'widget-sm': '200px'
            },
            width: {
                'filter-dropdown-sm': '250px',
                'filter-dropdown-md': '350px',
            }
        },
    },

    plugins: []
};
