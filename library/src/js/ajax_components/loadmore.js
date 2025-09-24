import { GetProducts, GetPosts } from './get_posttypes'

const LoadMore = {
  hasButton: false,
  init(scope) {
    this.cacheDom(scope)
    const $buttons = jQuery('.btnLoadMore');
    if ($buttons.length) {
      this.hasButton = true;
      this.addEvents()
    }
    this.getAvailablePosttypes(this.ajaxSections)
  },
  cacheDom(scope) {
    this.body = scope
    this.btnLoadMore = this.body.querySelector('.btnLoadMore')
    this.ajaxSections = this.body.querySelectorAll('[data-post-type]')
  },
  getAvailablePosttypes(sections) {
    sections.forEach((section, i) => {
      this.renderCards(section.dataset.postType, 1, this.hasButton)
    })
  },
  addEvents() {
    this.btnLoadMore.onclick = this.handleLoadMoreClick.bind(this)
  },
  handleLoadMoreClick(e) {
    this.hasButton = true
    let clickedItem = e.target.closest('.btnLoadMore')
    let postType = clickedItem.closest('[data-post-type]').dataset.postType
    let nextPage = parseInt(clickedItem.dataset.nextPage)
    this.renderCards(postType, nextPage, this.hasButton)
  },
  renderCards(post_type, page = 1, hasButton) {
    const post_types = {
      'product': (_this) => GetProducts.init(_this.body, page, hasButton),
      'post': (_this) => GetPosts.init(_this.body, page, hasButton)
    }
    post_types[post_type](this, page)
  }
}
export default LoadMore
