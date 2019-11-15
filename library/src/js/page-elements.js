import Globals from "./base/globals";
import HeroSlider from "./components/component-hero-slider"
// global variable stores body and we can use that to send to our modules
console.log(Globals.cacheBody())
var domBody = Globals.cacheBody();

// initiate the demo_module from /components/demo_module
HeroSlider.init(domBody)