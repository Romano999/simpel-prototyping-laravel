<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                    <x-jet-validation-errors class="mb-4" />
                    <form method="POST" action="{{ route('images.store') }}" 
                    enctype="multipart/form-data">
                @csrf
                <div class="image my-4">
                    <x-jet-label for="images" value="{{ __('Add Images') }}" />
                    <input type="file" class="form-control" required name="image">
                </div>
            
                <x-jet-button>
                    {{ __('Save Image') }}
                </x-jet-button>
              </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
