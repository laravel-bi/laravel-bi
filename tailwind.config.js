const { colors, fontSize } = require('tailwindcss/defaultTheme')

module.exports = {
  theme: {
    extend: {
      fontFamily: {
        'noto': 'Noto Sans TC, sans-serif',
        'condensed': 'Open Sans Condensed, sans-serif'
      },
      fontSize: {
        ...fontSize,
        'big-number': '3rem'
      },
      spacing: {
        header: 50,
        nav: 200,
        "closed-nav": 50
      },
      colors: {
        gray: {
          ...colors.gray,
          700: '#333',
          800: '#222',
          900: '#111'
        }
      }
    }
  },
  variants: {
    display: ['responsive', 'hover', 'focus', 'group-hover'],
    textColor: ['responsive', 'hover', 'focus', 'group-hover'],
    backgroundColor: ['responsive', 'hover', 'focus', 'group-hover']
  },
  plugins: []
}
