@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-600">
            {{ __('Whoops! Something went wrong.') }}
        </div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session()->has('failed'))
    <div {{ $attributes }}>
        <div class="font-medium text-red-600">
            {{session()->get('failed')}}
        </div>
    </div>
@endif

@if (session()->has('success'))
    <div {{ $attributes }}>
        <div class="font-medium text-green-600">
            {{session()->get('success')}}
        </div>
    </div>
@endif

