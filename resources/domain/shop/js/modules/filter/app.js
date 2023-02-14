import Vue from 'vue'
import CatalogFilter from './components/CatalogFilter'

window.eventBus = new Vue({})

new Vue({
  el: '#filter',
  components: { CatalogFilter }
})

// window.$ = window.jQuery = require('jquery')
//
// $('.js-filter__form').on('submit', function (e) {
//   e.preventDefault()
//
//   let url = $(this).attr('action')
//   let query = []
//
//   // Categories
//   let categories = []
//
//   $('.js-filter__category-input:checked').each(function () {
//     categories.push($(this).val())
//   })
//
//   if (categories.length) {
//     query.push(`category=${categories.join(',')}`)
//   }
//
//   // Brands
//   let brands = []
//
//   $('.js-filter__brand-input:checked').each(function () {
//     brands.push($(this).val())
//   })
//
//   if (brands.length) {
//     query.push(`brand=${brands.join(',')}`)
//   }
//
//   // Other
//   query.push(`price_from=${$('.js-filter__price-from').val()}`)
//   query.push(`price_to=${$('.js-filter__price-to').val()}`)
//
//   if ($('.js-filter__discount').is(':checked')) {
//     query.push('discount=1')
//   }
//
//   if (query.length) {
//     url += `?${query.join('&')}`
//   }
//
//   window.location.href = url
// })
