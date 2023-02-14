<template>
  <div class="filter">
    <div class="filter__button">
      <div class="filter__value">
        {{ label }}
      </div>

      <svg width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
           fill="none" stroke-linecap="round" stroke-linejoin="round" class="filter__icon">
        <path stroke="none" d="M0 0h24v24H0z"/>
        <polyline points="6 9 12 15 18 9"/>
      </svg>
    </div>

    <div class="filter__dropdown filter__dropdown--right">
      <div class="filter-menu">
        <div class="filter-menu__list">
          <div class="filter-menu__item" v-for="(sortingLabel, sortingValue) in options" :key="sortingValue">
            <div @click="changeSorting(sortingValue)" class="filter-menu__label" v-show="sortingValue !== value">
              {{ sortingLabel }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'CatalogFilterSorting',
  props: {
    url: {
      type: String,
      required: true,
    },
    options: {
      type: Object,
      required: true,
    },
    value: {
      type: String,
      required: true,
    },
  },
  computed: {
    label () {
      return this.options[this.value]
    },
  },
  methods: {
    changeSorting (sorting) {
      let symbol = this.url.includes('?') ? '&' : '?'

      window.location.href = `${this.url}${symbol}sort=${sorting}`
    }
  }
}
</script>
