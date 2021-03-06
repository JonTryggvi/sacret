const Animation = {
  init(sr) {
    this.sr = sr
    this.fadeIn();
  },

  fadeIn() {
    this.sr.reveal('.item-fadein', {
      reset: false,
      delay: 700,
      duration: 1200,
      distance: '20px',
      interval: 600,
      // opacity: 0,
      // viewFactor: 0.9,
      // container: container
    }) 
    
  },
  animationSync(sr = this.sr) {
    sr.sync()
  }
}
module.exports = Animation