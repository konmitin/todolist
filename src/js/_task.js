const createTodo = document.querySelector(".creation");
const formTask = document.querySelector('[data-type="formTask"]');

if (formTask) {
  formTask.addEventListener("click", () => {
    createTodo.classList.add("active");

    console.log(formTask);
  });
}

if (createTodo) {
  createTodo.addEventListener("click", (event) => {
    if (!event.target.closest(".creation-form")) {
      createTodo.classList.remove("active");
    }
  });

  createTodo.addEventListener("submit", (event) => {
    event.preventDefault();

    let form = event.target;
    let title = form.title.value;
    let enddate = form.enddate.value;

    if (title && enddate) {
      addTodo(title, enddate);
    } else {
      alert("Ошибка создания. Заполните все поля!");
    }
  });
}

async function addTodo(title, enddate) {
  const todoData = {};

  todoData.title = title;
  todoData.enddate = enddate;

  // временно, в дальнейшем необходимо переписать скрипты для отправки на создание
  let response = await fetch("controllers/addtodo.php", {
    method: "POST",
    body: JSON.stringify(todoData),
    headers: { "content-type": "application/json;charset=utf-8" },
  });

  if (response.ok) {
    let result = await response.json();

    if (result.status == 200) {
      setTimeout(function () {
          window.location.reload();
      }, 500);
    } else {
        alert(result.message);
    }
  }
}
