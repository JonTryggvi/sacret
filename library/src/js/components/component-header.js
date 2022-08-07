$ = window.$
// let sr = ScrollReveal();
import anime from 'animejs/lib/anime.es.js'
const Header = {
  scrolled: false,
  init(body, loaded){
    this.cacheDom(body)
    this.addEvents()
    if (window.innerWidth > 414) {
      this.animation.play()
    }
    
  },
  cacheDom(body) {
    this.body = body
    this.header = body.querySelector('header')
    this.nav = this.header.querySelector('nav')
    this.navUl = this.header.querySelector('.uni_header__nav-list')
    this.menuItems = this.nav.querySelectorAll('.menu-item:not(.sub-menu > .menu-item)')
    this.magicLine = this.nav.querySelector('.magic-line')
    this.hamburger = this.nav.querySelector('.menu_hamburger')
    // this.btnCart = this.nav.querySelector('.toggle-cart');
    // this.miniCart = body.querySelector('.uni-minicart')
    this.iMenuItems = this.menuItems.length
    
  },
  addEvents() {
    this.theme_color = this.header.dataset.theme_color;
    this.menuItems.forEach(menuItem => {
      // if(menuItem.parentNode.classList.contains('sub'))
      // menuItem.addEventListener('mouseover', this.handleMenuItemMouseover.bind(this))
      menuItem.addEventListener('mouseenter', this.handleMenuItemMouseEnter.bind(this))
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
  handleBtnCartClick(e) {
    this.miniCart.classList.toggle('mini-active')
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
  handleMenuItemMouseover(e) {
    const liItem = e.target.closest('.menu-item:not(.sub-menu > .menu-item)')
    const menuItemPosition = liItem.getBoundingClientRect()
    this.setMacigLine(this.magicLine, liItem.offsetLeft, menuItemPosition.top, menuItemPosition.width)
  },
  handleMenuItemMouseEnter(e) {
    const liItem = e.target.closest('.menu-item:not(.sub-menu > .menu-item)')
    const menuItemPosition = liItem.getBoundingClientRect()
    this.setMacigLine(this.magicLine, liItem.offsetLeft, menuItemPosition.top, menuItemPosition.width)
    if (liItem.classList.contains('menu-item-has-children') && this.currentSubMenu == null) {
      this.currentSubMenu = liItem.querySelector('#' + liItem.id + ' .sub-menu');
      this.currentSubMenu.classList.add('active')
      this.animateMenu = this.submenuAnimationIn('#' + liItem.id + ' .sub-menu')
      this.animateMenu.play()
      
    }
  },
  handleMenuItemMouseleave(e) {
    const liItem = e.target.closest('.menu-item:not(.sub-menu > .menu-item)')
    this.hideMagicLine(this.magicLine)
    if (this.currentSubMenu) {
      this.submenuAnimationOut('.sub-menu.active').play()
      this.currentSubMenu.classList.remove('active')
      this.currentSubMenu = null
    }
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
    // sr.reveal(this.menuItems, options);
  },
  animation: anime({
    targets: '#menu-main-nav .menu-item:not(.sub-menu > .menu-item)',
    translateY: [20, 0],
    opacity: 1,
    autoplay: false,
    easing: 'easeInOutSine',
    delay: anime.stagger(200) // increase delay by 100ms for each elements.
  }), 
  submenuAnimationIn(target) {
    return anime.timeline({ autoplay: false,
    }).add({
          targets: target,
          translateY: [{value:-10, delay:2, duration: 400}, {value:0, delay:2, duration: 400}],
          opacity: [{ value: 0, delay: 2, duration: 400 }, {value:1, delay: 2, duration: 400}],
          scale: [{ value: 0, delay:0, duration: 1 }, { value: 1, delay: 0, duration: 1 }],
          easing: 'easeInOutSine',
        }).add({
          targets: '.sub-menu.active li',
          translateX: [10, 0],
          opacity: [0, 1],
          delay: anime.stagger(100)
    })
  },
  submenuAnimationOut(target) {
    return anime({
      targets: target,
      translateY: [{ value: 0, delay: 0, duration: 200 }, { value: -10, delay: 0, duration: 200 }],
      opacity: [{ value: 1, delay: 0, duration: 210 }, { value: 0, delay: 0, duration: 210 }],
      scale: [{ value: 1, delay: 400, duration: 1 }, { value: 0, delay: 400, duration: 1 }],
      autoplay: false,
      easing: 'easeInOutSine',
      duration: 400,
      
    })
  },
}
module.exports = Header

