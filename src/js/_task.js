function addTaskEvent() {
  const createTodo = document.querySelector(".creation");
  const formTask = document.querySelector('[data-type="formTask"]');
  const tasks = document.querySelectorAll(".backlog__item ");

  if (formTask) {
    formTask.addEventListener("click", () => {
      createTodo.classList.add("active");
    });
  }

  if (createTodo) {
    createTodo.addEventListener("click", (event) => {
      if (!event.target.closest(".creation-form")) {
        createTodo.classList.remove("active");
      }
    });

    createTodo.addEventListener("submit", createTodoEvent);
  }

  tasks.forEach((task) => {
    task.addEventListener("click", clickForTaskEvent);
  });
}

async function addTodo(title, enddate) {
  const todoData = {};

  todoData.title = title;
  todoData.enddate = enddate;

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

async function deleteTask(id, task) {
  const deleteData = {};

  deleteData.id = id;

  let response = await fetch("controllers/deleteTask.php", {
    method: "POST",
    body: JSON.stringify(deleteData),
    headers: { "content-type": "application/json;charset=utf-8" },
  });

  if (response.ok) {
    let result = await response.json();

    const backlogCount = document.querySelector(".backlog__check");

    if (result.status == 200) {
      backlogCount.textContent = backlogCount.textContent - 1;
      task.remove();
      return result;
    } else {
      alert(result.message);
    }
  }
}

async function closeTaskSuccess(id, task) {
  const successData = {};

  successData.id = id;

  let response = await fetch("controllers/successTask.php", {
    method: "POST",
    body: JSON.stringify(successData),
    headers: { "content-type": "application/json;charset=utf-8" },
  });

  if (response.ok) {
    let result = await response.json();

    const backlogList = document.querySelector(".backlog__list");

    if (result.status == 200) {
      task.classList.add("_successful");
      window.location.reload();
      return result;
    } else {
      alert(result.message);
    }
  }
}

function createTodoEvent(event) {
  event.preventDefault();

  let form = event.target;
  let title = form.title.value;
  let enddate = form.enddate.value;

  if (title && enddate) {
    addTodo(title, enddate);
  } else {
    alert("Ошибка создания. Заполните все поля!");
  }
}

function clickForTaskEvent(event) {
  let target = event.target;
  let task = event.target.closest(".backlog__item");
  if (target.getAttribute("data-type") == "deleteTask") {
    deleteTask(task.getAttribute("data-id"), task);
  } else if(target.getAttribute("data-type") == "taskSuccess"){
    closeTaskSuccess(task.getAttribute("data-id"), task);
  }
}
addTaskEvent();
