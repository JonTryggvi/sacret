import Globals from "./base/globals";
import Header from "./components/component-header";
import DrawSvg from "./effects/draw-svg";
import MailChimp from "./components/component-mailchimp";
jQuery.fn.exists = function (callback) {
  let args = [].slice.call(arguments, 1);
  if (this.length) {
    callback.call(this, args);
  }
  return this;
}

// global variable stores body and we can use that to send to our modules
var domBody = Globals.cacheBody();

// initiate the demo_module from /components/demo_module
Header.init(domBody)
window.addEventListener('load', e => {
  DrawSvg.init(domBody)
})

MailChimp.init(domBody, Globals)

