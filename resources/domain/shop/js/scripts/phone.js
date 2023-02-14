import IMask from 'imask'

var el = document.getElementById('phone')

if (el) {
  IMask(el, {
    mask: '+{7}(000)0000000'
  })
}
