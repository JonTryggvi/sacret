let $ = jQuery
let sr = ScrollReveal()

const QuoteSection = {
  init(scope){
    this.cacheDom(scope)
    this.reveal(this.main, this.ops)
  },
  cacheDom(scope){
    this.body = scope
    this.q_section = this.body.querySelector('.uni_section_quote')
    this.main = this.q_section.querySelector('main')
    this.accent = this.main.querySelector('.q-accent')

  },
  reveal(el, options) {
    // console.log(options)
    sr.reveal(el, options);
  },
  ops:{
    // mobile: true,
    duration: 700,
    delay: 100,
    distance: '20px',
    interval: 200,
    origin: 'bottom',
    viewFactor: 0.2,
    opacity: 0,
    // easing: 'linier',
    afterReveal: function (el) {
      QuoteSection.accent.classList.add('q-accent--active')
    }
  }
}
export default QuoteSection
