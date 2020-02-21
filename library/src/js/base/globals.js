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
    

  }
}
module.exports = Globals