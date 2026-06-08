@extends('anggota.layouts.app')

@section('content')
<main class="flex-1 px-4 sm:px-6 lg:px-8 space-y-4">

    {{-- ========== ACCORDION LIST ========== --}}

    {{-- BAB I --}}
    <div class="bg-white rounded-lg border border-colab-gray overflow-hidden hover:shadow-md transition-shadow duration-200"
         id="accordion-1">
        <button type="button"
                onclick="toggleAccordion(1)"
                aria-expanded="false"
                class="w-full flex items-center justify-between p-4 sm:p-5 cursor-pointer select-none hover:bg-colab-gray-light transition-colors">
            <span class="text-sm sm:text-base font-bold text-gray-800">BAB I Judul Materi</span>
            <span id="chevron-1"
                  class="w-8 h-8 flex items-center justify-center rounded-full border border-colab-gray flex-shrink-0 transition-transform duration-300">
                <svg class="w-4 h-4 text-colab-gray-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </span>
        </button>

        <div class="hidden border-t border-colab-gray px-4 sm:px-5 pb-4 sm:pb-5" id="content-1">
            <p class="text-sm text-colab-gray-dark mt-3 mb-4">Lampiran materi untuk BAB I. Klik untuk mengunduh.</p>
            <div class="space-y-2">

                {{-- PDF --}}
                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-colab-gray-light transition-colors">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg flex-shrink-0 bg-red-100">
                        <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zM6 20V4h7v5h5v11H6z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">Dokumen_Robotika.pdf</p>
                        <p class="text-xs text-colab-gray-dark">2.4 MB</p>
                    </div>
                    <svg class="w-4 h-4 text-colab-gray-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                </a>

                {{-- Video --}}
                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-colab-gray-light transition-colors">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg flex-shrink-0 bg-blue-100">
                        <svg class="w-4 h-4 text-colab-blue" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">Video_Pengenalan_Robotika.mp4</p>
                        <p class="text-xs text-colab-gray-dark">45.8 MB</p>
                    </div>
                    <svg class="w-4 h-4 text-colab-gray-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                </a>

                {{-- PPTX --}}
                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-colab-gray-light transition-colors">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg flex-shrink-0 bg-orange-100">
                        <svg class="w-4 h-4 text-orange-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zM6 20V4h7v5h5v11H6z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">Presentasi_BAB_I.pptx</p>
                        <p class="text-xs text-colab-gray-dark">8.1 MB</p>
                    </div>
                    <svg class="w-4 h-4 text-colab-gray-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                </a>

            </div>
        </div>
    </div>

    {{-- BAB II --}}
    <div class="bg-white rounded-lg border border-colab-gray overflow-hidden hover:shadow-md transition-shadow duration-200"
         id="accordion-2">
        <button type="button"
                onclick="toggleAccordion(2)"
                aria-expanded="false"
                class="w-full flex items-center justify-between p-4 sm:p-5 cursor-pointer select-none hover:bg-colab-gray-light transition-colors">
            <span class="text-sm sm:text-base font-bold text-gray-800">BAB II Judul Materi</span>
            <span id="chevron-2"
                  class="w-8 h-8 flex items-center justify-center rounded-full border border-colab-gray flex-shrink-0 transition-transform duration-300">
                <svg class="w-4 h-4 text-colab-gray-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </span>
        </button>
        <div class="hidden border-t border-colab-gray px-4 sm:px-5 pb-4 sm:pb-5" id="content-2">
            <p class="text-sm text-colab-gray-dark mt-3 mb-4">Lampiran materi untuk BAB II. Klik untuk mengunduh.</p>
            <div class="space-y-2">
                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-colab-gray-light transition-colors">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg flex-shrink-0 bg-red-100">
                        <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zM6 20V4h7v5h5v11H6z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">Modul_BAB_II.pdf</p>
                        <p class="text-xs text-colab-gray-dark">3.2 MB</p>
                    </div>
                    <svg class="w-4 h-4 text-colab-gray-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    {{-- BAB III --}}
    <div class="bg-white rounded-lg border border-colab-gray overflow-hidden hover:shadow-md transition-shadow duration-200"
         id="accordion-3">
        <button type="button"
                onclick="toggleAccordion(3)"
                aria-expanded="false"
                class="w-full flex items-center justify-between p-4 sm:p-5 cursor-pointer select-none hover:bg-colab-gray-light transition-colors">
            <span class="text-sm sm:text-base font-bold text-gray-800">BAB III Judul Materi</span>
            <span id="chevron-3"
                  class="w-8 h-8 flex items-center justify-center rounded-full border border-colab-gray flex-shrink-0 transition-transform duration-300">
                <svg class="w-4 h-4 text-colab-gray-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </span>
        </button>
        <div class="hidden border-t border-colab-gray px-4 sm:px-5 pb-4 sm:pb-5" id="content-3">
            <p class="text-sm text-colab-gray-dark mt-3 mb-4">Lampiran materi untuk BAB III. Klik untuk mengunduh.</p>
            <div class="space-y-2">
                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-colab-gray-light transition-colors">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg flex-shrink-0 bg-red-100">
                        <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zM6 20V4h7v5h5v11H6z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">Modul_BAB_III.pdf</p>
                        <p class="text-xs text-colab-gray-dark">1.9 MB</p>
                    </div>
                    <svg class="w-4 h-4 text-colab-gray-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

</main>

@push('scripts')
<script>
    function toggleAccordion(id) {
        const content = document.getElementById('content-' + id);
        const chevron = document.getElementById('chevron-' + id);
        const btn = content.previousElementSibling;

        const isOpen = !content.classList.contains('hidden');

        if (isOpen) {
            content.classList.add('hidden');
            chevron.classList.remove('rotate-180');
            btn.setAttribute('aria-expanded', 'false');
        } else {
            content.classList.remove('hidden');
            chevron.classList.add('rotate-180');
            btn.setAttribute('aria-expanded', 'true');
        }
    }
</script>
@endpush
@endsection