<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-5 py-3 bg-danger hover:bg-danger/95 border border-transparent rounded-[14px] font-semibold text-sm text-white shadow-sm hover:shadow active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-danger focus:ring-offset-2 transition-all duration-150']) }}>
    {{ $slot }}
</button>
