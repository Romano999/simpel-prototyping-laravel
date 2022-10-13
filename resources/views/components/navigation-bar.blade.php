@if (Route::has('login'))
<div class=" px-6 py-4 sm:block">
    @auth
        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
    @else
    <div class="flex flex-row">
        <div class="flex-1">
            <a href="{{ url('/') }}">
                <x-jet-application-mark class="block h-9 w-auto" />
            </a>
        </div>
        <div class="flex-1">
            <div class="flex">
                <a class="flex-auto" href="{{ url('/') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>

                <a class="flex-auto" href="{{ url('/about') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">About</a>
    
                <a class="flex-auto" href="{{ url('/contact') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Contact</a>
    
                <a class="flex-auto" href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
    
                @if (Route::has('register'))
                    <a class="flex-auto" href="{{ route('register') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endif
            </div>
        </div>
        @endauth
    </div>
</div>
@endif