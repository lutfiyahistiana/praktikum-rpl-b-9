@extends('anggota.layouts.app')

@section('content')
<main class="flex-1 px-4 sm:px-6 lg:px-8 py-6 space-y-6">

    @if (session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('anggota_tim.task.progress.store', $task->id_task) }}"
          method="POST" enctype="multipart/form-data">
        @csrf

        <div class="flex flex-col md:flex-row gap-6">

            {{-- ===== KOLOM KIRI: Detail Tugas ===== --}}
            <div class="w-full md:w-3/5">
                <div class="bg-white rounded-xl border border-colab-gray p-5 sm:p-6 h-full">

                    {{-- Header --}}
                    <div class="flex items-start justify-between gap-2 mb-1">
                        <h1 class="text-xl sm:text-2xl font-bold text-gray-800">{{ $task->title }}</h1>
                        @if ($task->status === 'done')
                            <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full bg-green-100 text-green-700 whitespace-nowrap">Selesai</span>
                        @elseif ($task->deadline && \Carbon\Carbon::parse($task->deadline)->isPast())
                            <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full bg-red-100 text-red-600 whitespace-nowrap">Terlambat</span>
                        @else
                            <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 whitespace-nowrap">Belum Selesai</span>
                        @endif
                    </div>
                    <p class="text-sm text-colab-gray-dark mb-4">
                        Dibuat oleh: {{ $task->assigner->name ?? '-' }}
                    </p>

                    <hr class="border-t border-colab-gray my-4">

                    {{-- Deskripsi --}}
                    <div>
                        <label class="text-sm text-colab-gray-dark mb-2 block">Deskripsi tugas</label>
                        <div class="w-full min-h-[120px] px-4 py-3 text-sm text-gray-800
                                    border border-colab-gray rounded-lg bg-colab-input">
                            {{ $task->description ?? 'Tidak ada deskripsi.' }}
                        </div>
                    </div>

                    <p class="text-sm text-colab-gray-dark mt-4">
                        Deadline: {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->translatedFormat('d F Y') : '-' }}
                    </p>

                    {{-- Attachment dari ketua tim --}}
                    @if($task->attachment_link || $task->attachment_file)
                        <div class="mt-4 space-y-2">
                            <p class="text-sm font-semibold text-gray-700">Lampiran:</p>
                            @if($task->attachment_link)
                                <a href="{{ $task->attachment_link }}" target="_blank"
                                   class="flex items-center gap-2 text-sm text-colab-blue underline">
                                    🔗 {{ $task->attachment_link }}
                                </a>
                            @endif
                            @if($task->attachment_file)
                                <a href="{{ \App\Helpers\StorageHelper::url($task->attachment_file) }}" target="_blank"
                                   class="flex items-center gap-2 text-sm text-colab-blue underline">
                                    📎 Lihat File Lampiran
                                </a>
                            @endif
                        </div>
                    @endif

                    {{-- Riwayat pengerjaan --}}
                    @if ($task->progresses->count() > 0)
                        <div class="mt-5">
                            <h2 class="text-sm font-bold text-gray-700 mb-2">Riwayat Pengerjaan</h2>
                            <div class="space-y-2">
                                @foreach ($task->progresses as $progress)
                                    <div class="border border-colab-gray rounded-lg px-4 py-3 text-sm">
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="font-semibold text-green-600">✓ Diselesaikan</span>
                                            <span class="text-xs text-gray-400">
                                                {{ \Carbon\Carbon::parse($progress->created_at)->translatedFormat('d F Y, H:i') }}
                                            </span>
                                        </div>
                                        @if ($progress->notes)
                                            <p class="text-gray-600 mb-1">{{ $progress->notes }}</p>
                                        @endif
                                        @if ($progress->link_url)
                                            <a href="{{ $progress->link_url }}" target="_blank"
                                               class="text-xs text-colab-blue underline">🔗 {{ $progress->link_url }}</a>
                                        @endif
                                        @if ($progress->file_path)
                                            <a href="{{ \App\Helpers\StorageHelper::url($progress->file_path) }}" target="_blank"
                                               class="block text-xs text-colab-blue underline mt-1">📎 Lihat File</a>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
            </div>

            {{-- ===== KOLOM KANAN: Upload & Submit ===== --}}
            <div class="w-full md:w-2/5">
                <div class="bg-white rounded-xl border border-colab-gray p-5 sm:p-6 h-full space-y-4">

                    @if ($task->status !== 'done' && $task->assigned_to == auth()->user()->id_user)

                        {{-- Tombol Lampiran Tautan --}}
                        <button type="button" onclick="toggleLinkInput()"
                                class="w-full px-4 py-3 bg-white text-colab-blue text-sm font-semibold rounded-md
                                       border-2 border-colab-blue hover:bg-blue-50 active:scale-95 transition-all duration-200">
                            Tambahkan Lampiran Tautan
                        </button>

                        {{-- Input Tautan --}}
                        <div id="linkInputWrapper" class="hidden">
                            <input type="url" name="link_url"
                                   placeholder="https://contoh.com/file-tugas"
                                   class="w-full px-3 py-2 text-sm border border-colab-gray rounded-lg
                                          bg-colab-input focus:outline-none focus:ring-2 focus:ring-colab-blue
                                          focus:border-transparent transition-all">
                        </div>

                        {{-- Dropzone Upload File --}}
                        <label for="fileUpload"
                               class="w-full border-2 border-dashed border-colab-gray rounded-lg
                                      py-10 px-4 flex flex-col items-center justify-center text-center
                                      cursor-pointer hover:border-colab-blue hover:bg-blue-50
                                      transition-all duration-200 block">
                            <svg class="w-6 h-6 text-colab-gray-dark mb-2" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                            </svg>
                            <p class="text-sm text-colab-gray-dark">Klik atau seret file ke sini</p>
                            <p class="text-xs text-colab-gray-dark mt-1">PDF, DOC, ZIP, JPG, PNG (Maks. 10MB)</p>
                            <input type="file" id="fileUpload" name="file_tugas" class="hidden"
                                   accept=".pdf,.doc,.docx,.zip,.jpg,.jpeg,.png">
                        </label>

                        {{-- Nama file terpilih --}}
                        <p id="fileName" class="text-xs text-colab-gray-dark hidden"></p>

                        {{-- Catatan opsional --}}
                        <textarea name="notes" rows="3"
                                  placeholder="Tuliskan keterangan pengerjaan atau progres tugas Anda di sini..."
                                  class="w-full px-3 py-2 text-sm border border-colab-gray rounded-lg
                                         bg-colab-input focus:outline-none focus:ring-2 focus:ring-colab-blue
                                         focus:border-transparent transition-all resize-y">{{ old('notes') }}</textarea>

                        {{-- Tombol Submit --}}
                        <button type="submit"
                                class="w-full px-4 py-3 bg-colab-blue text-white text-sm font-semibold rounded-md
                                       hover:bg-colab-blue-dark active:scale-95 transition-all duration-200">
                            Submit
                        </button>

                    @else
                        <div class="text-center py-8">
                            <p class="text-sm font-semibold text-green-600 mt-4">Tugas ini sudah selesai!</p>
                            <p class="text-xs text-gray-400 mt-1">Kerja bagus!</p>

                            {{-- Tombol Batal Kirim --}}
                            <form action="{{ route('anggota_tim.task.progress.revert', $task->id_task) }}"
                                  method="POST" class="mt-4"
                                  onsubmit="return confirm('Yakin ingin membatalkan pengiriman tugas ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-4 py-2 text-sm border border-red-400 text-red-500 rounded-lg hover:bg-red-50 transition-colors">
                                    Batal Kirim
                                </button>
                            </form>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </form>
</main>

<script>
    function toggleLinkInput() {
        document.getElementById('linkInputWrapper').classList.toggle('hidden');
    }

    document.getElementById('fileUpload').addEventListener('change', function () {
        const el = document.getElementById('fileName');
        if (this.files.length > 0) {
            el.textContent = '📎 ' + this.files[0].name;
            el.classList.remove('hidden');
        } else {
            el.classList.add('hidden');
        }
    });
</script>
@endsection