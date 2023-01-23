const CardHoverState = {
  init(scope){
    this.cacheDom(scope)
    this.addEvents()
  },
  cacheDom(scope){
    this.body = scope
    this.uniCards = this.body.querySelectorAll('.uni_card')
  },
  addEvents(){
    this.uniCards.forEach(card => {
      card.onmouseenter = (e) => {
          e.target.closest('.uni_card').classList.add('hovering')
      }
      card.onmouseleave = (e) => {
        setTimeout(() => {
          e.target.closest('.uni_card').classList.remove('hovering')
        }, 1000);
      }
    })

  }
}
export { CardHoverState }