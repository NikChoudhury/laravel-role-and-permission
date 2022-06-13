<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Role Create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             <!-- Validation Errors -->
             <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
   
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('admin.roles.index') }}">
                      {{ __('Roles') }}
                    </a>

                    <div class="form__div" style="margin-top: 1rem">
                      <form method="POST" action="{{ route('admin.roles.store') }}">
                        @csrf
                        <div>
                          <x-label for="name" :value="__('Name')" />
          
                          <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        </div>

                        <x-button class="mt-4">
                          {{ __('Save') }}
                        </x-button>
                      </form>
                    </div>
                   
                    
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
