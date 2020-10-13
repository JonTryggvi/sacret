import Globals from "../base/globals";
import QuoteSection from "../components/component-quote"
// global variable stores body and we can use that to send to our modules
var domBody = Globals.cacheBody();

QuoteSection.init(domBody)



