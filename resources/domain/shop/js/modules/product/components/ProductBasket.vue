<template>
  <div class="product__config__grid">
    <div class="stock" v-if="variations && variations.length">
      <div class="form-select">
        <label for="variation" class="form-label">Вариация товара</label>

        <select id="variation" v-model="variation" class="form-input">
          <option v-for="(variation, key) in variations" :value="key" v-text="variation.name"></option>
        </select>
      </div>
    </div>

    <div class="basket">
      <div class="basket__count">
        <div class="basket__count__button" :class="{ 'basket__count__button--disabled': reachMin }" @click="decrease">
          <span>-</span>
        </div>

        <div class="basket__count__value">
          <span v-text="count"></span>
        </div>

        <div class="basket__count__button" :class="{ 'basket__count__button--disabled': reachMax }" @click="increase">
          <span>+</span>
        </div>
      </div>

      <button class="basket__button" :class="{ 'basket__button--active' : inBasket }" @click="handle">
        <span class="basket__button__content">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="basket__button__icon">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
          </svg>
          <span>{{ inBasket ? 'В корзине' : 'В корзину' }}</span>
        </span>
      </button>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'ProductBasket',
  props: {
    product_id: {
      type: Number,
      required: true
    },
    price: {
      type: Number,
      required: true
    },
    price_sale: {
      type: Number,
      required: false
    },
    quantity: {
      type: Number,
      required: true,
    },
    variations: {
      type: Array,
      required: false,
    }
  },
  data () {
    return {
      count: 1,
      added: {},
      stock: null,
      variation: 0,
    }
  },
  computed: {
    reachMin () {
      return this.count === 1
    },
    reachMax () {
      return this.count >= this.quantity
    },
    inBasket () {
      return this.added.hasOwnProperty(this.product_id) && this.added[this.product_id] > 0
    }
  },
  methods: {
    decrease () {
      if (this.reachMin) {
        return
      }

      if (this.inBasket) {
        return this.request('/basket/decrease')
      }

      return this.count--
    },
    increase () {
      if (this.reachMax) {
        return
      }

      if (this.inBasket) {
        return this.request('/basket/increase')
      }

      return this.count++
    },
    request (endpoint) {
      let data = {
        product_id: this.product_id,
        variation: this.variations && this.variations.length ? this.variation : null
      }

      axios.post(endpoint, data)
        .then(({ data }) => {
          this.$set(this.added, this.product_id, this.count = data.count)
        })
    },
    handle () {
      if (this.inBasket) {
        return window.location.href = '/basket'
      }

      this.request(`/basket?quantity=${this.count}`)
    }
  }
}
</script>
