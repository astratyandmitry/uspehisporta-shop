import Vue from 'vue'
import Basket from './components/Basket'

window.eventBus = new Vue({})

Vue.filter('formatPrice', function (value) {
  return value.toString().replace(/(\d)(?=(\d{3})+$)/g, '$1 ')
})

new Vue({
  el: '#basket',
  components: { Basket }
})
