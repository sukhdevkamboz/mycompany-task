<x-app-layout>
    <h2 style="margin:50px">Add company</h2> 
    <form style="margin:50px" method="POST" action="{{ route('companies.store') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

         <div>
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus autocomplete="address" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

         <div>
            <x-input-label for="industry" :value="__('Industry')" />
            <x-text-input id="industry" class="block mt-1 w-full" type="text" name="industry" :value="old('industry')" required autofocus autocomplete="industry" />
            <x-input-error :messages="$errors->get('industry')" class="mt-2" />
        </div>


       

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Submit') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
