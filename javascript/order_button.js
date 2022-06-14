const dish_array_order = document.querySelectorAll(".dish-array-element")
let messages_container_order = document.querySelector("#messages-container")

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
    messages_container_order.removeChild(msgArticle);
  })
  messages_container_order.appendChild(msgArticle)
}

async function addOrderDish(event) {
  const button = event.target;
  event.preventDefault();
  event.stopPropagation();

  let aParent = button.parentNode;
  while (!aParent.classList.contains("dish-array-element")) aParent = aParent.parentNode;
  const id_p = parseInt(aParent.querySelector(".dish-id-holder").textContent);

  let response = await fetch('http://localhost:9000/api_add_order.php?dish_id=' + id_p.toString())
  response = await response.json()
  if (response['response'] === "error" ) {
    createAndAddMessage("error", "There was a problem ordering that dish!")
    return;
  }
  else if (response['response'] === "success") {
    createAndAddMessage("success", "Dish was added to cart!")
    return;
  }
  else {
    createAndAddMessage("error", "Unidentified error occurred!")
    return;
  }
}

async function setup_dish_buttons(dishElementArray) {
  for (let dish of dishElementArray) {
    let order_button = dish.querySelector(".dish-shopping-bag-icon")
    if (order_button === null) continue;
    if (order_button.classList.contains("not-logged-in")) {
      order_button.addEventListener('click', () => {window.location.href="http://localhost:9000/pages/sign_in.php"})
    }
    else {
      order_button.addEventListener('click', addOrderDish)
    }
  }
}

async function main() {
  await setup_dish_buttons(dish_array_order)
}

main();