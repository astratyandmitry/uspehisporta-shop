<template>
  <div class="loadable">
    <div class="loadable__loader" :class="{ 'loadable__loader--active': loading } "></div>
    <table v-if="items.length" width="100%" cellpadding="0" cellspacing="0" class="items-table">
      <thead>
      <tr>
        <th align="left">Товар</th>
        <th nowrap width="120" align="left">Кол-во</th>
        <th nowrap width="120" align="right">Цена</th>
        <th nowrap width="20"></th>
      </tr>
      </thead>
      <tbody>
      <basket-item v-for="item in items" :item="item" :key="item.id"/>
      </tbody>
      <tfoot>
      <tr>
        <th align="right" colspan="2">
          <span>Сумма</span>
        </th>
        <th nowrap align="right">
          {{ amount | formatPrice }} ₸
        </th>
        <th></th>
      </tr>
      <tr>
        <th align="right" colspan="2">
          <span>Итого</span>
        </th>
        <th nowrap align="right">
          {{ total | formatPrice }} ₸
        </th>
        <th></th>
      </tr>
      </tfoot>
    </table>

    <slot v-else></slot>
  </div>
</template>

<script>
import BasketItem from './BasketItem'

export default {
  name: 'Basket',
  components: { BasketItem },
  props: {
    data: {
      type: Array,
      default: [],
    },
    deliveryPrice: {
      type: Number,
      required: true,
    },
  },
  data () {
    return {
      items: [],
      amount: 0,
      loading: false,
    }
  },
  created () {
    this.items = this.data

    window.eventBus.$on('basket.update', this.updateItem)
    window.eventBus.$on('basket.remove', this.removeItem)
    window.eventBus.$on('basket.loading', this.startLoading)
  },
  computed: {
    total () {
      return this.amount + this.deliveryPrice
    },
  },
  methods: {
    updateItem ({ id, total }) {
      let item = this.items.find((item) => item.id === id)
      let _index = this.items.indexOf(item)

      if (_index >= 0) {
        this.items[_index].total = total
      }

      this.loading = false
    },
    removeItem ({ id }) {
      this.items = this.items.filter((item) => item.id !== id)

      this.loading = false
    },
    startLoading () {
      this.loading = true
    },
  },
  watch: {
    items: {
      deep: true,
      handler () {
        this.amount = this.items.reduce(function (total, item) {
          return total + (item.total ? item.total : 0)
        }, 0)

        if (this.amount <= 0) {
          window.location.href = '/catalog'
        }
      },
    },
  },
}
</script>
