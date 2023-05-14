const HorizontalScrolling = {
  time: 1,
  init(args) {
    let is_archive = this.cacheDom(args)
    if (!is_archive) {
      let counter = 'counter_' + this.slider.id
      let hold_time = 'hold_time_' + this.slider.id
      this[hold_time] = 0
      this[counter] = 0
      this.addEvents()
    }
  },
  cacheDom(args){
    this.slider = args.sliderWrapper
    this.scrollForward = this.slider.querySelector('.scrollForward')
    this.scrollBack = this.slider.querySelector('.scrollBack')
    this.productContainer = this.slider.querySelector('.card-container')
    return this.slider.classList.contains('archive')
  },
  addEvents(){
    this.scrollForward.addEventListener('mousedown', this.handleMouseEvent.bind(this))
    this.scrollForward.addEventListener('mouseup', this.handleMouseEvent.bind(this))
    this.scrollForward.addEventListener('click', this.handleMouseEvent.bind(this))
    this.scrollForward.addEventListener('mouseleave', this.handleMouseEvent.bind(this))
    this.scrollBack.addEventListener('mousedown', this.handleMouseEvent.bind(this))
    this.scrollBack.addEventListener('mouseup', this.handleMouseEvent.bind(this))
    this.scrollBack.addEventListener('click', this.handleMouseEvent.bind(this))
    this.scrollBack.addEventListener('mouseleave', this.handleMouseEvent.bind(this))
    this.productContainer.addEventListener('scroll', this.handleContainerScroll.bind(this))
  },
  handleMouseEvent(e) {
    let container = e.target.closest('.uni_section')
    let direction = 'direction_' + container.id
    this[direction] = e.target.closest('.scrollBtn').classList.contains('scrollForward');
    this[e.type](e)
  },
  mousedown(e) {
    e.preventDefault()
    let container = e.target.closest('.uni_section')
    let timer_id = 'timer_'+container.id
    let direction = 'direction_' + container.id
    let counter = 'counter_' + container.id
    let productContainer = container.querySelector('.card-container')
    let down = 'down_' + container.id
    this[down] = +new Date()
    this[timer_id] = setInterval(() => {
      this[direction] ? this[counter]++ : this[counter]--;
      productContainer.scroll({ left: this[counter], top: 0, behavior: 'instant' })
    }, this.time)
  },
  mouseup(e) {
    let container = e.target.closest('.uni_section')
    let timer_id = 'timer_' + container.id
    let hold_time = 'hold_time_' + container.id
    let down = 'down_' + container.id
    let up = +new Date()
    clearInterval(this[timer_id]);
    this[hold_time] = up - this[down]
    this[timer_id] = 0
  },
  mouseleave(e) {
    let container = e.target.closest('.uni_section')
    let timer_id = 'timer_' + container.id
    clearInterval(this[timer_id]);
  },
  click(e) {
    let container = e.target.closest('.uni_section')
    let direction = 'direction_' + container.id
    let counter = 'counter_' + container.id
    let hold_time = 'hold_time_' + container.id
    if (this[hold_time] < 200) {
      let productContainer = container.querySelector('.card-container')
      this[counter] += this[direction] ? productContainer.offsetWidth : -productContainer.offsetWidth;
      console.log(this[counter])
      productContainer.scroll({ left: this[counter], top: 0, behavior: 'smooth' })
    }
  },
  scrollFunction(e) {
    let container = e.target.closest('.uni_section')
    let direction = 'direction_' + container.id
    let counter = 'counter_' + container.id
    let productContainer = container.querySelector('.card-container')
    this[direction] ? this[counter]++ : this[counter]--;
    productContainer.scroll({ left: this[counter] , top: 0, behavior: 'instant'})
  },
  handleContainerScroll(e) {
    let container = e.target.closest('.uni_section')
    let counter = 'counter_' + container.id
    this[counter] = e.target.scrollLeft
    let scrollBack = e.target.closest('.uni_section').querySelector('.scrollBack')
    let scrollForward = e.target.closest('.uni_section').querySelector('.scrollForward')
    0 < e.target.scrollLeft ? scrollBack.classList.remove('visibility__hidden') : scrollBack.classList.add('visibility__hidden')
    50 < e.target.scrollWidth - (e.target.offsetWidth + e.target.scrollLeft) ? scrollForward.classList.remove('visibility__hidden') : scrollForward.classList.add('visibility__hidden')
  }
}
module.exports = { HorizontalScrolling }