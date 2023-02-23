<template>
  <div class="products__filter">
    <div class="products__filter__main">

      <div class="container">
        <div class="products__filter__grid js-filter__form">
          <div>
            <catalog-filter-dropdown v-if="categories.length" :options="categories" :value="inputCategory" eng="category" label="Категория"/>

            <catalog-filter-dropdown :options="brands" :value="inputBrand" eng="brand" label="Бренд"/>

            <catalog-filter-price :min="priceMin" :max="priceMax" :from="inputPriceFrom" :to="inputPriceTo"/>

            <catalog-filter-discount :checked="inputDiscount"/>
          </div>

          <catalog-filter-actions :apply-button-visible="applyButton" :reset-url="resetUrl"/>
        </div>
      </div>
    </div>

    <div class="products__filter__additional">
      <div class="container">
        <div class="products__filter__grid products__filter__grid--fix">
          <catalog-filter-stats :total="total"/>

          <catalog-filter-sorting :options="sorting" :value="inputSorting" :url="sortingUrl"/>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import CatalogFilterStats from './CatalogFilterStats'
import CatalogFilterSorting from './CatalogFilterSorting'
import CatalogFilterActions from './CatalogFilterActions'
import CatalogFilterDiscount from './CatalogFilterDiscount'
import CatalogFilterPrice from './CatalogFilterPrice'
import CatalogFilterDropdown from './CatalogFilterDropdown'

export default {
  name: 'CatalogFilter',
  components: {
    CatalogFilterDropdown,
    CatalogFilterPrice,
    CatalogFilterDiscount,
    CatalogFilterActions,
    CatalogFilterSorting,
    CatalogFilterStats
  },
  props: {
    total: {
      type: Number,
      required: true,
    },
    categories: {
      type: Array,
      required: true,
    },
    brands: {
      type: Array,
      required: true,
    },
    sorting: {
      type: Object,
      required: true,
    },
    priceMin: {
      type: Number,
      required: true,
    },
    priceMax: {
      type: Number,
      required: true,
    },
    inputCategory: {
      type: Array,
      required: true,
    },
    inputBrand: {
      type: Array,
      required: true,
    },
    inputPriceFrom: {
      type: Number,
      required: true,
    },
    inputPriceTo: {
      type: Number,
      required: true,
    },
    inputSorting: {
      type: String,
      required: true,
    },
    inputDiscount: {
      type: Boolean,
      required: true,
    },
    resetUrl: {
      type: String,
      required: true,
    },
    sortingUrl: {
      type: String,
      required: true,
    },
  },
  created () {
    this.filter.category = this.inputCategory
    this.filter.brand = this.inputBrand
    this.filter.priceFrom = this.inputPriceFrom
    this.filter.priceTo = this.inputPriceTo
    this.filter.discount = this.inputDiscount

    window.eventBus.$on('input.category', (value) => this.updateInput('country', value))
    window.eventBus.$on('input.brand', (value) => this.updateInput('brand', value))
    window.eventBus.$on('input.price-from', (value) => this.updateInput('priceFrom', value))
    window.eventBus.$on('input.price-to', (value) => this.updateInput('priceTo', value))
    window.eventBus.$on('input.discount', (value) => this.updateInput('discount', value))

    window.eventBus.$on('apply-filter', this.applyFilter)

    this.$nextTick(() => {
      this.watcherStarted = true
    })
  },
  data () {
    return {
      applyButton: false,
      watcherStarted: false,
      filter: {
        category: [],
        brand: [],
        priceFrom: 0,
        priceTo: 0,
        discount: false,
      },
    }
  },
  methods: {
    updateInput (input, value) {
      this.filter[input] = value
    },
    applyFilter () {
      let params = []

      if (this.filter.category.length) {
        params.push(`category=${this.filter.category.join(',')}`)
      }

      if (this.filter.brand.length) {
        params.push(`brand=${this.filter.brand.join(',')}`)
      }

      params.push(`price_from=${this.filter.priceFrom}`)
      params.push(`price_to=${this.filter.priceTo}`)

      if (this.filter.discount) {
        params.push('discount=1')
      }

      window.location.href = `${this.resetUrl}?${params.join('&')}`
    },
  },
  watch: {
    filter: {
      deep: true,
      handler () {
        if (this.watcherStarted && !this.applyButton) {
          this.applyButton = true
        }
      },
    },
  },
}
</script>
