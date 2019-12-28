import Global from '../base/globals';

const AddToCart = {
  init(scope){
    this.cacheDom(scope)
    this.addEvents()
  },
  cacheDom(scope){
    this.body = scope
    this.btnAddToCart = this.body.querySelectorAll('.addToCart')
  },
  addEvents() {
    this.btnAddToCart.forEach(btn => {
      btn.addEventListener('click', this.handleAddToCartClick.bind(this))
    });
  },
  handleAddToCartClick(e) {
    var clickedBtn = e.target.closest('.addToCart'),
      productId = clickedBtn.dataset.productId,
      path = location.hostname == 'localhost' ?    '/uni/cart/?add-to-cart=' + productId : '/cart/?add-to-cart=' + productId;
      location.href = path
  }
}
module.exports = AddToCart