var $ = window.jQuery
import Owl from "../modules/module-owl";
import anime from 'animejs/lib/anime.es.js'

  
const HeroSlider = {
  sliderOptions: {
    stagePadding: 0,
    loop: true,
    margin: 0,
    items: 1,
    autoplay: true,
    autoplaySpeed: 10000,
    autoplayTimeout: 10000,
    navigation : true,
    // slideSpeed: 4000,
    // rewindSpeed : 4000,
    // paginationSpeed : 4000,
    singleItem: true,
    dotsEach: 1,
    stopOnHover : true,
    lazyLoad: true,
    animateIn: 'fadeIn',
    animateOut: 'fadeOut',
    onTranslate(e) {
      // HeroSlider.animation.reset()
      // HeroSlider.animationBtn.reset()
    },
    onTranslated(e){
      HeroSlider.animation.play()
      HeroSlider.animationBtn.play()
    }
  },
  init(scope){
    this.cacheDom(scope)
    this.setSLider(this.sliderOptions)
    this.animation.play();
    this.animationBtn.play();
  },
  cacheDom(scope){
    this.body = scope
    this.heroSlides = this.body.querySelectorAll('.uni_section__hero__row');
    this.sliderContainer = this.body.querySelector('.slider')
  },
  setSLider(sliderOptions) {
    if (this.heroSlides.length > 1) {
      Owl.init(this.body, '.slider', sliderOptions)
    }
  },
  animation: anime({
    targets: '.uni_section__hero__row .stagger',
    translateY: [
      {value: 20, duration: 0 },
      {value: 0, duration: 300 },
      {value: 0, duration: 7500 },
      {value: 20, duration: 200 },
    ],
    opacity: [
      {value: 0, duration: 0 },
      {value: 1, duration: 200 },
      {value: 1, duration: 7600 },
      {value: 0, duration: 200 }
    ],
    autoplay: false,
    easing: 'spring(1, 80, 10, 0)',
    delay: anime.stagger(200) // increase delay by 100ms for each elements.
  }),
  animationBtn: anime({
    targets: '.uni_section__hero__row .staggerBtn',
    translateY: [
      {value: 20, duration: 0, delay: 100 },
      {value: 0, duration: 300, delay: 100 },
      {value: 0, duration: 7300, delay: 150 },
      {value: 20, duration: 100 , delay:100},
    ],
    opacity: [
      {value: 0, duration: 0, delay: 100 },
      {value: 1, duration: 200, delay: 100  },
      {value: 1, duration: 7600, delay: 50 },
      {value: 0, duration: 100 , delay: 0}
    ],
    autoplay: false,
    easing: 'spring(1, 80, 10, 0)',
    // delay: anime.stagger(400) // increase delay by 100ms for each elements.
  }),

  
}
module.exports = HeroSlider