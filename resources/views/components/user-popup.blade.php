<?php
session_start();
// $currentUserID = $_SESSION["user_id"];

// $friends = User::getFriends($currentUserID);

// $userData = User::getById($_SESSION["user_id"]);
?>

<div id="userinfo" class="user-info">

    <div class="user-info__container">
        <button class="user-info__close">
            X
        </button>
        <div class="user-info__top">
            {{-- <h4 class="user-info__name">$userData->getName()</h4> --}}
            <span class="user-info__register-date">Зарегистрирован
                {{-- date('d M y', strtotime($userData->getRegisterDate())) --}}
            </span>
        </div>
        <ul class="user-info__tab">
            <li class="user-info__tab-item">
                <a href="#u-friends" class="user-info__tab-link">Друзья</a>
            </li>
            <li class="user-info__tab-item">
                <a href="#other" class="user-info__tab-link">Other</a>
            </li>
        </ul>
        <div class="user-info__content-list">
            <div id="u-friends" class="user-info__content-item">
                <ul class="user-info__friends">
                    {{-- @foreach ($friends as $friend)
                        $friendID = $friend['id'];
                        $friendName = $friend['name'];

                        <li class="user-info__friend">
                            <a href="#$friendID" class="user-info__friend-link">$friendName</a>
                        </li>
                    @endforeach --}}

                    
                </ul>
            </div>
        </div>
    </div>
</div>
