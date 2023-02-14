<form action="{{ $action }}" method="post" class="form">
  @csrf

  @if (isset($model) && $model->id)
    @method('PATCH')
  @endif

  <div class="page-grid">
    <div class="page-grid--left">
      @include("cms::crud.{$globals['model']}.form.general")
    </div>

    <div class="page-grid--right">
      <div class="block aside">
        @include("cms::crud.{$globals['model']}.form.additional")

        @include('cms::layouts.includes.form.actions')
      </div>
    </div>
  </div>
</form>
