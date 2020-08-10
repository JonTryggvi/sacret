import Globals from "./base/globals";
import HeroSlider from "./components/component-hero-slider"
import QuoteSection from "./components/component-quote"
import LoadMore from "./ajax_components/loadmore"
// global variable stores body and we can use that to send to our modules
var domBody = Globals.cacheBody();
HeroSlider.init(domBody)
LoadMore.init(domBody) 
QuoteSection.init(domBody)
// window.onload = () => {

// }


