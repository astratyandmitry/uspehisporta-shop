@if (!session()->has('age-confirmed'))
  <div class="age-confirm" x-data="ageConfirmation()" x-show="show">
    <div class="age-confirm-content" x-show="!young">
      <div class="age-confirm-message">
        <div class="age-confirm-title">
          Внимание 18+
        </div>

        <div class="age-confirm-about">
          Сайт содержит информацию для лиц совершеннолетнего возраста. Чтобы продолжить вам необходимо подтвердить свой
          возраст.
        </div>
      </div>

      <div class="age-confirm-actions">
        <button class="js-yes form-button" @click="doYes">Да, мне уже есть 18 лет</button>
        <button class="js-no form-button --secondary" @click="doNo">Нет, я младше 18 лет</button>
      </div>
    </div>

    <div class="age-confirm-content" x-show="young">
      <div class="age-confirm-message">
        <div class="age-confirm-title">
          Извинте
        </div>

        <div class="age-confirm-about">
          Материалы на сайте предназначены только для взрослых
        </div>
      </div>
    </div>
  </div>

  @push('scripts')
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
      function ageConfirmation () {
        return {
          show: true,
          young: false,
          doYes () {
            fetch('/confirm-age')
            this.show = false
          },
          doNo () {
            this.young = true
          }
        }
      }
    </script>
  @endpush
@endif
