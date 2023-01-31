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
