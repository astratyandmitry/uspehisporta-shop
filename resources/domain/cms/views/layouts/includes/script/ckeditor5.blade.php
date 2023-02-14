@push('scripts')
  <script src="/vendor/ckeditor5/ckeditor.js"></script>
  <script>
    var editorOptions = {
      toolbar: {
        items: [
          'removeFormat',
          '|',
          'heading',
          '|',
          'bold',
          'italic',
          'link',
          '|',
          'alignment',
          '|',
          'bulletedList',
          'numberedList',
          '|',
          'insertTable',
          '|',
          'imageUpload',
          'mediaEmbed',
          '|',
          'horizontalLine',
          '|',
          'undo',
          'redo'
        ]
      },
      language: 'ru',
      heading: {
        options: [
          { model: 'paragraph', title: 'Параграф', class: 'ck-heading_paragraph' },
          { model: 'heading1', view: 'h2', title: 'Заголовок', class: 'ck-heading_heading2' },
          { model: 'heading2', view: 'h3', title: 'Подзаголовок', class: 'ck-heading_heading3' }
        ]
      },
      simpleUpload: {
        uploadUrl: '/cms/upload/ckeditor5',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
      },
      image: {
        toolbar: [
          'imageTextAlternative',
          'imageStyle:full',
          'imageStyle:side'
        ]
      },
      table: {
        contentToolbar: [
          'tableColumn',
          'tableRow',
          'mergeTableCells',
          'tableCellProperties',
          'tableProperties'
        ]
      },
      licenseKey: '',
    }

    $(function () {
      $('.js-ckeditor5').each(function () {
        ClassicEditor.create(document.getElementById($(this).attr('id')), editorOptions)
      })
    })
  </script>
@endpush
