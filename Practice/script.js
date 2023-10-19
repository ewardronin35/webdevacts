var btnLogin = document.getElementById('do-login');
var idLogin = document.getElementById('login');
var idForgot = document.getElementById('forgots');
var username = document.getElementById('username');
var btnForgot = document.getElementById('do-forgot');
btnLogin.onclick = function(){
  idLogin.innerHTML = '<p>We\'re happy to see you again, </p><h1>' +username.value+ '</h1>';
}
btnForgot.onclick = function() {
  idForgot.innerHTML = '<p> Oh no you forgot your password!, </p><h1>' +username.value+ '</h1>';
}