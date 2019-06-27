import Vue from 'vue'
// See:
// https://vuejs.org/v2/guide/components-registration.html#Automatic-Global-Registration-of-Base-Components
// https://github.com/chrisvfritz/vue-enterprise-boilerplate/blob/master/src/components/_globals.js

const requireComponent = require.context(
  // The relative path of the components folder
  '../components',
  // Whether or not to look in subfolders
  false,
  // The regular expression used to match base component filenames
  /[A-Z]\w+\.(vue|js)$/
)

requireComponent.keys().forEach(fileName => {
  // Get component config
  const componentConfig = requireComponent(fileName)

  // Get component name
  // const componentName = 'Base' +
  const componentName = fileName
    .split('/')
    .pop()
    .replace(/\.\w+$/, '')

  // Register component globally
  Vue.component(
    componentName,
    // Look for the component options on `.default`, which will
    // exist if the component was exported with `export default`,
    // otherwise fall back to module's root.
    componentConfig.default || componentConfig
  )
})
