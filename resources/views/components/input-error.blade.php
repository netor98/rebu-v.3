@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'mt-3 list-none text-sm space-y-2']) }}>
        @foreach ((array) $messages as $message)
            <li class="bg-red-600 border-l-4 border-white text-white p-3 font-bold">{{ $message }}</li>
        @endforeach
    </ul>
@endif
