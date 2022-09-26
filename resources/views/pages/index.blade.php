<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="">
                    <div>
                        <x-link href="{{ route('pages.create') }}" class="m-4">Create a new page!</x-link>
                    </div>
                    @forelse ($pages as $page)
                    <div class="inline-grid grid-cols-3 gap-3 items-center">
                        <div class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            {{ $page->name }}
                        </div>

                        <div>
                            <x-link href="{{ route('pages.edit', $page) }}">Edit</x-link>
                        </div>
                        
                        <div class="px-6 py-4">                
                            <form method="POST" action="{{ route('pages.destroy', $page) }}" class="inline-block">                    
                                @csrf
                                @method('DELETE')                    
                                <x-jet-danger-button                    
                                    type="submit"                    
                                    onclick="return confirm('Are you sure?')">Delete</x-jet-danger-button>                    
                            </form>                    
                        </div>
                    </div>
                    @empty
                    <div>
                        No pages found!
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
