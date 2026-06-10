@extends('ketuaTim.layouts.app')

@section('content')
        {{-- ========================== MAIN CONTENT ========================== --}}
     <main class="flex-1 px-4 sm:px-6 lg:px-8 pb-6 space-y-6">

            {{-- ========== STATISTICS SECTION ========== --}}
            <section id="statistics-section">
                <div class="bg-white rounded-xl border p-5 sm:p-6 border-[#E6E6E6]">
                    <h1 class="text-lg sm:text-xl font-bold text-gray-900 mb-5">Statistics</h1>

                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                        @foreach ($statistics as $label => $value)
                        <div class="rounded-lg border bg-white p-4 text-center hover:shadow-md transition-shadow duration-200 border-[#E6E6E6]">
                            <p class="text-sm font-medium mb-2 text-[#969696]">{{ $label }}</p>
                            <p class="text-3xl sm:text-4xl font-extrabold text-gray-900">{{ $value }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- ========== PROGRES TUGAS SECTION (per anggota) ========== --}}
            <section id="progress-section">
                <div class="bg-white rounded-xl border p-5 sm:p-6 border-[#E6E6E6]">
                    <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-5">Progres Tugas</h2>

                    <div class="space-y-4">
                        @foreach ($progressItems as $item)
                        <div class="flex items-center gap-4">
                            <span class="text-sm font-medium text-gray-800 whitespace-nowrap min-w-[180px]">{{ $item['name'] }}</span>
                            <div class="flex-1 h-4 rounded-full overflow-hidden bg-[#E6E6E6]">
                                <div class="h-full bg-green-500 rounded-full transition-all duration-500 ease-out" style="width: {{ $item['progress'] }}%;"></div>
                            </div>
                            <span class="text-sm font-semibold text-gray-700 whitespace-nowrap">{{ $item['progress'] }}%</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- ========== DAFTAR TUGAS BELUM SELESAI SECTION ========== --}}
            <section id="task-list-section">
                <div class="bg-white rounded-xl border p-5 sm:p-6 border-[#E6E6E6]">
                    <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-5">Daftar Tugas Belum Selesai</h2>

                    <div class="space-y-4">
                        @foreach ($pendingTasks as $task)
                        <div class="rounded-lg border bg-white p-4 hover:shadow-md transition-shadow duration-200 border-[#E6E6E6]">
                            <p class="text-sm font-bold text-gray-900 mb-1">{{ $task['title'] }}</p>
                            <p class="text-xs text-[var(--color-secondary)]">{{ $task['assignee'] }} | {{ $task['status'] }} | Deadline: {{ $task['deadline'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

        </main>
    </div>
@endsection