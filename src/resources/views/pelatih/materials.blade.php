@extends('ketuaTim.layouts.app')

@section('content')
    {{-- ========================== MAIN CONTENT ========================== --}}
        <main class="flex-1 px-4 sm:px-6 lg:px-8 py-6 space-y-6">

            {{-- Page Header: Title + Tambah Materi Button --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-2">
                <h1 class="text-xl font-bold text-gray-900">Daftar Materi</h1>
                <a href="/pelatih/add-material" id="btn-tambah-materi" class="inline-flex items-center gap-2 bg-[#008CFF] hover:bg-[#006FCC] text-white font-medium text-sm px-5 py-2.5 rounded-lg transition-colors shadow-sm">
                    {{-- Plus icon --}}
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    <span>Tambah Materi</span>
                </a>
            </div>

            {{-- ========== ACCORDION LIST ========== --}}
            <div class="space-y-4">

                {{-- ===== BAB I ===== --}}
                <div class="bg-white border border-[#E6E6E6] rounded-lg overflow-hidden" id="accordion-1">
                    <button type="button" class="w-full flex items-center justify-between px-5 py-4 text-left hover:bg-[#F5F7FA] transition-colors" onclick="toggleAccordion(1)" aria-expanded="false">
                        <span class="text-sm font-bold text-gray-900">BAB I Judul Materi</span>
                        <span class="w-5 h-5 text-[#969696] transition-transform duration-200" id="chevron-1">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </span>
                    </button>

                    {{-- Isi Accordion --}}
                    <div class="hidden px-5 pb-5" id="content-1">
                        <p class="text-sm text-[#969696] mt-3 mb-4">Lampiran materi untuk BAB I. Klik untuk mengunduh.</p>

                        <div class="space-y-2">
                            {{-- File PDF --}}
                            <a href="#" class="flex items-center gap-3 p-3 rounded-lg border border-[#E6E6E6] hover:shadow-sm transition-shadow">
                                <div class="w-8 h-8 flex items-center justify-center rounded-lg flex-shrink-0 bg-red-100">
                                    <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zM6 20V4h7v5h5v11H6z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-800">Dokumen_Robotika.pdf</p>
                                    <p class="text-xs text-[#969696]">2.4 MB</p>
                                </div>
                                <svg class="w-4 h-4 text-[#969696]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                            </a>

                            {{-- File Video --}}
                            <a href="#" class="flex items-center gap-3 p-3 rounded-lg border border-[#E6E6E6] hover:shadow-sm transition-shadow">
                                <div class="w-8 h-8 flex items-center justify-center rounded-lg flex-shrink-0 bg-blue-100">
                                    <svg class="w-4 h-4 text-[#008CFF]" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-800">Video_Pengenalan_Robotika.mp4</p>
                                    <p class="text-xs text-[#969696]">45.8 MB</p>
                                </div>
                                <svg class="w-4 h-4 text-[#969696]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                            </a>

                            {{-- File Presentasi --}}
                            <a href="#" class="flex items-center gap-3 p-3 rounded-lg border border-[#E6E6E6] hover:shadow-sm transition-shadow">
                                <div class="w-8 h-8 flex items-center justify-center rounded-lg flex-shrink-0 bg-orange-100">
                                    <svg class="w-4 h-4 text-orange-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zM6 20V4h7v5h5v11H6z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-800">Presentasi_BAB_I.pptx</p>
                                    <p class="text-xs text-[#969696]">8.1 MB</p>
                                </div>
                                <svg class="w-4 h-4 text-[#969696]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                            </a>
                        </div>

                        {{-- Action Buttons (Pelatih: Edit & Hapus) --}}
                        <div class="flex items-center gap-3 mt-4 pt-4 border-t border-[#E6E6E6]">
                            <button type="button" class="text-[#008CFF] border border-[#008CFF] rounded-lg px-4 py-1.5 text-sm hover:bg-[#EBF5FF] transition-colors">Edit</button>
                            <button type="button" class="text-red-500 border border-red-500 rounded-lg px-4 py-1.5 text-sm hover:bg-red-50 transition-colors">Hapus</button>
                        </div>
                    </div>
                </div>

                {{-- ===== BAB II ===== --}}
                <div class="bg-white border border-[#E6E6E6] rounded-lg overflow-hidden" id="accordion-2">
                    <button type="button" class="w-full flex items-center justify-between px-5 py-4 text-left hover:bg-[#F5F7FA] transition-colors" onclick="toggleAccordion(2)" aria-expanded="false">
                        <span class="text-sm font-bold text-gray-900">BAB II Judul Materi</span>
                        <span class="w-5 h-5 text-[#969696] transition-transform duration-200" id="chevron-2">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </span>
                    </button>

                    <div class="hidden px-5 pb-5" id="content-2">
                        <p class="text-sm text-[#969696] mt-3 mb-4">Lampiran materi untuk BAB II. Klik untuk mengunduh.</p>
                        <div class="space-y-2">
                            <a href="#" class="flex items-center gap-3 p-3 rounded-lg border border-[#E6E6E6] hover:shadow-sm transition-shadow">
                                <div class="w-8 h-8 flex items-center justify-center rounded-lg flex-shrink-0 bg-red-100">
                                    <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zM6 20V4h7v5h5v11H6z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-800">Modul_BAB_II.pdf</p>
                                    <p class="text-xs text-[#969696]">3.2 MB</p>
                                </div>
                                <svg class="w-4 h-4 text-[#969696]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                            </a>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex items-center gap-3 mt-4 pt-4 border-t border-[#E6E6E6]">
                            <button type="button" class="text-[#008CFF] border border-[#008CFF] rounded-lg px-4 py-1.5 text-sm hover:bg-[#EBF5FF] transition-colors">Edit</button>
                            <button type="button" class="text-red-500 border border-red-500 rounded-lg px-4 py-1.5 text-sm hover:bg-red-50 transition-colors">Hapus</button>
                        </div>
                    </div>
                </div>

                {{-- ===== BAB III ===== --}}
                <div class="bg-white border border-[#E6E6E6] rounded-lg overflow-hidden" id="accordion-3">
                    <button type="button" class="w-full flex items-center justify-between px-5 py-4 text-left hover:bg-[#F5F7FA] transition-colors" onclick="toggleAccordion(3)" aria-expanded="false">
                        <span class="text-sm font-bold text-gray-900">BAB III Judul Materi</span>
                        <span class="w-5 h-5 text-[#969696] transition-transform duration-200" id="chevron-3">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </span>
                    </button>

                    <div class="hidden px-5 pb-5" id="content-3">
                        <p class="text-sm text-[#969696] mt-3 mb-4">Lampiran materi untuk BAB III. Klik untuk mengunduh.</p>
                        <div class="space-y-2">
                            <a href="#" class="flex items-center gap-3 p-3 rounded-lg border border-[#E6E6E6] hover:shadow-sm transition-shadow">
                                <div class="w-8 h-8 flex items-center justify-center rounded-lg flex-shrink-0 bg-red-100">
                                    <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zM6 20V4h7v5h5v11H6z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-800">Modul_BAB_III.pdf</p>
                                    <p class="text-xs text-[#969696]">1.9 MB</p>
                                </div>
                                <svg class="w-4 h-4 text-[#969696]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                            </a>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex items-center gap-3 mt-4 pt-4 border-t border-[#E6E6E6]">
                            <button type="button" class="text-[#008CFF] border border-[#008CFF] rounded-lg px-4 py-1.5 text-sm hover:bg-[#EBF5FF] transition-colors">Edit</button>
                            <button type="button" class="text-red-500 border border-red-500 rounded-lg px-4 py-1.5 text-sm hover:bg-red-50 transition-colors">Hapus</button>
                        </div>
                    </div>
                </div>

            </div>

        </main>
@endsection