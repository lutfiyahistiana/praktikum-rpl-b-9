@extends('pelatih.layouts.app')

@section('content')
    {{-- ========================== MAIN CONTENT ========================== --}}
        <main class="flex-1 px-4 sm:px-6 lg:px-8 py-6 space-y-6">

            {{-- ========== STATISTICS SECTION ========== --}}
            <section id="statistics-section">
                <div class="bg-white border border-[#E6E6E6] rounded-lg p-6">
                    <h1 class="text-lg font-bold text-gray-900 mb-4">Statistics</h1>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-3xl">
                        {{-- Card: Total BAB Ditambahkan --}}
                        <div class="border border-[#E6E6E6] rounded-lg p-10 text-center">
                            <p class="text-sm text-[#969696] py-2">Total BAB Ditambahkan</p>
                            <p class="text-3xl font-extrabold text-gray-900">11</p>
                        </div>

                        {{-- Card: Total File Ditambahkan --}}
                        <div class="border border-[#E6E6E6] rounded-lg p-10 text-center">
                            <p class="text-sm text-[#969696] py-2">Total File Ditambahkan</p>
                            <p class="text-3xl font-extrabold text-gray-900">11</p>
                        </div>
                    </div>
                </div>
            </section>

        </main>
@endsection