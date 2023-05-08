

function newcaptcha() {
  var dataString = 'index=1';
  var url = "./captcha-generator/captcha.php"
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      html = this.responseText;
      if (html != 1) {
        document.getElementById('divcaptcha').innerHTML = html;
      }
    }
  };
  xhttp.open("POST", url, true);
  xhttp.send();
}
