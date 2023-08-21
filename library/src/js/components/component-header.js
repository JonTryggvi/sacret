$ = window.$
import anime from 'animejs/lib/anime.es.js'
const Header = {
  scrolled: false,
  init(body, loaded){
    this.cacheDom(body)
    this.addEvents()
  },
  cacheDom(body) {
    this.body = body
    this.header = body.querySelector('header')
    this.nav = this.header.querySelector('nav')
    this.navUl = this.header.querySelector('.main-menu')
    this.menuItems = this.nav.querySelectorAll('.menu-item:not(.sub-menu > .menu-item)')
    // this.magicLine = this.nav.querySelector('.magic-line')
    this.hamburger = this.nav.querySelector('.menu_hamburger')
    // this.btnCart = this.nav.querySelector('.toggle-cart');
    // this.miniCart = body.querySelector('.uni-minicart')
    this.iMenuItems = this.menuItems.length

  },
  addEvents() {
    this.theme_color = this.header.dataset.theme_color;
    this.hamburger.onclick = e => {
      let clickedItem = e.target.closest('.menu_hamburger')
      if (clickedItem.classList.contains('menu_hamburger--active')) {
        document.querySelector('html').classList.remove('menu-is-open')
        this.header.classList.remove('menu-open')
        clickedItem.classList.remove('menu_hamburger--active')
        this.navUl.classList.remove('main-menu--active')
      } else {
        document.querySelector('html').classList.add('menu-is-open')
        this.header.classList.add('menu-open')
        clickedItem.classList.add('menu_hamburger--active')
        this.navUl.classList.add('main-menu--active')
        this.animation.restart();
      }
    }
    window.addEventListener('scroll', this.handleWindowScroll.bind(this))
    this.navUl.addEventListener('transitionend', e => {
      if (this.header.classList.contains('menu-open') && window.innerWidth <= 414) {
        this.animation.play()
      }
    })
    let windowScrollTop = window.pageYOffset || document.documentElement.scrollTop
    if (windowScrollTop > 30) {
      this.header.classList.add('bc__header--'+this.theme_color)
      this.scrolled = true
    }
  },
  handleWindowScroll(e) {
    let scrollTop = e.srcElement.scrollingElement.scrollTop;
    if (scrollTop > 0 && !this.scrolled) {
      this.header.classList.add('bc__header--'+this.theme_color)
      this.scrolled = true
    } else if(scrollTop < 1){
      this.header.classList.remove('bc__header--'+this.theme_color)
      this.scrolled = false
    }
  },
  animation: anime({
    targets: '.uni_header__nav-list .menu-item:not(.sub-menu > .menu-item)',
    translateY: [20, 0],
    opacity: 1,
    autoplay: false,
    easing: 'easeInOutSine',
    delay: anime.stagger(200, { direction: 'reverse' }) // increase delay by 100ms for each elements.
  }),
}
export default Header

