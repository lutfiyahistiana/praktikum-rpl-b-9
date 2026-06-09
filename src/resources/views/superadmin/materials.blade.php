@extends('superadmin.layouts.app')

@section('content')
    {{-- ========================== MAIN CONTENT ========================== --}}
    <main class="box-border flex-1 w-full px-8 py-6 flex flex-col gap-6">

            <h1 class="box-border m-0 text-[28px] leading-[1.2] font-extrabold text-[#111827]">Daftar Materi</h1>

            <div class="box-border flex flex-col gap-4">
                    <div id="accordion1" class="box-border bg-white border border-[#E6E6E6] rounded-lg overflow-hidden shadow-sm">
                        <button type="button" onclick="toggleAccordion(1)" aria-expanded="true" class="box-border w-full p-5 border-0 bg-white flex items-center justify-between gap-4 cursor-pointer text-left hover:bg-[#F5F7FA] transition-colors">
                            <span class="box-border text-base leading-[1.35] font-extrabold text-[#1F2937]">Semua Materi</span>
                            <span id="chevron-1" class="box-border w-8 h-8 border border-[#E6E6E6] rounded-full inline-flex items-center justify-center text-[#969696] shrink-0 transition-transform duration-300 transform rotate-180">
                                <svg class="box-border w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </span>
                        </button>

                        <div id="content-1" class="box-border block px-5 pb-5 pt-4 border-t border-[#E6E6E6]">
                            <p class="box-border m-0 mb-4 text-sm leading-relaxed text-[#969696]">Berikut adalah daftar semua materi yang telah diunggah ke dalam sistem.</p>

                            <div class="box-border flex flex-col gap-2">
                                @forelse($materials as $material)
                                    <a href="#" class="box-border p-3 rounded-lg flex items-center gap-3 no-underline text-inherit hover:bg-[#F5F7FA] transition-colors">
                                        <div class="box-border w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center shrink-0">
                                            <svg class="box-border w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zM6 20V4h7v5h5v11H6z"/>
                                            </svg>
                                        </div>
                                        <div class="box-border flex-1 min-w-0">
                                            <p class="box-border m-0 text-sm leading-[1.35] font-semibold text-[#1F2937] whitespace-nowrap overflow-hidden text-ellipsis">{{ $material->title }}</p>
                                            <p class="box-border mt-0.5 mb-0 text-xs leading-[1.35] text-[#969696]">{{ $material->description ?? 'Tidak ada deskripsi' }} | Diunggah oleh: {{ $material->uploadedBy ? $material->uploadedBy->name : 'Unknown' }}</p>
                                        </div>
                                        <svg class="box-border w-5 h-5 text-[#969696] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                        </svg>
                                    </a>
                                @empty
                                    <div class="text-gray-500 italic text-sm py-4">Belum ada materi yang diunggah.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
            </div>

        </main>
@endsection