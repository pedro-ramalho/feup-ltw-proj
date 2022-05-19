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

const sections = Array(accountSection, ownedRestaurantsSection, favDishesSection, favRestaurantsSection)

let visible = accountSection;
let selected = accountAnchor;

function toggleSection(newVisible, newSelected) {
  visible.setAttribute("hidden", "")
  newVisible.removeAttribute("hidden")
  visible = newVisible;

  selected.classList.remove("selected")
  newSelected.classList.add("selected")
  selected = newSelected
}


/* event listeners */

accountAnchor.addEventListener('click', () => {
  toggleSection(accountSection, accountAnchor)
})

ownedRestaurantsAnchor.addEventListener('click', () => {
  toggleSection(ownedRestaurantsSection, ownedRestaurantsAnchor)
})

favDishesAnchor.addEventListener('click', () => {
  toggleSection(favDishesSection, favDishesAnchor)
})

favRestaurantsAnchor.addEventListener('click', () => {
  toggleSection(favRestaurantsSection, favRestaurantsAnchor)
})