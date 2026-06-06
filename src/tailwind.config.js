/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        '../../vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        '../../storage/framework/views/*.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                inter: ['Inter', 'sans-serif'],
            },
            colors: {
                'colab-blue':           '#2563EB',
                'colab-blue-dark':      '#1D4ED8',
                'colab-blue-super-dark':'#002EA1',
                'colab-blue-light':     '#3B82F6',
                'colab-cyan':           '#38BDF8',
                'colab-gray':           '#E6E6E6',
                'colab-gray-light':     '#F5F5F5',
                'colab-input':          '#F9FAFB',
                'card-blue':            '#1877F2',
            },
            animation: {
                'fade-in-up':    'fadeInUp 0.6s ease-out forwards',
                'fade-in-right': 'fadeInRight 0.8s ease-out forwards',
                'slide-in-left': 'slideInLeft 0.5s ease-out forwards',
                'float':         'float 4s ease-in-out infinite',
                'rotate-slow':   'rotateSlow 20s linear infinite',
            },
            keyframes: {
                fadeInUp: {
                    from: { opacity: '0', transform: 'translateY(20px)' },
                    to:   { opacity: '1', transform: 'translateY(0)' },
                },
                fadeInRight: {
                    from: { opacity: '0', transform: 'translateX(20px)' },
                    to:   { opacity: '1', transform: 'translateX(0)' },
                },
                slideInLeft: {
                    from: { opacity: '0', transform: 'translateX(-30px)' },
                    to:   { opacity: '1', transform: 'translateX(0)' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%':      { transform: 'translateY(-8px)' },
                },
                rotateSlow: {
                    from: { transform: 'rotate(0deg)' },
                    to:   { transform: 'rotate(360deg)' },
                },
            },
        },
    },
    plugins: [],
}