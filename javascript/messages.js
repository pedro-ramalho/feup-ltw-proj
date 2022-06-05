let messages = document.querySelectorAll("section#messages-container > article")
let section_container = document.querySelector("section#messages-container")

messages.forEach((message) => {
  message.addEventListener('mouseover', () => {
    message.classList.add("hovered")
  })
  message.addEventListener('mouseout', () => {
    message.classList.remove("hovered")
  })
  message.addEventListener('click', () => {
    section_container.removeChild(message);
  })
})