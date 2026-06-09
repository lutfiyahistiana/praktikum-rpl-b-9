@extends('anggota.layouts.app')

@section('content')
<main class="flex-1 mb-4 sm:mb-6 lg:mb-8 mx-4 sm:mx-6 lg:mx-8 space-y-6">

    {{-- ========== PROGRES TUGAS ========== --}}
    <section>
        <div class="bg-white rounded-xl border border-colab-gray p-5 sm:p-6">
            <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-5">Progres Tugas</h2>
            <div class="flex items-center gap-4">
                <div class="flex-1 h-4 bg-colab-gray rounded-full overflow-hidden">
                    <div class="h-full bg-green-500 rounded-full transition-all duration-500 ease-out"
                         style="width: {{ $avgProgress }}%;"></div>
                </div>
                <span class="text-sm font-semibold text-gray-700 whitespace-nowrap">{{ $avgProgress }}%</span>
            </div>
        </div>
    </section>

    {{-- ========== DAFTAR TUGAS BELUM SELESAI ========== --}}
    <section>
        <div class="bg-white rounded-xl border border-colab-gray p-5 sm:p-6">
            <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-5">Daftar Tugas Belum Selesai</h2>
            <div class="space-y-4">
                @forelse ($tugasBelumSelesai as $task)
                    @php
                        $isLate = $task->deadline && \Carbon\Carbon::parse($task->deadline)->isPast();
                        $badgeClass = $isLate ? 'bg-red-100 text-red-600' : 'bg-yellow-100 text-yellow-700';
                        $badgeText  = $isLate ? 'Terlambat' : 'Belum Selesai';
                    @endphp
                    <a href="{{ route('anggota_tim.task.detail', $task->id_task) }}"
                       class="block bg-white rounded-lg border border-colab-gray p-5 shadow-sm hover:shadow-md transition-shadow duration-200">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 mb-2">
                            <p class="text-base font-bold text-gray-900">{{ $task->title }}</p>
                            <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full {{ $badgeClass }}">
                                {{ $badgeText }}
                            </span>
                        </div>
                        <p class="text-sm text-colab-gray-dark mb-3">{{ $task->description ?? '-' }}</p>
                        <div class="flex items-center gap-1.5 text-xs text-colab-gray-dark">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>Deadline: {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->translatedFormat('d F Y') : '-' }}</span>
                        </div>
                    </a>
                @empty
                    <p class="text-sm text-gray-400">Tidak ada tugas yang belum selesai. 🎉</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ========== DAFTAR TUGAS SELESAI ========== --}}
    <section>
        <div class="bg-white rounded-xl border border-colab-gray p-5 sm:p-6">
            <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-5">Daftar Tugas Selesai</h2>
            <div class="space-y-4">
                @forelse ($tugasSelesai as $task)
                    <a href="{{ route('anggota_tim.task.detail', $task->id_task) }}"
                       class="block bg-white rounded-lg border border-colab-gray p-5 shadow-sm hover:shadow-md transition-shadow duration-200">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 mb-2">
                            <p class="text-base font-bold text-gray-900">{{ $task->title }}</p>
                            <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full bg-green-100 text-green-700">Selesai</span>
                        </div>
                        <p class="text-sm text-colab-gray-dark mb-3">{{ $task->description ?? '-' }}</p>
                        <div class="flex items-center gap-1.5 text-xs text-colab-gray-dark">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>Deadline: {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->translatedFormat('d F Y') : '-' }}</span>
                        </div>
                    </a>
                @empty
                    <p class="text-sm text-gray-400">Belum ada tugas yang selesai.</p>
                @endforelse
            </div>
        </div>
    </section>

</main>
@endsection