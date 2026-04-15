<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-[linear-gradient(to_top,#000c,#0000),url({{ asset('images/bg-welcome.png') }})] min-h-dvh bg-no-repeat bg-center bg-fixed pt-14 bg-cover">
    <main class="p-12 flex flex-col gap-2 justify-center items-center min-h-dvh">
        @if (session('message'))
            <div class="alert alert-success fixed top-16 right-4 w-auto max-w-sm z-50 shadow-lg" id="flash-message">
                <span>{{ session('message') }}</span>
            </div>
        @endif
        @yield('content')
    </main>
    @yield('js')
    <script>
        setTimeout(() => { document.getElementById('flash-message')?.remove() }, 4000)
    </script>
</body>
</html>