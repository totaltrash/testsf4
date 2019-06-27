import '../css/app.scss'

import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import $ from 'jquery'
import 'bootstrap/js/src'
import './plugins/base_components'

global.Vue = Vue
global.$ = global.jQuery = $

Vue.use(BootstrapVue)

new Vue({
  el: '#app',
  data: {
    message: 'hello'
  }
})
