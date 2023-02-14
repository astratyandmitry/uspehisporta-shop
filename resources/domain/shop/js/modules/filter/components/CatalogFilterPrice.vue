<template>
  <div class="filter">
    <div class="filter__button">
      <div class="filter__value">Цена</div>

      <svg width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
           fill="none" stroke-linecap="round" stroke-linejoin="round" class="filter__icon">
        <path stroke="none" d="M0 0h24v24H0z"/>
        <polyline points="6 9 12 15 18 9"/>
      </svg>
    </div>

    <div class="filter__dropdown">
      <div class="filter-price-range">
        <div class="filter-price-range__item">
          <label class="filter-price-range__label" for="from">От</label>

          <div class="filter-price-range__value">
            <input class="filter-price-range__input" id="from" type="number"
                   v-model="inputFrom" :min="min" :max="max">
            <div class="filter-price-range__currency">₸</div>
          </div>
        </div>

        <div class="filter-price-range__item">
          <label class="filter-price-range__label" for="to">До</label>

          <div class="filter-price-range__value">
            <input class="filter-price-range__input" id="to" type="number"
                   v-model="inputTo" :min="min" :max="max">
            <div class="filter-price-range__currency">₸</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'CatalogFilterPrice',
  props: {
    min: {
      type: Number,
      required: true,
    },
    max: {
      type: Number,
      required: true,
    },
    from: {
      type: Number,
      required: true,
    },
    to: {
      type: Number,
      required: true,
    },
  },
  created () {
    this.inputFrom = this.from
    this.inputTo = this.to
  },
  data () {
    return {
      inputFrom: 0,
      inputTo: 0,
    }
  },
  watch: {
    inputFrom (value) {
      window.eventBus.$emit('input.price-from', value)
    },
    inputTo (value) {
      window.eventBus.$emit('input.price-to', value)
    },
  },
}
</script>
