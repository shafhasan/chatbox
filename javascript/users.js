const searchBar = document.querySelector('.users .search input');
const searchBtn = document.querySelector('.users .search button');
const usersList = document.querySelector('.users .users-list');

searchBtn.onclick = () => {
  searchBar.classList.toggle("active");
  searchBar.focus();
  searchBtn.classList.toggle("active");
  searchBar.value = ''; // resets search bar from previous search
}

searchBar.onkeyup = () => {
  let searchTerm = searchBar.value; // user search value
  if (searchTerm != '') { // when user is searching, add the active class. This will not show users list
    searchBar.classList.add('active');
  } else {
    searchBar.classList.remove('active');
  }
  // AJAX
  let xhr = new XMLHttpRequest(); // creating XML object
  xhr.open('POST', 'php/search.php', true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) { // checks if the state of the request is equal to 4(DONE)
      if (xhr.status === 200) {
        let data = xhr.response; // gives response of passed url
        usersList.innerHTML = data;
      }
    }
  }
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.send('searchTerm' + '=' + searchTerm); //sending user search term to php file
}

setInterval(() => {
  // AJAX
  let xhr = new XMLHttpRequest(); // creating XML object
  xhr.open('GET', 'php/users.php', true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) { // checks if the state of the request is equal to 4(DONE)
      if (xhr.status === 200) {
        let data = xhr.response; // gives response of passed url
        if (!searchBar.classList.contains('active')) { // if active class is not present, then show users list
          usersList.innerHTML = data;
        }
      }
    }
  }
  xhr.send();
}, 500);