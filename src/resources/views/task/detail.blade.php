@extends('layouts.app')

@section('content')
    {{-- ========================== MAIN CONTENT ========================== --}}
    <main class="flex-1 px-4 sm:px-6 lg:px-8 py-6 space-y-6">
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- ========== KONTEN 2 KOLOM (60:40) ========== --}}
            <div class="flex flex-col md:flex-row gap-6">

                {{-- ===== KOLOM KIRI: Detail & Progres (60%) ===== --}}
                <div class="w-full md:w-3/5">
                    <div class="bg-white rounded-xl border border-colab-gray p-5 sm:p-6 h-full">

                        {{-- Header --}}
                        <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Judul Tugas</h1>
                        <p class="text-sm text-colab-gray-dark mt-1">Tanggal Diupload: 1 Mei 2026</p>

                        <hr class="border-t border-colab-gray my-5">

                        {{-- Deskripsi Tugas --}}
                        <div>
                            <label for="deskripsi" class="text-sm text-colab-gray-dark mb-2 block">
                                Deskripsi tugas
                            </label>
                            <div
                                id="deskripsi"
                                name="deskripsi"
                                class="w-full min-h-[120px] px-4 py-3 text-sm text-gray-800
                                       border border-colab-gray rounded-lg resize-y
                                       bg-colab-input
                                       focus:outline-none focus:ring-2 focus:ring-colab-blue focus:border-transparent
                                       transition-all"
                            ><h1>Keterangan pengerjaan</h1></div>
                        </div>

                        {{-- Deadline --}}
                        <p class="text-sm text-colab-gray-dark mt-3">Deadline: 1 Mei 2026</p>
                    </div>
                </div>

                {{-- ===== KOLOM KANAN: Upload & Pengumpulan (40%) ===== --}}
                <div class="w-full md:w-2/5">
                    <div class="bg-white rounded-xl border border-colab-gray p-5 sm:p-6 h-full space-y-4">

                        {{-- Tambahkan Lampiran Tautan --}}
                        <button
                            type="button"
                            onclick="toggleLinkInput()"
                            class="w-full px-4 py-3 bg-white text-colab-blue text-sm font-semibold rounded-md text-center
                                   border-2 border-colab-blue
                                   hover:bg-blue-50 active:scale-95
                                   transition-all duration-200"
                        >
                            Tambahkan Lampiran Tautan
                        </button>

                        {{-- Input Tautan (tersembunyi awalnya) --}}
                        <div id="linkInputWrapper" class="hidden">
                            <input
                                type="url"
                                name="lampiran_tautan"
                                placeholder="https://contoh.com/file-tugas"
                                class="w-full px-3 py-2 text-sm border border-colab-gray rounded-lg
                                       bg-colab-input
                                       focus:outline-none focus:ring-2 focus:ring-colab-blue focus:border-transparent
                                       transition-all"
                            >
                        </div>

                        {{-- Dropzone Upload File --}}
                        <label
                            for="fileUpload"
                            class="w-full border-2 border-dashed border-colab-gray rounded-lg
                                   py-10 px-4 flex flex-col items-center justify-center text-center
                                   cursor-pointer
                                   hover:border-colab-blue hover:bg-blue-50
                                   transition-all duration-200 block"
                        >
                            {{-- Upload Icon --}}
                            <svg class="w-6 h-6 text-colab-gray-dark mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                            </svg>

                            <p class="text-sm text-colab-gray-dark">Klik atau seret file ke sini</p>
                            <p class="text-xs text-colab-gray-dark mt-1">PDF, DOC, ZIP, JPG, PNG (Maks. 10MB)</p>

                            <input
                                type="file"
                                id="fileUpload"
                                name="file_tugas"
                                class="hidden"
                                accept=".pdf,.doc,.docx,.zip,.jpg,.jpeg,.png"
                            >
                        </label>

                        {{-- Nama File Terpilih --}}
                        <p id="fileName" class="text-xs text-colab-gray-dark hidden"></p>

                        {{-- Tombol Submit --}}
                        <button
                            type="submit"
                            class="w-full px-4 py-3 bg-colab-blue text-white text-sm font-semibold rounded-md text-center
                                   hover:bg-colab-blue-dark active:scale-95
                                   transition-all duration-200"
                        >
                            Mulai Dikerjakan
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </main>

    {{-- ========================== SCRIPTS ========================== --}}
    <script>
        // Toggle input tautan
        function toggleLinkInput() {
            const wrapper = document.getElementById('linkInputWrapper');
            wrapper.classList.toggle('hidden');
        }

        // Tampilkan nama file saat dipilih
        document.getElementById('fileUpload').addEventListener('change', function () {
            const fileNameEl = document.getElementById('fileName');
            if (this.files.length > 0) {
                fileNameEl.textContent = '📎 ' + this.files[0].name;
                fileNameEl.classList.remove('hidden');
            } else {
                fileNameEl.classList.add('hidden');
            }
        });
    </script>
@endsection