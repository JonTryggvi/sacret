import Globals from "./base/globals";
import Demo_module from "./components/demo_module";
// global variable stores body and we can use that to send to our modules
var domBody = Globals.cacheBody();

// initiate the demo_module from /components/demo_module
Demo_module.init(domBody)
