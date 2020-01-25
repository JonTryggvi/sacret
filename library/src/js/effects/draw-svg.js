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
    const scrollpercent = (this.body.scrollTop + document.documentElement.scrollTop) / (document.documentElement.scrollHeight - document.documentElement.clientHeight)
    this.setPaths(scrollpercent)
  },
  setPaths(scrlPerc = false) {
    this.paths.forEach(path => {
      const length = path.getTotalLength()
      path.style.strokeDasharray = length
      path.style.strokeDashoffset = length
      if (scrlPerc) {
        const draw = length > 1000 ? length * scrlPerc / 50 : length * scrlPerc
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