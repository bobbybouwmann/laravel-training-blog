@include('includes.head')

<body>

<div id="app">

    @include('includes.menu')

    <main class="py-4">

        <div class="container">

            <div class="row">

                <div class="col-md-8">

                    @if (session()->has('message'))
                        <div class="alert alert-success mb-4" role="alert">
                            {{ session()->get('message') }}
                        </div>
                    @endif

                    @yield('content')

                </div>

                <div class="col-md-4">

                    @include('includes.sidebar')

                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>
