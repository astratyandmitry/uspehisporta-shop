<template>
  <div class="products__filter__actions">
    <button type="button" class="reset" @click="resetFilter">
      <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="reset__icon">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
      </svg>

      Сбросить
    </button>

    <button type="button" class="apply" @click="applyFilter" v-show="applyButtonVisible">
      <svg fill="none" width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" class="reset__icon">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
      </svg>

      Применить
    </button>
  </div>
</template>

<script>
export default {
  name: 'CatalogFilterActions',
  props: {
    applyButtonVisible: {
      type: Boolean,
      default: false,
    },
    resetUrl: {
      type: String,
      required: true
    },
  },
  methods: {
    resetFilter () {
      window.location.href = this.resetUrl
    },
    applyFilter () {
      window.eventBus.$emit('apply-filter')
    },
  },
}
</script>
