@extends('anggota.layouts.app')

@section('content')
<main class="flex-1 px-4 sm:px-6 lg:px-8 space-y-4">

    @forelse ($materials as $index => $material)
    @php $num = $index + 1; @endphp
    <div class="bg-white rounded-lg border border-colab-gray overflow-hidden hover:shadow-md transition-shadow duration-200"
         id="accordion-{{ $material->id_material }}">

        <button type="button"
                onclick="toggleAccordion({{ $material->id_material }})"
                aria-expanded="false"
                class="w-full flex items-center justify-between p-4 sm:p-5 cursor-pointer select-none hover:bg-colab-gray-light transition-colors">
            <span class="text-sm sm:text-base font-bold text-gray-800">
                BAB {{ $num }} – {{ $material->title }}
            </span>
            <span id="chevron-{{ $material->id_material }}"
                  class="w-8 h-8 flex items-center justify-center rounded-full border border-colab-gray flex-shrink-0 transition-transform duration-300">
                <svg class="w-4 h-4 text-colab-gray-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </span>
        </button>

        <div class="hidden border-t border-colab-gray px-4 sm:px-5 pb-4 sm:pb-5"
             id="content-{{ $material->id_material }}">
            @if ($material->description)
                <p class="text-sm text-colab-gray-dark mt-3 mb-4">{{ $material->description }}</p>
            @else
                <p class="text-sm text-colab-gray-dark mt-3 mb-4">Lampiran materi untuk BAB {{ $num }}. Klik untuk mengunduh.</p>
            @endif

            <div class="space-y-2">
                @forelse ($material->files as $file)
                    @php
                        $ext = strtolower(pathinfo($file->file_name, PATHINFO_EXTENSION));
                        $isPdf   = $ext === 'pdf';
                        $isVideo = in_array($ext, ['mp4', 'mkv', 'avi', 'mov']);
                        $isPptx  = in_array($ext, ['ppt', 'pptx']);

                        if ($isPdf) {
                            $iconBg  = 'bg-red-100';
                            $iconColor = 'text-red-500';
                        } elseif ($isVideo) {
                            $iconBg  = 'bg-blue-100';
                            $iconColor = 'text-colab-blue';
                        } elseif ($isPptx) {
                            $iconBg  = 'bg-orange-100';
                            $iconColor = 'text-orange-500';
                        } else {
                            $iconBg  = 'bg-gray-100';
                            $iconColor = 'text-gray-500';
                        }
                    @endphp
                    <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-colab-gray-light transition-colors">
                        <a href="{{ \Illuminate\Support\Facades\Storage::disk('oss')->url($file->file_path) }}" target="_blank" class="flex items-center gap-3 flex-1 min-w-0 no-underline text-inherit">
                            <div class="w-8 h-8 flex items-center justify-center rounded-lg flex-shrink-0 {{ $iconBg }}">
                                @if ($isVideo)
                                    <svg class="w-4 h-4 {{ $iconColor }}" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 {{ $iconColor }}" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zM6 20V4h7v5h5v11H6z"/>
                                    </svg>
                                @endif
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-800">{{ $file->file_name }}</p>
                                <p class="text-xs text-colab-gray-dark uppercase">{{ strtoupper($ext) }}</p>
                            </div>
                        </a>
                        <a href="{{ route('materials.download', $file->id_material_file) }}" class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 text-colab-gray-dark hover:bg-[#008CFF] hover:text-white transition-colors" title="Download">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                        </a>
                    </div>
                @empty
                    <p class="text-sm text-gray-400 mt-2">Belum ada file untuk materi ini.</p>
                @endforelse
            </div>
        </div>
    </div>
    @empty
        <div class="bg-white rounded-xl border border-colab-gray p-8 text-center">
            <p class="text-gray-400">Belum ada materi yang tersedia.</p>
        </div>
    @endforelse

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