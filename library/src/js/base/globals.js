const Globals = {
  cacheBody() {
    return document.querySelector('body');
  },
  sr() {
    return ScrollReveal();
  },
  postAjax(dataObj, files = false) {
    let ajaxOptions = {
      type: 'POST',
      url: phpObj.ajaxPath,
      data: dataObj,
      dataType: 'json',
      error(err) {
        console.log(err);
        return err
      }
    }
    let ajaxOptionsWithFiles = {
      url: phpObj.ajaxPath,
      type: 'POST',
      contentType: false,
      processData: false,
      data: dataObj,
      error(err) {
        console.log(err);
        return err
      },
      cache: false

    }
    let options = files ? ajaxOptionsWithFiles : ajaxOptions;
    return jQuery.ajax(options);
  },
  fetch(dataObj) {
    return {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      action: dataObj.action,
      body: JSON.stringify( dataObj )
    }
    

  },
  validateEmail(inputText, inp) {
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (inputText.match(mailformat)) {
      return { success: true };
    }
    else {
      inp.focus();
      return { success: false, msg: "You have entered an invalid email address!"};
    }
  }
}
module.exports = Globals