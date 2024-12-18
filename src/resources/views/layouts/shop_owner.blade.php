<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rese</title>
        <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
        <link rel="stylesheet" href="{{ asset('css/layouts/shop_owner.css') }}">
        @yield('css')
    </head>
    <body>
        <header class="main-header">
            <div class="main-nav">
                <label class="drawer_open" for="drawer_input"><span></span></label>
                <input class="drawer_hidden" id="drawer_input" type="checkbox">
                    <nav class="nav_content">
                        <ul class="nav_list">
                            <li class="nav_item">
                                <a href="{{route('shop_owner.reservations')}}">Home</a>
                            </li>
                            <li class="nav_item">
                                <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                    <button type="submit">Logout</button>
                                </form>
                            </li>
                            @if (!Auth::user()->shop)
                            <li class="nav_item">
                                <a href="{{route('shop_owner.shop.create')}}">Creating shop information</a>
                            </li>
                            @else
                            <li class="nav_item">
                                <a href="{{route('shop_owner.shop.edit.edit', ['shop' => Auth::user()->shop->id])}}">Update shop information</a>
                            </li>
                            <li class="nav_item">
                                <a href="{{route('shop_owner.notification.create')}}">Send a notification e-mail</a>
                            </li>
                            @endif
                        </ul>
                    </nav>
            </div>
            <div class="logo">Rese</div>
        </header>
        <main class="main-content">
            @yield('content')
        </main>
    </body>
</html>