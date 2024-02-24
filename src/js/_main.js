const addToDoForm = document.querySelector("[data-form='addToDo']");
const text = document.querySelector(".backlog__description");
console.log(typeof text.textContent);

addToDoForm.addEventListener("submit", (event) => {
  event.preventDefault();

  addToDo(event.target);
});

async function addToDo(form) {
  let formData = new FormData(form);

  let response = await fetch("../php/addtodo.php", {
    method: "POST",
    body: formData,
  });

  form.reset();

  let result = await response.json();

  setTimeout(function () {
    window.location.reload();
  }, 1000);
}
