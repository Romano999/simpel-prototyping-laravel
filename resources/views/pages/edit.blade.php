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
                
            </div>
                {{-- Canvas --}}
                <div class="py-12 flex-1">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                            <div class="overflow-hidden relative shadow-md sm:rounded-lg px-4 py-4">  
                                <canvas id="canvas" class="absolute" width="1000" height="1000"></canvas>
                                {{-- Canvas Item Editor --}}
                                <div id="canvas-editor">
                                    {{-- Text box --}}
                                    <div id="canvas-edit-text" class="absolute top-10 left-10" >
                                        <div class="flex flex-row justify-between">
                                            <label for="Color">Color:</label>
                                            <input type="color" value="" id="text-fill-color">
                                        </div>
                                        <div class="flex flex-row justify-between">
                                            <label for="text-font-size">Font size:</label>
                                            <input class="w-24" type="number" value="" step="1" id="text-font-size">
                                        </div>
                                        <div>
                                            <label for="text-z-index">Z-index:</label>
                                            <input type="number" value="" step="1" id="text-z-index">
                                        </div>
                                        <div>
                                            <x-jet-button id="delete-text-button" class="flex-1">
                                                {{ __('Delete text') }}
                                            </x-jet-button>
                                        </div>
                                    </div>
                                    {{-- Image --}}
                                    <div id="canvas-edit-image" class="absolute top-10 left-10" >
                                        <div>
                                            <label for="image-z-index">Z-index:</label>
                                            <input type="number" value="" step="1" id="image-z-index">
                                        </div>
                                        <div>
                                            <x-jet-button id="delete-image-button" class="flex-1">
                                                {{ __('Delete image') }}
                                            </x-jet-button>
                                        </div>
                                    </div>
                                    {{-- Rectangle --}}
                                    <div id="canvas-edit-rectangle" class="absolute top-10 left-10">
                                        <div class="flex flex-row justify-between">
                                            <label for="Fill-color">Fill-color:</label>
                                            <input type="color" value="" id="rectangle-fill-color">
                                        </div>
                                        <div class="flex flex-row justify-between">
                                            <label for="Stroke-color">Stroke-color:</label>
                                            <input type="color" value="" id="rectangle-stroke-color">
                                        </div>
                                        <div>
                                            <label for="rectangle-stroke-width">Stroke width</label>
                                            <input type="number" value="" step="1" id="rectangle-stroke-width">
                                        </div>
                                        <div>
                                            <label for="rectangle-z-index">Z-index:</label>
                                            <input type="number" value="" step="1" id="rectangle-z-index">
                                        </div>
                                        <div>
                                            <x-jet-button id="delete-rectangle-button" class="flex-1">
                                                {{ __('Delete rectangle') }}
                                            </x-jet-button>
                                        </div>
                                    </div>
                                    {{-- Circle --}}
                                    <div id="canvas-edit-circle" class="absolute top-10 left-10" >
                                        <div class="flex flex-row justify-between">
                                            <label for="Fill-color">Fill-color:</label>
                                            <input type="color" value="" id="circle-fill-color">
                                        </div>
                                        <div class="flex flex-row justify-between">
                                            <label for="Stroke-color">Stroke-color:</label>
                                            <input type="color" value="" id="circle-stroke-color">
                                        </div>
                                        <div>
                                            <label for="circle-stroke-width">Stroke width</label>
                                            <input type="number" value="" step="1" id="circle-stroke-width">
                                        </div>
                                        <div>
                                            <label for="circle-z-index">Z-index:</label>
                                            <input type="number" value="" step="1" id="circle-z-index">
                                        </div>
                                        <div>
                                            <x-jet-button id="delete-circle-button" class="flex-1">
                                                {{ __('Delete circle') }}
                                            </x-jet-button>
                                        </div>
                                    </div>
                                    {{-- Triangle --}}
                                    <div id="canvas-edit-triangle" class="absolute top-10 left-10" >
                                        <div class="flex flex-row justify-between">
                                            <label for="Fill-color">Fill-color:</label>
                                            <input type="color" value="" id="triangle-fill-color">
                                        </div>
                                        <div class="flex flex-row justify-between">
                                            <label for="Stroke-color">Stroke-color:</label>
                                            <input type="color" value="" id="triangle-stroke-color">
                                        </div>
                                        <div>
                                            <label for="triangle-stroke-width">Stroke width</label>
                                            <input type="number" value="" step="1" id="triangle-stroke-width">
                                        </div>
                                        <div>
                                            <label for="triangle-z-index">Z-index:</label>
                                            <input type="number" value="" step="1" id="triangle-z-index">
                                        </div>
                                        <div>
                                            <x-jet-button id="delete-triangle-button" class="flex-1">
                                                {{ __('Delete triangle') }}
                                            </x-jet-button>
                                        </div>
                                    </div>
                                </div>
                                {{-- Canvas Item Creator --}}
                                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg absolute top-10 right-10">
                                    <div>
                                        <h1 class="px-4 bold">{{ __('Create new objects') }}</h1>
                                    </div>
                                    <div class="flex flex-col shadow-md sm:rounded-lg px-4 py-2 gap-2">  
                                        <x-jet-button id="create-text-button" class="flex-1">
                                            {{ __('Create text') }}
                                        </x-jet-button>
                                        <x-jet-button href="{{ route('register') }}" id="create-image-button" class="flex-1">
                                            <a href="{{ url("images/$page->id") }}">{{ __('Create image') }}</a>
                                        </x-jet-button>
                                        <x-jet-button id="create-rectangle-button" class="flex-1">
                                            {{ __('Create rectangle') }}
                                        </x-jet-button>
                                        <x-jet-button id="create-circle-button" class="flex-1">
                                            {{ __('Create circle') }}
                                        </x-jet-button>
                                         <x-jet-button id="create-triangle-button" class="flex-1">
                                            {{ __('Create triangle') }}
                                        </x-jet-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</x-app-layout>
