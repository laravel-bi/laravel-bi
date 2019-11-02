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
            muli: 'Muli, sans-serif'
        },
        fontSize: {
            '4': '0.4rem',
            '6': '0.6rem',
            '8': '0.8rem',
            '10': '1.0rem',
            '12': '1.2rem',
            '14': '1.4rem',
            '16': '1.6rem',
            '18': '1.8rem',
            '20':  '2.0rem',
            'nav-title': '2.4rem',
            'big-number': '5rem'
        },
        borderRadius: {
            none: '0px',
            widget: '0.8rem'
        },
        colors: {
            background: '#FAFAFA',
            head: 'rgb(45, 50, 62)',
            header: '#f5f5f5',
            widget: 'white',
            'widget-border': 'rgba(0, 0, 0, 0.12)',
            text: 'rgba(0, 0, 0, 0.87)',
            icon: 'rgba(0, 0, 0, 0.50)',
            'table-head': 'rgba(0, 0, 0, 0.54)',
            btn: '#039be5',
            'btn-h': '#0288d1',
            white: 'white',
            nav: 'rgb(45, 50, 62)',
            gray: {
                100: '#EAEAEA',
                '100-alpha': 'rgba(234, 234, 234, .5)',
                200: '#DDD',
                300: '#BBB',
                400: '#888',
                500: '#666',
                600: '#444',
                700: '#333',
                800: '#222',
                900: '#111'
            }
        },
        height: {
            'head-box': '8rem',
            header: '4.8rem',
            'widget-sm': 150,
            'widget-md': 250,
            'widget-lg': 400,
            full: '100%'
        },

        spacing: {
            '4': '0.4rem',
            '6': '0.6rem',
            '8': '0.8rem',
            '10': '1.0rem',
            '12': '1.2rem',
            '14': '1.4rem',
            '16': '1.6rem',
            '18': '1.8rem',
            '20':  '2.0rem'
        },

        extend: {
            width: {
                'filter-dropdown': '30rem',
                'filter-dropdown-lg': '40rem',
                nav: '300px'
            }
        }
    },

    plugins: []
};
