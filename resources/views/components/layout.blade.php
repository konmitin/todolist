<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <title>ToDoList</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>


<body class="antialiased">
    @csrf
    <div class="wrapper">

        <body>
            <div class="wrapper">

                <x-header.index></x-header.index>

                <main class="main">
                    <div class="main__container">
                        {{ $slot }}
                    </div>
                </main>
            </div>

            <x-auth-form />
            <x-task-create-form />
            <x-user-popup />

        </body>
    </div>
</body>

</html>
