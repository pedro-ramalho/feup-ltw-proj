window.onscroll = function (e) {
  let header = document.querySelector('header')
  if (window.scrollY >= 40)
    header.classList.add("header-opaque")
  else 
    header.classList.remove("header-opaque")
}
