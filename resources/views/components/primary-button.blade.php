<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-orange-500 opacity-85 border border-transparent rounded-md font-semibold text-xs text-white uppercase text-center tracking-widest hover:bg-white hover:text-black focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
