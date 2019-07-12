const SinglePostType = {
  init(body){
    this.cacheDom(body)
    this.addEvents()
    console.log('I am only visble on single post types');
  },
  cacheDom(body){
    this.body = body

  },
  addEvents(){


  }
}
module.exports = SinglePostType