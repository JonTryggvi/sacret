import Global from './base/globals'
import MailChimp from "./components/component-mailchimp";
let domBody = Global.cacheBody()
MailChimp.init(domBody, Global)