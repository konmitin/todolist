const addToDoForm = document.querySelector("[data-form='addToDo']");
const deleteTaskBtn = document.querySelectorAll("[data-type='deleteTask']");
const cancelBtn = document.querySelector("[data-type='cancelBtn']");
const checkTodo = document.querySelectorAll(".backlog__checkbox");

checkTodo.forEach((elem) => {
  elem.addEventListener("change", (event) => {
    let item = event.target;

    while (!item.classList.contains("backlog__item")) {
      item = item.parentElement;
    }
    item.classList.add("_succesful");

    todo(item.getAttribute("data-id"), "succesful");
  });
});

// cancelBtn.addEventListener("click", (event) => {
//   const form = event.target.closest("form");
//   form.reset();
// });

// addToDoForm.addEventListener("submit", (event) => {
//   event.preventDefault();

//   addToDo(event.target);
// });

deleteTaskBtn.forEach((btn) => {
  btn.addEventListener("click", (event) => {
    const task = event.target.closest(".backlog__item");
    const taskId = task.getAttribute("data-id");

    todo(taskId, "delete");
  });
});

async function addToDo(form) {
  if (!validateForm(form)) {
    return;
  }

  let formData = new FormData(form);

  try {
    let response = await fetch("controllers/addtodo.php", {
      method: "POST",
      body: formData,
    });

    form.reset();
    setTimeout(function () {
      window.location.reload();
    }, 500);
  } catch (e) {
    console.log(e);
  }
}

async function addTodo(id, type) {
  const data = "id=" + id + "&" + type;

  // временно, в дальнейшем необходимо переписать скрипты для отправки на создание
  let response = await fetch("source/classes.php", {
    method: "POST",
    body: data,
    headers: { "content-type": "application/x-www-form-urlencoded" },
  });

  let result = await response.json();

  if (!result) {
    alert(result);
    return;
  }

  setTimeout(function () {
    window.location.reload();
  }, 500);
}

function validateForm(form) {
  let error = 0;

  if (!form.enddate.value) {
    error++;
    alert("Заполните дату!");
  } else if (!form.name.value) {
    error++;
    alert("Please, write your to do!");
  }

  if (error > 0) {
    return false;
  } else {
    return true;
  }
}

//==== Вход/Регистрация ====
const authForm = document.querySelector(".auth-form");
const loginLink = document.querySelector("[data-type=login]");
const regLink = document.querySelector("[data-type=reg]");

loginLink.addEventListener("click", (event) => {
  event.preventDefault();
  authForm.classList.add("active");

  const authFormActiveTab = authForm.querySelector(".tab__link.active");
  const authFormTabs = authForm.querySelectorAll(".tab__link");
  const tabContent = authForm.querySelector(".tab-content");

  authFormActiveTab.classList.remove("active");

  authFormTabs.forEach((tab) => {
    if (tab.getAttribute("href") == "#login") {
      tab.classList.add("active");

      const login = tabContent.querySelector("#login");
      const reg = tabContent.querySelector("#signup");

      login.classList.add("active");
      reg.classList.remove("active");
    }
  });
});
regLink.addEventListener("click", (event) => {
  event.preventDefault();
  authForm.classList.add("active");

  const authFormActiveTab = authForm.querySelector(".tab__link.active");
  const authFormTabs = authForm.querySelectorAll(".tab__link");
  const tabContent = authForm.querySelector(".tab-content");

  authFormActiveTab.classList.remove("active");

  authFormTabs.forEach((tab) => {
    if (tab.getAttribute("href") == "#signup") {
      tab.classList.add("active");

      const login = tabContent.querySelector("#login");
      const reg = tabContent.querySelector("#signup");

      login.classList.remove("active");
      reg.classList.add("active");
    }
  });
});

//==== Вход/Регистрация - отправка данных ====

const regUserForm = document.querySelector("[data-type=registerForm]");
const loginForm = document.querySelector("[data-type=loginForm]");

regUserForm.addEventListener("submit", (event) => {
  event.preventDefault();

  registerUser(regUserForm);
});

loginForm.addEventListener("submit", (event) => {
  event.preventDefault();

  loginUser(loginForm);
});

async function registerUser(form) {
  const regUserData = {};

  regUserData.name = form.name.value;
  regUserData.login = form.login.value;
  regUserData.password = form.password.value;

  let response = await fetch("./controllers/register.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json;charset=utf-8",
    },
    body: JSON.stringify(regUserData),
  });

  if (response.ok) {
    let result = await response.json();

    alert(result.message);
  }
}

async function loginUser(form) {
  const loginData = {};

  loginData.login = form.login.value;
  loginData.password = form.password.value;

  let response = await fetch("./controllers/login.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json;charset=utf-8",
    },
    body: JSON.stringify(loginData),
  });

  if (response.ok) {
    let result = await response.json();

    alert(result.message);

    location.reload();
  }
}
//==== Форма авторизации ====

const authFormTabs = authForm.querySelectorAll(".tab__link");
const authFormFields = authForm.querySelectorAll(".field-wrap");

authForm.addEventListener("click", (event) => {
  if (!event.target.closest(".auth-form__container")) {
    event.target.classList.remove("active");
  }
});

authFormTabs.forEach((tab) => {
  tab.addEventListener("click", (event) => {
    event.preventDefault();

    let target = event.target;

    const authFormActiveTab = authForm.querySelector(".tab__link.active");
    const tabContent = authForm.querySelector(".tab-content");

    authFormActiveTab.classList.remove("active");

    target.classList.add("active");

    if (target.getAttribute("href") == "#login") {
      const login = tabContent.querySelector("#login");
      const reg = tabContent.querySelector("#signup");

      login.classList.add("active");
      reg.classList.remove("active");
    } else if (target.getAttribute("href") == "#signup") {
      const login = tabContent.querySelector("#login");
      const reg = tabContent.querySelector("#signup");

      login.classList.remove("active");
      reg.classList.add("active");
    }
  });
});

authFormFields.forEach((field) => {
  const input = field.querySelector("input");
  const label = field.querySelector("label");
  input.addEventListener("focus", (event) => {
    label.classList.add("active");
  });

  input.addEventListener("blur", (event) => {
    if (input.value == "") {
      label.classList.remove("active");
    }
  });

  input.addEventListener("keyup", (event) => {
    label.classList.add("active");
  });
});
