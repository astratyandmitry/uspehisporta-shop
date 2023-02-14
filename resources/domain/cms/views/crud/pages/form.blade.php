@extends('cms::layouts.master', $globals)

@section('content')
  <main>
    @include('cms::layouts.includes.form.wrapper')
  </main>
@endsection

@push('scripts')
  @include('cms::layouts.includes.script.ckeditor5')
@endpush
