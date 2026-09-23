<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'xans task manager' }} · xans task manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { theme: { extend: { colors: { ink: '#30243d', plum: '#4b3065', violet: '#dfc8ff', lavender: '#eee6f8', muted: '#776685', line: '#e4d9ef', rose: '#d26b91' }, fontFamily: { display: ['Georgia', 'serif'], sans: ['ui-sans-serif', 'system-ui', 'sans-serif'] }, boxShadow: { panel: '0 24px 70px rgba(74, 48, 101, .16)' } } } };</script>
    <style>body { background: #eee6f8; color: #30243d; } .texture { background-image: radial-gradient(rgba(93,65,124,.08) .7px, transparent .7px); background-size: 7px 7px; }</style>
</head>
<body class="texture min-h-screen font-sans antialiased">
    <main class="flex min-h-screen items-center justify-center px-5 py-10 sm:px-8"><div class="grid w-full max-w-5xl overflow-hidden rounded-[2rem] bg-white shadow-panel lg:grid-cols-[.9fr_1.1fr]">
        <section class="relative hidden overflow-hidden bg-plum p-10 text-white lg:flex lg:flex-col lg:justify-between"><div class="absolute -right-20 -top-20 h-64 w-64 rounded-full border-[28px] border-white/10"></div><div class="relative"><a href="{{ route('login') }}" class="flex items-center gap-3"><span class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet text-ink"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5v14"/></svg></span><span class="text-sm font-bold">xans task manager</span></a><p class="mt-24 max-w-xs font-display text-4xl font-bold leading-tight">Make space for what matters.</p><p class="mt-5 max-w-xs text-sm leading-6 text-[#d7c9e1]">A calmer way to plan your day and keep your progress visible.</p></div><p class="relative text-xs text-[#c4b2d2]">Personal workspace · {{ now()->format('Y') }}</p></section>
        <section class="p-7 sm:p-12"><div class="mb-8 flex items-center gap-3 lg:hidden"><span class="flex h-9 w-9 items-center justify-center rounded-xl bg-plum text-violet"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5v14"/></svg></span><span class="text-sm font-bold text-ink">xans task manager</span></div>@if (session('success'))<div class="mb-5 rounded-xl border border-[#dbc8f3] bg-[#f3edff] px-4 py-3 text-sm text-[#654c7d]">{{ session('success') }}</div>@endif @if ($errors->any())<div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">{{ $errors->first() }}</div>@endif @yield('content')</section>
    </div></main>
</body>
</html>
