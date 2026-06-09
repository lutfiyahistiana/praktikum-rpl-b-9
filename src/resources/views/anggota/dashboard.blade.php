@extends('anggota.layouts.app')

@section('content')
<main class="flex-1 px-4 sm:px-6 lg:px-8 pb-6 space-y-6">

    {{-- ========== STATISTICS ========== --}}
    <section>
        <div class="bg-white rounded-xl border border-colab-gray p-5 sm:p-6">
            <h1 class="text-lg sm:text-xl font-bold text-gray-900 mb-5">Statistics</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                <div class="rounded-lg border border-colab-gray bg-white p-4 text-center hover:shadow-md transition-shadow duration-200">
                    <p class="text-sm text-gray-400 font-medium mb-2">Total Tugas</p>
                    <p class="text-3xl sm:text-4xl font-extrabold text-gray-900">{{ $totalTugas }}</p>
                </div>
                <div class="rounded-lg border border-colab-gray bg-white p-4 text-center hover:shadow-md transition-shadow duration-200">
                    <p class="text-sm text-gray-400 font-medium mb-2">Total Tugas Selesai</p>
                    <p class="text-3xl sm:text-4xl font-extrabold text-gray-900">{{ $totalSelesai }}</p>
                </div>
                <div class="rounded-lg border border-colab-gray bg-white p-4 text-center hover:shadow-md transition-shadow duration-200">
                    <p class="text-sm text-gray-400 font-medium mb-2">Total Tugas Berjalan</p>
                    <p class="text-3xl sm:text-4xl font-extrabold text-gray-900">{{ $totalBerjalan }}</p>
                </div>
                <div class="rounded-lg border border-colab-gray bg-white p-4 text-center hover:shadow-md transition-shadow duration-200">
                    <p class="text-sm text-gray-400 font-medium mb-2">Total Tugas Terlambat</p>
                    <p class="text-3xl sm:text-4xl font-extrabold text-gray-900">{{ $totalTerlambat }}</p>
                </div>
            </div>
        </div>
    </section>

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
                    @endphp
                    <a href="{{ route('anggota_tim.task.detail', $task->id_task) }}"
                       class="block rounded-lg border border-colab-gray bg-white p-4 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-start justify-between gap-2">
                            <p class="text-sm font-bold text-gray-900">{{ $task->title }}</p>
                            @if ($isLate)
                                <span class="inline-block text-xs font-semibold px-2 py-1 rounded-full bg-red-100 text-red-600 whitespace-nowrap">Terlambat</span>
                            @else
                                <span class="inline-block text-xs font-semibold px-2 py-1 rounded-full bg-yellow-100 text-yellow-700 whitespace-nowrap">Belum Selesai</span>
                            @endif
                        </div>
                        <p class="text-xs text-gray-400 mt-1">
                            Deadline: {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->translatedFormat('d F Y') : '-' }}
                        </p>
                    </a>
                @empty
                    <p class="text-sm text-gray-400">Semua tugas sudah selesai! 🎉</p>
                @endforelse
            </div>
        </div>
    </section>

</main>
@endsection