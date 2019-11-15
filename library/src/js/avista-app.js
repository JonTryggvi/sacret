import Globals from "./base/globals";
import Header from "./components/component-header";

// global variable stores body and we can use that to send to our modules
var domBody = Globals.cacheBody();

// initiate the demo_module from /components/demo_module
Header.init(domBody)

