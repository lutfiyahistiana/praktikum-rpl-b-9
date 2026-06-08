@extends('anggota.layouts.app')

@section('content')
<main class="flex-1 mb-4 sm:mb-6 lg:mb-8 mx-4 sm:mx-6 lg:mx-8 space-y-6">
    {{-- ========== PROGRES TUGAS ========== --}}
    <section>
        <div class="bg-white rounded-xl border border-colab-gray p-5 sm:p-6">
            <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-5">Progres Tugas</h2>
            <div class="flex items-center gap-4">
                <div class="flex-1 h-4 bg-colab-gray rounded-full overflow-hidden">
                    <div class="h-full bg-green-500 rounded-full transition-all duration-500 ease-out" style="width: 50%;"></div>
                </div>
                <span class="text-sm font-semibold text-gray-700 whitespace-nowrap">50%</span>
            </div>
        </div>
    </section>

    {{-- ========== DAFTAR TUGAS BELUM SELESAI ========== --}}
    <section>
        <div class="bg-white rounded-xl border border-colab-gray p-5 sm:p-6">
            <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-5">Daftar Tugas Belum Selesai</h2>
            <div class="space-y-4">

                {{-- Sedang Dikerjakan --}}
                <div class="bg-white rounded-lg border border-colab-gray p-5 shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 mb-2">
                        <p class="text-base font-bold text-gray-900">Slicing UI Dashboard</p>
                        <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full bg-blue-100 text-colab-blue">Sedang Dikerjakan</span>
                    </div>
                    <p class="text-sm text-colab-gray-dark mb-3">Melakukan slicing UI halaman dashboard berdasarkan mockup.</p>
                    <div class="flex items-center gap-1.5 text-xs text-colab-gray-dark">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Deadline: 1 Mei 2026</span>
                    </div>
                </div>

                {{-- Belum Selesai --}}
                <div class="bg-white rounded-lg border border-colab-gray p-5 shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 mb-2">
                        <p class="text-base font-bold text-gray-900">Integrasi API Login</p>
                        <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">Belum Selesai</span>
                    </div>
                    <p class="text-sm text-colab-gray-dark mb-3">Menghubungkan form login dengan endpoint autentikasi backend.</p>
                    <div class="flex items-center gap-1.5 text-xs text-colab-gray-dark">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Deadline: 15 Mei 2026</span>
                    </div>
                </div>

                {{-- Terlambat --}}
                <div class="bg-white rounded-lg border border-colab-gray p-5 shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 mb-2">
                        <p class="text-base font-bold text-gray-900">Desain Database Schema</p>
                        <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full bg-red-100 text-red-600">Terlambat</span>
                    </div>
                    <p class="text-sm text-colab-gray-dark mb-3">Merancang struktur tabel database untuk modul manajemen tugas.</p>
                    <div class="flex items-center gap-1.5 text-xs text-colab-gray-dark">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Deadline: 20 April 2026</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ========== DAFTAR TUGAS SELESAI ========== --}}
    <section>
        <div class="bg-white rounded-xl border border-colab-gray p-5 sm:p-6">
            <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-5">Daftar Tugas Selesai</h2>
            <div class="space-y-4">

                {{-- Selesai 1 --}}
                <div class="bg-white rounded-lg border border-colab-gray p-5 shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 mb-2">
                        <p class="text-base font-bold text-gray-900">Setup Environment Laravel</p>
                        <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full bg-green-100 text-green-700">Selesai</span>
                    </div>
                    <p class="text-sm text-colab-gray-dark mb-3">Instalasi dan konfigurasi awal proyek Laravel 12 beserta Tailwind CSS.</p>
                    <div class="flex items-center gap-1.5 text-xs text-colab-gray-dark">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Deadline: 1 Mei 2026</span>
                    </div>
                </div>

                {{-- Selesai 2 --}}
                <div class="bg-white rounded-lg border border-colab-gray p-5 shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 mb-2">
                        <p class="text-base font-bold text-gray-900">Wireframe Halaman Login</p>
                        <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full bg-green-100 text-green-700">Selesai</span>
                    </div>
                    <p class="text-sm text-colab-gray-dark mb-3">Membuat wireframe untuk halaman login dan register aplikasi.</p>
                    <div class="flex items-center gap-1.5 text-xs text-colab-gray-dark">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Deadline: 1 Mei 2026</span>
                    </div>
                </div>

                {{-- Selesai 3 --}}
                <div class="bg-white rounded-lg border border-colab-gray p-5 shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 mb-2">
                        <p class="text-base font-bold text-gray-900">Dokumentasi API Endpoint</p>
                        <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full bg-green-100 text-green-700">Selesai</span>
                    </div>
                    <p class="text-sm text-colab-gray-dark mb-3">Menyusun dokumentasi lengkap untuk semua endpoint REST API.</p>
                    <div class="flex items-center gap-1.5 text-xs text-colab-gray-dark">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Deadline: 1 Mei 2026</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>
@endsection