/* anchors */

const accountAnchor = document.querySelector("#acc-anchor")
const ownedRestaurantsAnchor = document.querySelector("#owned-res-anchor")
const favDishesAnchor = document.querySelector("#fav-dishes-anchor")
const favRestaurantsAnchor = document.querySelector("#fav-res-anchor")


/* content sections */

const accountSection = document.querySelector("#user-credentials")
const ownedRestaurantsSection = document.querySelector("#owned-restaurants")
const favDishesSection = document.querySelector("#favorite-dishes")
const favRestaurantsSection = document.querySelector("#favorite-restaurants")


/* event listeners */

accountAnchor.addEventListener('click', () => {
  accountSection.removeAttribute("hidden")

  ownedRestaurantsSection.setAttribute("hidden", "")
  favDishesSection.setAttribute("hidden", "")
  favRestaurantsSection.setAttribute("hidden", "")
})

ownedRestaurantsAnchor.addEventListener('click', () => {
  accountSection.setAttribute("hidden", "")
  ownedRestaurantsSection.removeAttribute("hidden")
  favDishesSection.setAttribute("hidden", "")
  favRestaurantsSection.setAttribute("hidden", "")
})

favDishesAnchor.addEventListener('click', () => {
  accountSection.setAttribute("hidden", "")
  ownedRestaurantsSection.setAttribute("hidden", "")
  favDishesSection.removeAttribute("hidden")
  favRestaurantsSection.setAttribute("hidden", "")
})

favRestaurantsAnchor.addEventListener('click', () => {
  accountSection.setAttribute("hidden", "")
  ownedRestaurantsSection.setAttribute("hidden", "")
  favDishesSection.setAttribute("hidden", "")
  favRestaurantsSection.removeAttribute("hidden")
})