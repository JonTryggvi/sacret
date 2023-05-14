import Global from '../base/globals'
import Animation from "../effects/animation"
// import { CardHoverState } from '../components/component-card'

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
    this.mainArea = this.body.querySelector('#mainarea');
  },

  get_products(page = 1, hasButton) {
    this.ajaxObj.page = page
    this.ajaxObj.preselected = this.section.dataset.hasOwnProperty('preselected') ? this.section.dataset.preselected : false;
    this.ajaxObj.per_page = this.section.dataset.hasOwnProperty('per_page') ? this.section.dataset.per_page : 4;
    Global.postAjax(this.ajaxObj).done(res => {
      if (page == 1) {
        this.cardContainer.innerHTML = res.products
      }
      if (page > 1) {
        this.cardContainer.insertAdjacentHTML('beforeend', res.products)
      }
      Animation.init(window.sr, '#' + this.cardContainer.id)
      if (res.queryObject?.max_num_pages && res.queryObject.max_num_pages > 1 && hasButton )  {
        this.loadMoreBtn = this.section.querySelector('.btnLoadMore')
        this.loadMoreBtn.dataset.nextPage = parseInt(this.loadMoreBtn.dataset.nextPage) + 1
        res.queryObject.max_num_pages <= page ? this.loadMoreBtn.classList.add('visibility__hidden') : this.loadMoreBtn.classList.remove('visibility__hidden')
      }
      // CardHoverState.init(this.body)
      this.mainArea.classList.add('mainarea--loaded');
      Animation.animationSync(window.sr)
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
    this.cardContainer = this.section.querySelector('.card-container')
    this.loadMoreBtn = this.section.querySelector('.btnLoadMore')
    this.mainArea = this.body.querySelector('#mainarea');
  },
  get_posts(page = 1, hasButton) {
    this.ajaxObj.page = page
    this.ajaxObj.term_id = this.section.dataset.hasOwnProperty('termId') ? this.section.dataset.termId : false;
    this.ajaxObj.preselected = this.section.dataset.hasOwnProperty('preselected') ? this.section.dataset.preselected : false;
    this.ajaxObj.per_page = this.section.dataset.hasOwnProperty('per_page') ? this.section.dataset.per_page : 4;
    this.ajaxObj.post_id = this.section.dataset.hasOwnProperty('post_id') ? this.section.dataset.post_id : false;
    this.ajaxObj.post_type = this.section.dataset.hasOwnProperty('post_type') ? this.section.dataset.post_type : 'post';
    Global.postAjax(this.ajaxObj).done(res => {
      if (page == 1) {
        this.cardContainer.innerHTML = res.posts
      }
      if (page > 1) {
        this.cardContainer.insertAdjacentHTML('beforeend', res.posts)
      }
      Animation.init(window.sr, '#'+this.cardContainer.id)
      if (res.queryObject?.max_num_pages && res.queryObject.max_num_pages > 1 && hasButton) {
        this.loadMoreBtn.dataset.nextPage = parseInt(this.loadMoreBtn.dataset.nextPage) + 1
        res.queryObject.max_num_pages <= page ? this.loadMoreBtn.classList.add('visibility__hidden') : this.loadMoreBtn.classList.remove('visibility__hidden')
      }
      this.mainArea.classList.add('mainarea--loaded');
      Animation.animationSync(window.sr)
      // CardHoverState.init(this.body)
      this.cacheDom(this.body)
    })
  }
}

export { GetProducts, GetPosts }