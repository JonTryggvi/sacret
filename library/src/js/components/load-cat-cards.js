import Animation from "../effects/animation"

const LoadCatCards = {
  init(scope) {
    this.cacheDOM(scope) 
  },
  cacheDOM(scope) {
    this.section = scope;
    this.cards = this.section.querySelectorAll('.uni_card')
    Animation.init(ScrollReveal())
    Animation.animationSync()
  }
}

export {LoadCatCards}