@extends('ketuaTim.layouts.app')

@section('content')
        {{-- ========================== MAIN CONTENT ========================== --}}
        <main class="flex-1 px-4 sm:px-6 lg:px-8 pb-6 space-y-6">


            <form action="/task/ketua/tambah" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- ========== LAYOUT 2 KOLOM ========== --}}
                <div class="flex flex-col md:flex-row gap-8 mt-2 items-start">

                    {{-- ===== KOLOM KIRI: Form Fields ===== --}}
                    <div class="space-y-5 w-full md:w-[580px] flex-shrink-0">

                        {{-- Judul Tugas --}}
                        <div>
                            <label for="judul_tugas" class="block text-sm font-semibold text-gray-800 mb-2">Judul Tugas</label>
                            <div class="flex items-center gap-2 border rounded-lg px-3 py-2.5 transition-all duration-200 border-[#E6E6E6] bg-white focus-within:border-[#2563EB] focus-within:shadow-[0_0_0_3px_rgba(37,99,235,0.12)]">
                                <span class="flex-shrink-0 text-[#9CA3AF]">
                                    {{-- Document icon --}}
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                    </svg>
                                </span>
                                <input
                                    type="text"
                                    id="judul_tugas"
                                    name="judul_tugas"
                                    class="flex-1 text-sm bg-transparent outline-none text-[#333] placeholder-[#9CA3AF]"
                                    placeholder="Johndoe@student.uns.ac.id"
                                >
                            </div>
                        </div>

                        {{-- Ditugaskan Kepada --}}
                        <div>
                            <label for="ditugaskan_kepada" class="block text-sm font-semibold text-gray-800 mb-2">Ditugaskan Kepada</label>
                            <div class="flex items-center gap-2 border rounded-lg px-3 py-2.5 transition-all duration-200 border-[#E6E6E6] bg-white focus-within:border-[#2563EB] focus-within:shadow-[0_0_0_3px_rgba(37,99,235,0.12)]">
                                <span class="flex-shrink-0 text-[#9CA3AF]">
                                    {{-- Person icon --}}
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                                    </svg>
                                </span>
                                <input
                                    type="text"
                                    id="ditugaskan_kepada"
                                    name="ditugaskan_kepada"
                                    class="flex-1 text-sm bg-transparent outline-none text-[#333] placeholder-[#9CA3AF]"
                                    placeholder="Johndoe@student.uns.ac.id"
                                >
                            </div>
                        </div>

                        {{-- Deskripsi Tugas --}}
                        <div>
                            <label for="deskripsi_tugas" class="block text-sm font-semibold text-gray-800 mb-2">Deskripsi Tugas</label>
                            <div class="flex items-start gap-2 border rounded-lg px-3 py-2.5 transition-all duration-200 border-[#E6E6E6] bg-white focus-within:border-[#2563EB] focus-within:shadow-[0_0_0_3px_rgba(37,99,235,0.12)]">
                                <span class="flex-shrink-0 text-[#9CA3AF] mt-1">
                                    {{-- Document text icon --}}
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                    </svg>
                                </span>
                                <textarea
                                    id="deskripsi_tugas"
                                    name="deskripsi_tugas"
                                    class="flex-1 text-sm bg-transparent outline-none resize-y min-h-[100px] text-[#333] placeholder-[#9CA3AF]"
                                    rows="4"
                                    placeholder="Johndoe@student.uns.ac.id"
                                ></textarea>
                            </div>
                        </div>

                        {{-- Tenggat Waktu --}}
                        <div>
                            <label for="tenggat_waktu" class="block text-sm font-semibold text-gray-800 mb-2">Tenggat Waktu</label>
                            <div class="flex items-center gap-2 border rounded-lg px-3 py-2.5 transition-all duration-200 border-[#E6E6E6] bg-white focus-within:border-[#2563EB] focus-within:shadow-[0_0_0_3px_rgba(37,99,235,0.12)]">
                                <span class="flex-shrink-0 text-[#9CA3AF]">
                                    {{-- Calendar icon --}}
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                                    </svg>
                                </span>
                                <input
                                    type="date"
                                    id="tenggat_waktu"
                                    name="tenggat_waktu"
                                    class="flex-1 text-sm bg-transparent outline-none text-[#333] placeholder-[#9CA3AF]"
                                    placeholder="Johndoe@student.uns.ac.id"
                                >
                            </div>
                        </div>
                    </div>

                    {{-- ===== KOLOM KANAN: Tombol Aksi ===== --}}
                    <div id="attachment-container" class="flex-1 flex justify-center items-start">

                        <div class="w-full max-w-[400px] space-y-3">

                            {{-- Kotak Preview Lampiran --}}
                            <div id="attachments-list" class="flex flex-col gap-3">
                                {{-- Kotak kosong default --}}
                                <div id="empty-attachment-box" class="w-16 h-16 border border-gray-300 rounded bg-white"></div>
                            </div>

                            {{-- Dropdown wrapper --}}
                            <div class="relative">
                                {{-- "Tambahkan Lampiran" outline button --}}
                                <button type="button" id="btn-tambah-lampiran"
                                    class="w-full px-4 py-3 bg-white text-sm font-semibold rounded-md text-center active:scale-95 transition-all duration-200 text-[#2563EB] border-2 border-[#2563EB] hover:bg-blue-50"
                                    onclick="toggleDropdown()">
                                    Tambahkan Lampiran
                                </button>

                                {{-- Dropdown menu --}}
                                <div id="attachment-dropdown"
                                    class="hidden absolute left-0 w-full mt-2 bg-white border border-gray-200 rounded-xl shadow-lg z-10 py-1.5 overflow-hidden">
                                    <button type="button"
                                        class="w-full text-left px-4 py-2.5 hover:bg-gray-50 flex items-center gap-3 text-sm font-medium text-gray-700 transition-colors"
                                        onclick="openLinkInput()">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                        </svg>
                                        Link
                                    </button>
                                    <label for="fileUpload"
                                        class="w-full text-left px-4 py-2.5 hover:bg-gray-50 flex items-center gap-3 text-sm font-medium text-gray-700 cursor-pointer transition-colors"
                                        style="margin:0">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                        </svg>
                                        File
                                    </label>
                                    <input type="file" id="fileUpload" name="lampiran_file" class="hidden">
                                </div>
                            </div>

                            {{-- Link Input Area (hidden by default) --}}
                            <div id="link-input-area" class="hidden w-max bg-gray-50 p-4 rounded-xl border border-gray-200">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tambahkan Link</label>
                                <div class="flex gap-2 items-center">
                                    <input type="url" id="link-url" class="flex-1 text-sm bg-transparent outline-none text-[#333] placeholder-[var(--color-secondary)] w-48 bg-white border border-gray-300 rounded-lg px-3 py-2" placeholder="https://">
                                    <button type="button"
                                        class="shrink-0 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors"
                                        onclick="addLink()">Tambah</button>
                                    <button type="button"
                                        class="shrink-0 bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors"
                                        onclick="closeLinkInput()">Batal</button>
                                </div>
                            </div>

                            {{-- Hidden input for link --}}
                            <input type="hidden" name="lampiran_link" id="lampiran_link_input" value="">

                            {{-- Tugaskan Button --}}
                            <button type="submit" id="btn-serahkan" class="w-full px-4 py-3 text-white text-sm font-semibold rounded-md text-center active:scale-95 transition-all duration-200 bg-[#2563EB] hover:bg-[#1D4ED8]">
                                Tugaskan
                            </button>

                        </div>

                    </div>

                </div>
            </form>

        </main>
    </div>

<script>
        function toggleDropdown() {
            const dropdown = document.getElementById('attachment-dropdown');
            dropdown.classList.toggle('hidden');
        }

        function openLinkInput() {
            document.getElementById('attachment-dropdown').classList.add('hidden');
            document.getElementById('btn-tambah-lampiran').classList.add('hidden');
            document.getElementById('link-input-area').classList.remove('hidden');
        }

        function closeLinkInput() {
            document.getElementById('link-input-area').classList.add('hidden');
            document.getElementById('btn-tambah-lampiran').classList.remove('hidden');
            document.getElementById('link-url').value = '';
        }

        function addLink() {
            const urlInput = document.getElementById('link-url');
            const url = urlInput.value.trim();
            if (!url) return;

            document.getElementById('lampiran_link_input').value = url;
            const list = document.getElementById('attachments-list');
            list.innerHTML = `
                <div class="flex items-center bg-white rounded-xl border overflow-hidden border-[#E6E6E6] shadow-[0_1px_3px_rgba(0,0,0,0.07)] min-h-[64px]">
                    <div class="shrink-0 w-14 h-14 flex items-center justify-center overflow-hidden bg-blue-50">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0 px-3 py-2">
                        <a href="${url}" target="_blank" class="text-sm font-medium text-gray-800 truncate leading-snug underline block">${url}</a>
                        <p class="text-xs mt-0.5 text-[var(--color-secondary)]">Link</p>
                    </div>
                    <button type="button" class="shrink-0 px-3 self-stretch flex items-center transition-colors text-[#d1d5db] hover:text-[#ef4444] hover:bg-[#fef2f2]" onclick="removeAttachment()">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            `;
            closeLinkInput();
        }

        function removeAttachment() {
            document.getElementById('lampiran_link_input').value = '';
            document.getElementById('fileUpload').value = '';
            const list = document.getElementById('attachments-list');
            list.innerHTML = '<div id="empty-attachment-box" class="w-16 h-16 border border-gray-300 rounded bg-white"></div>';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const fileUpload = document.getElementById('fileUpload');
            if(fileUpload) {
                fileUpload.addEventListener('change', function(e) {
                    if (this.files && this.files.length > 0) {
                        const file = this.files[0];
                        document.getElementById('attachment-dropdown').classList.add('hidden');
                        
                        const list = document.getElementById('attachments-list');
                        list.innerHTML = `
                            <div class="flex items-center bg-white rounded-xl border overflow-hidden border-[#E6E6E6] shadow-[0_1px_3px_rgba(0,0,0,0.07)] min-h-[64px]">
                                <div class="shrink-0 w-14 h-14 flex items-center justify-center overflow-hidden bg-red-50">
                                    <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zM6 20V4h7v5h5v11H6z"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0 px-3 py-2">
                                    <p class="text-sm font-medium text-gray-800 truncate leading-snug underline">${file.name}</p>
                                    <p class="text-xs mt-0.5 text-[var(--color-secondary)]">File (${(file.size / 1024 / 1024).toFixed(2)} MB)</p>
                                </div>
                                <button type="button" class="shrink-0 px-3 self-stretch flex items-center transition-colors text-[#d1d5db] hover:text-[#ef4444] hover:bg-[#fef2f2]" onclick="removeAttachment()">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        `;
                    }
                });
            }
        });
    </script>
@endsection