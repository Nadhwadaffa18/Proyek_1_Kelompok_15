@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-white text-[#0F172A] border border-slate-200 focus:border-primary focus:ring-1 focus:ring-primary rounded-[12px] shadow-sm py-3 px-4 transition-all text-sm']) }}>
