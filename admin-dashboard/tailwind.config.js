module.exports = {
    purge: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
    theme: {
        extend: {
            colors: {
                'navbar-border': '#B8B9BE',
                'primary-bg': '#E0E5EC',
                'primary-color': '#FF4C60'
            },
            keyframes: {
                'accordion-down': {
                    from: { height: 0 },
                    to: { height: 'var(--radix-accordion-content-height)' }
                },
                'accordion-up': {
                    from: { height: 'var(--radix-accordion-content-height)' },
                    to: { height: 0 }
                },
                title: {
                    from: {
                        letterSpacing: 0
                    },
                    to: { letterSpacing: '2rem' }
                }
            },
            animation: {
                'accordion-down': 'accordion-down 0.2s ease-out',
                'accordion-up': 'accordion-up 0.2s ease-out',
                title: 'title .5s ease-out '
            }
        }
    },
    variants: {
        extend: {}
    }
}
