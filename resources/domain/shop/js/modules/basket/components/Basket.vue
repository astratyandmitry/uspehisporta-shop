<template>
  <div class="page__grid">
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
        <basket-item v-for="item in items" :item="item" :key="item.id" />
        </tbody>
      </table>
      <slot v-else></slot>
    </div>

    <div class="page__aside">
      <div class="basket-confirm">
        <div class="basket-info">
          <div class="basket-info__item">
            <div class="basket-info__content">
              <div class="basket-info__label">
                Товары
              </div>
            </div>

            <div class="basket-info__value">
              ₽{{ amount | formatPrice }}
            </div>
          </div>

          <div class="basket-info__item">
            <div class="basket-info__content">
              <div class="basket-info__label">
                Доставка
              </div>

              <div class="basket-info__detail">
                Первый класс почта РФ, по территории РФ
              </div>
            </div>

            <div class="basket-info__value">
              ₽{{ deliveryPrice | formatPrice }}
            </div>
          </div>

          <div class="basket-info__item">
            <div class="basket-info__content">
              <div class="basket-info__label">
                Итог
              </div>
            </div>

            <div class="basket-info__value">
              ₽{{ total | formatPrice }}
            </div>
          </div>

          <div class="basket-info__item">
            <div class="basket-info__content">
              <div class="basket-info__label">
                Итог
              </div>
            </div>

            <div class="basket-info__value">
              ₽{{ total | formatPrice }}
            </div>
          </div>
        </div>

        <div class="form-field" style="margin-top: 2rem">
          <label class="form-label" for="promo">Промо-код:</label>
          <div class="promo">
            <input type="text" id="promo" class="form-input" v-model="promo.code" placeholder="Введите промо-код">
            <button type="button" class="i-button" style="margin-left: 0.5rem" @click="checkPromoCode">Проверить</button>
          </div>

          <div class="form-help form-help--success" v-if="promo.discount">
            Промо-код действителен, скидка {{ promo.discount }}% на определнную продукцию, детали можно увидеть на странице оформления заказа
          </div>

          <div class="form-help form-help--error" v-else-if="promo.error">
            Промо-код не найден или уже недействителен
          </div>
        </div>

        <div class="basket-actions">
          <a :href="`/checkout?promo=${promo.code}`" class="i-button i-button--full i-button--fill" type="button">
            <span>Оформить заказ</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import BasketItem from './BasketItem'

export default {
  name: 'Basket',
  components: {BasketItem},
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
  data() {
    return {
      items: [],
      amount: 0,
      loading: false,
      promo: {
        code: '',
        discount: 0,
        error: false,
      }
    }
  },
  created() {
    this.items = this.data

    window.eventBus.$on('basket.update', this.updateItem)
    window.eventBus.$on('basket.remove', this.removeItem)
    window.eventBus.$on('basket.loading', this.startLoading)
  },
  computed: {
    total() {
      return this.amount + this.deliveryPrice
    },
  },
  methods: {
    checkPromoCode() {
      this.promo.discount = 0
      this.promo.success = false
      this.promo.error = false

      if (!this.promo.code) {
        this.promo.error = true;
        return;
      }

      axios.post(`/promo-code/${this.promo.code}`)
        .then(({data}) => {
          if (data.discount) {
            this.promo.discount = data.discount
          } else {
            this.promo.error = true
          }
        })
        .catch(() => this.promo.error = true)
    },
    updateItem({id, total}) {
      let item = this.items.find((item) => item.id === id)
      let _index = this.items.indexOf(item)

      if (_index >= 0) {
        this.items[_index].total = total
      }

      this.loading = false
    },
    removeItem({id}) {
      this.items = this.items.filter((item) => item.id !== id)

      this.loading = false
    },
    startLoading() {
      this.loading = true
    },
  },
  watch: {
    items: {
      deep: true,
      handler() {
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

<style>
.promo {
  display: flex;
  align-items: center;
}
</style>
