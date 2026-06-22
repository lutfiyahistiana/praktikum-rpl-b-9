@extends('superadmin.layouts.app')

@section('content')
    {{-- ========================== MAIN CONTENT ========================== --}}
    <main class="flex-1 px-4 sm:px-6 lg:px-8 pb-6 space-y-6">

        {{-- Back button --}}
        <a href="{{ route('superadmin.task') }}" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Daftar Tugas
        </a>

        <div class="flex flex-col md:flex-row gap-6">

            {{-- ===== KOLOM KIRI: Detail Tugas ===== --}}
            <div class="w-full md:w-3/5">
                <div class="bg-white rounded-xl border border-[#E6E6E6] p-5 sm:p-6 h-full">

                    {{-- Header --}}
                    <div class="flex items-start justify-between gap-2 mb-1">
                        <h1 class="text-xl sm:text-2xl font-bold text-gray-800">{{ $task->title }}</h1>
                        @if ($task->status === 'done')
                            <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full bg-green-100 text-green-700 whitespace-nowrap">Selesai</span>
                        @elseif ($status === 'Terlambat')
                            <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full bg-red-100 text-red-600 whitespace-nowrap">Terlambat</span>
                        @else
                            <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 whitespace-nowrap">Berjalan</span>
                        @endif
                    </div>

                    <p class="text-sm text-[#969696] mb-4">
                        Ditugaskan kepada: {{ $task->assignedTo ? $task->assignedTo->name : '-' }}
                    </p>

                    <hr class="border-t border-[#E6E6E6] my-4">

                    {{-- Deskripsi --}}
                    <div>
                        <label class="text-sm text-[#969696] mb-2 block">Deskripsi tugas</label>
                        <div class="w-full min-h-[120px] px-4 py-3 text-sm text-gray-800 border border-[#E6E6E6] rounded-lg bg-gray-50">
                            {{ $task->description ?? 'Tidak ada deskripsi.' }}
                        </div>
                    </div>

                    <p class="text-sm text-[#969696] mt-4">
                        Deadline: {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('d F Y') : '-' }}
                    </p>

                    {{-- Riwayat pengerjaan --}}
                    @if ($task->progresses && $task->progresses->count() > 0)
                        <div class="mt-5">
                            <h2 class="text-sm font-bold text-gray-700 mb-2">Riwayat Pengerjaan</h2>
                            <div class="space-y-2">
                                @foreach ($task->progresses as $progress)
                                    <div class="border border-[#E6E6E6] rounded-lg px-4 py-3 text-sm">
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="font-semibold text-green-600">✓ Diselesaikan</span>
                                            <span class="text-xs text-gray-400">
                                                {{ \Carbon\Carbon::parse($progress->created_at)->format('d F Y, H:i') }}
                                            </span>
                                        </div>
                                        @if ($progress->notes)
                                            <p class="text-gray-600 mb-1">{{ $progress->notes }}</p>
                                        @endif
                                        @if ($progress->link_url)
                                            <a href="{{ $progress->link_url }}" target="_blank"
                                               class="text-xs text-[#2563EB] underline">🔗 {{ $progress->link_url }}</a>
                                        @endif
                                        @if ($progress->file_path)
                                            <a href="{{ \Illuminate\Support\Facades\Storage::disk('oss')->url($progress->file_path) }}" target="_blank"
                                               class="block text-xs text-[#2563EB] underline mt-1">📎 Lihat File</a>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
            </div>

            {{-- ===== KOLOM KANAN: Info Tambahan ===== --}}
            <div class="w-full md:w-2/5">
                <div class="bg-white rounded-xl border border-[#E6E6E6] p-5 sm:p-6 h-full space-y-4">
                    <h2 class="text-sm font-bold text-gray-700">Informasi Tugas</h2>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-[#969696]">Status</span>
                            <span class="font-medium text-gray-800">{{ $status }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-[#969696]">Dibuat oleh</span>
                            <span class="font-medium text-gray-800">{{ $task->assignedBy ? $task->assignedBy->name : '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-[#969696]">Dibuat pada</span>
                            <span class="font-medium text-gray-800">{{ $task->created_at ? \Carbon\Carbon::parse($task->created_at)->format('d F Y') : '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>
@endsection
