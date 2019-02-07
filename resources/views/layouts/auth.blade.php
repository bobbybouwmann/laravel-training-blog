@include('includes.head')

<body>

<div id="app">

    @include('includes.menu')

    <main class="py-4">

        @yield('content')

    </main>
</div>

</body>

</html>
