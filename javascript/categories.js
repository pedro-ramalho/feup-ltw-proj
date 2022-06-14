const btn = document.querySelector("#add-category")
const container = document.querySelector(".res-info")

function createCategoryInput() {
  const category = document.createElement('input')

  category.type = 'text'
  category.placeholder = 'category'
  category.name = 'res-category'

  return category
}

btn.onclick = () => {
  container.appendChild(createCategoryInput())
}

