<div class="chat-modal" x-data="{open: true}" x-show="open && !localStorage.getItem('modalChatClosed')">
  <div class="chat-modal__backdrop" x-on:click="closeModal(() => open = false)"></div>
  <div class="chat-modal__content">
    <div class="chat-message">
      <h2>Важное сообщение</h2>

      <p>
        Друзья! Чтобы всегда быть в курсе новостей магазина и акций, просьба подписаться на наш Telegram канал. Также в
        нем мы постоянно публикуем скидочные купоны и вы сможете покупать у нас еще дешевле! Заранее благодарим!
      </p>


      <p>
        <a href="https://t.me/uspehisporta_news" target="_blank" class="i-button i-button--fill">
          Подписаться
        </a>
      </p>

      <p>
        <button class="chat-message__close" x-on:click="closeModal(() => open = false)">Закрыть</button>
      </p>
    </div>
  </div>
</div>

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
  <script>
    function closeModal(callback) {
      callback();
      localStorage.setItem('modalChatClosed', 'true');
    }
  </script>
@endpush
