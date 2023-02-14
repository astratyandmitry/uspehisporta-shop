<table class="panel" width="100%" cellpadding="0" cellspacing="0" role="presentation">
  <tr>
    <td class="panel-content @if (isset($pink)) panel-content-pink @endif">
      <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
          <td class="panel-item @if (isset($centered)) panel-item-centered @endif">
            {{ Illuminate\Mail\Markdown::parse($slot) }}
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
