let sidebar_button = document.querySelector("button#toggle-sidebar")
let sidebar = document.querySelector("aside#sidebar")

sidebar_button.onclick = function (e) {
  if (sidebar_button.classList.contains("hamburger")) {
    sidebar_button.classList.remove("hamburger")
    sidebar_button.classList.add("close")
    sidebar.classList.add("displayed")
  }
  else if (sidebar_button.classList.contains("close")) {
    sidebar_button.classList.remove("close")
    sidebar_button.classList.add("hamburger")
    sidebar.classList.remove("displayed")
  }
  else {
    console.error("sidebar_button is missing a valid class!")
  }
}