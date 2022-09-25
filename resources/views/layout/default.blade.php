<!doctype html>
<html>
<head>
   @include('includes.head')
</head>
<body>
    <div id="app">
        <header class="row">
        @include('includes.header')
        </header>
        <div class="container">
        
            <div id="main" class="row">
                @yield('content')
            </div>

        </div>
        <footer class="row">
            @include('includes.footer')
        </footer>
    </div>
</body>
</html>