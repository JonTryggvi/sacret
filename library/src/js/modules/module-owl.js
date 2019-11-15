$ = window.jQuery
import "owl.carousel";
const Owl = {
  init(scope, sliderName, sliderOptions){
    this.cacheDom(scope, sliderName)
    this.setSlider(this.sliderContainer, sliderOptions)
  },
  cacheDom(scope, sliderName){
    this.body = scope;
    this.sliderContainer = this.body.querySelector(sliderName)
  },
  setSlider(slider, sliderOptions) {
    $(slider).owlCarousel(sliderOptions);
  }
}
module.exports = Owl