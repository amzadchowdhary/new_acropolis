<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Header') }}
        </h2>
    </x-slot>
    <x-guest-layout>

        <x-auth-card>
            <x-slot name="logo">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Tax Rate Register') }}
                </h2>
            </x-slot>

            <form method="POST" action="{{ route('tax.register') }}">
                @csrf

                <!--Tax Name -->
                <div>
                    <x-input-label for="name" :value="__('Tax Name')" />

                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>


                <!-- Tax Rate percentage(%) -->
                <div class="mt-4">
                    <x-input-label for="tax_percentage" :value="__('% of tax')" />

                    <x-text-input id="pin_code" class="block mt-1 w-full" type="text" name="tax_percentage" :value="old('pin_code')"  />

                    <x-input-error :messages="$errors->get('tax_percentage')" class="mt-2" />
                </div>


                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ '/tax/rate'}}">
                        {{ __('Go Back?') }}
                    </a>

                    <x-primary-button class="ml-4">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </x-auth-card>
    </x-guest-layout>
</x-app-layout>
