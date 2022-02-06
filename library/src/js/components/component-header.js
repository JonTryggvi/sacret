$ = window.$
let sr = ScrollReveal();
import anime from 'animejs/lib/anime.es.js'
const Header = {
  scrolled: false,
  init(body, loaded){
    this.cacheDom(body)
    this.addEvents()
    this.animation.play()
    
  },
  cacheDom(body) {
    this.body = body
    this.header = body.querySelector('header')
    this.nav = this.header.querySelector('nav')
    this.navUl = this.header.querySelector('.uni_header__nav-list')
    this.menuItems = this.nav.querySelectorAll('.menu-item')
    this.magicLine = this.nav.querySelector('.magic-line')
    this.hamburger = this.nav.querySelector('.menu_hamburger')
    // this.btnCart = this.nav.querySelector('.toggle-cart');
    // this.miniCart = body.querySelector('.uni-minicart')
    this.iMenuItems = this.menuItems.length
    
  },
  addEvents(){
    this.menuItems.forEach(menuItem => {
      menuItem.addEventListener('mouseover', this.handleMenuItemMouseover.bind(this))
      menuItem.addEventListener('mouseleave', this.handleMenuItemMouseleave.bind(this))
    })
    this.hamburger.onclick = e => {
      let clickedItem = e.target.closest('.menu_hamburger')
      if (clickedItem.classList.contains('menu_hamburger--active')) {
        this.header.classList.remove('menu-open')
        clickedItem.classList.remove('menu_hamburger--active')
        this.navUl.classList.remove('uni_header__nav-list--active')
      } else {
        this.header.classList.add('menu-open')
        clickedItem.classList.add('menu_hamburger--active')
        this.navUl.classList.add('uni_header__nav-list--active')
      }
    }
  

    window.addEventListener('scroll', this.handleWindowScroll.bind(this))
    this.navUl.addEventListener('transitionend', e => {
      if (this.header.classList.contains('menu-open') && window.innerWidth <= 414) {
        this.reveal({
          scale: 1,
          reset: false,
          mobile: true,
          duration: 1200,
          distance: '20px',
          interval: 200,
          origin: 'bottom',
          container: this.navUl
        })
      }
    })
    let windowScrollTop = window.pageYOffset || document.documentElement.scrollTop
    if (windowScrollTop > 30) {
      this.header.classList.add('bc__header--white')
      this.scrolled = true
    }
  },
  handleBtnCartClick(e) {
    this.miniCart.classList.toggle('mini-active')
  },
  handleWindowScroll(e) {
    let scrollTop = e.srcElement.scrollingElement.scrollTop;
    if (scrollTop > 0 && !this.scrolled) {
      this.header.classList.add('bc__header--white')
      this.scrolled = true 
    } else if(scrollTop < 1){
      this.header.classList.remove('bc__header--white')
      this.scrolled = false
    } 
  },
  handleMenuItemMouseover(e) {
    const liItem = e.target.closest('.menu-item')
    const menuItemPosition = liItem.getBoundingClientRect()
    this.setMacigLine(this.magicLine, liItem.offsetLeft, menuItemPosition.top, menuItemPosition.width)
  },
  handleMenuItemMouseleave(e) {
    this.hideMagicLine(this.magicLine)
  },
  setMacigLine(line, left, top, width) {
    line.style.opacity = '1'
    line.style.left = left - 10 + 'px'
    line.style.top = top + 6 + 'px'
    line.style.width = width + 20 + 'px'
  },
  hideMagicLine(line) {
    line.style.opacity = '0'
    // line.style.width = '0'
  },
  reveal(options) {
    sr.reveal(this.menuItems, options);
  },
  animation: anime({
    targets: '#menu-main-nav .menu-item',
    translateY: [20, 0],
    opacity: 1,
    autoplay: false,
    easing: 'easeInOutSine',
    delay: anime.stagger(200) // increase delay by 100ms for each elements.
  }),
}
module.exports = Header

