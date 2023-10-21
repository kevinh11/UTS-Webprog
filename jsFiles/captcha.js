const captchaText = document.getElementById('captcha');
const loginForm = document.getElementById('loginForm');

function preventSubmission(event) {
  const captchaForm = document.getElementById('captchaForm');

  if (captchaForm.value != captchaText.textContent) {
    alert('please insert the correct captcha');

    event.preventDefault();
    window.history.back();
  }

  else {
    alert('login succesful!');
  }
  
}

loginForm.addEventListener('submit',preventSubmission);

