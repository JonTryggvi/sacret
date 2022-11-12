import Global from '../base/globals'
import { LoadCatCards } from "../components/load-cat-cards";
let domBody = Global.cacheBody()
let navCardSecton = domBody.querySelector('.uni_section__cat_nav')

LoadCatCards.init(navCardSecton)