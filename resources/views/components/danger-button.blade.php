<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-2.5 bg-rose-500 hover:bg-rose-600 border border-transparent rounded-[12px] font-semibold text-sm text-white shadow-sm hover:shadow active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 dark:focus:ring-offset-slate-900 transition-all duration-150']) }}>
    {{ $slot }}
</button>
