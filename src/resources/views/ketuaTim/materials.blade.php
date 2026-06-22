@extends('ketuaTim.layouts.app')

@section('content')
    {{-- ========================== MAIN CONTENT ========================== --}}
    <main class="flex-1 px-4 sm:px-6 lg:px-8 pb-6 space-y-6">

        @if ($selectedDivision)
            {{-- ====== LEVEL 2: Daftar Materi per Divisi ====== --}}
            <div class="box-border bg-white border border-[#E6E6E6] rounded-2xl p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-5">
                    <a href="{{ route('ketua_tim.materials') }}" class="text-gray-500 hover:text-gray-800 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <h2 class="box-border m-0 text-xl leading-[1.2] font-extrabold text-[#111827]">Daftar Materi {{ $selectedDivision->division_name }}</h2>
                </div>

                <div class="box-border flex flex-col gap-4">
                    @forelse ($materials as $index => $material)
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
                                        <div class="box-border p-3 rounded-lg flex items-center gap-3 hover:bg-gray-50 transition-colors">
                                            <a href="{{ \App\Helpers\StorageHelper::url($file['path']) }}" target="_blank" class="box-border flex items-center gap-3 flex-1 min-w-0 no-underline text-inherit">
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
                                            </a>
                                            <a href="{{ route('materials.download', $file['id']) }}" class="box-border w-8 h-8 rounded-lg flex items-center justify-center shrink-0 text-[#969696] hover:bg-[#008CFF] hover:text-white transition-colors" title="Download">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                </svg>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-[#969696]">Belum ada materi untuk divisi ini.</p>
                    @endforelse
                </div>
            </div>
        @else
            {{-- ====== LEVEL 1: Daftar Divisi ====== --}}
            <div class="box-border bg-white border border-[#E6E6E6] rounded-2xl p-6 shadow-sm">
                <div class="box-border flex flex-col gap-4">
                    @forelse ($divisions as $division)
                        <a href="{{ route('ketua_tim.materials', ['division_id' => $division->id_division]) }}"
                           class="box-border bg-white border border-[#E6E6E6] rounded-lg overflow-hidden shadow-sm no-underline text-inherit hover:bg-gray-50 transition-colors">
                            <div class="box-border w-full p-5 flex items-center justify-between gap-4">
                                <span class="box-border text-base leading-[1.35] font-extrabold text-[#1F2937]">{{ $division->division_name }}</span>
                                <span class="box-border w-8 h-8 border border-[#E6E6E6] rounded-full inline-flex items-center justify-center text-[#969696] shrink-0">
                                    <svg class="box-border w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </span>
                            </div>
                        </a>
                    @empty
                        <p class="text-sm text-[#969696]">Belum ada divisi.</p>
                    @endforelse
                </div>
            </div>
        @endif

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