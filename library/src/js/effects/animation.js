const Animation = {
  init(sr, currentContainer) {
    this.sr = sr
    this.fadeIn(currentContainer);
  },
  fadeIn(currentContainer) {
    let fadein = document.querySelectorAll('.item-fadein')
    this.sr.reveal(fadein, {
      reset: false,
      delay: 700,
      duration: 800,
      distance: '20px',
      interval: 200,
      // opacity: 0,
      // viewFactor: 0.9,
      container: currentContainer
    })
  },
  animationSync(sr = this.sr) {
    sr.sync()
  }
}
export default Animation