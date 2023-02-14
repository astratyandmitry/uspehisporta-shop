$(function () {
  let formOnLeave = {
    modified: false,
    submitted: false,
    modify () {
      this.modified = true
    },
    submit () {
      this.submitted = true
    },
    changed () {
      return this.modified && !this.submitted
    }
  }

  $(document).on('change', 'form input, form textarea, form select', function () {
    formOnLeave.modify()
  })

  $(function () {
    window.onbeforeunload = function (e) {
      if (formOnLeave.changed()) {
        let message = 'You have unsaved changes.', e = e || window.event

        if (e) {
          e.returnValue = message
        }

        return message
      }
    }

    $('form').submit(function () {
      $(this).find('button[type=submit]').attr('disabled', true)

      formOnLeave.submit()
    })
  })
})
