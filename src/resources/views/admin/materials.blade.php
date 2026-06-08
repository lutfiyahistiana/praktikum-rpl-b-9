@extends('admin.layouts.app')

@section('content')
        {{-- ========================== MAIN CONTENT ========================== --}}
        @php
            $materials = [
                [
                    'title' => 'BAB I Judul Materi',
                    'description' => 'Lampiran materi untuk BAB I. Klik untuk mengunduh.',
                    'files' => [
                        ['name' => 'Dokumen_Robotika.pdf', 'size' => '2.4 MB', 'color' => '#EF4444', 'background' => '#FEE2E2', 'icon' => 'file'],
                        ['name' => 'Video_Pengenalan_Robotika.mp4', 'size' => '45.8 MB', 'color' => '#008CFF', 'background' => '#DBEAFE', 'icon' => 'play'],
                        ['name' => 'Presentasi_BAB_I.pptx', 'size' => '8.1 MB', 'color' => '#F97316', 'background' => '#FFEDD5', 'icon' => 'file'],
                    ],
                ],
                [
                    'title' => 'BAB II Judul Materi',
                    'description' => 'Lampiran materi untuk BAB II. Klik untuk mengunduh.',
                    'files' => [
                        ['name' => 'Modul_BAB_II.pdf', 'size' => '3.2 MB', 'color' => '#EF4444', 'background' => '#FEE2E2', 'icon' => 'file'],
                    ],
                ],
                [
                    'title' => 'BAB III Judul Materi',
                    'description' => 'Lampiran materi untuk BAB III. Klik untuk mengunduh.',
                    'files' => [
                        ['name' => 'Modul_BAB_III.pdf', 'size' => '1.9 MB', 'color' => '#EF4444', 'background' => '#FEE2E2', 'icon' => 'file'],
                    ],
                ],
            ];
        @endphp

    <main class="flex-1 px-4 sm:px-6 lg:px-8 pb-6 space-y-6">

            <div class="box-border flex flex-col gap-4">
                @foreach ($materials as $index => $material)
                    @php $id = $index + 1; @endphp
                    <div id="accordion-{{ $id }}" class="box-border bg-white border border-[#E6E6E6] rounded-lg overflow-hidden shadow-sm">
                        <button type="button" onclick="toggleAccordion({{ $id }})" aria-expanded="false" class="box-border w-full p-5 border-0 bg-white hover:bg-gray-50 transition-colors flex items-center justify-between gap-4 cursor-pointer text-left">
                            <span class="box-border text-base leading-[1.35] font-extrabold text-[#1F2937]">{{ $material['title'] }}</span>
                            <span id="chevron-{{ $id }}" class="box-border w-8 h-8 border border-[#E6E6E6] rounded-full inline-flex items-center justify-center text-[#969696] shrink-0 transition-transform duration-300">
                                <svg class="box-border w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </span>
                        </button>

                        <div id="content-{{ $id }}" class="box-border hidden px-5 pb-5 pt-4 border-t border-[#E6E6E6]">
                            <p class="box-border m-0 mb-4 text-sm leading-relaxed text-[#969696]">{{ $material['description'] }}</p>

                            <div class="box-border flex flex-col gap-2">
                                @foreach ($material['files'] as $file)
                                    <a href="#" class="box-border p-3 rounded-lg flex items-center gap-3 no-underline text-inherit hover:bg-gray-50 transition-colors">
                                        <div style="background: {{ $file['background'] }}; color: {{ $file['color'] }};" class="box-border w-8 h-8 rounded-lg flex items-center justify-center shrink-0">
                                            @if ($file['icon'] === 'play')
                                                <svg class="box-border w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M8 5v14l11-7z"/>
                                                </svg>
                                            @else
                                                <svg class="box-border w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zM6 20V4h7v5h5v11H6z"/>
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="box-border flex-1 min-w-0">
                                            <p class="box-border m-0 text-sm leading-[1.35] font-semibold text-[#1F2937] whitespace-nowrap overflow-hidden text-ellipsis">{{ $file['name'] }}</p>
                                            <p class="box-border mt-0.5 mb-0 text-xs leading-[1.35] text-[#969696]">{{ $file['size'] }}</p>
                                        </div>
                                        <svg class="box-border w-4 h-4 text-[#969696] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                        </svg>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </main>

<script>
    function toggleAccordion(id) {
        const content = document.getElementById('content-' + id);
        const chevron = document.getElementById('chevron-' + id);
        const btn     = content.previousElementSibling;
        const isOpen  = !content.classList.contains('hidden');

        if (isOpen) {
            content.classList.add('hidden');
            chevron.style.transform = 'rotate(0deg)';
            btn.setAttribute('aria-expanded', 'false');
        } else {
            content.classList.remove('hidden');
            chevron.style.transform = 'rotate(180deg)';
            btn.setAttribute('aria-expanded', 'true');
        }
    }
</script>
@endsection