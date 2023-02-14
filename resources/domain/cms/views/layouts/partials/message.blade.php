@if (session()->has('success'))
  <div class="message message--sm message--success js-session-message">
    <p>{{ session()->get('success') }}</p>
  </div>
@endif

@if (session()->has('warning'))
  <div class="message message--sm message--warning js-session-message">
    <p>{{ session()->get('warning') }}</p>
  </div>
@endif

@if (session()->has('danger'))
  <div class="message message--sm message--danger js-session-message">
    <p>{{ session()->get('danger') }}</p>
  </div>
@endif
