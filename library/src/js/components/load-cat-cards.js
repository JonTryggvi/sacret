import Animation from "../effects/animation"

const LoadCatCards = {
  init(scope) {
    this.cacheDOM(scope)
  },
  cacheDOM(scope) {
    this.section = scope;
    this.cards = this.section.querySelectorAll('.uni_card')
    console.log(this.section.querySelector('.cat-nav-container').id)
    Animation.init(window.sr, '#'+this.section.querySelector('.cat-nav-container').id)
    Animation.animationSync(window.sr)
  }
}

export {LoadCatCards}