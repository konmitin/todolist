"use strict";

const addToDoForm = document.querySelector("[data-form='addToDo']");
const cancelBtn = document.querySelector("[data-type='cancelBtn']");
const checkTodo = document.querySelectorAll(".backlog__checkbox");

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
const logoutLink = document.querySelector("[data-type=logout]");
const regLink = document.querySelector("[data-type=reg]");

if (loginLink) {
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
}

if (regLink) {
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
}

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
  let response = await fetch("/register", {
    method: "POST",
    headers: { accept: "application/json" },
    body: new FormData(form),
  });

  if (response.ok) {
    let result = await response.json();
    alert(result.message);

    location.reload();
  }
}

async function loginUser(form) {
  let response = await fetch("/login", {
    method: "POST",
    headers: { accept: "application/json" },
    body: new FormData(form),
  });

  let result = await response.json();

  if (response.ok) {
    // alert("Добро пожаловать!");
    location.reload();
  } else {
    alert(result.error.message);
  }
}
if (logoutLink) {
  logoutLink.addEventListener("click", (event) => {
    event.preventDefault();
    logoutUser();
  });
}
async function logoutUser() {
  let response = await fetch("/logout", {
    method: "GET",
  });

  if (response.ok) {
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

// === Разделы в userpopup === //

try {
  const userInfo = document.querySelector(".user-info");
  const toUserInfo = document.querySelector("[data-type='userinfo']");
  const userInfoTabLink = userInfo.querySelectorAll(".user-info__tab-link");

  toUserInfo.addEventListener("click", (event) => {
    event.preventDefault();

    userInfo.classList.add("active");
  });

  userInfo.addEventListener("click", (event) => {
    if (
      !event.target.closest(".user-info__container") ||
      event.target.closest(".user-info__close")
    ) {
      userInfo.classList.remove("active");
    }
  });

  userInfoTabLink.forEach((tab) => {
    tab.addEventListener("click", (event) => {
      event.preventDefault();

      let target = event.target;
      let href = target.getAttribute("href");

      const activeTab = userInfo.querySelector(".user-info__tab-link.active");
      const content = userInfo.querySelector(".user-info__content-list");

      if (activeTab) {
        activeTab.classList.remove("active");
      }

      target.classList.add("active");

      console.log(href);

      const targetContent = content.querySelector(href);
      const activeContent = content.querySelector(".active");

      if (targetContent) {
        targetContent.classList.add("active");
      }

      if (activeContent) {
        let activeHref = "#" + activeContent.getAttribute("id");
        console.log(activeHref);

        if (href != activeHref) {
          activeContent.classList.remove("active");
        }
      }
    });
  });
} catch (e) {}

import './task';
import './sort';
