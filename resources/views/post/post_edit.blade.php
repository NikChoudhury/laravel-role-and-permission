<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              
                <div class="p-6 bg-white border-b border-gray-200">
   
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('admin.post.index') }}">
                      {{ __('Post') }}
                    </a>

                    <div class="form__div" style="margin-top: 1rem">
                      <form method="POST" action="{{ route('admin.post.update',$post['id']) }}">
                        @csrf
                        @method("PUT")
                        <div>
                          <x-label for="name" :value="__('Name')" />
          
                          <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{isset($post) ? old('name',$post['name']):''}}" required />
                        </div>

                        <div class="mt-4">
                          <x-label for="content" :value="__('Content')" />
          
                          <x-textarea id="content" class="block mt-1 w-full" type="text" name="content" required >
                            {{isset($post) ? old('content',$post['content']):''}}
                          </x-textarea>
                        </div>
                        <input type="hidden" name="created_by" @if(Auth::guard('admin')->check()) value="{{ Auth::guard('admin')->user()->name }}"@endif>
                        <x-button class="mt-4">
                          {{ __('Update') }}
                        </x-button>
                      </form>
                    </div>
                   
                    
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
