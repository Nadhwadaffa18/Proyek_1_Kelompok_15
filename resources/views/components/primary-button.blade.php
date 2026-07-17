<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-5 py-3 bg-gradient-to-r from-primary to-secondary text-white font-semibold text-sm rounded-[14px] shadow-md shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-all duration-200']) }}>
    {{ $slot }}
</button>
