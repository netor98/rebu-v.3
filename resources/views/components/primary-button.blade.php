<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-sky-600 hover:bg-sky-800 transition-colors cursor-pointer uppercase w-full p-2 rounded-lg text-white font-bold']) }}>
    {{ $slot }}
</button>
