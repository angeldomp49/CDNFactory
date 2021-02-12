<x-header>
    <x-slot name="pageTitle">
        new-file
    </x-slot>
</x-header>
    <div class="container">
        <div class="empty-space h-5em"></div>
        <div class="wrap">
            <p>this is the cdn:  {{ $route }} </p>
            for view the file <a href="{{ $route }}">Go</a>
        </div>
        <empty-space class="h5-em"></empty-space>
    </div>
    
<x-footer/>