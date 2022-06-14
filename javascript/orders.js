let form_container = document.querySelector("section#orders-container")
let forms = document.querySelectorAll("form.order-form")
let submit_button = document.querySelector("button#submit-orders")

for (let form of forms) {
  const dish_quantity_form = form.querySelector("input.dish-quantity-form")
  const base_price = parseFloat(form.querySelector("p.base-price").textContent)
  const increase_quantity_button = form.querySelector("button.increase-quantity")
  const decrease_quantity_button = form.querySelector("button.decrease-quantity")
  const dish_quantity_p = form.querySelector("p.order-quantity")
  const order_price_p = form.querySelector("p.order-price")
  const remove_order_button = form.querySelector("button.remove-form-button")

  increase_quantity_button.addEventListener('click', (event) => {
    event.preventDefault();
    event.stopPropagation();
    console.log("CLICKED THE PLUS BUTTON")
    
    let quantity = parseInt(dish_quantity_form.value) + 1;
    dish_quantity_form.value = quantity;
    dish_quantity_p.textContent = quantity.toString();
    order_price_p.textContent = (quantity * base_price).toString();
  })
  decrease_quantity_button.addEventListener('click', (event) => {
    event.preventDefault();
    event.stopPropagation();
    
    console.log("CLICKED THE - MINUS BUTTON")
    let quantity = parseInt(dish_quantity_form.value) - 1
    if (quantity < 0) quantity = 0
    dish_quantity_form.value = quantity;
    dish_quantity_p.textContent = quantity.toString();
    order_price_p.textContent = (quantity * base_price).toString();
  })
  remove_order_button.addEventListener('click', (event) => {
    event.preventDefault();
    event.stopPropagation();
    form_container.removeChild(form);
  })
}

if (submit_button !== null) {
  submit_button.addEventListener('click', async (event) => {
    event.preventDefault();
    event.stopPropagation();
    const all_forms = form_container.querySelectorAll("form.order-form")
    for (const aForm of all_forms) {
      aForm.submit();
    }
    await fetch('http://localhost:9000/api_remove_orders.php')
    console.log("Clicked submit button")
    location.reload();
  })
}