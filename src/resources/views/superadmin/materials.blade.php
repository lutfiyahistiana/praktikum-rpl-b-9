@extends('superadmin.layouts.app')

@section('content')
    {{-- ========================== MAIN CONTENT ========================== --}}
    <main class="box-border flex-1 w-full px-8 py-6 flex flex-col gap-6">

            <h1 class="box-border m-0 text-[28px] leading-[1.2] font-extrabold text-[#111827]">Daftar Materi</h1>

            <div class="box-border flex flex-col gap-4">
                    <div id="accordion1" class="box-border bg-white border border-[#E6E6E6] rounded-lg overflow-hidden shadow-sm">
                        <button type="button" onclick="toggleAccordion('content1', 'chevron1')" aria-expanded="false" class="box-border w-full p-5 border-0 bg-white flex items-center justify-between gap-4 cursor-pointer text-left hover:bg-[#F5F7FA] transition-colors">
                            <span class="box-border text-base leading-[1.35] font-extrabold text-[#1F2937]">Divisi Programming</span>
                            <span id="chevron1" class="box-border w-8 h-8 border border-[#E6E6E6] rounded-full inline-flex items-center justify-center text-[#969696] shrink-0 transition-transform duration-300">
                                <svg class="box-border w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </span>
                        </button>

                        <div id="content1" class="box-border hidden px-5 pb-5 pt-4 border-t border-[#E6E6E6]">
                            <p class="box-border m-0 mb-4 text-sm leading-relaxed text-[#969696]">Materi pengenalan dasar robotika meliputi sejarah, konsep, dan komponen utama robot.</p>

                            <div class="box-border flex flex-col gap-2">
                                    <a href="#" class="box-border p-3 rounded-lg flex items-center gap-3 no-underline text-inherit hover:bg-[#F5F7FA] transition-colors">
                                        <div class="box-border w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center shrink-0">
                                            <svg class="box-border w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zM6 20V4h7v5h5v11H6z"/>
                                            </svg>
                                        </div>
                                        <div class="box-border flex-1 min-w-0">
                                            <p class="box-border m-0 text-sm leading-[1.35] font-semibold text-[#1F2937] whitespace-nowrap overflow-hidden text-ellipsis">Dokumen_Robotika.pdf</p>
                                            <p class="box-border mt-0.5 mb-0 text-xs leading-[1.35] text-[#969696]">2.4 MB</p>
                                        </div>
                                        <svg class="box-border w-5 h-5 text-[#969696] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                        </svg>
                                    </a>
                                    <a href="#" class="box-border p-3 rounded-lg flex items-center gap-3 no-underline text-inherit hover:bg-[#F5F7FA] transition-colors">
                                        <div class="box-border w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center shrink-0">
                                            <svg class="box-border w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z"/>
                                            </svg>
                                        </div>
                                        <div class="box-border flex-1 min-w-0">
                                            <p class="box-border m-0 text-sm leading-[1.35] font-semibold text-[#1F2937] whitespace-nowrap overflow-hidden text-ellipsis">Video_Pengenalan.mp4</p>
                                            <p class="box-border mt-0.5 mb-0 text-xs leading-[1.35] text-[#969696]">45.8 MB</p>
                                        </div>
                                        <svg class="box-border w-5 h-5 text-[#969696] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                        </svg>
                                    </a>
                            </div>
                        </div>
                    </div>

                    <div id="accordion2" class="box-border bg-white border border-[#E6E6E6] rounded-lg overflow-hidden shadow-sm">
                        <button type="button" onclick="toggleAccordion('content2', 'chevron2')" aria-expanded="false" class="box-border w-full p-5 border-0 bg-white flex items-center justify-between gap-4 cursor-pointer text-left hover:bg-[#F5F7FA] transition-colors">
                            <span class="box-border text-base leading-[1.35] font-extrabold text-[#1F2937]">Divisi Elektronika</span>
                            <span id="chevron2" class="box-border w-8 h-8 border border-[#E6E6E6] rounded-full inline-flex items-center justify-center text-[#969696] shrink-0 transition-transform duration-300">
                                <svg class="box-border w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </span>
                        </button>

                        <div id="content2" class="box-border hidden px-5 pb-5 pt-4 border-t border-[#E6E6E6]">
                            <p class="box-border m-0 mb-4 text-sm leading-relaxed text-[#969696]">Materi tentang komponen-komponen elektronika dasar yang digunakan dalam robotika.</p>

                            <div class="box-border flex flex-col gap-2">
                                    <a href="#" class="box-border p-3 rounded-lg flex items-center gap-3 no-underline text-inherit hover:bg-[#F5F7FA] transition-colors">
                                        <div class="box-border w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center shrink-0">
                                            <svg class="box-border w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zM6 20V4h7v5h5v11H6z"/>
                                            </svg>
                                        </div>
                                        <div class="box-border flex-1 min-w-0">
                                            <p class="box-border m-0 text-sm leading-[1.35] font-semibold text-[#1F2937] whitespace-nowrap overflow-hidden text-ellipsis">Modul_BAB_II.pdf</p>
                                            <p class="box-border mt-0.5 mb-0 text-xs leading-[1.35] text-[#969696]">3.2 MB</p>
                                        </div>
                                        <svg class="box-border w-5 h-5 text-[#969696] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                        </svg>
                                    </a>
                            </div>
                        </div>
                    </div>
            </div>

        </main>
@endsection