let draw_dishes = Document.querySelectorAll(".dish-frontpage")



for (let dish of draw_dishes) {
  let id_p = dish.querySelector("p");
  let favorite_button = dish.querySelector(".dish-favorite-icon")
  if (favorite_button.classList.includes("not-logged-in")) {
    favorite_button.addEventListener(() => {window.location.href="http://localhost:9000/pages/sign_in.php"})
  }
  else if (favorite_button.classList.includes("dish-is-favorited")) {
    //use ajax
    favorite_button.addEventListener('click', () => {
      favorite_button.src = "../assets/icons/favorite.svg"

    })
  }
}