module.exports = {
    content: [   
        "./resources/**/*.blade.php",    
        "./resources/**/*.js",    
        "./resources/**/*.vue",  
    ],
    safelist: [
        {
            pattern: /^w-/
        }
    ],
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
