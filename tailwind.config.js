module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
  ],
  theme: {
    extend: {
      animation: ['motion-reduce'],
    }
  },
  variants: {
    
    extend: {
      maxHeight: ['focus', 'active'],
      backgroundColor: ['responsive', 'focus', 'active', 'hover', 'group-focus' ],
      fontSize: ['active']
    }
  },
  plugins: [
    require('@tailwindcss/ui'),
  ]
}
