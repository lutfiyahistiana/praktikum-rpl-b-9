@extends('pelatih.layouts.app')

@section('content')
    {{-- ========================== MAIN CONTENT ========================== --}}
        <main class="flex-1 px-4 sm:px-6 lg:px-8 py-6 space-y-6">

            {{-- Page Title --}}
            <div class="mb-6">
                <h1 class="text-xl font-bold text-gray-900">Edit Materi</h1>
            </div>

            {{-- ========== FORM EDIT MATERI ========== --}}
            <form action="{{ route('pelatih.materials.update', $material->id_material) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Card: Informasi BAB --}}
                <div class="bg-white border border-[#E6E6E6] rounded-lg p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Informasi BAB</h2>

                    {{-- Judul BAB --}}
                    <div class="mb-5">
                        <label for="judul_bab" class="block text-sm font-medium text-gray-700 mb-1">Judul BAB <span class="text-red-500">*</span></label>
                        <div class="flex items-center gap-2 border border-[#E6E6E6] rounded-lg px-3 py-2.5 bg-white focus-within:border-[#008CFF] focus-within:ring-1 focus-within:ring-[#008CFF] transition-colors">
                            <svg class="w-5 h-5 text-[#969696] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                            </svg>
                            <input type="text" id="judul_bab" name="judul_bab" value="{{ old('judul_bab', $material->title) }}" class="flex-1 bg-transparent text-sm text-gray-900 outline-none placeholder-[#969696]" placeholder="Contoh: BAB I Pengenalan Robotika" required>
                        </div>
                    </div>

                    {{-- Deskripsi BAB --}}
                    <div>
                        <label for="deskripsi_bab" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi <span class="text-xs text-[#969696] font-normal">(opsional)</span></label>
                        <textarea id="deskripsi_bab" name="deskripsi_bab" rows="3" class="w-full border border-[#E6E6E6] rounded-lg px-3 py-2.5 text-sm text-gray-900 outline-none placeholder-[#969696] focus:border-[#008CFF] focus:ring-1 focus:ring-[#008CFF] transition-colors resize-y" placeholder="Tuliskan deskripsi singkat tentang BAB ini...">{{ old('deskripsi_bab', $material->description) }}</textarea>
                    </div>
                </div>

                {{-- Card: File yang sudah ada --}}
                @if($material->files->count() > 0)
                <div class="bg-white border border-[#E6E6E6] rounded-lg p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">File Saat Ini</h2>
                    <p class="text-sm text-[#969696] mb-4">Centang file yang ingin dihapus.</p>

                    <div class="space-y-2">
                        @foreach($material->files as $file)
                        <div class="flex items-center gap-3 p-3 rounded-lg border border-[#E6E6E6]">
                            <input type="checkbox" name="delete_files[]" value="{{ $file->id_material_file }}" id="file-{{ $file->id_material_file }}" class="w-4 h-4 text-red-500 border-gray-300 rounded focus:ring-red-400 cursor-pointer">
                            <label for="file-{{ $file->id_material_file }}" class="flex items-center gap-3 flex-1 cursor-pointer">
                                <div class="w-8 h-8 flex items-center justify-center rounded-lg flex-shrink-0 bg-blue-100">
                                    <svg class="w-4 h-4 text-[#008CFF]" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zM6 20V4h7v5h5v11H6z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-800">{{ $file->file_name }}</p>
                                    <p class="text-xs text-[#969696]">{{ strtoupper($file->file_type) }}</p>
                                </div>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Card: Upload File Baru --}}
                <div class="bg-white border border-[#E6E6E6] rounded-lg p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Tambah File Baru <span class="text-xs text-[#969696] font-normal">(opsional)</span></h2>

                    {{-- Dropzone --}}
                    <label for="file_materi" class="flex flex-col items-center justify-center border-2 border-dashed border-[#E6E6E6] rounded-lg py-10 px-6 cursor-pointer hover:border-[#008CFF] hover:bg-[#F8FCFF] transition-colors" id="dropzone-area">
                        <svg class="w-10 h-10 text-[#969696]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                        </svg>
                        <p class="text-sm text-[#969696] mt-2">
                            <span class="font-semibold text-[#008CFF]">Klik untuk upload</span>
                            <span> atau drag & drop file di sini</span>
                        </p>
                        <p class="text-xs text-[#969696] mt-1">PDF, PPTX, DOCX, MP4, ZIP — Maks. 50MB per file</p>
                        <input type="file" id="file_materi" name="file_materi[]" multiple accept=".pdf,.pptx,.docx,.mp4,.zip" class="hidden">
                    </label>

                    {{-- File Preview List --}}
                    <div id="file-preview-list" class="mt-4 space-y-2 hidden"></div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="submit" id="btn-update-materi" class="w-full sm:w-auto sm:px-8 bg-[#008CFF] hover:bg-[#006FCC] text-white font-medium text-sm py-2.5 rounded-lg transition-colors shadow-sm text-center">
                        Perbarui Materi
                    </button>
                    <a href="{{ route('pelatih.materials') }}" class="w-full sm:w-auto sm:px-8 border border-[#E6E6E6] text-gray-700 hover:bg-[#F5F7FA] font-medium text-sm py-2.5 rounded-lg transition-colors text-center">
                        Batal
                    </a>
                </div>

            </form>

        </main>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fileInput = document.getElementById('file_materi');
        const dropzone = document.getElementById('dropzone-area');
        const previewList = document.getElementById('file-preview-list');
        let selectedFiles = new DataTransfer();

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 B';
            const k = 1024;
            const sizes = ['B', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
        }

        function getFileIcon(ext) {
            const icons = {
                'pdf': { bg: 'bg-red-100', text: 'text-red-500' },
                'pptx': { bg: 'bg-orange-100', text: 'text-orange-500' },
                'docx': { bg: 'bg-blue-100', text: 'text-blue-500' },
                'mp4': { bg: 'bg-purple-100', text: 'text-purple-500' },
                'zip': { bg: 'bg-yellow-100', text: 'text-yellow-600' },
            };
            return icons[ext.toLowerCase()] || { bg: 'bg-gray-100', text: 'text-gray-500' };
        }

        function renderPreview() {
            previewList.innerHTML = '';
            if (selectedFiles.files.length === 0) {
                previewList.classList.add('hidden');
                return;
            }
            previewList.classList.remove('hidden');

            Array.from(selectedFiles.files).forEach((file, index) => {
                const ext = file.name.split('.').pop();
                const icon = getFileIcon(ext);
                const item = document.createElement('div');
                item.className = 'flex items-center gap-3 p-3 rounded-lg border border-[#E6E6E6] bg-white';
                item.innerHTML = `
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg flex-shrink-0 ${icon.bg}">
                        <svg class="w-4 h-4 ${icon.text}" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zM6 20V4h7v5h5v11H6z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-800 truncate">${file.name}</p>
                        <p class="text-xs text-[#969696]">${formatFileSize(file.size)}</p>
                    </div>
                    <button type="button" data-index="${index}" class="remove-file p-1 rounded hover:bg-red-50 transition-colors" title="Hapus file">
                        <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                `;
                previewList.appendChild(item);
            });

            previewList.querySelectorAll('.remove-file').forEach(btn => {
                btn.addEventListener('click', function () {
                    const idx = parseInt(this.dataset.index);
                    const newDt = new DataTransfer();
                    Array.from(selectedFiles.files).forEach((f, i) => {
                        if (i !== idx) newDt.items.add(f);
                    });
                    selectedFiles = newDt;
                    fileInput.files = selectedFiles.files;
                    renderPreview();
                });
            });
        }

        fileInput.addEventListener('change', function () {
            Array.from(this.files).forEach(f => selectedFiles.items.add(f));
            fileInput.files = selectedFiles.files;
            renderPreview();
        });

        ['dragenter', 'dragover'].forEach(evt => {
            dropzone.addEventListener(evt, function (e) {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.add('border-[#008CFF]', 'bg-[#F8FCFF]');
            });
        });

        ['dragleave', 'drop'].forEach(evt => {
            dropzone.addEventListener(evt, function (e) {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.remove('border-[#008CFF]', 'bg-[#F8FCFF]');
            });
        });

        dropzone.addEventListener('drop', function (e) {
            const files = e.dataTransfer.files;
            Array.from(files).forEach(f => selectedFiles.items.add(f));
            fileInput.files = selectedFiles.files;
            renderPreview();
        });
    });
</script>
@endsection
