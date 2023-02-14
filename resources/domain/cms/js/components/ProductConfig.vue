<template>
  <section class="block block--offset">
    <div class="section">
      <div class="section__heading">
        <div class="section__title">
          Вариации товара
        </div>

        <button @click="addEmptyItem"
                type="button" class="btn btn--outlined btn--primary btn--sm">
          Добавить
        </button>
      </div>

      <div v-if="items.length > 0">
        <div class="packing-grid field" v-for="itemIndex in items.keys()">
          <input type="text" v-model="items[itemIndex]['name']">

          <input type="number" v-model="items[itemIndex]['quantity']">

          <button @click="deleteItem(itemIndex)" type="button" class="btn btn--danger btn--outlined">
            <i class="fas fa-trash"></i>
          </button>
        </div>

        <input type="hidden" name="variations" :value="json">
      </div>

      <div class="empty-message" v-else>
        Добавьте вкус для того, чтобы указать остатки
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'ProductConfig',
  props: {
    variations: {
      type: Array,
      default: []
    }
  },
  data () {
    return {
      items: []
    }
  },
  mounted () {
    this.items = this.variations
  },
  computed: {
    json () {
      return JSON.stringify(this.items)
    },
  },
  methods: {
    addEmptyItem () {
      this.items.push({
        name: '',
        quantity: 0
      })
    },
    deleteItem (index) {
      this.items.splice(index, 1)
    },
    find (tasteId) {
      const taste = this.tastes.filter((el) => el.id === tasteId)

      return taste.length ? taste[0] : {}
    },
    getName (tasteId) {
      return this.find(tasteId).name
    },
  },
}
</script>

<style lang="scss">
.empty-message {
  background: #fafafa;
  text-align: center;
  padding: 1rem;
  border-radius: 4px;
  color: #777;
  font-size: 14px;
  margin-bottom: 2rem;
}

.packing-grid {
  display: flex;

  select {
    margin-right: 8px;
    flex-grow: 1;
    width: 100%;
  }

  input {
    margin-right: 8px;

    &:last-child {
      margin-right: 0;
    }
  }

  input[type=number] {
    width: 132px !important;
  }

  button i {
    margin: 0;
  }
}
</style>
