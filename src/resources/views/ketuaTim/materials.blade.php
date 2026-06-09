@extends('ketuaTim.layouts.app')

@section('content')
        {{-- ========================== MAIN CONTENT ========================== --}}
        <main class="flex-1 px-4 sm:px-6 lg:px-8 pb-6 space-y-6">

            {{-- ========== ACCORDION LIST ========== --}}
            <div class="space-y-4">
                @foreach ($materials as $index => $material)
                    @php $id = $index + 1; @endphp
                    <div class="bg-white rounded-lg border overflow-hidden transition-shadow duration-200 hover:shadow-md border-[#E6E6E6]" id="accordion-{{ $id }}">
                        <button type="button" class="w-full flex items-center justify-between p-4 sm:p-5 cursor-pointer select-none hover:bg-gray-50 transition-colors" onclick="toggleAccordion({{ $id }})" aria-expanded="false">
                            <span class="text-sm sm:text-base font-bold text-gray-800">{{ $material['title'] }}</span>
                            <span class="w-8 h-8 flex items-center justify-center rounded-full border border-[#E6E6E6] flex-shrink-0 transition-transform duration-300" id="chevron-{{ $id }}">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </span>
                        </button>

                        <div class="px-4 sm:px-5 pb-4 sm:pb-5 border-t border-t-[#E6E6E6] hidden" id="content-{{ $id }}">
                            <p class="text-sm text-[#969696] mt-3 mb-4">{{ $material['description'] }}</p>

                            <div class="space-y-2">
                                @foreach ($material['files'] as $file)
                                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-[#F5F7FA] transition-colors cursor-pointer">
                                    <div style="background: {{ $file['background'] }}; color: {{ $file['color'] }};" class="w-8 h-8 flex items-center justify-center rounded-lg flex-shrink-0">
                                        @if ($file['icon'] === 'play')
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z"/>
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zM6 20V4h7v5h5v11H6z"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-800">{{ $file['name'] }}</p>
                                        <p class="text-xs text-[var(--color-secondary)]">{{ $file['size'] }}</p>
                                    </div>
                                    <svg class="w-4 h-4 text-[#969696]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
    </div>

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