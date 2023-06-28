<!DOCTYPE html>
<html lang="en">
<head>
    @livewireStyles
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css">
    <title>@yield('title')</title>
</head>
<body>

<div class="container mx-auto">
    @yield('content')
</div>

@include('layout.footer')
{{--<script src="{{ mix('js/app.js') }}"></script>--}}
{{--<script>--}}
{{--    window.Alpine = require('alpinejs');--}}
{{--    window.Alpine.start();--}}
{{--</script>--}}
@livewireScripts
</body>
</html>
