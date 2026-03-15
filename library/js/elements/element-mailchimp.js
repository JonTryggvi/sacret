import Global from '../base/globals.js'
import MailChimp from "../components/component-mailchimp.js";
let domBody = Global.cacheBody()
MailChimp.init(domBody, Global)
