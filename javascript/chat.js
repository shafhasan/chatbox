const form = document.querySelector('.typing-area');
const inputField = form.querySelector('.input-field');
const sendBtn = form.querySelector('button');
const chatBox = document.querySelector('.chat-box');

form.onsubmit = (e) => {
  e.preventDefault(); // prevents the form from being submitted
}

sendBtn.onclick = () => {
  // AJAX
  let xhr = new XMLHttpRequest(); // creating XML object
  xhr.open('POST', 'php/insert-chat.php', true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) { // checks if the state of the request is equal to 4(DONE)
      if (xhr.status === 200) {
        inputField.value = ''; // input box will be blank after msg is inserted into database
      }
    }
  }

  // Send form data through AJAX to php
  let formData = new FormData(form); // creating new FormData object to send via xhr.send
  xhr.send(formData);
  scrollToBottom();
}

chatBox.onmouseenter = () => {
  chatBox.classList.add('active');
}
chatBox.onmouseleave = () => {
  chatBox.classList.remove('active');
}

setInterval(() => {
  // AJAX
  let xhr = new XMLHttpRequest(); // creating XML object
  xhr.open('POST', 'php/get-chat.php', true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) { // checks if the state of the request is equal to 4(DONE)
      if (xhr.status === 200) {
        let data = xhr.response; // gives response of passed url
        chatBox.innerHTML = data;
        if (!chatBox.classList.contains('active')) { // if cursor is not in chatbox, scroll to the bottom automatically
          scrollToBottom();
        }
      }
    }
  }
  let formData = new FormData(form);
  xhr.send(formData);
}, 500);

const scrollToBottom = () => {
  chatBox.scrollTop = chatBox.scrollHeight;
}