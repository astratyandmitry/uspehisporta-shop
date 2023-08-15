@push('scripts')
  <script src="https://cdn.tiny.cloud/1/6tn0n2ut4t4dafkjvydq682uekp1da9wyibkc495bdfsnowy/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: '.js-ckeditor5',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount advcode code',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat advcode code',
    });
  </script>

{{--  <script src="/vendor/ckeditor5/ckeditor.js?1"></script>--}}
{{--  <script>--}}
{{--    var editorOptions = {--}}
{{--      toolbar: {--}}
{{--        items: [--}}
{{--          'removeFormat',--}}
{{--          '|',--}}
{{--          'heading',--}}
{{--          '|',--}}
{{--          'bold',--}}
{{--          'italic',--}}
{{--          'link',--}}
{{--          '|',--}}
{{--          'alignment',--}}
{{--          '|',--}}
{{--          'bulletedList',--}}
{{--          'numberedList',--}}
{{--          '|',--}}
{{--          'insertTable',--}}
{{--          '|',--}}
{{--          'imageUpload',--}}
{{--          'mediaEmbed',--}}
{{--          '|',--}}
{{--          'horizontalLine',--}}
{{--          '|',--}}
{{--          'undo',--}}
{{--          'redo',--}}
{{--          '|',--}}
{{--          'sourceEditing',--}}
{{--        ]--}}
{{--      },--}}
{{--      language: 'ru',--}}
{{--      heading: {--}}
{{--        options: [--}}
{{--          { model: 'paragraph', title: 'Параграф', class: 'ck-heading_paragraph' },--}}
{{--          { model: 'heading1', view: 'h2', title: 'Заголовок', class: 'ck-heading_heading2' },--}}
{{--          { model: 'heading2', view: 'h3', title: 'Подзаголовок', class: 'ck-heading_heading3' }--}}
{{--        ]--}}
{{--      },--}}
{{--      simpleUpload: {--}}
{{--        uploadUrl: '/cms/upload/ckeditor5',--}}
{{--        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }--}}
{{--      },--}}
{{--      image: {--}}
{{--        toolbar: [--}}
{{--          'imageTextAlternative',--}}
{{--          'imageStyle:full',--}}
{{--          'imageStyle:side'--}}
{{--        ]--}}
{{--      },--}}
{{--      table: {--}}
{{--        contentToolbar: [--}}
{{--          'tableColumn',--}}
{{--          'tableRow',--}}
{{--          'mergeTableCells',--}}
{{--          'tableCellProperties',--}}
{{--          'tableProperties'--}}
{{--        ]--}}
{{--      },--}}
{{--      licenseKey: '',--}}
{{--    }--}}

{{--    $(function () {--}}
{{--      $('.js-ckeditor5').each(function () {--}}
{{--        ClassicEditor.create(document.getElementById($(this).attr('id')), editorOptions)--}}
{{--      })--}}
{{--    })--}}
{{--  </script>--}}
@endpush
