<div class="chat-modal" style="display: none">
  <div class="chat-modal__backdrop js-close-modal"></div>
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
        <button class="chat-message__close js-close-modal">Закрыть</button>
      </p>
    </div>
  </div>
</div>

@push('scripts')
  <script
    src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
    crossorigin="anonymous"></script>

  <script>
    if (! localStorage.getItem('modalChatClosed', 'true')) {
      $('.chat-modal').fadeIn(200);
    }

    $('.js-close-modal').on('click', function() {
      $('.chat-modal').fadeOut(200);
      localStorage.setItem('modalChatClosed', 'true');
    });

  </script>
@endpush
