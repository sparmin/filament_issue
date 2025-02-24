<head>
    <title>{{config('app.name')}}</title>
    <link rel="icon" type="image/x-icon" href="{{Storage::url('theme/logo.svg')}}">
    {{-- include stylesheets --}}
    @include('layout.include.style')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
