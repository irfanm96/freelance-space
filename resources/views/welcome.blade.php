{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Biller For Freelancers</title>
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@next/dist/tailwind.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,700" rel="stylesheet" />
</head>

<body class="text-gray-700 bg-white" style="font-family: 'Source Sans Pro', sans-serif">
    <!--Nav-->
    <nav>
        <div class="container mx-auto px-6 py-2 flex justify-between items-center">
            <a class="font-bold text-2xl lg:text-4xl" href="#">
                FreelanceSpace
            </a>
            <div class="block lg:hidden">
                <button
                    class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-800 hover:border-teal-500 appearance-none focus:outline-none">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                    </svg>
                </button>
            </div>
            <div class="hidden lg:block">
                <ul class="inline-flex">
                    <li>
                        <a class="px-4 font-bold" href="/">Home</a>
                    </li>
                    <li>
                        <a class="px-4 hover:text-gray-800" href="#">About</a>
                    </li>
                    <li>
                        <a class="px-4 hover:text-gray-800" href="#">Contact</a>
                    </li>
                    <li>
                        <a class="px-4 hover:text-gray-800" href="/admin/login">Login</a>
                    </li>
                    <li>
                        <a class="px-4 hover:text-gray-800" href="{{ route('register') }}">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--Hero-->
    <div class="py-20" style="background: linear-gradient(90deg, #667eea 0%, #764ba2 100%)">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold mb-2 text-white">
                Smart way to track your tasks for invoicing!
            </h2>
            <h3 class="text-2xl mb-8 text-gray-200">
                Go easy on generating invoices.
            </h3>
            <a href="{{ route('register') }}" class="bg-white font-bold rounded-full py-4 px-8 shadow-lg uppercase tracking-wider">
                Register
            </a>
        </div>
    </div>
    <!-- Features -->
    <section class="container mx-auto px-6 p-10">
        <h2 class="text-4xl font-bold text-center text-gray-800 mb-8">
            Features
        </h2>
        <div class="flex items-center flex-wrap mb-20">
            <div class="w-full md:w-1/2">
                <h4 class="text-3xl text-gray-800 font-bold mb-3">
                    Track Tasks from trello
                </h4>
                <p class="text-gray-600 text-xl mb-8">
                    Our platofrom will intergate with trello to monitor your tasks,all of the required tasks will be in sync.
                    We will track down the completed tasks and help you to generate the invoice
                </p>
            </div>
            <div class="w-full md:w-1/2">
                <img src="{{asset('/images/trello.png')}}" alt="Trello" />
            </div>
        </div>
        <div class="flex items-center flex-wrap mb-20">
            <div class="w-full md:w-1/2">
                <img src="{{asset('/images/reporting.png')}}" alt="Reporting" />
            </div>
            <div class="w-full md:w-1/2 pl-10">
                <h4 class="text-3xl text-gray-800 font-bold mb-3">
                    Reporting
                </h4>
                <p class="text-gray-600 text-xl mb-8">
                    Our Platfrom will show the statistics of the freelancing projects you are involved
                </p>
            </div>
        </div>
        <div class="flex items-center flex-wrap mb-20">
            <div class="w-full md:w-1/2">
                <h4 class="text-3xl text-gray-800 font-bold mb-3">
                    Generate Quotations
                </h4>
                <p class="text-gray-600 text-xl mb-8">
                    Coming Soon
                </p>
            </div>
            <div class="w-full md:w-1/2">
                <img src="{{asset('/images/quotation.png')}}" alt="Quotations" />
            </div>
        </div>
    </section>
    <!-- Testimonials -->
    {{-- <section class="bg-gray-100">
        <div class="container mx-auto px-6 py-20">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-8">
                Testimonials
            </h2>
            <div class="flex flex-wrap">
                <div class="w-full md:w-1/3 px-2 mb-4">
                    <div class="bg-white rounded shadow py-2">
                        <p class="text-gray-800 text-base px-6 mb-5">
                            .....
                        </p>
                        <p class="text-gray-500 text-xs md:text-sm px-6">
                            John Doe
                        </p>
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-2 mb-4">
                    <div class="bg-white rounded shadow py-2">
                        <p class="text-gray-800 text-base px-6 mb-5">
                            ....
                        </p>
                        <p class="text-gray-500 text-xs md:text-sm px-6">
                            Jane Doe
                        </p>
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-2 mb-4">
                    <div class="bg-white rounded shadow py-2">
                        <p class="text-gray-800 text-base px-6 mb-5">
                            ....
                        </p>
                        <p class="text-gray-500 text-xs md:text-sm px-6">
                            James Doe
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!--Call to Action-->
    <section style="background-color: #667eea">
        <div class="container mx-auto px-6 text-center py-20">
            <h2 class="mb-6 text-4xl font-bold text-center text-white">
                Get in to our platfrom
            </h2>
            <h3 class="my-4 text-2xl text-white">
                Get yourself the Smart Biller!
            </h3>
            <a href="{{route('register')}}" class="bg-white font-bold rounded-full mt-6 py-4 px-8 shadow-lg uppercase tracking-wider">
                Register
            </a>
        </div>
    </section>
    <!--Footer-->
    <footer class="bg-gray-100">
        <div class="container mx-auto px-6 pt-10 pb-6">
            <div class="flex flex-wrap">
                <div class="w-full md:w-1/4 text-center md:text-left ">
                    <h5 class="uppercase mb-6 font-bold">Links</h5>
                    <ul class="mb-4">
                        <li class="mt-2">
                            <a href="#" class="hover:underline text-gray-600 hover:text-orange-500">FAQ</a>
                        </li>
                        <li class="mt-2">
                            <a href="#" class="hover:underline text-gray-600 hover:text-orange-500">Help</a>
                        </li>
                        <li class="mt-2">
                            <a href="#" class="hover:underline text-gray-600 hover:text-orange-500">Support</a>
                        </li>
                    </ul>
                </div>
                <div class="w-full md:w-1/4 text-center md:text-left ">
                    <h5 class="uppercase mb-6 font-bold">Legal</h5>
                    <ul class="mb-4">
                        <li class="mt-2">
                            <a href="#" class="hover:underline text-gray-600 hover:text-orange-500">Terms</a>
                        </li>
                        <li class="mt-2">
                            <a href="#" class="hover:underline text-gray-600 hover:text-orange-500">Privacy</a>
                        </li>
                    </ul>
                </div>
                <div class="w-full md:w-1/4 text-center md:text-left ">
                    <h5 class="uppercase mb-6 font-bold">Social</h5>
                    <ul class="mb-4">
                        <li class="mt-2">
                            <a href="#" class="hover:underline text-gray-600 hover:text-orange-500">Facebook</a>
                        </li>
                        <li class="mt-2">
                            <a href="#" class="hover:underline text-gray-600 hover:text-orange-500">Linkedin</a>
                        </li>
                        <li class="mt-2">
                            <a href="#" class="hover:underline text-gray-600 hover:text-orange-500">Twitter</a>
                        </li>
                    </ul>
                </div>
                <div class="w-full md:w-1/4 text-center md:text-left ">
                    <h5 class="uppercase mb-6 font-bold">Company</h5>
                    <ul class="mb-4">
                        <li class="mt-2">
                            <a href="#" class="hover:underline text-gray-600 hover:text-orange-500">Official Blog</a>
                        </li>
                        <li class="mt-2">
                            <a href="#" class="hover:underline text-gray-600 hover:text-orange-500">About Us</a>
                        </li>
                        <li class="mt-2">
                            <a href="#" class="hover:underline text-gray-600 hover:text-orange-500">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>