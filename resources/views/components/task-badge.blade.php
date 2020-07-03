@props([
    'type' => 'sprint_backlog',
    'lookUpTable' => [
        'sprint_backlog' =>'red',
        'in_progress' => 'blue',
        'in_staging' => 'orange',
        'in_production' => 'green'
    ]
])
<span class="whitespace-no-wrap px-2 py-1 rounded-full uppercase text-xs font-bold bg-{{$lookUpTable[$type]}}-300 text-{{$lookUpTable[$type]}}-600">
    {{$type}}
</span>