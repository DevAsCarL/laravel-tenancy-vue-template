const path = require('path')

export default defineConfig({
  resolve:{
    alias:{
      '@modules' : path.resolve(__dirname + '/modules')
    },
  }
})