
const Mailchimp = {
  ajaxObj: {
    action: 'call_mailchimp',
    security: phpObj.ajax_nonce
  },
  init(scope, glob) {
    this.Global = glob
    this.cacheDom(scope)
    this.addEvents()
    
  },
  cacheDom(scope){
    this.body = scope
    this.form = this.body.querySelector('.mailchimp--form')
    this.inputEmails = this.body.querySelectorAll('.mc-email')
    this.btns = this.body.querySelectorAll('.btm--mc-submit')
  },
  addEvents(){
    this.btns.forEach( btn => btn.onclick = this.handleBtnClick.bind(this) )
    this.inputEmails.forEach( inp => inp.onfocus = this.handleInputFocus.bind(this) )
  },
  handleBtnClick(e) {
    let form = e.target.closest('form'),
      input = form.querySelector('.mc-email'),
      inputFname = form.querySelector('[name="fname"]'),
      inputlname = form.querySelector('[name="lname"]'),
      label = form.querySelector('.mc-label--email');

    let validEmail = this.Global.validateEmail(input.value, input)
    if (!validEmail.success) {
      label.innerText = validEmail.msg
      label.classList.add('error')
      return false
    }
    label.classList.contains('error') ? label.classList.remove('error') : '';
    label.innerText = phpObj.translations['Skrá vefpóst']
    this.ajaxObj.email = input.value
    this.ajaxObj.fname = inputFname.value
    this.ajaxObj.lname = inputlname.value
    this.Global.postAjax(this.ajaxObj).done(jRes => {
      console.log(jRes)
      const has = jRes.prototype.hasOwnProperty
      if(has.call(jRes, 'body')) {}
      // res ok skilaboð
    })
  },
  handleInputFocus(e) {
    let form = e.target.closest('form'),
      hidden = form.querySelectorAll('.hide');
    hidden.forEach(hid => hid.classList.add('show'))
  }
  
}
module.exports = Mailchimp