$ = window.$
let sr =  ScrollReveal();
const Header = {
  scrolled: false,
  init(body){
    this.cacheDom(body)
    this.addEvents()
    
  },
  cacheDom(body){
    this.header = body.querySelector('header')
    this.nav = this.header.querySelector('nav')
    this.navUl = this.header.querySelector('.uni_header__nav-list')
    this.menuItems = this.nav.querySelectorAll('.menu-item')
    this.magicLine = this.nav.querySelector('.magic-line')
    this.hamburger = this.nav.querySelector('.menu_hamburger')
    
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
      if (this.header.classList.contains('menu-open')) {

        sr.reveal(this.menuItems, {
          scale: 1,
          reset: false,
          // mobile: fal,
          duration: 1000,
          distance: '20px',
          interval: 250,
          origin: 'bottom'
        });
      }
    })
    window.onload = e => {
      if (!this.header.classList.contains('menu-open')) {
        sr.reveal(this.menuItems, {
          scale: 1,
          reset: false,
          mobile: false,
          duration: 600,
          distance: '10px',
          interval: 200,
          origin: 'bottom'
        });
      }
    }
  },
  handleWindowScroll(e) {
    var scrollTop = e.srcElement.scrollingElement.scrollTop;
    if (scrollTop > 30 && !this.scrolled) {
      this.header.classList.add('bc__header--white')
      this.scrolled = true
    } else if(scrollTop < 30){
      this.header.classList.remove('bc__header--white')
      this.scrolled = false
    }
    console.log(this.scrolled)
  },
  handleMenuItemMouseover(e) {
    const liItem = e.target.closest('.menu-item')
    const menuItemPosition = liItem.getBoundingClientRect()
    this.setMacigLine(this.magicLine, menuItemPosition.left, menuItemPosition.top, menuItemPosition.width)
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
  },

}
module.exports = Header