const scores = document.querySelectorAll(".score-container")

const gradients = {
  5 : "rgb(49,193,191) linear-gradient(90deg, rgba(49,193,191,1) 0%, rgba(0,211,255,1) 100%)",
  4 : "rgb(23,122,40) linear-gradient(90deg, rgba(23,122,40,1) 0%, rgba(0,255,34,1) 100%)",
  3 : "rgb(73,122,23) linear-gradient(90deg, rgba(73,122,23,1) 0%, rgba(255,226,0,1) 100%)",
  2 : "rgb(122,79,23) linear-gradient(90deg, rgba(122,79,23,1) 0%, rgba(255,85,0,0.9836309523809523) 100%)",
  1 : "rgb(3,2,2) linear-gradient(90deg, rgba(3,2,2,1) 0%, rgba(198,49,39,0.9836309523809523) 100%)",
  0 : "rgb(0,0,0) linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(148,60,25,1) 100%)"
}

function gradient(score) {
  return gradients[Math.floor(score)]
}

for (let score of scores) {
  let value = score.textContent
  score.style.background = gradient(value)
}
