import camelCase from 'lodash/camelCase'
const requireModule = require.context('./modules', false, /\.js$/)
const modules = {}

requireModule.keys().forEach(fileName => {
  if(fileName == './index.js') return

  const moduleName = camelCase(
    fileName.replace(/(\.\/|\.js)/g, '')
  )

  modules[moduleName] = {
    namespaced: false,
    ...requireModule(fileName).default
  }

})

export default modules