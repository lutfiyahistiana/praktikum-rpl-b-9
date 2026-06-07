@extends('anggota.layouts.app')

@section('content')
    {{-- ========================== MAIN CONTENT ========================== --}}
    <main class="flex-1 px-4 sm:px-6 lg:px-8 pb-6 space-y-6">

        {{-- ========== STATISTICS SECTION ========== --}}
        <section id="statistics-section">
            <div class="bg-white rounded-xl border border-colab-gray p-5 sm:p-6">
                <h1 class="text-lg sm:text-xl font-bold text-gray-900 mb-5">Statistics</h1>

                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                    {{-- Card: Total Tugas --}}
                    <div class="rounded-lg border border-colab-gray bg-white p-4 text-center hover:shadow-md transition-shadow duration-200">
                        <p class="text-sm text-gray-400 font-medium mb-2">Total Tugas</p>
                        <p class="text-3xl sm:text-4xl font-extrabold text-gray-900">11</p>
                    </div>

                    {{-- Card: Total Tugas Selesai --}}
                    <div class="rounded-lg border border-colab-gray bg-white p-4 text-center hover:shadow-md transition-shadow duration-200">
                        <p class="text-sm text-gray-400 font-medium mb-2">Total Tugas Selesai</p>
                        <p class="text-3xl sm:text-4xl font-extrabold text-gray-900">11</p>
                    </div>

                    {{-- Card: Total Tugas Berjalan --}}
                    <div class="rounded-lg border border-colab-gray bg-white p-4 text-center hover:shadow-md transition-shadow duration-200">
                        <p class="text-sm text-gray-400 font-medium mb-2">Total Tugas Berjalan</p>
                        <p class="text-3xl sm:text-4xl font-extrabold text-gray-900">11</p>
                    </div>

                    {{-- Card: Total Tugas Terlambat --}}
                    <div class="rounded-lg border border-colab-gray bg-white p-4 text-center hover:shadow-md transition-shadow duration-200">
                        <p class="text-sm text-gray-400 font-medium mb-2">Total Tugas Terlambat</p>
                        <p class="text-3xl sm:text-4xl font-extrabold text-gray-900">11</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ========== PROGRES TUGAS SECTION ========== --}}
        <section id="progress-section">
            <div class="bg-white rounded-xl border border-colab-gray p-5 sm:p-6">
                <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-5">Progres Tugas</h2>

                <div class="flex items-center gap-4">
                    {{-- Progress Bar --}}
                    <div class="flex-1 h-4 bg-colab-gray rounded-full overflow-hidden">
                        <div class="h-full bg-green-500 rounded-full transition-all duration-500 ease-out" style="width: 50%;"></div>
                    </div>
                    {{-- Percentage --}}
                    <span class="text-sm font-semibold text-gray-700 whitespace-nowrap">50%</span>
                </div>
            </div>
        </section>

        {{-- ========== DAFTAR TUGAS BELUM SELESAI SECTION ========== --}}
        <section id="task-list-section">
            <div class="bg-white rounded-xl border border-colab-gray p-5 sm:p-6">
                <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-5">Daftar Tugas Belum Selesai</h2>

                <div class="space-y-4">
                    {{-- Task Item 1 --}}
                    <div class="rounded-lg border border-colab-gray bg-white p-4 hover:shadow-md transition-shadow duration-200">
                        <p class="text-sm font-bold text-gray-900 mb-1">Nama Tugas</p>
                        <p class="text-xs text-gray-400">Deadline: 1 Mei 2026</p>
                        {{-- Form Input Progres di sini --}}
                    </div>

                    {{-- Task Item 2 --}}
                    <div class="rounded-lg border border-colab-gray bg-white p-4 hover:shadow-md transition-shadow duration-200">
                        <p class="text-sm font-bold text-gray-900 mb-1">Nama Tugas</p>
                        <p class="text-xs text-gray-400">Deadline: 1 Mei 2026</p>
                        {{-- Form Input Progres di sini --}}
                    </div>

                    {{-- Task Item 3 --}}
                    <div class="rounded-lg border border-colab-gray bg-white p-4 hover:shadow-md transition-shadow duration-200">
                        <p class="text-sm font-bold text-gray-900 mb-1">Nama Tugas</p>
                        <p class="text-xs text-gray-400">Deadline: 1 Mei 2026</p>
                        {{-- Form Input Progres di sini --}}
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection