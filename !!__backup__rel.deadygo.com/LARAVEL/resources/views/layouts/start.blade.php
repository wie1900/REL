<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/app.css" rel="stylesheet">
    <script src="/js/app.js"></script>
    <title>@yield('title')</title>
    <style>
        .container {
            max-width: 1800px;
        }
        #content {
            margin-top: 0px;
        }
        body {
            font-size: 0.85rem;
        }
        .thrash {
            height: 0.85rem;
            margin-bottom: 2px;
        }
        #left {
            width: 12%;
        }
        #right {
            width: 88%;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
    <body>
        <div class="container">
            {{-- header --}}
            <div id="header" class="row bg-secondary text-light">
                <div class="col-12 mt-3 text-center border-bottom">
                    <h1><b>@yield('title')</b> <span class="h4">@yield('ver')</span></h1>
                </div>
            </div>

            <div id="content" class="row">

                {{-- left sidebar --}}
                <div id="left" class="border-end">
                    <div class="row fw-bold text-light mb-0">
                        <button class="h5 fw-bold text-center border-0 btn-success btn-block py-2 mb-1" onclick="window.location.href='/';">
                            Home
                        </button>
                    </div>
                    <div class="row mt-0">
                        <div class="col-12 my-1 py-1 btn btn-primary fs-5 text-light mt-0" onclick="window.location.href='/total';">Reports</div>
                        <div class="col-12 mb-1 py-1 btn btn-primary fs-5 text-light" onclick="window.location.href='/revenues';">Revenues</div>
                        <div class="col-12 mb-1 py-1 btn btn-primary fs-5 text-light" onclick="window.location.href='/expenses';">Expenses</div>
                        <div class="col-12 mb-1 py-1 btn btn-primary fs-5 text-light" onclick="window.location.href='/customers';">Customers</div>
                        <div class="col-12 mb-1 py-1 btn btn-primary fs-5 text-light" onclick="window.location.href='/contractors';">Contractors</div>

                        <div class="col-12 text-start ps-4 mt-3 h6">-> <b><a href="/pdfs">PDF files</a></b> > <b><a href="/clearpdfs" class="text-danger">Delete ALL</a></b></div>
                    </div>
                    <div class="row mt-5">
                            <a class="btn btn-danger text-light" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                    </div>
                    <div class="row">
                        @yield('subleft')
                    </div>
                </div>

                {{-- main content --}}
                <div id="right" class="">
                    @yield('content')
                </div>
            </div>

            {{-- Footer --}}
            <div class="row">
                <div class="col-12">
                </div>
            </div>

        </div>
    </body>
</html>
