<template>
  <div class="filter">
    <div class="filter__button">
      <div class="filter__value">{{ label }}</div>

      <svg width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
           fill="none" stroke-linecap="round" stroke-linejoin="round" class="filter__icon">
        <path stroke="none" d="M0 0h24v24H0z"/>
        <polyline points="6 9 12 15 18 9"/>
      </svg>
    </div>

    <div class="filter__dropdown">
      <div class="filter-menu">
        <div class="filter-menu__list">
          <div class="filter-menu__item" v-for="option in options" :key="option.id">
            <label class="filter-menu__label" :for="`filter__${eng}__${option.id}`">
              {{ option.name }}
            </label>

            <input class="filter-menu__input" type="checkbox"
                   :id="`filter__${eng}__${option.id}`"
                   :checked="checked(option.id)" @change="toggle(option.id)">
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'CatalogFilterDropdown',
  props: {
    eng: {
      type: String,
      required: true,
    },
    label: {
      type: String,
      required: true,
    },
    value: {
      type: Array,
      required: true,
    },
    options: {
      type: Array,
      required: true,
    },
  },
  created () {
    this.input = this.value
  },
  data () {
    return {
      input: []
    }
  },
  methods: {
    checked (value) {
      return this.input.includes(value.toString())
    },
    toggle (value) {
      value = value.toString()

      let index = this.input.indexOf(value)

      if (index === -1) {
        this.input.push(value)
      } else {
        this.input.splice(index, 1)
      }
    },
  },
  watch: {
    input (value) {
      window.eventBus.$emit(`input.${this.key}`, value)
    },
  }
}
</script>
