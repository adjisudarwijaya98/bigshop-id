<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>
</head>

<body class="bg-gray-50">
    {{-- Header kustom untuk Dashboard (opsional, tapi seringkali lebih baik) --}}
    @include('layouts._header_dashboard')

    <div class="flex min-h-screen pt-16">

        <aside class="w-64 bg-white shadow-xl border-r">
            @include('umkm._sidebar')
        </aside>

        <main class="flex-1 p-8">
            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>

    </div>

    {{-- Kita tidak perlu footer di Dashboard --}}

</body>

</html>
