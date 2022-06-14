let order_state_forms = document.querySelectorAll("form.order-state-form")
let order_state_submit_button = document.querySelector("#save-orders-state-button")
console.log(order_state_forms.length)

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&')
}

if (order_state_submit_button !== null) {
  order_state_submit_button.addEventListener('click', async (event) => {
    event.preventDefault();
    event.stopPropagation();
    for (const oneForm of order_state_forms) {
      const request = new XMLHttpRequest()
      request.open("post", "../actions/action_update_order_state.php", true)
      request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
      request.send(encodeForAjax({order_id: oneForm.querySelector(".order-id-input").value, order_state: oneForm.querySelector(".order-state").value}))
    }
  location.reload();
  })
}