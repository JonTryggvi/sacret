const Animation = {
  init(sr) {
    this.sr = sr
    this.fadeIn();
  },

  fadeIn() {
    this.sr.reveal('.item-fadein', {
      reset: false,
      delay: 700,
      duration: 800,
      distance: '20px',
      interval: 200,
      // opacity: 0,
      // viewFactor: 0.9,
      // container: '.card-container'
    }) 
    
  },
  animationSync(sr = this.sr) {
    console.log('runs')
    sr.sync()
  }
}
export default Animation