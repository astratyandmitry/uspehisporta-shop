<template>
  <div class="filter filter--static">
    <div class="filter__button">
      <div class="filter__label">
        Найдено:
      </div>
      <div class="filter__value">
        {{ total }} товаров
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'CatalogFilterStats',
  props: {
    total: {
      type: Number,
      required: true,
    }
  }
}
</script>
