<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layouts/app.css') }}">
    @yield('css')
</head>

<body>
    <header class="main-header">
        <div class="main-nav">
            <input id="drawer_input" class="drawer_hidden" type="checkbox">
            <label for="drawer_input" class="drawer_open"><span></span></label>
                <nav class="nav_content">
                    <ul class="nav_list">
                        <li class="nav_item">
                            <a href="{{route('shops.index')}}">Home</a>
                        </li>
                        @if (Auth::check())
                        <li class="nav_item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit">Logout</button>
                            </form>
                        </li>
                        <li class="nav_item">
                            <a href="{{route('users.mypage')}}">Mypage</a>
                        </li>
                        <li class="nav_item">
                            <a href="{{ route('payment.input-amount') }}">Payment Page</a>
                        </li>
                        @else
                        <li class="nav_item">
                            <a href="{{route('register')}}">Registration</a>
                        </li>
                        <li class="nav_item">
                            <a href="{{route('login')}}">Login</a>
                        </li>
                        @endif
                    </ul>
                </nav>
        </div>
        <div class="logo">Rese</div>
        @if (Request::is('/') || Request::is('search*'))
        <div class="filter-bar">
            <form action="{{ route('search') }}" method="get">
            @csrf
                <div class="search-container">
                    <select class="search-select" name="area_id">
                        <option value="all" {{ request('area_id') == 'all' ? 'selected' : '' }}>
                            All area
                        </option>
                        @foreach($areas as $area)
                        <option value="{{ $area->id }}" {{ request('area_id') == $area->id ? 'selected' : '' }}>
                            {{ $area->name }}
                        </option>
                        @endforeach
                    </select>
                    <select class="search-select" name="genre_id">
                        <option value="all" {{ request('genre_id') == 'all' ? 'selected' : '' }}>
                            All genre
                        </option>
                        @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" {{ request('genre_id') == $genre->id ? 'selected' : '' }}>
                            {{$genre->name}}
                        </option>
                        @endforeach
                    </select>
                    <div class="search-input">
                        <button type="submit" class="search-icon">&#128269;</button>
                        <input class="search-input" name="name" type="text" value="{{request('name')}}" placeholder="Search...">
                    </div>
                </div>
            </form>
        </div>
        @endif
    </header>

    <main class="main-content">
        @yield('content')
        @yield('scripts')
    </main>
</body>
</html>
