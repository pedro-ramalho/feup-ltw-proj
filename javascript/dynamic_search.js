const searchBar = document.querySelector("#query")

function createAndAppendDiv(parent, divClass) {
  const elem = document.createElement('div')
  elem.classList.add(divClass)
  parent.appendChild(elem)
  return elem;
}

function createAndAppendH3(parent, text, h3Class) {
  const elem = document.createElement('h3')
  elem.textContent = text
  elem.classList.add(h3Class)
  parent.appendChild(elem)
}

function createAndAppendRestaurant(parent, restaurant) {
  const searchResult = document.createElement('a')
  searchResult.href = "/pages/view_restaurant.php?id=" + restaurant.id
  searchResult.classList.add("search-result-restaurant")
  createAndAppendH3(searchResult, restaurant.res_name, "restaurant-name")
  const div = createAndAppendDiv(searchResult, "score-and-coords-container")
  createAndAppendH3(div, restaurant.score, "restaurant-score")
  createAndAppendH3(div, restaurant.coords, "restaurant-coords")
  parent.appendChild(searchResult)
}

function createAndAppendDish(parent, dish) {
  const searchResult = document.createElement('a')
  searchResult.href = "/pages/view_restaurant.php?id=" + dish.restaurant
  searchResult.classList.add("search-result-dish")
  createAndAppendH3(searchResult, dish.name, "dish-name")
  createAndAppendH3(searchResult, dish.price + '€', "dish-price")
  //createAndAppendH3(searchResult, dish.restaurant, "dish-restaurant-name") 💀💀💀
  parent.appendChild(searchResult)
}

if (searchBar) {
  searchBar.addEventListener('input', async function() {
    let response = await fetch('api_search.php?search=' + this.value)
    response = await response.json()
    const restaurants = response[0]
    const dishes = response[1]
    
    const container = document.querySelector("#search-results-container")
    if (searchBar.value.length === 0) {
      container.classList.add("hidden-search-results")
    }
    else {
      container.innerHTML = ''
      container.classList.remove("hidden-search-results")
      //restaurants
      const restaurantSectionTitle = document.createElement('h1')
      restaurantSectionTitle.textContent = "Restaurants"
      container.appendChild(restaurantSectionTitle)

      if (restaurants.length === 0) {
        const message = document.createElement('h2')
        message.textContent = "No restaurants found"
        container.appendChild(message)
      }
      else {
        for (const restaurant of restaurants) {
          createAndAppendRestaurant(container, restaurant)
        }
      }
      
      //dishes
      const dishesSectionTitle = document.createElement('h1')
      dishesSectionTitle.textContent = "Dishes"
      container.appendChild(dishesSectionTitle)

      if (dishes.length === 0) {
        const message = document.createElement('h2')
        message.textContent = "No dishes found"
        container.appendChild(message)
      }
      else {
        for (const dish of dishes) {
          createAndAppendDish(container, dish)
        }
      }
    }
  })
}