const Demo_module = {
  init(body){
    this.cacheDom(body)
    this.addEvents()
    console.log(this.body)
  },
  cacheDom(body){
    this.body = body

  },
  addEvents(){


  }
}
module.exports = Demo_module