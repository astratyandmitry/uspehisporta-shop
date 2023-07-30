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

      <button class="i-button i-button--icon" :class="{ 'i-button--fill' : !inBasket }" @click="handle">
          <span>{{ inBasket ? 'В корзине' : 'В корзину' }}</span>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="i-button__icon">
          <path
            d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" />
        </svg>

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

          window.document.getElementById('basket-total').innerText = data.total
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
