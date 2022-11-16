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
                    {{ $title }}
                </h2>
            </x-slot>

            <form method="POST" action="{{ $url }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name of product')" />

                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$product->name}}" required autofocus />

                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>


                <!-- Cost of Product -->
                <div class="mt-4">
                    <x-input-label for="cost" :value="__('Cost of product')" />

                    <x-text-input id="cost" class="block mt-1 w-full" type="number" name="cost" value="{{$product->cost}}" required />

                    <x-input-error :messages="$errors->get('cost')" class="mt-2" />
                </div>


                <!-- Tax rate -->
                <div class="mt-4">
                    <x-input-label for="tax_rate" :value="__('Tax Rate Applied')" />

                    <select name="tax_rate" id="tax_rate" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" required>
                        <option  selected hidden value="{{$product->taxes['id']}}" name="tax_rate">{{$product->taxes['name']}}={{ $product->taxes['tax_rate']}}%</option>
                        @foreach($taxes as $tax)
                            <option value="{{ $tax['id'] }}" name="tax_rate">{{$tax['name']}}={{ $tax['tax_rate']}}%</option>
                        @endforeach
                    </select>

                    <x-input-error :messages="$errors->get('tax_rate')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ '/products'}}">
                        {{ __('Go Back?') }}
                    </a>

                    <x-primary-button class="ml-4">
                        {{ __('Update') }}
                    </x-primary-button>
                </div>
            </form>
        </x-auth-card>
    </x-guest-layout>
</x-app-layout>
