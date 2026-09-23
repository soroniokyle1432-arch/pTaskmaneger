<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'xans task manager' }} · xans task manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { ink: '#30243d', plum: '#4b3065', lavender: '#eee6f8', violet: '#dfc8ff', muted: '#776685', line: '#e4d9ef', rose: '#d26b91' },
                    fontFamily: { display: ['Georgia', 'serif'], sans: ['ui-sans-serif', 'system-ui', 'sans-serif'] },
                    boxShadow: { panel: '0 20px 55px rgba(74, 48, 101, .12)' }
                }
            }
        }
    </script>
    <style>
        body { background: #eee6f8; color: #30243d; }
        .page-texture { background-image: linear-gradient(135deg, rgba(255,255,255,.28), transparent 45%), radial-gradient(rgba(93,65,124,.08) .7px, transparent .7px); background-size: auto, 7px 7px; }
        .task-row { transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease; }
        .task-row:hover { transform: translateY(-2px); box-shadow: 0 14px 30px rgba(74, 48, 101, .10); border-color: #cdb5e1; }
        .fade-up { animation: fadeUp .45s ease both; }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="min-h-screen font-sans antialiased">
    <div class="page-texture pointer-events-none fixed inset-0 opacity-60"></div>
    <div class="relative flex min-h-screen">
        <aside class="hidden w-64 shrink-0 flex-col bg-plum px-5 py-6 text-white lg:flex">
            <a href="{{ route('tasks.index') }}" class="flex items-center gap-3" aria-label="xans task manager home"><span class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet text-ink"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5v14"/></svg></span><span><span class="block text-sm font-bold tracking-tight">xans task manager</span><span class="mt-0.5 block text-[9px] uppercase tracking-[.2em] text-[#cdbfe0]">Personal workspace</span></span></a>
            <div class="mt-14"><p class="px-3 text-[10px] font-bold uppercase tracking-[.2em] text-[#bca8cf]">Workspace</p><nav class="mt-3 space-y-1"><a href="{{ route('tasks.index') }}" class="flex items-center gap-3 rounded-xl bg-white/10 px-3 py-3 text-sm font-semibold text-white"><svg class="h-4 w-4 text-violet" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 5h16M4 12h16M4 19h10"/></svg>All tasks</a><span class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm text-[#bca8cf]"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="m12 7 3 5-3 2-3-2 3-5Z"/></svg>Focus space</span></nav></div>
            <div class="mt-auto rounded-2xl border border-white/10 bg-white/5 p-4"><p class="text-xs font-semibold text-violet">{{ session('user_name', 'Your workspace') }}</p><p class="mt-2 text-xs leading-5 text-[#cdbfe0]">The clearest next step is usually the best one.</p><form method="POST" action="{{ route('logout') }}" class="mt-4">@csrf<button type="submit" class="text-xs font-semibold text-[#e8dff0] hover:text-white">Sign out →</button></form></div>
        </aside>
        <div class="relative min-w-0 flex-1">
            <div class="mx-auto max-w-[1440px] px-4 py-4 sm:px-8 lg:px-12 lg:py-6">
                <header class="flex items-center justify-between rounded-2xl border border-white/70 bg-white/70 px-4 py-3 shadow-sm backdrop-blur sm:px-5 lg:hidden"><a href="{{ route('tasks.index') }}" class="flex items-center gap-3" aria-label="xans task manager home"><span class="flex h-9 w-9 items-center justify-center rounded-xl bg-plum text-violet"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5v14"/></svg></span><span><span class="block text-sm font-bold tracking-tight text-ink">xans task manager</span><span class="block text-[9px] font-semibold uppercase tracking-[.2em] text-muted">Personal workspace</span></span></a><form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="text-xs font-bold text-muted hover:text-ink">Sign out</button></form></header>
                <div class="hidden items-center justify-between border-b border-[#d8c9e5] pb-5 lg:flex"><div><p class="text-xs font-semibold text-muted">Workspace / All tasks</p><p class="mt-1 text-sm font-bold text-ink">{{ now()->format('l, F j, Y') }}</p></div><div class="flex items-center gap-2 rounded-full bg-white/70 px-3 py-2 text-xs font-semibold text-muted"><span class="h-2 w-2 rounded-full bg-[#a779c7]"></span>Personal mode</div></div>
                @if (session('success'))
                    <div class="mt-5 flex items-center gap-3 rounded-xl border border-[#dbc8f3] bg-[#f3edff] px-4 py-3 text-sm font-medium text-[#654c7d]" role="status"><span class="flex h-6 w-6 items-center justify-center rounded-full bg-violet">✓</span>{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="mt-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700" role="alert">Please check the highlighted fields and try again.</div>
                @endif
                @yield('content')
                <footer class="mt-16 border-t border-[#d8c9e5] py-6 text-center text-xs text-muted">Plan clearly. Move deliberately.</footer>
            </div>
        </div>
    </div>
</body>
</html>
