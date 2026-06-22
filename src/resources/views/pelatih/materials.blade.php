@extends('pelatih.layouts.app')

@section('content')
    {{-- ========================== MAIN CONTENT ========================== --}}
        <main class="flex-1 px-4 sm:px-6 lg:px-8 pb-6 space-y-6">

            {{-- Page Header: Title + Tambah Materi Button --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-2">
                <h1 class="text-xl font-bold text-gray-900">Daftar Materi</h1>
                <a href="{{ route('pelatih.materials.create') }}" id="btn-tambah-materi" class="inline-flex items-center gap-2 bg-[#008CFF] hover:bg-[#006FCC] text-white font-medium text-sm px-5 py-2.5 rounded-lg transition-colors shadow-sm">
                    {{-- Plus icon --}}
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    <span>Tambah Materi</span>
                </a>
            </div>

            {{-- ========== ACCORDION LIST ========== --}}
            <div class="space-y-4">

                @forelse($materials as $index => $material)
                <div class="bg-white border border-[#E6E6E6] rounded-lg overflow-hidden" id="accordion-{{ $index }}">
                    <button type="button" class="w-full flex items-center justify-between px-5 py-4 text-left hover:bg-[#F5F7FA] transition-colors" onclick="toggleAccordion({{ $index }})" aria-expanded="false">
                        <span class="text-sm font-bold text-gray-900">{{ $material->title }}</span>
                        <span class="w-5 h-5 text-[#969696] transition-transform duration-200" id="chevron-{{ $index }}">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </span>
                    </button>

                    <div class="hidden px-5 pb-5" id="content-{{ $index }}">
                        <p class="text-sm text-[#969696] mt-3 mb-4">{{ $material->description ?? 'Tidak ada deskripsi.' }}</p>

                        <div class="space-y-2">
                            @forelse($material->files as $file)
                            <div class="flex items-center gap-3 p-3 rounded-lg border border-[#E6E6E6] hover:shadow-sm transition-shadow">
                                <a href="{{ \App\Helpers\StorageHelper::url($file->file_path) }}" target="_blank" class="flex items-center gap-3 flex-1 min-w-0 no-underline text-inherit">
                                    <div class="w-8 h-8 flex items-center justify-center rounded-lg flex-shrink-0 bg-blue-100">
                                        <svg class="w-4 h-4 text-[#008CFF]" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zM6 20V4h7v5h5v11H6z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-800 whitespace-nowrap overflow-hidden text-ellipsis">{{ $file->file_name }}</p>
                                        <p class="text-xs text-[#969696]">{{ strtoupper(pathinfo($file->file_name, PATHINFO_EXTENSION) ?: $file->file_type) }}</p>
                                    </div>
                                </a>
                                <a href="{{ route('materials.download', $file->id_material_file) }}" class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 text-[#969696] hover:bg-[#008CFF] hover:text-white transition-colors" title="Download">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                </a>
                            </div>
                            @empty
                            <p class="text-xs italic text-gray-500">Belum ada file materi.</p>
                            @endforelse
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex items-center gap-3 mt-4 pt-4 border-t border-[#E6E6E6]">
                            <a href="{{ route('pelatih.materials.edit', $material->id_material) }}" class="text-[#008CFF] border border-[#008CFF] rounded-lg px-4 py-1.5 text-sm hover:bg-[#EBF5FF] transition-colors">Edit</a>
                            <form action="{{ route('pelatih.materials.destroy', $material->id_material) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus materi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 border border-red-500 rounded-lg px-4 py-1.5 text-sm hover:bg-red-50 transition-colors">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-gray-500 italic text-sm py-4">Belum ada materi yang ditambahkan.</div>
                @endforelse

            </div>

        </main>
@endsection