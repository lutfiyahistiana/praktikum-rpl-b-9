@extends('ketuaTim.layouts.app')

@section('content')
        {{-- ========================== MAIN CONTENT ========================== --}}
        <main class="flex-1 px-4 sm:px-6 lg:px-8 pb-6 space-y-6">

            {{-- ========== TAMBAH TUGAS BUTTON ========== --}}
            <a href="{{ route('ketua_tim.task.tambah') }}" class="group bg-white rounded-xl border p-5 sm:p-6 flex items-center justify-between cursor-pointer hover:shadow-md transition-shadow duration-200  border-[#E6E6E6]" id="btn-tambah-tugas">
                <span class="text-lg sm:text-xl font-bold text-gray-900">Tambah Tugas</span>
                <span class="w-8 h-8 flex items-center justify-center rounded-full border flex-shrink-0 border-[var(--color-border)] text-[var(--color-secondary)] group-hover:text-[var(--color-primary)] group-hover:border-[var(--color-primary)]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="9"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v8m-4-4h8"/>
                    </svg>
                </span>
            </a>

            {{-- ========== DAFTAR TUGAS BELUM SELESAI ========== --}}
            <section id="task-pending-section">
                <div class="bg-white rounded-xl border p-5 sm:p-6 border-[#E6E6E6]">
                    <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-5">Daftar Tugas Belum Selesai</h2>

                    <div class="space-y-4">
                        @forelse ($unfinishedTasks as $task)
                        <div class="rounded-lg border bg-white p-4 hover:shadow-md transition-shadow duration-200 border-[#E6E6E6]">
                            <p class="text-sm font-bold text-gray-900 mb-1">{{ $task['title'] }}</p>
                            <p class="text-xs text-[var(--color-secondary)]">{{ $task['receiver'] }} | {{ $task['status'] }} | Deadline: {{ $task['deadline'] }}</p>
                        </div>
                        @empty
                        <p class="text-sm text-gray-500">Tidak ada tugas yang belum selesai.</p>
                        @endforelse
                    </div>
                </div>
            </section>

            {{-- ========== DAFTAR TUGAS SELESAI ========== --}}
            <section id="task-done-section">
                <div class="bg-white rounded-xl border p-5 sm:p-6 border-[#E6E6E6]">
                    <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-5">Daftar Tugas Selesai</h2>

                    <div class="space-y-4">
                        @forelse ($finishedTasks as $task)
                        <div class="rounded-lg border bg-white p-4 hover:shadow-md transition-shadow duration-200 border-[#E6E6E6]">
                            <p class="text-sm font-bold text-gray-900 mb-1">{{ $task['title'] }}</p>
                            <p class="text-xs text-[var(--color-secondary)]">{{ $task['receiver'] }} | {{ $task['status'] }} | Deadline: {{ $task['deadline'] }}</p>
                        </div>
                        @empty
                        <p class="text-sm text-gray-500">Tidak ada tugas yang selesai.</p>
                        @endforelse
                    </div>
                </div>
            </section>

        </main>
    </div>
@endsection