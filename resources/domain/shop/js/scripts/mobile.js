let hamburger = document.querySelector('.hamburger')
let dropdown = document.querySelector('.header .dropdown')
let loader = document.querySelector('.loader')
let body = document.querySelector('body')
let searchInput = document.querySelector('.search__input')

hamburger.addEventListener('click', () => {
  if (dropdown.classList.contains('dropdown--active')) {
    dropdown.classList.remove('dropdown--active')
    loader.classList.remove('loader--active')
    body.classList.remove('fixed')
  } else {
    dropdown.classList.add('dropdown--active')
    loader.classList.add('loader--active')
    body.classList.add('fixed')
  }
})

loader.addEventListener('click', () => {
  dropdown.classList.remove('dropdown--active')
  loader.classList.remove('loader--active')
  body.classList.remove('fixed')
})

searchInput.addEventListener('focusin', () => {
  loader.classList.add('loader--active')
  body.classList.add('fixed')
})

searchInput.addEventListener('focusout', () => {
  loader.classList.add('loader--active')
  body.classList.add('fixed')
})

let mainMenuItem = document.querySelectorAll('.menu--main .menu__item')
let activeChildMenu = null

if (!('ontouchstart' in document.documentElement)) {
  for (let i = 0; i < mainMenuItem.length; i++) {
    let childMenu = document.getElementById(`child-menu-${mainMenuItem[i].dataset.for}`)

    mainMenuItem[i].addEventListener('mouseover', function () {
      if (activeChildMenu) {
        activeChildMenu.classList.remove('menu--active')
      }

      activeChildMenu = childMenu

      childMenu.classList.add('menu--active')
    })
  }
}
