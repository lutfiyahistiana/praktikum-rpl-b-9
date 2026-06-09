@extends($layout)

@section('content')
<main class="flex-1 px-4 sm:px-6 lg:px-8 py-6">

    @if (session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg text-sm mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl border border-colab-gray p-6 sm:p-8">

        {{-- Header Profil --}}

        <form action="{{ route('profil.update') }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="flex items-center gap-4 mb-8">

            <div class="w-20 h-20">
                @if($user->photo)
                    <img
                        src="{{ asset('storage/' . $user->photo) }}"
                        alt="Foto Profil"
                        class="w-20 h-20 rounded-full object-cover border">
                @else
                    <div class="w-20 h-20 rounded-full bg-colab-gray flex items-center justify-center text-2xl font-bold text-gray-500">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
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
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Foto Profil
                    </label>

                    <input
                        type="file"
                        name="photo"
                        accept="image/*"
                        class="text-sm">
                </div>
            </div>

        </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Prodi --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Prodi</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
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
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
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
@endsection