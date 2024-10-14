<div class="creation main__creation">

    <form data-form="addToDo" class="creation__form creation-form" action="" method="post">
        @csrf

        <div class="creation-form__item">
            <h3 class="creation-form__title title_h3">Заголовок</h3>
            <label class="creation-form__input-box">
                <input name="title" type="text" class="creation-form__input" />
            </label>
        </div>
        <div class="creation-form__item">
            <h3 class="creation-form__title title_h3">Описание</h3>
            <label class="creation-form__input-box">
                <input name="description" type="text" class="creation-form__input" />
            </label>
        </div>
        <div class="creation-form__item">
            <h3 class="creation-form__title title_h3">Дата завершения</h3>
            <label class="creation-form__input-box">
                <input type="date" id="dateForToDo" name="enddate" class="creation-form__input" />
            </label>
        </div>
        <div class="creation-form__buttons">
            <button class="creation-form__button creation-form__button-add" type="submit">
                Добавить
            </button>
            <button class="creation-form__button creation-form__button-cancel" type="reset" data-type="cancelBtn">
                Отмена
            </button>
        </div>
    </form>
    <a class="creation__close">
    </a>
</div>
