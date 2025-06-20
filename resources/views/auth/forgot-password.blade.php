<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <a href="/">
                <img src="{{asset('images/cait.png')}}" alt="CAIT Logo" class="w-full h-16">
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Wachtwoord vergeten? Geen probleem. Vul je emailadres in, dan krijg je een mailtje met een link om je wachtwoord te resetten. Het kan even duren voordat je het mailtje ontvangt.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Verstuur wachtwoord reset link') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
