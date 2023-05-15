<x-guest-layout>
    <div class="mt-2">
        <div style="text-align: right" class="m-2">
            <a href="{{route('register')}}" class="mb-2 p-2" style="text-align: right"><x-button class="ml-4">{{ __('ثبت نام') }}</x-button></a>     
        </div>
        <x-authentication-card>
            <x-slot name="logo">
                <x-authentication-card-logo />
            </x-slot>
    
            <x-validation-errors class="mb-4" />
    
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ session('status') }}
                </div>
            @endif
    
            <form method="POST" action="{{ route('login') }}" dir="rtl">
                @csrf
    
                <div>
                    <x-label for="email" style="text-align: right" value="{{ __('نام کاربری') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>
    
                <div class="mt-4">
                    <x-label for="password" style="text-align: right" value="{{ __('کلمه عبور') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                </div>
    
                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400 mr-2">{{ __('مرا به خاطر داشته باش') }}</span>
                    </label>
                </div>
    
                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-4">
                        {{ __('ورود') }}
                    </x-button>
                </div>
            </form>
        </x-authentication-card>

    </div>
</x-guest-layout>
