// Tempel bagian "keyframes" dan "animation" ini ke dalam theme.extend
// di tailwind.config.js kamu, sejajar dengan "colors" dan "fontFamily"
// yang sudah ditambahkan sebelumnya.

module.exports = {
  theme: {
    extend: {
      keyframes: {
        'fade-up': {
          '0%': { opacity: '0', transform: 'translateY(14px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
        'fade-in': {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        float: {
          '0%, 100%': { transform: 'translateY(0)' },
          '50%': { transform: 'translateY(-6px)' },
        },
        'spin-slow': {
          '0%': { transform: 'rotate(0deg)' },
          '100%': { transform: 'rotate(360deg)' },
        },
        'glow-pulse': {
          '0%, 100%': { boxShadow: '0 0 0 0 rgba(94,234,212,0.35)' },
          '50%': { boxShadow: '0 0 0 6px rgba(94,234,212,0)' },
        },
        shimmer: {
          '0%': { backgroundPosition: '-200% 0' },
          '100%': { backgroundPosition: '200% 0' },
        },
      },
      animation: {
        'fade-up': 'fade-up 0.6s ease-out both',
        'fade-in': 'fade-in 0.6s ease-out both',
        float: 'float 4s ease-in-out infinite',
        'spin-slow': 'spin-slow 18s linear infinite',
        'glow-pulse': 'glow-pulse 2.2s ease-out infinite',
        shimmer: 'shimmer 2.5s linear infinite',
      },
    },
  },
}
