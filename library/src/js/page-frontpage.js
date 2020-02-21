import Globals from "./base/globals";
import HeroSlider from "./components/component-hero-slider"
import LoadMore from "./ajax_components/loadmore"
// global variable stores body and we can use that to send to our modules
var domBody = Globals.cacheBody();
console.log('i run')
HeroSlider.init(domBody)
LoadMore.init(domBody) 
