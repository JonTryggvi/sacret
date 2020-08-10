import Global from '../base/globals'
import Animation from "../effects/animation"

const GetProducts = {
  ajaxObj: {
    action: 'get_products',
    security: phpObj.ajax_nonce,
    lang: phpObj.lang
  },
  init(scope, page, hasButton){
    this.cacheDom(scope)
    this.get_products(page, hasButton)
  },
  cacheDom(scope){
    this.body = scope
    this.section = this.body.querySelector('.uni_section__products')
    this.cardContainer = this.section.querySelector('.card-container')
  },
  
  get_products(page = 1, hasButton) {
    this.ajaxObj.page = page
    Global.postAjax(this.ajaxObj).done(res => {
      if (page == 1) {
        this.cardContainer.innerHTML = res.products
      }
      if (page > 1) {
        this.cardContainer.insertAdjacentHTML('beforeend', res.products)
      }
      if (res.queryObject.max_num_pages > 1 && hasButton )  {
        this.loadMoreBtn = this.section.querySelector('.btnLoadMore')
        this.loadMoreBtn.dataset.nextPage = parseInt(this.loadMoreBtn.dataset.nextPage) + 1
        res.queryObject.max_num_pages <= page ? this.loadMoreBtn.classList.add('visibility__hidden') : this.loadMoreBtn.classList.remove('visibility__hidden')
      }
      this.cacheDom(this.body)
    })
  }
}
const GetPosts = {
  ajaxObj: {
    action: 'get_uni_posts',
    security: phpObj.ajax_nonce,
    lang: phpObj.lang
  },
  init(scope, page, hasButton) {
    this.cacheDom(scope)
    this.get_posts(page, hasButton)
    
  },
  cacheDom(scope){
    this.body = scope
    this.section = this.body.querySelector('.uni_section__posts')
    this.cardContainer = this.section.querySelector('.uni_section__posts__container')
    this.loadMoreBtn = this.section.querySelector('.btnLoadMore')
  },
  get_posts(page = 1, hasButton) {
    this.ajaxObj.page = page
    Global.postAjax(this.ajaxObj).done(res => {
      if (page == 1) {
        this.cardContainer.innerHTML = res.posts
      }
      if (page > 1) {
        this.cardContainer.insertAdjacentHTML('beforeend', res.posts)
      }
      Animation.init(ScrollReveal())
      if (res.queryObject.max_num_pages >= 1 && hasButton) {
        this.loadMoreBtn.dataset.nextPage = parseInt(this.loadMoreBtn.dataset.nextPage) + 1
        res.queryObject.max_num_pages <= page ? this.loadMoreBtn.classList.add('visibility__hidden') : this.loadMoreBtn.classList.remove('visibility__hidden')
      } 
      Animation.animationSync(ScrollReveal())
      this.cacheDom(this.body)
    })
  }
}

module.exports = { GetProducts, GetPosts }