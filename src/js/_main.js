const addToDoForm = document.querySelector("[data-form='addToDo']");
const deleteTaskBtn = document.querySelectorAll("[data-type='deleteTask']");
const cancelBtn = document.querySelector("[data-type='cancelBtn']");

cancelBtn.addEventListener("click", (event) => {
  const form = event.target.closest("form");
  form.reset();
});

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
  if (!validateForm(form)) {
    alert(
      "Заполните корректно форму:\nНазвание задачи должно быть заполнено и содержать не более 50 символов \nДата должна быть заполнена"
    );
    return;
  }

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

function validateForm(form) {
  let error = 0;

  if (!form.enddate.value) {
    error++;
  } else if (!form.name.value || !form.name.value.length < 10) {
    error++;
  }

  if (error > 0) {
    return false;
  } else {
    return true;
  }
}
