<footer>
  <div class="container">
    <div class="footer-content">
      <div class="menu">
        <ul class="menu-list">
          <li class="menu-list-item">
            <a href="{{ route('shop::home') }}" target="_blank" class="menu-list-item-link">
              @lang('cms.go-site')
            </a>
          </li>
        </ul>
      </div>

      <div class="copyright">
        <div class="copyright-text">
          &copy; {{ date('Y') }} ArmenianBros.
        </div>
      </div>
    </div>
  </div>
</footer>
