const form = document.querySelector('.login form');
const continueBtn = form.querySelector('.button input');
const errorText = form.querySelector('.error-txt');

form.onsubmit = (e) => {
  e.preventDefault(); // prevents the form from being submitted
}

continueBtn.onclick = () => {
  // AJAX
  let xhr = new XMLHttpRequest(); // creating XML object
  xhr.open('POST', 'php/login.php', true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) { // checks if the state of the request is equal to 4(DONE)
      if (xhr.status === 200) {
        let data = xhr.response; // gives response of passed url
        console.log(data);
        if (data == 'Success') {
          location.href = 'users.php';
        }
        else {
          errorText.textContent = data;
          errorText.style.display = 'block';
        }
      }
    }
  }

  // Send form data through AJAX to php
  let formData = new FormData(form); // creating new FormData object to send via xhr.send
  xhr.send(formData);
}