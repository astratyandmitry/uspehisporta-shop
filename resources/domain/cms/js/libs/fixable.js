$(function () {
  let Fixable = {
    init () {
      this.fix()
    },
    fix () {
      let $cache = $('.aside')

      if ($(window).width() > 1024) {
        if ($(window).scrollTop() > $cache.parent().offset().top - 32) {
          $cache.css({
            'width': $cache.parent().width(),
            'position': 'fixed',
            'top': '2rem'
          })
        } else {
          $cache.css({
            'position': 'static',
            'width': 'auto',
            'top': 'auto'
          })
        }
      }
    }
  }

  Fixable.init()

  $(window).scroll(Fixable.fix)
})
