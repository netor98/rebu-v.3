@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-md  uppercase dark:text-gray-300']) }}>
    {{ $value ?? $slot }}
</label>
