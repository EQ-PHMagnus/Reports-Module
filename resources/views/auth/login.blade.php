<x-guest-layout >
    <x-auth-card>
        <x-slot name="logo">
            <a href="{{url('/')}}">
                <img class="h-24 w-auto" src="{{asset('assets/images/log-full.PNG')}}">
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />


        <form method="POST" action="{{ route('raven.login') }}" autocomplete="off">
            @csrf

            <!-- Username -->
            <div>
                <x-label for="username" :value="__('Username')" />

                <x-input id="username" class="block mt-1 w-full rounded-md focus:outline-none ring-2 ring-blue-900" type="text" name="username" :value="old('username')" required autofocus autocomplete="off"/>
            </div>

            <!-- Password -->
            <div class="mt-4 ">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full "
                                type="password"
                                name="password"
                                required autocomplete="current-password"
                                autocomplete="off"
                                />
            </div>

            <!-- Remember Me -->
            <!-- <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div> -->

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <!-- <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a> -->
                @endif

                <x-button class="ml-3 bg-blue-900">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
