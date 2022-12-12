fetch("http://localhost:8080/git-repos.php")
  .then((response) => {
    return response.json();
  })
  .then((data) => {
    data.repos.forEach((element) => {
      let container = document.createElement("div");
      container.classList.add("repo-container");
      container.textContent = element.id;
      document.querySelector("main").appendChild(container);
    });
  });

function populateDocument(fromFile, targetElement) {
  fetch(fromFile)
    .then((response) => {
      return response.text();
    })
    .then((html) => {
      document
        .querySelector(targetElement)
        .insertAdjacentHTML("beforeend", html);
    });
}
