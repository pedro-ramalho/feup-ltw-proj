let order_state_forms = document.querySelectorAll("form.order-state-form")
let order_state_submit_button = document.querySelector("#save-orders-state-button")
console.log(order_state_forms.length)

if (order_state_submit_button !== null) {
  order_state_submit_button.addEventListener('click', async (event) => {
    event.preventDefault();
    event.stopPropagation();
    for (const oneForm of order_state_forms) {
      
    }
  location.reload();
  })
}