import Globals from "./base/globals.js";
import AddToCart from './components/component-addToCart.js';

let domBody = Globals.cacheBody();
AddToCart.init(domBody)
