const container = document.querySelectorAll(".categories-container")

const colors = {
  'Fast-food' : 'rgb(231, 86, 14)',
  'Premium' : 'rgb(33, 29, 27)',
  'Affordable' : 'rgb(132, 209, 8)',
  'Sushi' : 'rgb(80, 152, 210)',
  'Vegan' : 'rgb(0, 194, 16)',
  'Vegetarian' : 'rgb(55, 142, 63)'
}

for (let categories of container) {
  let children = categories.children
  for (let child of children)
    child.style.background = colors[child.innerHTML]
}