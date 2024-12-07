const menuSorts = document.querySelectorAll("[data-sort]");

if (menuSorts.length > 0) {
  menuSorts.forEach((sort) => {
    sort.addEventListener("click", (event) => {
      event.preventDefault();
      let target = event.target;

      menuSorts.forEach((sort) => {
        sort.classList.remove("_active");
      });

      target.classList.add("_active");
      let sortType = target.getAttribute("data-sort");

      getSortList(sortType);
    });
  });
}

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

async function addTodo(title, description, enddate, token) {
  const todoData = {};

  todoData.title = title;
  todoData.enddate = enddate;
  todoData.description = description;
  todoData._token = token;

  let response = await fetch("task/create", {
    method: "POST",
    body: JSON.stringify(todoData),
    headers: {
      "content-type": "application/json;charset=utf-8",
      accept: "application/json",
    },
  });

  if (response.ok) {
    return true;
  }
}

async function deleteTask(position, task) {
  let data = {};

  data._token = document.querySelector("[name='_token']").value;

  let response = await fetch(`task/${position}`, {
    method: "DELETE",
    headers: {
      "content-type": "application/json;charset=utf-8",
      accept: "application/json",
    },
    body: JSON.stringify(data),
  });

  if (response.ok) {
    let result = await response.json();
    const backlogCount = document.querySelector(".backlog__check");

    backlogCount.textContent = backlogCount.textContent - 1;
    task.remove();
  } else {
    let result = await response.json();
    alert(result.message);
  }
}

async function closeTaskSuccess(postition, task) {
  const successData = {};

  successData._token = document.querySelector("[name='_token']").value;

  let response = await fetch(`task/success/${postition}`, {
    method: "PATCH",
    body: JSON.stringify(successData),
    headers: {
      "content-type": "application/json;charset=utf-8",
      accept: "application/json",
    },
  });

  if (response.ok) {
    let result = await response.json();
    const backlogList = document.querySelector(".backlog__list");

    task.classList.add("_successful");

    getSortList("all");
  } else {
    alert(result.message);
  }
}

function createTodoEvent(event) {
  event.preventDefault();

  let form = event.target;
  let title = form.title.value;
  let enddate = form.enddate.value;
  let token = form._token.value;
  let description = form.description.value;
  let $created = false;

  if (title && enddate && token) {
    $created = addTodo(title, description, enddate, token);
  } else {
    alert("Ошибка создания. Заполните все поля!");
  }

  if ($created) {
    const createDiv = document.querySelector(".creation.active");

    createDiv.classList.remove("active");
    form.reset();

    getSortList("all");
  }
}

function clickForTaskEvent(event) {
  let target = event.target;
  let task = event.target.closest(".backlog__item");
  let index = task ? [...task.parentNode.children].indexOf(task) : -1;

  if (
    target.closest(".backlog__btn").getAttribute("data-type") == "deleteTask"
  ) {
    deleteTask(index, task);
  } else if (
    target.closest(".backlog__btn").getAttribute("data-type") == "taskSuccess"
  ) {
    closeTaskSuccess(index, task);
  }
}

async function getSortList(sort) {
  let response = await fetch(`/tasks/sort/${sort}`, {
    method: "GET",
    headers: { accept: "application/json" },
  });

  if (response.ok) {
    let result = await response.json();

    const backlogList = document.querySelector(".backlog__list");
    const backlogCount = document.querySelector(".backlog__check");

    let listInner = "";

    result.list.forEach((item) => {
      let classElem = "";
      let btnSuccess = `<button class="backlog__success backlog__btn" data-type="taskSuccess">
                            <img class="backlog__delete_img" src="/storage/img/check-task-green.svg" alt="">
                        </button>`;

      if (item.status == "success") {
        classElem = "_success";
        btnSuccess = "";
      } else if (item.status == "fail") {
        classElem = "_fail";
      } else if (item.status == "check") {
        classElem = "_check";
      }

      let itemDate = new Date(item.end_date);

      let elem = `<a href="/task/${item.id}" class= 'backlog__item ${classElem}' data-id="${item.id}">

                  <div class="backlog__desc-block">
                      <p class="backlog__description">${item.title}</p>
                  </div>
                  <div class="backlog__date-box date-box">
                      <p class="date-box__date">${itemDate.toLocaleDateString()}</p>
                  </div>
                  <div class="backlog__right backlog__btns">
                      ${btnSuccess}

                      <button class="backlog__delete backlog__btn" type="button" data-type="deleteTask">
                          <img class="backlog__delete_img" src="/storage/img/trash-task-red.svg" alt="">
                      </button>
                  </div>
              </a>`;

      listInner += elem;
    });
    // window.location.reload();
    backlogList.innerHTML = listInner;
    backlogCount.textContent = result.count;

    addTaskEvent();
  }
}

addTaskEvent();
