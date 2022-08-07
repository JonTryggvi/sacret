import Globals from "./base/globals";
import AddToCart from './components/component-addToCart';
import HeroSlider from "./components/component-hero-slider"

var domBody = Globals.cacheBody();
HeroSlider.init(domBody)
AddToCart.init(domBody)
