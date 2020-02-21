const DrawSvg = {
  init(scope){
    this.cacheDom(scope)
    this.addEvents()
    this.setPaths()
  },
  cacheDom(scope){
    this.body = scope
    this.svgMandala = this.body.querySelector('.svgBody')
    this.paths = this.svgMandala.querySelectorAll('path')
    this.gMandala = this.svgMandala.querySelector('#mandala')
  },
  addEvents(){
    window.addEventListener('scroll', this.handleScroll.bind(this))
  },
  handleScroll(e) {
    var h = document.documentElement,
      b = document.body,
      st = 'scrollTop',
      sh = 'scrollHeight';
    var percent = (h[st] || b[st]) / ((h[sh] || b[sh]) - h.clientHeight);
    this.setPaths(percent)
  },
  setPaths(scrlPerc = false) {
    this.paths.forEach(path => {
      const length = path.getTotalLength()
      path.style.strokeDasharray = length
      path.style.strokeDashoffset = length
      if (scrlPerc) {
        const draw = length > 1000 ? length * scrlPerc : length * scrlPerc
        path.style.strokeDashoffset = length - draw
        if (scrlPerc <= 0.2) {
          this.svgMandala.style.opacity = scrlPerc
        }
      }
      if (scrlPerc === 1) {
        this.gMandala.classList.add('svgFill')
        path.classList.add('svgPath')
        this.svgMandala.classList.add('svgShadow')
      } else {
        this.gMandala.classList.remove('svgFill')
        path.classList.remove('svgPath')
        this.svgMandala.classList.remove('svgShadow')
      }
    })
  }
}
module.exports = DrawSvg