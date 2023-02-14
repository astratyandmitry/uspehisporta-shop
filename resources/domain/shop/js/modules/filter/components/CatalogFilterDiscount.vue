<template>
  <div class="filter filter--static">
    <div class="filter__button">
      <div class="filter__label">
        <input type="checkbox" id="discount" v-model="input" :checked="checked">
      </div>
      <label for="discount" class="filter__value">
        Со скидкой
      </label>
    </div>
  </div>
</template>

<script>
export default {
  name: 'CatalogFilterDiscount',
  props: {
    checked: {
      type: Boolean,
      required: true,
    },
  },
  created () {
    this.input = this.checked
  },
  data () {
    return {
      input: false
    }
  },
  watch: {
    input (value) {
      window.eventBus.$emit('input.discount', value)
    },
  },
}
</script>
