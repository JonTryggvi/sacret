// not in use! went for slack
$ = window.jQuery
import "owl.carousel";
const Owl = {
  init(scope, sliderName, sliderOptions){
    this.cacheDom(scope, sliderName)
    return this.setSlider(this.sliderContainer, sliderOptions)
  },
  cacheDom(scope, sliderName){
    this.body = scope;
    this.sliderContainer = this.body.querySelector(sliderName)
  },
  setSlider(slider, sliderOptions) {
    return $(slider).owlCarousel(sliderOptions);
  }
}
module.exports = Owl