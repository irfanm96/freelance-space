<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

</head>

<body class="bg-gray-100 h-screen antialiased leading-none">
    <div class="antialiased sans-serif min-h-screen bg-white" style="min-height: 900px">
        <div class="container mx-auto py-6 px-4">
            <div class="flex justify-between">
                <h2 class="text-2xl font-bold mb-6 pb-2 tracking-wider uppercase">{{$invoice->user->name}} <span class="text-sm lowercase">({{$invoice->user->email}})</span></h2>
                <div>
                    <div class="relative mr-4 inline-block">
                        <div
                            class="text-gray-500 cursor-pointer w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-300 inline-flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                <path
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                                <rect x="7" y="13" width="10" height="8" rx="2" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex mb-8 justify-between">
                <div class="w-2/4">
                    <div class="mb-2 md:mb-1 md:flex items-center">
                        <label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Invoice
                            No.</label>
                        <span class="mr-4 inline-block md:block">:</span>
                        <div class="flex-1">
                            <p
                                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-48 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500">
                            #IN-{{$invoice->id}}</p>
                        </div>
                    </div>

                    <div class="mb-2 md:mb-1 md:flex items-center">
                        <label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Invoice
                            Date</label>
                        <span class="mr-4 inline-block md:block">:</span>
                        <div class="flex-1">
                            <p
                                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-48 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500">
                            {{$invoice->date->format('yy-m-d')}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap justify-between mb-8">
                <div class="w-full md:w-1/3 mb-2 md:mb-0">
                    <label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">To:</label>
                    <div class="space-y-3 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight" >
                        {!!$invoice->to!!}
                    </div>
                </div>
                <div class="w-full md:w-1/3">
                    <label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">Bank Detail:</label>
                    <div
                        class="space-y-3 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight">
                        {!!$invoice->bankDetail->details!!}
                    </div>

                </div>
            </div>

            <div class="flex -mx-1 border-b py-2 items-start">
                <div class="flex-1 px-1">
                    <p class="text-gray-800 uppercase tracking-wide text-sm font-bold">Task Description</p>
                </div>

                <div class="px-1 w-20 text-right">
                    <p class="text-gray-800 uppercase tracking-wide text-sm font-bold">Status</p>
                </div>

                <div class="px-1 w-20 text-right">
                    <p class="text-gray-800 uppercase tracking-wide text-sm font-bold">Time</p>
                </div>

                <div class="px-1 w-32 text-right">
                    <p class="leading-none">
                        <span class="block uppercase tracking-wide text-sm font-bold text-gray-800">Rate</span>
                        <span class="font-medium text-xs text-gray-500">(USD/hour)</span>
                    </p>
                </div>

                <div class="px-1 w-32 text-right">
                    <p class="leading-none">
                        <span class="block uppercase tracking-wide text-sm font-bold text-gray-800">Amount</span>
                    </p>
                </div>
            </div>
            @php
                $total=0;
            @endphp
            @foreach($invoice->tasks as $task)
            <div class="flex -mx-1 py-2 border-b">
                <div class="flex-1 px-1">
                <p class="text-gray-800">{{$task->name}}</p>
                </div>

                <div class="px-1 w-20 mr-2">
                    <x-task-badge :type="$task->type"/>
                </div>

                <div class="px-1 w-20 text-right">
                    <p class="text-gray-800">{{$task->hours}}</p>
                </div>
                <div class="px-1 w-32 text-right">
                    <p class="text-gray-800">{{$invoice->project->rate}}</p>
                </div>

                <div class="px-1 w-32 text-right">
                    @php
                        $amount = $task->hours * $invoice->project->rate;
                        $total += $amount;
                    @endphp
                    <p class="text-gray-800">{{$amount}}</p>
                </div>
            </div>
            @endforeach

            <div class="py-2 ml-auto mt-5 w-full sm:w-2/4 lg:w-1/4">
                <div class="flex justify-between mb-3">
                    <div class="text-gray-800 text-right flex-1">Total Amount (USD)</div>
                    <div class="text-right w-40">
                    <div class="text-gray-800 font-medium">{{$total}}</div>
                    </div>
                </div>
                <div class="flex justify-between mb-4">
                    <div class="text-sm text-gray-600 text-right flex-1">Discount (USD)</div>
                    <div class="text-right w-40">
                    <div class="text-sm text-gray-600" >{{$invoice->discount}}</div>
                    </div>
                </div>

                <div class="py-2 border-t border-b">
                    <div class="flex justify-between">
                        <div class="text-xl text-gray-600 text-right flex-1">Amount due</div>
                        <div class="text-right w-40">
                            <div class="text-xl text-gray-800 font-bold">{{$total - $invoice->discount}}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-10 text-center">
                <p class="text-gray-600">Created by <a
                        class="text-blue-600 hover:text-blue-500 border-b-2 border-blue-200 hover:border-blue-300"
                        href="/">FreelanceSpace</a></p>
            </div>
        </div>
</body>

</html>