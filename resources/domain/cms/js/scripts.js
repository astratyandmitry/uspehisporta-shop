global.$ = global.jQuery = require('jquery')
window.Sortable = require('sortablejs').Sortable;
window.autosize = require('autosize')
window.select2 = require('select2')

// AJAX Setup
$.ajaxSetup({
  headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
})

$(function () {
  // Preload
  $('body').removeClass('preload')

  // Select2
  $('select').select2({
    'language': {
      'noResults': function () {
        return ''
      }
    },
  })

  // Textarea autosize
  autosize($('textarea'))
  $(document).ajaxSuccess(function () {
    autosize($('textarea'))
  })

  // Hide Session Message
  setTimeout(function () {
    $('.js-session-message').slideUp(120)
  }, 3000)

  // Disable submitting form by press Enter
  $(document).on('keyup keypress', 'form', function (e) {
    e = e || event
    let txtArea = /textarea/i.test((e.target || e.srcElement).tagName)
    return txtArea || (e.keyCode || e.which || e.charCode || 0) !== 13
  })

  // Filter logic
  $('.js-filter').on('click', function () {
    let filter = []

    $(this).parents('.row--filter').find('input, select').each(function () {
      if ($(this).val()) {
        filter.push(`${$(this).attr('name')}=${$(this).val()}`)
      }
    })

    let url = location.pathname
    let oldQuery = location.search === '' ? '?' : location.search
    let newQuery = '?' + filter.join('&')

    if (oldQuery !== newQuery) {
      window.location.href = `${url}${newQuery}`
    }
  })

  // On submit confirm message
  $('.js-confirm-submit').on('click', function (e) {
    e.preventDefault()

    if (!confirm($(this).data('message'))) {
      return
    }

    if ($(this).hasClass('js-is-ajax')) {
      let $tr = $(this).parents('tr')

      $.ajax({
        method: 'POST',
        url: $(this).parent().attr('action'),
        dataType: 'json',
        data: {
          _method: 'DELETE',
        },
        success: function () {
          $tr.fadeOut(400, function () {
            $(this).remove()
          })
        }
      })
    } else {
      $(this).parent().submit()
    }
  })

  // Active switch toggle
  $('.switch input').on('change', function () {
    $.ajax({
      url: '/cms/active-switch',
      method: 'POST',
      data: {
        id: $(this).data('id'),
        model: $(this).data('model'),
        active: $(this).is(':checked')
      }
    })
  })

  // Sortable table
  $('.js-sortable').each(function () {
    new Sortable($(this).get(0), {
      handle: '.js-sortable-handle',
      ghostClass: 'js-sortable--on-drag',
      animation: 150,
      onUpdate: function (e) {
        let $el = $(e.target)

        let sorting = []

        $el.find('tr').each(function () {
          sorting.push($(this).data('id'))
        })

        $.ajax({
          method: 'POST',
          url: '/cms/update-sorting',
          data: {
            model: $el.data('model'),
            sorting: sorting,
          }
        })
      },
    })
  })
})
