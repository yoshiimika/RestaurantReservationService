<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layouts/verify-email.css') }}">
    @yield('css')
</head>

<body>
    <header class="main-header">
        <div class="logo">Rese</div>
    </header>

    <main class="main-content">
        @yield('content')
    </main>

</body>
</html>
