var $ = window.jQuery
// import Owl from "../modules/module-owl";
import slick from 'slick-slider';
import anime from 'animejs/lib/anime.es.js'
const HeroSlider = {
  
  init(scope){
    this.cacheDom(scope)
    let sliderCount = this.sliderContainer ?   parseInt(this.sliderContainer.dataset.slide_count) : 0;
    this.is_slider = sliderCount > 1 // this.heroSlides.length > 1
    this.setSLider()
    this.addEvents()
  },
  cacheDom(scope){
    this.body = scope
    this.heroSlides = this.body.querySelectorAll('.uni_section__hero__row');
    this.sliderContainer = this.body.querySelector('.slider')
  },
  setSLider() {
    // if (this.is_slider)
    {
     let slider =  $('.slider').slick({
        // dots: true,
        infinite: true,
        speed: 0,
        slidesToShow: 1,
        autoplay: true,
       autoplaySpeed: 10000,
       lazyLoad: 'progressive'
      });
      slider.on('afterChange', e => {
        HeroSlider.animation(HeroSlider.is_slider, 'animatOptMulti').play()
      })
    }
  },
  addEvents() {
    window.onload = e => {
      this.animation(this.is_slider).play();
      this.animationBtn(this.is_slider).play();
    }
  },
  animatOptMulti: {
    targets: '.uni_section__hero__row .stagger',

    translateY: [
      { value: 20, duration: 0 },
      { value: 0, duration: 300 },
      { value: 0, duration: 7500 },
      { value: 20, duration: 200 },
    ],
    opacity: [
      { value: 0, duration: 0 },
      { value: 1, duration: 200 },
      { value: 1, duration: 7600 },
      { value: 0, duration: 200 }
    ],
    autoplay: false,
    easing: 'linear',
    delay: anime.stagger(200), // increase delay by 100ms for each elements.

  },
  animatOptMulti_out: {
    targets: '.uni_section__hero__row .stagger',
    translateY: [
      { value: 20, duration: 0 },
      { value: 0, duration: 300 },
      { value: 0, duration: 7500 },
      { value: 0 , duration: 200 },
    ],
    opacity: [
      { value: 0, duration: 0 },
      { value: 1, duration: 200 },
      { value: 1, duration: 7600 },
      { value: 1, duration: 200 }
    ],
    autoplay: false,
    // easing: 'easeInOutQuad',
    // delay: anime.stagger(200), // increase delay by 100ms for each elements.

  },
  animatOptSolo: {
    targets: '.uni_section__hero__row .stagger',
    translateY: [20, 0],
    opacity: [0, 1],
    // translateY: [
    //   { value: 20, duration: 200 },
    //   { value: 0, delay: 300, duration: 300 },
    //   { value: 0, duration: 7500 },
    //   { value: 0, duration: 200 },
    // ],
    // opacity: [
    //   { value: 0, duration: 0 },
    //   { value: 1, duration: 200 },
    //   { value: 1, duration: 7600 },
    //   { value: 1, duration: 200 }
    // ],
    autoplay: false,
    easing: 'spring(1, 80, 10, 0)',
    delay: anime.stagger(400), // increase delay by 100ms for each elements.

  },
  animatBtnOptMulti: {
    targets: '.uni_section__hero__row .staggerBtn',
    translateY: [
      { value: 20, duration: 0, delay: 100 },
      { value: 0, duration: 300, delay: 100 },
      { value: 0, duration: 7300, delay: 150 },
      { value: 20, duration: 100, delay: 100 },
    ],
    opacity: [
      { value: 0, duration: 0, delay: 100 },
      { value: 1, duration: 200, delay: 100 },
      { value: 1, duration: 7600, delay: 50 },
      { value: 0, duration: 100, delay: 0 }
    ],
    autoplay: false,
    easing: 'spring(1, 80, 10, 0)',
    // delay: anime.stagger(400) // increase delay by 100ms for each elements.
  },
  animatBtnOptSolo: {
    targets: '.uni_section__hero__row .staggerBtn',
    translateY: [
      { value: 20, duration: 0, delay: 100 },
      { value: 0, duration: 300, delay: 100 },
      { value: 0, duration: 7300, delay: 150 },
      { value: 0, duration: 100, delay: 100 },
    ],
    opacity: [
      { value: 0, duration: 0, delay: 100 },
      { value: 1, duration: 200, delay: 100 },
      { value: 1, duration: 7600, delay: 50 },
      { value: 1, duration: 100, delay: 0 }
    ],
    autoplay: false,
    easing: 'spring(1, 80, 10, 0)',
    // delay: anime.stagger(400) // increase delay by 100ms for each elements.
  },
  animation(is_slider, inout = 'animatOptMulti') { console.log(inout);  return anime(is_slider ? this[inout] : this.animatOptSolo)},
  animationBtn(is_slider){return anime(is_slider ? this.animatBtnOptMulti : this.animatBtnOptSolo)},

  
}
export default HeroSlider