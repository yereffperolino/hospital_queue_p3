@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border border-slate-300 focus:border-blue-500 focus:ring-blue-500 focus:ring-offset-0 rounded-xl shadow-sm bg-white']) }}>
