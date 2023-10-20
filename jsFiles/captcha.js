const captchaText = document.getElementById('captcha');
const loginForm = document.getElementById('loginForm');

function preventSubmission(event) {
  const captchaForm = document.getElementById('captchaForm');

  if (captchaForm.value != captchaText.textContent) {
    event.preventDefault();
    window.history.back();
    alert('please insert the correct captcha');
  }

  else {
    alert('login succesful!');
  }
  
}

loginForm.addEventListener('submit',preventSubmission);

