import Globals from "./base/globals.js";
import Header from "./components/component-header.js";
// import DrawSvg from "./effects/draw-svg";
// import Animation from "./effects/animation";
import MailChimp from "./components/component-mailchimp.js";
jQuery.fn.exists = function (callback) {
  let args = [].slice.call(arguments, 1);
  if (this.length) {
    callback.call(this, args);
  }
  return this;
}
window.sr = ScrollReveal();

// global variable stores body and we can use that to send to our modules
let domBody = Globals.cacheBody();
let mainarea = domBody.querySelector('#mainarea')
// initiate the demo_module from /components/demo_module

window.addEventListener('load', e => {
  Header.init(domBody, true)
  MailChimp.init(domBody, Globals)
  if (null != mainarea) {
    mainarea.classList.add('mainarea--loaded')
  }
  // Animation.init(sr)
  // DrawSvg.init(domBody)
})
// MailChimp.init(domBody, Globals)
