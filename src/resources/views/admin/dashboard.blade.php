@extends('admin.layouts.app')

@section('content')

            {{-- ========================== MAIN CONTENT ========================== --}}
    <main class="flex-1 px-4 sm:px-6 lg:px-8 pb-6 space-y-6">

            <section id="statistics-section">
                <div class="box-border bg-white border border-[#E6E6E6] rounded-2xl p-6">
                    <h1 class="box-border m-0 mb-5 text-xl leading-[1.2] font-extrabold text-black">Statistics</h1>

                    <div class="box-border grid grid-cols-[repeat(auto-fit,minmax(260px,1fr))] gap-x-24 gap-y-5">
                        @foreach ($statistics as $label => $value)
                            <div class="box-border min-h-[120px] p-4 bg-white border hover:shadow-md transition-shadow duration-200 border-[#E6E6E6] rounded-lg flex flex-col items-center justify-center text-center">
                                <p class="box-border m-0 mb-2 text-sm leading-[1.35] font-semibold text-[#969696]">{{ $label }}</p>
                                <p class="box-border m-0 text-[40px] leading-none font-medium text-black">{{ $value }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <section id="progress-section">
                <div class="box-border bg-white border border-[#E6E6E6] rounded-2xl p-6 shadow-sm">
                    <h2 class="box-border m-0 mb-5 text-xl leading-[1.2] font-extrabold text-[#111827]">Progres Tugas</h2>

                    <div class="box-border flex flex-col gap-4">
                        @foreach ($progressItems as $item)
                            <div class="box-border flex items-center gap-3 ">
                                <span class="box-border min-w-[260px] text-sm leading-[1.35] font-bold text-[#374151] whitespace-nowrap">{{ $item['name'] }}</span>
                                <div class="box-border flex-1 h-3 bg-[#D9D9D9] rounded-full overflow-hidden">
                                    <div style="width: {{ $item['progress'] }}%;" class="box-border h-full bg-[#2F8F4E] rounded-full"></div>
                                </div>
                                <span class="box-border text-sm leading-[1.35] font-bold text-[#374151] whitespace-nowrap">{{ $item['progress'] }}%</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <section id="task-list-section">
                <div class="box-border bg-white border border-[#E6E6E6] rounded-2xl p-6 shadow-sm">
                    <h2 class="box-border m-0 mb-5 text-xl leading-[1.2] font-extrabold text-[#111827]">Daftar Tugas Belum Selesai</h2>

                    <div class="box-border flex flex-col gap-4">
                        @foreach ($pendingTasks as $task)
                            <div class="box-border p-4 bg-white border hover:shadow-md transition-shadow duration-200 border-[#E6E6E6] rounded-lg">
                                <p class="box-border m-0 mb-1 text-sm leading-[1.35] font-extrabold text-[#111827]">{{ $task['title'] }}</p>
                                <p class="box-border m-0 text-xs leading-[1.35] text-[#969696]">{{ $task['assignee'] }} | {{ $task['status'] }} | Deadline: {{ $task['deadline'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

        </main>
    </div>
@endsection