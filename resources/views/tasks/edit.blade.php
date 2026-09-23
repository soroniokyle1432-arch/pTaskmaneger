@extends('layouts.app')

@section('content')
<main class="mx-auto max-w-2xl py-12 lg:py-16"><a href="{{ route('tasks.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-moss hover:text-ink">← Back to tasks</a><div class="mt-8 rounded-3xl border border-line bg-white p-6 shadow-soft sm:p-9"><p class="text-xs font-bold uppercase tracking-[.2em] text-moss">Refine your plan</p><h1 class="mt-3 font-display text-4xl font-bold tracking-tight">Edit task</h1><p class="mt-3 text-sm leading-6 text-moss">Keep the details current so your list stays useful.</p><form method="POST" action="{{ route('tasks.update', $task) }}" class="mt-8 space-y-5">@csrf @method('PUT') @include('tasks.partials.form', ['buttonLabel' => 'Save changes'])</form></div></main>
@endsection
