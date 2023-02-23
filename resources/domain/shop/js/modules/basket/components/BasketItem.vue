<template>
  <tr>
    <td>
      <a :href="item.product.url" target="_blank" class="product">
        <div class="product__media">
          <img :src="item.product.image" :alt="item.product.name" class="product__image">
        </div>

        <div class="product__content">
          <div class="product__name">
            {{ item.product.name }}
          </div>

          <div class="product__price">
            ₽{{ price | formatPrice }}/шт.
          </div>
        </div>
      </a>
    </td>
    <td nowrap>
      <div class="count">
        <div class="count__config">
          <button class="count__button" @click="decrease" :disabled="reachMin">
            -
          </button>

          <div class="count__value">
            {{ count }}
          </div>

          <button class="count__button" @click="increase" :disabled="reachMax">
            +
          </button>
        </div>
      </div>
    </td>
    <td nowrap>
      <div class="price">
        <div class="price__value">
          ₽{{ total | formatPrice }}
        </div>

        <div class="price__prev" v-if="item.product.price_sale">
          ₽{{ totalPrev | formatPrice }}
        </div>
      </div>
    </td>
    <td nowrap>
      <svg @click="remove" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="items-table__icon">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
      </svg>
    </td>
  </tr>
</template>

<script>
import axios from 'axios'

export default {
  name: 'BasketItem',
  props: {
    item: {
      type: Object,
      required: true,
    },
  },
  data () {
    return {
      count: 1,
    }
  },
  created () {
    this.count = this.item.count
  },
  computed: {
    max () {
      return this.item.variation ? this.item.product.variations[this.item.variation]['quantity'] : this.item.product.quantity
    },
    price () {
      return this.item.product.price_sale ? this.item.product.price_sale : this.item.product.price
    },
    total () {
      return this.price * this.count
    },
    totalPrev () {
      return this.item.product.price * this.count
    },
    reachMin () {
      return this.count === 1
    },
    reachMax () {
      return this.count === this.max
    }
  },
  methods: {
    decrease () {
      if (this.reachMin) {
        return
      }

      this.handleRequest('/basket/decrease')
    },
    increase () {
      if (this.reachMax) {
        return
      }

      this.handleRequest('/basket/increase')
    },
    handleRequest (endpoint) {
      window.eventBus.$emit('basket.loading')

      const data = {
        product_id: this.item.product.id,
        variation: this.item.variation
      }

      axios.post(endpoint, data)
        .then(({ data }) => this.handleResponse(data))
        .catch(() => this.handleResponse({}))
    },
    handleResponse (obj) {
      if (obj.count) {
        this.count = obj.count
      }

      window.eventBus.$emit('basket.update', {
        id: this.item.id,
        total: this.total,
      })
    },
    remove () {
      axios.delete(`/basket/${this.item.id}`)
        .then(() => {
          window.eventBus.$emit('basket.remove', {
            id: this.item.id,
          })
        })
    },
  },
}
</script>
