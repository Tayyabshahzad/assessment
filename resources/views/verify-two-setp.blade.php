<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('verify') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email ') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="email" />
                <p> Please Check Your Email For Code</p>
            </div>

            <div>
                <x-label for="code" value="{{ __('Code ') }}" />
                <x-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')" required autofocus autocomplete="code" />
                <p> Please Check Your Email For Code</p>
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-button class="ms-4">
                    {{ __('verify') }}
                </x-button>



            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </x-authentication-card>
</x-guest-layout>
