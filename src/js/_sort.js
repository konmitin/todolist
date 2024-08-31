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

      getTodoList(sortType);
    });
  });
}

async function getTodoList(sort) {

  let sortData = {};

  sortData.sort = sort;

  let response = await fetch("/controllers/getTodoList.php", {
    method: "POST",
    headers: {"content-type": "application/json;charset=utf8"},
    body: JSON.stringify(sortData)
  });

  if(response.ok) {

    let result = await response.json();

    const backlogList = document.querySelector(".backlog__list");
    const backlogCount = document.querySelector(".backlog__check");

    if(result.status == 200) {
      // window.location.reload();
      backlogList.innerHTML = result.list;
      backlogCount.textContent = result.count;
      addTaskEvent();
    } else {
      alert(result.message);
    }
  }
}