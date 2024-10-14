<header class="header">
    <div class="header__container">
        <div class="header__title-block">
            <a href="/" class="header__title">ToDoList</a>
        </div>
        <div class="header__auth-block">
            @auth
                <a href="#userinfo" class="header__auth" data-type="userinfo">{{ auth()->user()->email }}</a>
                <a href="{{ route('logout') }}" class="header__auth" data-type="logout">Выход</a>
            @else
                <a href="#" class="header__auth" data-type="login">Вход</a>
                <a href="#" class="header__auth" data-type="reg">Регистрация</a>
            @endauth
        </div>
    </div>
</header>
