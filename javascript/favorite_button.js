const dish_array = document.querySelectorAll(".dish-array-element")
const restaurant_array = document.querySelectorAll(".restaurant-array-element")
let messages_container = document.querySelector("#messages-container")

function createAndAddMessage(messageClass, messageText) {
  const msgArticle = document.createElement('article')
  msgArticle.classList.add(messageClass);
  const paragraph = document.createElement('p')
  paragraph.textContent = messageText
  msgArticle.appendChild(paragraph)
  msgArticle.addEventListener('mouseover', () => {
    msgArticle.classList.add("hovered")
  })
  msgArticle.addEventListener('mouseout', () => {
    msgArticle.classList.remove("hovered")
  })
  msgArticle.addEventListener('click', () => {
    messages_container.removeChild(msgArticle);
  })
  messages_container.appendChild(msgArticle)
}

async function favoriteDish(event) {
  const button = event.target;
  event.preventDefault();
  event.stopPropagation();

  let aParent = button.parentNode;
  while (!aParent.classList.contains("dish-array-element")) aParent = aParent.parentNode;
  const id_p = parseInt(aParent.querySelector(".dish-id-holder").textContent);

  let response = await fetch('http://localhost:9000/api_toggle_favorited.php?dish=' + id_p)
  response = await response.json()
  if (response['response'] === "error" ) {
    createAndAddMessage("error", "There was a problem favoriting that dish!")
    return;
  }
  else if (response['response'] === "unfavorited") {
    createAndAddMessage("error", "There was a problem favoriting that dish! Please try refreshing the page")
    return;
  }
  else if (response['response'] === "favorited") {
    createAndAddMessage("success", "Dish was favorited successfuly!")
  }
  else {
    createAndAddMessage("error", "Unidentified error occurred!")
    return;
  }

  button.src = "../assets/icons/favorite_filled.svg"
  button.classList.remove('dish-is-not-favorited')
  button.classList.add('dish-is-favorited')
  button.addEventListener('click', unfavoriteDish, {once: true})
}

async function unfavoriteDish(event) {
  const button = event.target;
  event.preventDefault();
  event.stopPropagation();

  let aParent = button.parentNode;
  while (!aParent.classList.contains("dish-array-element")) aParent = aParent.parentNode;
  const id_p = parseInt(aParent.querySelector(".dish-id-holder").textContent);

  let response = await fetch('http://localhost:9000/api_toggle_favorited.php?dish=' + id_p)
  response = await response.json()
  if (response['response'] === "error" ) {
    createAndAddMessage("error", "There was a problem unfavoriting that dish!")
    return;
  }
  else if (response['response'] === "unfavorited") {
    createAndAddMessage("success", "Dish was unfavorited successfuly!")
  }
  else if (response['response'] === "favorited") {
    createAndAddMessage("error", "There was a problem unfavoriting that dish! Please try refreshing the page")
    return;
  }
  else {
    createAndAddMessage("error", "Unidentified error occurred!")
    return;
  }

  button.src = "../assets/icons/favorite.svg"
  button.classList.remove('dish-is-favorited')
  button.classList.add('dish-is-not-favorited')
  button.addEventListener('click', favoriteDish, {once: true})
}

async function favoriteRestaurant(event) {
  const button = event.target;
  event.preventDefault();
  event.stopPropagation();

  let aParent = button.parentNode;
  while (!aParent.classList.contains("restaurant-array-element")) aParent = aParent.parentNode;
  const id_p = parseInt(aParent.querySelector(".res-id-holder").textContent);

  let response = await fetch('http://localhost:9000/api_toggle_favorited.php?res=' + id_p)
  response = await response.json()
  if (response['response'] === "error" ) {
    createAndAddMessage("error", "There was a problem favoriting that restaurant!")
    return;
  }
  else if (response['response'] === "unfavorited") {
    createAndAddMessage("error", "There was a problem favoriting that restaurant! Please try refreshing the page")
    return;
  }
  else if (response['response'] === "favorited") {
    createAndAddMessage("success", "Restaurant was favorited successfuly!")
  }
  else {
    createAndAddMessage("error", "Unidentified error occurred!")
    return;
  }

  button.src = "../assets/icons/favorite_filled.svg"
  button.classList.remove('res-is-not-favorited')
  button.classList.add('res-is-favorited')
  button.addEventListener('click', unfavoriteRestaurant, {once: true})
}

async function unfavoriteRestaurant(event) {
  const button = event.target;
  event.preventDefault();
  event.stopPropagation();

  let aParent = button.parentNode;
  while (!aParent.classList.contains("restaurant-array-element")) aParent = aParent.parentNode;
  const id_p = parseInt(aParent.querySelector(".res-id-holder").textContent);

  let response = await fetch('http://localhost:9000/api_toggle_favorited.php?res=' + id_p)
  response = await response.json()
  if (response['response'] === "error" ) {
    createAndAddMessage("error", "There was a problem unfavoriting that restaurant!")
    return;
  }
  else if (response['response'] === "unfavorited") {
    createAndAddMessage("success", "Restaurant was unfavorited successfuly!")
  }
  else if (response['response'] === "favorited") {
    createAndAddMessage("error", "There was a problem unfavoriting that restaurant! Please try refreshing the page")
    return;
  }
  else {
    createAndAddMessage("error", "Unidentified error occurred!")
    return;
  }

  button.src = "../assets/icons/favorite.svg"
  button.classList.remove('res-is-favorited')
  button.classList.add('res-is-not-favorited')
  button.addEventListener('click', favoriteRestaurant, {once: true})
}


async function setup_dish_buttons(dishElementArray) {
  for (let dish of dishElementArray) {
    let favorite_button = dish.querySelector(".dish-favorite-icon")
    if (favorite_button.classList.contains("not-logged-in")) {
      favorite_button.addEventListener('click', () => {window.location.href="http://localhost:9000/pages/sign_in.php"})
    }
    else if (favorite_button.classList.contains("dish-is-favorited")) {
      favorite_button.addEventListener('click', unfavoriteDish, {once: true})
    }
    else if (favorite_button.classList.contains("dish-is-not-favorited")) {
      favorite_button.addEventListener('click', favoriteDish, {once: true})
    }
  }
}

async function setup_restaurant_buttons(restaurantElementArray) {
  for (let restaurant of restaurantElementArray) {
    let favorite_button = restaurant.querySelector(".res-favorite-button")
    if (favorite_button.classList.contains("not-logged-in")) {
      favorite_button.addEventListener('click', () => {window.location.href="http://localhost:9000/pages/sign_in.php"})
    }
    else if (favorite_button.classList.contains("res-is-favorited")) {
      favorite_button.addEventListener('click', unfavoriteRestaurant, {once: true})
    }
    else if (favorite_button.classList.contains("res-is-not-favorited")) {
      favorite_button.addEventListener('click', favoriteRestaurant, {once: true})
    }
  }
}

async function main() {
  await setup_dish_buttons(dish_array)
  await setup_restaurant_buttons(restaurant_array)
}

main();