import Vue from 'vue';
import ProductBasket from './components/ProductBasket'
import ProductItemBasket from './components/ProductItemBasket'
import ProductGallery from './components/ProductGallery'

window.eventBus = new Vue({})

new Vue({
  el: '#product',
  components: { ProductBasket, ProductItemBasket, ProductGallery }
})
