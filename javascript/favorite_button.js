let draw_dishes = document.querySelectorAll(".dish-frontpage")
let messages_container = document.querySelector("#messages-container")

let id_p;

async function favorite(event) {
  const button = event.target;
  event.preventDefault();
  event.stopPropagation();
  button.src = "../assets/icons/favorite_filled.svg"
  button.classList.remove('dish-is-not-favorited')
  button.classList.add('dish-is-favorited')
  let response = await fetch('/api_toggle_favorited.php?dish=' + id_p)
  response = await response.json()
  if (response['response'] === "error" ) {
    console.log("Oops, there was a very bad error");
  }
  else if (response['response'] === "unfavorited") {
    console.log("You tried to favorite something that was already favorited so now it's unfavorited...")
  }
  else if (response['response'] === "favorited") {
    console.log("Success!")
  }
  else {
    console.log("Unidentified error")
  }
  button.addEventListener('click', unfavorite, {once: true})
}

async function unfavorite(event) {
  const button = event.target;
  event.preventDefault();
  event.stopPropagation();
  button.src = "../assets/icons/favorite.svg"
  button.classList.remove('dish-is-favorited')
  button.classList.add('dish-is-not-favorited')
  let response = await fetch('/api_toggle_favorited.php?dish=' + id_p)
  response = await response.json()
  if (response['response'] === "error" ) {
    console.log("Oops, there was a very bad error");
  }
  else if (response['response'] === "unfavorited") {
    console.log("Success!")
  }
  else if (response['response'] === "favorited") {
    console.log("You tried to unfavorite something that was already unfavorited so now it's favorited...")
  }
  else {
    console.log("Unidentified error")
  }
  button.addEventListener('click', favorite, {once: true})
}

async function main() {
for (let dish of draw_dishes) {
  id_p = parseInt(dish.querySelector("p").textContent);
  let favorite_button = dish.querySelector(".dish-favorite-icon")
  if (favorite_button.classList.contains("not-logged-in")) {
    favorite_button.addEventListener('click', () => {window.location.href="http://localhost:9000/pages/sign_in.php"})
  }
  else if (favorite_button.classList.contains("dish-is-favorited")) {
    favorite_button.addEventListener('click', unfavorite, {once: true})
  }
  else if (favorite_button.classList.contains("dish-is-not-favorited")) {
    favorite_button.addEventListener('click', favorite, {once: true})
  }
}
}

main();