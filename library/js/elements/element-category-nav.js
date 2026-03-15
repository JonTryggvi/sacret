import Global from '../base/globals.js'
import { LoadCatCards } from "../components/load-cat-cards.js";
let domBody = Global.cacheBody()
let navCardSecton = domBody.querySelector('.uni_section__cat_nav')
LoadCatCards.init(navCardSecton)
