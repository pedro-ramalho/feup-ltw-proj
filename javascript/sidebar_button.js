let sidebarButton = document.querySelector("button#toggle-sidebar")
let sidebar = document.querySelector("aside#sidebar")

function hideSidebar() {
  sidebarButton.classList.remove("close")
  sidebarButton.classList.add("hamburger")
  sidebar.classList.remove("displayed")
}

function showSidebar() {
    sidebarButton.classList.remove("hamburger")
    sidebarButton.classList.add("close")
    sidebar.classList.add("displayed")
}

sidebarButton.onclick = function () {
  if (sidebarButton.classList.contains("hamburger")) {
    showSidebar();

  }
  else if (sidebarButton.classList.contains("close")) {
    hideSidebar();
  }
  else {
    console.error("sidebarButton is missing a valid class!")
  }
}

