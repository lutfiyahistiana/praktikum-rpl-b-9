@extends($layout)

@section('content')
<main class="flex-1 px-4 sm:px-6 lg:px-8 pb-6">

    @if (session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg text-sm mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl border border-colab-gray p-6 sm:p-8">

        <form action="{{ route('profil.update') }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Header Profil --}}
            <div class="flex items-center gap-4 mb-8">

                <div class="w-20 h-20 flex-shrink-0">
                    @if($user->photo)
                        <img
                            id="preview-foto"
                            src="{{ asset('storage/' . $user->photo) }}"
                            alt="Foto Profil"
                            class="w-20 h-20 rounded-full object-cover border">
                    @else
                        <div id="preview-initial"
                             class="w-20 h-20 rounded-full bg-colab-gray flex items-center justify-center text-2xl font-bold text-gray-500">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <img
                            id="preview-foto"
                            src=""
                            alt="Foto Profil"
                            class="w-20 h-20 rounded-full object-cover border hidden">
                    @endif
                </div>

                <div>
                    <h1 class="text-xl font-bold text-gray-900">
                        {{ $user->name }}
                    </h1>

                    <p class="text-sm text-gray-400">
                        {{ $user->email }}
                    </p>

                    <div class="mt-2">
                        <input
                            type="file"
                            name="photo"
                            id="input-foto"
                            accept="image/*"
                            class="hidden">

                        <button type="button"
                            onclick="document.getElementById('input-foto').click()"
                            class="px-4 py-1.5 text-sm border border-gray-300 rounded-lg bg-white hover:bg-gray-50 text-gray-700 transition-colors cursor-pointer">
                            Pilih Foto
                        </button>
                        <span id="foto-name" class="ml-2 text-sm text-gray-400 hidden"></span>

                        <p id="foto-error" class="text-xs text-red-500 mt-1 hidden"></p>
                    </div>
                </div>

            </div>{{-- akhir flex header --}}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Prodi --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Prodi</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0121 21H3a12.083 12.083 0 012.84-10.422L12 14z"/>
                            </svg>
                        </span>
                        <input type="text" name="prodi" value="{{ old('prodi', $user->prodi) }}"
                               placeholder="Masukkan Prodi"
                               class="w-full pl-10 pr-4 py-2.5 text-sm border border-colab-gray rounded-lg bg-colab-input focus:outline-none focus:ring-2 focus:ring-colab-blue focus:border-transparent transition-all">
                    </div>
                </div>

                {{-- Nomor HP --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </span>
                        <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}"
                               placeholder="Masukkan Nomor"
                               class="w-full pl-10 pr-4 py-2.5 text-sm border border-colab-gray rounded-lg bg-colab-input focus:outline-none focus:ring-2 focus:ring-colab-blue focus:border-transparent transition-all">
                    </div>
                </div>

                {{-- Fakultas --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Fakultas</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </span>
                        <input type="text" name="fakultas" value="{{ old('fakultas', $user->fakultas) }}"
                               placeholder="Masukkan Fakultas"
                               class="w-full pl-10 pr-4 py-2.5 text-sm border border-colab-gray rounded-lg bg-colab-input focus:outline-none focus:ring-2 focus:ring-colab-blue focus:border-transparent transition-all">
                    </div>
                </div>

                {{-- Username GitHub --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Username GitHub</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                        <input type="text" name="username_github" value="{{ old('username_github', $user->username_github) }}"
                               placeholder="Masukkan Username GitHub"
                               class="w-full pl-10 pr-4 py-2.5 text-sm border border-colab-gray rounded-lg bg-colab-input focus:outline-none focus:ring-2 focus:ring-colab-blue focus:border-transparent transition-all">
                    </div>
                </div>

                {{-- Divisi (read only) --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Divisi</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </span>
                        <input type="text"
                               value="{{ $divisionMember?->division?->division_name ?? '-' }}"
                               placeholder="Masukkan Divisi"
                               class="w-full pl-10 pr-4 py-2.5 text-sm border border-colab-gray rounded-lg bg-gray-50 text-gray-500"
                               readonly>
                    </div>
                </div>

                {{-- Email (read only) --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        <input type="text"
                               value="{{ $user->email }}"
                               class="w-full pl-10 pr-4 py-2.5 text-sm border border-colab-gray rounded-lg bg-gray-50 text-gray-500"
                               readonly>
                    </div>
                </div>

                {{-- Tim (read only) --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tim</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </span>
                        <input type="text"
                               value="{{ $teamMember?->team?->team_name ?? '-' }}"
                               placeholder="Masukkan Tim"
                               class="w-full pl-10 pr-4 py-2.5 text-sm border border-colab-gray rounded-lg bg-gray-50 text-gray-500"
                               readonly>
                    </div>
                </div>

                {{-- Hak Akses (read only) --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Daftar Hak Akses</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </span>
                        <input type="text"
                               value="{{ $roles ?: '-' }}"
                               placeholder="Masukkan Hak Akses"
                               class="w-full pl-10 pr-4 py-2.5 text-sm border border-colab-gray rounded-lg bg-gray-50 text-gray-500"
                               readonly>
                    </div>
                </div>

            </div>

            {{-- Tombol Simpan --}}
            <div class="mt-8 flex justify-end">
                <button type="submit"
                        class="px-6 py-2.5 bg-colab-blue text-white text-sm font-semibold rounded-lg
                               hover:bg-colab-blue-dark active:scale-95 transition-all duration-200">
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</main>

<script>
    const inputFoto = document.getElementById('input-foto');
    const previewFoto = document.getElementById('preview-foto');
    const previewInitial = document.getElementById('preview-initial');
    const fotoError = document.getElementById('foto-error');
    const fotoName = document.getElementById('foto-name');

    const MAX_SIZE_MB = 2;

    inputFoto?.addEventListener('change', function () {
        const file = this.files[0];
        fotoError.classList.add('hidden');
        fotoError.textContent = '';

        if (!file) {
            fotoName.classList.add('hidden');
            fotoName.textContent = '';
            return;
        }

        // Validasi ukuran file
        if (file.size > MAX_SIZE_MB * 1024 * 1024) {
            fotoError.textContent = `Ukuran file maksimal ${MAX_SIZE_MB}MB.`;
            fotoError.classList.remove('hidden');
            fotoName.classList.add('hidden');
            this.value = '';
            return;
        }

        // Tampilkan nama file
        fotoName.textContent = file.name;
        fotoName.classList.remove('hidden');

        // Tampilkan preview
        const reader = new FileReader();
        reader.onload = function (e) {
            previewFoto.src = e.target.result;
            previewFoto.classList.remove('hidden');
            if (previewInitial) previewInitial.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    });
</script>
@endsection