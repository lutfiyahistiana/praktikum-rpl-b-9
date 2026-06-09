@extends('ketuaTim.layouts.app')

@section('content')
        {{-- ========================== MAIN CONTENT ========================== --}}
     <main class="flex-1 px-4 sm:px-6 lg:px-8 pb-6 space-y-6">

            {{-- ========== STATISTICS SECTION ========== --}}
            <section id="statistics-section">
                <div class="bg-white rounded-xl border p-5 sm:p-6 border-[#E6E6E6]">
                    <h1 class="text-lg sm:text-xl font-bold text-gray-900 mb-5">Statistics</h1>

                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                        {{-- Card: Total Tugas --}}
                        <div class="rounded-lg border bg-white p-4 text-center hover:shadow-md transition-shadow duration-200 border-[#E6E6E6]">
                            <p class="text-sm font-medium mb-2 text-[#969696]">Total Tugas</p>
                            <p class="text-3xl sm:text-4xl font-extrabold text-gray-900">11</p>
                        </div>

                        {{-- Card: Total Tugas Selesai --}}
                        <div class="rounded-lg border bg-white p-4 text-center hover:shadow-md transition-shadow duration-200 border-[#E6E6E6]">
                            <p class="text-sm font-medium mb-2 text-[#969696]">Total Tugas Selesai</p>
                            <p class="text-3xl sm:text-4xl font-extrabold text-gray-900">11</p>
                        </div>

                        {{-- Card: Total Tugas Berjalan --}}
                        <div class="rounded-lg border bg-white p-4 text-center hover:shadow-md transition-shadow duration-200 border-[#E6E6E6]">
                            <p class="text-sm font-medium mb-2 text-[#969696]">Total Tugas Berjalan</p>
                            <p class="text-3xl sm:text-4xl font-extrabold text-gray-900">11</p>
                        </div>

                        {{-- Card: Total Tugas Terlambat --}}
                        <div class="rounded-lg border bg-white p-4 text-center hover:shadow-md transition-shadow duration-200 border-[#E6E6E6]">
                            <p class="text-sm font-medium mb-2 text-[#969696]">Total Tugas Terlambat</p>
                            <p class="text-3xl sm:text-4xl font-extrabold text-gray-900">11</p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- ========== PROGRES TUGAS SECTION (per anggota) ========== --}}
            <section id="progress-section">
                <div class="bg-white rounded-xl border p-5 sm:p-6 border-[#E6E6E6]">
                    <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-5">Progres Tugas</h2>

                    <div class="space-y-4">
                        {{-- Member Progress 1 --}}
                        <div class="flex items-center gap-4">
                            <span class="text-sm font-medium text-gray-800 whitespace-nowrap min-w-[180px]">Nama Lengkap Penerima</span>
                            <div class="flex-1 h-4 rounded-full overflow-hidden bg-[#E6E6E6]">
                                <div class="h-full bg-green-500 rounded-full transition-all duration-500 ease-out" style="width: 50%;"></div>
                            </div>
                            <span class="text-sm font-semibold text-gray-700 whitespace-nowrap">50%</span>
                        </div>

                        {{-- Member Progress 2 --}}
                        <div class="flex items-center gap-4">
                            <span class="text-sm font-medium text-gray-800 whitespace-nowrap min-w-[180px]">Nama Lengkap Penerima</span>
                            <div class="flex-1 h-4 rounded-full overflow-hidden bg-[#E6E6E6]">
                                <div class="h-full bg-green-500 rounded-full transition-all duration-500 ease-out" style="width: 50%;"></div>
                            </div>
                            <span class="text-sm font-semibold text-gray-700 whitespace-nowrap">50%</span>
                        </div>

                        {{-- Member Progress 3 --}}
                        <div class="flex items-center gap-4">
                            <span class="text-sm font-medium text-gray-800 whitespace-nowrap min-w-[180px]">Nama Lengkap Penerima</span>
                            <div class="flex-1 h-4 rounded-full overflow-hidden bg-[#E6E6E6]">
                                <div class="h-full bg-green-500 rounded-full transition-all duration-500 ease-out" style="width: 50%;"></div>
                            </div>
                            <span class="text-sm font-semibold text-gray-700 whitespace-nowrap">50%</span>
                        </div>

                        {{-- Member Progress 4 --}}
                        <div class="flex items-center gap-4">
                            <span class="text-sm font-medium text-gray-800 whitespace-nowrap min-w-[180px]">Nama Lengkap Penerima</span>
                            <div class="flex-1 h-4 rounded-full overflow-hidden bg-[#E6E6E6]">
                                <div class="h-full bg-green-500 rounded-full transition-all duration-500 ease-out" style="width: 50%;"></div>
                            </div>
                            <span class="text-sm font-semibold text-gray-700 whitespace-nowrap">50%</span>
                        </div>

                        {{-- Member Progress 5 --}}
                        <div class="flex items-center gap-4">
                            <span class="text-sm font-medium text-gray-800 whitespace-nowrap min-w-[180px]">Nama Lengkap Penerima</span>
                            <div class="flex-1 h-4 rounded-full overflow-hidden bg-[#E6E6E6]">
                                <div class="h-full bg-green-500 rounded-full transition-all duration-500 ease-out" style="width: 50%;"></div>
                            </div>
                            <span class="text-sm font-semibold text-gray-700 whitespace-nowrap">50%</span>
                        </div>

                        {{-- Member Progress 6 --}}
                        <div class="flex items-center gap-4">
                            <span class="text-sm font-medium text-gray-800 whitespace-nowrap min-w-[180px]">Nama Lengkap Penerima</span>
                            <div class="flex-1 h-4 rounded-full overflow-hidden bg-[#E6E6E6]">
                                <div class="h-full bg-green-500 rounded-full transition-all duration-500 ease-out" style="width: 50%;"></div>
                            </div>
                            <span class="text-sm font-semibold text-gray-700 whitespace-nowrap">50%</span>
                        </div>
                    </div>
                </div>
            </section>

            {{-- ========== DAFTAR TUGAS BELUM SELESAI SECTION ========== --}}
            <section id="task-list-section">
                <div class="bg-white rounded-xl border p-5 sm:p-6 border-[#E6E6E6]">
                    <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-5">Daftar Tugas Belum Selesai</h2>

                    <div class="space-y-4">
                        {{-- Task Item 1 --}}
                        <div class="rounded-lg border bg-white p-4 hover:shadow-md transition-shadow duration-200 border-[#E6E6E6]">
                            <p class="text-sm font-bold text-gray-900 mb-1">Nama Tugas</p>
                            <p class="text-xs text-[var(--color-secondary)]">Nama Lengkap Penerima | Berjalan | Deadline: 1 Mei 2026</p>
                        </div>

                        {{-- Task Item 2 --}}
                        <div class="rounded-lg border bg-white p-4 hover:shadow-md transition-shadow duration-200 border-[#E6E6E6]">
                            <p class="text-sm font-bold text-gray-900 mb-1">Nama Tugas</p>
                            <p class="text-xs text-[var(--color-secondary)]">Nama Lengkap Penerima | Berjalan | Deadline: 1 Mei 2026</p>
                        </div>

                        {{-- Task Item 3 --}}
                        <div class="rounded-lg border bg-white p-4 hover:shadow-md transition-shadow duration-200 border-[#E6E6E6]">
                            <p class="text-sm font-bold text-gray-900 mb-1">Nama Tugas</p>
                            <p class="text-xs text-[var(--color-secondary)]">Nama Lengkap Penerima | Terlambat | Deadline: 1 Mei 2026</p>
                        </div>
                    </div>
                </div>
            </section>

        </main>
    </div>
@endsection