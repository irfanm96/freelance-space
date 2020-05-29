<x-dashboard>
    {{-- <livewire:twitter-tile position="a1:a4" />
    <livewire:calendar-tile position="b1:b4" /> --}}
    <livewire:calendar-tile position="c3" :calendar-id="config('dashboard.tiles.calendar.ids.0')" />
    <livewire:time-weather-tile position="a1" />
</x-dashboard>