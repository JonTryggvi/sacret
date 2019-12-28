var $ = window.jQuery
import Owl from "../modules/module-owl";
const HeroSlider = {
  sliderOptions: {
    stagePadding: 0,
    loop: true,
    margin: 0,
    items: 1,
    autoplay: true,
    autoplaySpeed: 1200,
    autoplayTimeout: 5000,
    navigation : false,
    slideSpeed: 1200,
    paginationSpeed : 1200,
    rewindSpeed : 1200,
    singleItem: true,
    dotsEach: 1,
    stopOnHover : true,
    lazyLoad: true,
    animateIn: 'fadeIn',
    animateOut: 'fadeOut',
    onTranslate() {
      // $('.slider').addClass('visibility__hidden')
      // $('.slider').removeClass('visibility__visible')
    },
    onTranslated(){
      // $('.slider').addClass('visibility__visible')
      // $('.slider').removeClass('visibility__hidden')
      
    }
  },
  init(scope){
    this.cacheDom(scope)
    this.setSLider(this.sliderOptions)
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
  }
}
module.exports = HeroSlider