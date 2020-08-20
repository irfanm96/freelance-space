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
    @if (session()->has('contactSuccess'))
        <div x-data="{open: ture}" x-show="open" x-init="setTimeout(function(){open = false},1000)" class="rounded-md bg-green-50 p-4">
            <div class="flex justify-center">
                <div class="ml-3">
                    <p class="text-lg leading-5 font-medium text-green-800">
                        {{session()->get('contactSuccess')}}
                    </p>
                </div>
            </div>
        </div>
    @endif
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
    <div class="relative bg-white" id="contact">
        <div class="absolute inset-0">
            <div class="absolute inset-y-0 left-0 w-1/2 bg-gray-50"></div>
        </div>
        <div class="relative max-w-7xl mx-auto lg:grid lg:grid-cols-5">
            <div class="bg-gray-50 py-16 px-4 sm:px-6 lg:col-span-2 lg:px-8 lg:py-24 xl:pr-12">
                <div class="max-w-lg mx-auto">
                    <h2 class="text-2xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-3xl sm:leading-9">
                        Contact Us
                    </h2>
                    <dl class="mt-8 text-base leading-6 text-gray-500">
                        <div>
                            <dt class="sr-only">Postal address</dt>
                            <dd>
                                <p>742 Evergreen Terrace</p>
                                <p>Springfield, OR 12345</p>
                            </dd>
                        </div>
                        <div class="mt-6">
                            <dt class="sr-only">Phone number</dt>
                            <dd class="flex">
                                <svg class="flex-shrink-0 h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span class="ml-3">
                                    +1 (555) 123-4567
                                </span>
                            </dd>
                        </div>
                        <div class="mt-3">
                            <dt class="sr-only">Email</dt>
                            <dd class="flex">
                                <svg class="flex-shrink-0 h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="ml-3">
                                    support@freelancespace.com
                                </span>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
            <div class="bg-white py-16 px-4 sm:px-6 lg:col-span-3 lg:py-24 lg:px-8 xl:pl-12">
                <div class="max-w-lg mx-auto lg:max-w-none">
                    <form action="{{route('contact')}}" method="POST" class="grid grid-cols-1 row-gap-6">
                        @csrf
                        <div>
                            <label for="name" class="sr-only">Full name</label>
                            <div class="relative rounded-md shadow-sm">
                                <input id="name" name="name"
                                    class="form-input border block w-full py-3 px-4 placeholder-gray-500 transition ease-in-out duration-150"
                                    placeholder="Full name">
                            </div>
                            @error('name') <span class="text-sm text-red-500">{{$message}}</span> @enderror
                        </div>
                        <div>
                            <label for="email" class="sr-only">Email</label>
                            <div class="relative rounded-md shadow-sm">
                                <input id="email" type="email" name="email"
                                    class="form-input border block w-full py-3 px-4 placeholder-gray-500 transition ease-in-out duration-150"
                                    placeholder="Email">
                            </div>
                            @error('email') <span class="text-sm text-red-500">{{$message}}</span> @enderror
                        </div>
                        <div>
                            <label for="phone" class="sr-only">Phone</label>
                            <div class="relative rounded-md shadow-sm">
                                <input id="phone" name="phone"
                                    class="form-input border block w-full py-3 px-4 placeholder-gray-500 transition ease-in-out duration-150"
                                    placeholder="Phone">
                            </div>
                            @error('phone') <span class="text-sm text-red-500">{{$message}}</span> @enderror
                        </div>
                        <div>
                            <label for="message" class="sr-only">Message</label>
                            <div class="relative rounded-md shadow-sm">
                                <textarea id="message" rows="4" name="message"
                                    class="form-input border block w-full py-3 px-4 placeholder-gray-500 transition ease-in-out duration-150"
                                    placeholder="Message"></textarea>
                            </div>
                            @error('message') <span class="text-sm text-red-500">{{$message}}</span> @enderror
                        </div>
                        <div class="">
                            <span class="inline-flex rounded-md shadow-sm">
                                <button type="submit"
                                    class="inline-flex justify-center py-3 px-6 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                                    Submit
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
                            <a href="#contact" class="hover:underline text-gray-600 hover:text-orange-500">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>