<x-app-layout>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.2.4/fabric.min.js"></script>
    <script>
        var page = @json($page);
        var pageObjects = @json($objects);
    </script>
    <script src="{{ asset("js/canvas.js") }}">
        
    </script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">     
                    <canvas id="canvas" width="1000" height="1000"></canvas>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>