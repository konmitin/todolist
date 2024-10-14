<div class="auth-form">
    <div class="auth-form__container">
        <ul class="tab-group">
            <li class="tab"><a class="tab__link" href="#login">Вход</a></li>
            <li class="tab">
                <a class="tab__link active" href="#signup">Регистрация</a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="signup" class="tab-content__item">
                <h1>Регистрируемся?</h1>

                <form action="{{ route('register') }}" method="post" data-type="registerForm">
                    @csrf

                    <div class="field-wrap">
                        <label class="auth-form__label"> Публичное имя<span class="req">*</span> </label>
                        <input name="name" type="text" required autocomplete="off" />
                    </div>

                    <div class="field-wrap">
                        <label class="auth-form__label"> Логин (email)<span class="req">*</span> </label>
                        <input name="email" type="text" required autocomplete="off" />
                    </div>

                    <div class="field-wrap">
                        <label class="auth-form__label"> Пароль<span class="req">*</span> </label>
                        <input name="password" type="password" required autocomplete="off" />
                    </div>

                    <button type="submit" class="button button-block" data-type="registerBtn">
                        Зарегистрироваться
                    </button>
                </form>
            </div>

            <div id="login" class="tab-content__item active">
                <h1>И снова привет!</h1>

                <form action="{{ route('login') }}" method="post" data-type="loginForm">
                    @csrf

                    <div class="field-wrap">
                        <label class="auth-form__label"> Логин (emal)<span class="req">*</span></label>
                        <input name="email" type="email" required autocomplete="off" />
                    </div>

                    <div class="field-wrap">
                        <label class="auth-form__label"> Пароль<span class="req">*</span> </label>
                        <input name="password" type="password" required autocomplete="off" />
                    </div>

                    <p class="forgot"><a href="#">Забыли пароль (в разработке)?</a></p>

                    <button class="button button-block">Войти</button>
                </form>
            </div>
        </div>
    </div>

    <!-- tab-content -->
</div>
