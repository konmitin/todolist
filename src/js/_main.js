const addToDoForm = document.querySelector("[data-form='addToDo']");
const deleteTaskBtn = document.querySelectorAll("[data-type='deleteTask']");

addToDoForm.addEventListener("submit", (event) => {
  event.preventDefault();

  addToDo(event.target);
});

deleteTaskBtn.forEach((btn) => {
  btn.addEventListener("click", (event) => {
    const task = event.target.closest(".backlog__item");
    const taskId = task.getAttribute("data-id");

    deleteToDo(taskId);
  });
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
  }, 500);
}

async function deleteToDo(id) {
  if (!confirm("Вы уверены?")) {
    return;
  }

  const data = "id=" + id;
  let response = await fetch("../php/deltodo.php", {
    method: "POST",
    body: data,
    headers: { "content-type": "application/x-www-form-urlencoded" },
  });

  setTimeout(function () {
    window.location.reload();
  }, 500);
}
