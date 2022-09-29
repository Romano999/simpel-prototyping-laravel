<x-app-layout>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.2.4/fabric.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        var page = @json($page);
        var pageObjects = @json($objects);
    </script>
    <script src="{{ asset("js/canvas/canvas.js") }}"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Page') }}
        </h2>
    </x-slot>

    <div class="flex justify-center items-center">
        <div class="w-2/3">
            <div>
                {{-- Canvas --}}
                <div class="py-12 flex-1">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                            <div>
                                <h1>{{ __('Create new objects') }}</h1>
                            </div>
                            <div class="flex shadow-md sm:rounded-lg px-4 py-4">  
                                <x-jet-button id="create-text-button" class="flex-1">
                                    {{ __('Create text') }}
                                </x-jet-button>
                                <x-jet-button class="flex-1">
                                    {{ __('Create image') }}
                                </x-jet-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex">
                {{-- Canvas Item Editor --}}
                <div class="py-12 flex-1">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">  
                                <div id="canvas-edit">
                                    <div>
                                        <label for="text-font-size">Font size:</label>
                                        <input type="range" value="" min="1" max="120" step="1" id="text-font-size">
                                    </div>
                                    <div>
                                        <x-jet-button id="delete-text-button" class="flex-1">
                                            {{ __('Delete text') }}
                                        </x-jet-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Canvas --}}
                <div class="py-12 flex-1">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">  
                                <canvas id="canvas" width="1000" height="1000"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</x-app-layout>
