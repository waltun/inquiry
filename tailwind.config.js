module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    theme: {
        extend: {
            fontFamily: {
                IRANSans: ['IRANSans'],
                Titr: ['Titr']
            },
            colors: {
                myYellow: {
                    100: '#F9A803'
                },
                myRed: {
                    100: '#FE2603',
                    200: '#F71717',
                    300: '#EF4444'
                },
                myBlue: {
                    100: '#0945F5',
                    200: '#517BF2',
                    300: '#379AFF',
                    900: '#130F2D',
                },
                mySky: {
                    100: '#09F5E7',
                    200: '#7485B1',
                },
                myGray: {
                    100: '#3C3C3C'
                },
                myGreen: {
                    100: '#22C55E'
                }
            },
            boxShadow: {
                'yellow': '0px 9px 25px rgba(249, 168, 3, 0.5)',
                'aside': '-7px 4px 159px rgba(0, 0, 0, 0.05)',
                'search': '0px 9px 42px rgba(0, 0, 0, 0.06)',
                'aside-active': '-1px -1px 15px rgba(9, 69, 245, 0.33)',
                'card-hover': '19px 27px 38px rgba(6, 86, 242, 0.33)',
            }
        },
    },
    plugins: [],
    darkMode: 'class'
}
