var $ = window.jQuery
import Owl from "../modules/module-owl";
const HeroSlider = {
  sliderOprions: {
    stagePadding: 0,
    loop: true,
    margin: 0,
    items: 1,
    autoplay: true,
    autoplaySpeed: 1500,
    autoplayTimeout: 4000,
    navigation : false,
    slideSpeed: 1200,
    paginationSpeed : 1200,
    rewindSpeed : 1200,
    singleItem: true,
    dotsEach: 1,
    stopOnHover : true,
    lazyLoad: true,
  },
  init(scope){
    this.cacheDom(scope)
    this.setSLider()
  },
  cacheDom(scope){
    this.body = scope
    this.heroSlides = this.body.querySelectorAll('.uni_section__hero__row');
  },
  setSLider(sliderOprions) {
    if (this.heroSlides.length > 1) {
      Owl.init(this.body, '.slider', this.sliderOprions)
    }
  }
}
module.exports = HeroSlider