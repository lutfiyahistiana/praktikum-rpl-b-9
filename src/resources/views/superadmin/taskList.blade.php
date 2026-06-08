@extends('superadmin.layouts.app')

@section('content')
    {{-- ========================== MAIN CONTENT ========================== --}}
    <main class="box-border flex-1 w-full p-8 flex flex-col gap-7">

            <div class="box-border flex flex-col gap-6">
                <h1 class="box-border m-0 text-2xl leading-[1.2] font-extrabold text-black">Daftar Tugas</h1>

                <div class="box-border relative w-max">
                    <button type="button" onclick="toggleTaskFilter()" class="box-border inline-flex items-center gap-3 p-0 border-0 bg-transparent text-black text-[15px] font-extrabold cursor-pointer">
                        <svg class="box-border w-[22px] h-[22px]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5h18l-7 8v5l-4 2v-7L3 5z"/>
                            <circle cx="17" cy="18" r="3"/>
                        </svg>
                        <span id="taskFilterLabel">Filter</span>
                    </button>

                    <div id="taskFilterMenu" class="box-border hidden absolute top-[34px] left-0 z-20 min-w-[220px] p-2 bg-white border border-[#E6E6E6] rounded-lg shadow-lg">
                        <button type="button" onclick="setTaskFilter('all')" class="box-border w-full px-3 py-[10px] border-0 rounded-md bg-transparent text-left text-[#777777] text-sm font-bold cursor-pointer hover:bg-gray-50">Semua Tugas</button>
                        <button type="button" onclick="setTaskFilter('unfinished')" class="box-border w-full px-3 py-[10px] border-0 rounded-md bg-transparent text-left text-[#777777] text-sm font-bold cursor-pointer hover:bg-gray-50">Tugas Belum Selesai</button>
                        <button type="button" onclick="setTaskFilter('finished')" class="box-border w-full px-3 py-[10px] border-0 rounded-md bg-transparent text-left text-[#777777] text-sm font-bold cursor-pointer hover:bg-gray-50">Tugas Selesai</button>
                    </div>
                </div>
            </div>

            <section id="task-pending-section" data-task-section="unfinished">
                <div class="box-border bg-white border border-[#E6E6E6] rounded-2xl px-7 py-[26px] shadow-sm">
                    <h2 class="box-border m-0 mb-6 text-2xl leading-[1.2] font-extrabold text-black">Daftar Tugas Belum Selesai</h2>

                    <div class="box-border flex flex-col gap-5">
                            <div class="box-border px-5 py-[18px] min-h-[82px] bg-white border border-[#E6E6E6] rounded-lg flex flex-col justify-center hover:shadow-md transition-shadow">
                                <p class="box-border m-0 mb-3 text-[15px] leading-[1.35] font-extrabold text-black">Slicing UI Dashboard</p>
                                <p class="box-border m-0 text-[13px] leading-[1.35] font-medium text-[#969696]">Ihza Dzikrullah | Tim A | Deadline: 1 Mei 2026</p>
                            </div>
                            <div class="box-border px-5 py-[18px] min-h-[82px] bg-white border border-[#E6E6E6] rounded-lg flex flex-col justify-center hover:shadow-md transition-shadow">
                                <p class="box-border m-0 mb-3 text-[15px] leading-[1.35] font-extrabold text-black">Integrasi API Login</p>
                                <p class="box-border m-0 text-[13px] leading-[1.35] font-medium text-[#969696]">Budi Santoso | Tim B | Deadline: 15 Mei 2026</p>
                            </div>
                    </div>
                </div>
            </section>

            <section id="task-done-section" data-task-section="finished">
                <div class="box-border bg-white border border-[#E6E6E6] rounded-2xl px-7 py-[26px] shadow-sm">
                    <h2 class="box-border m-0 mb-6 text-2xl leading-[1.2] font-extrabold text-black">Daftar Tugas Selesai</h2>

                    <div class="box-border flex flex-col gap-5">
                            <div class="box-border px-5 py-[18px] min-h-[82px] bg-white border border-[#E6E6E6] rounded-lg flex flex-col justify-center hover:shadow-md transition-shadow opacity-60">
                                <p class="box-border m-0 mb-3 text-[15px] leading-[1.35] font-extrabold text-black line-through">Setup Environment Laravel</p>
                                <p class="box-border m-0 text-[13px] leading-[1.35] font-medium text-[#969696]">Siti Aminah | Tim C | Diselesaikan pada: 10 Maret 2026</p>
                            </div>
                            <div class="box-border px-5 py-[18px] min-h-[82px] bg-white border border-[#E6E6E6] rounded-lg flex flex-col justify-center hover:shadow-md transition-shadow opacity-60">
                                <p class="box-border m-0 mb-3 text-[15px] leading-[1.35] font-extrabold text-black line-through">Wireframe Halaman Login</p>
                                <p class="box-border m-0 text-[13px] leading-[1.35] font-medium text-[#969696]">Ihza Dzikrullah | Tim A | Diselesaikan pada: 20 Maret 2026</p>
                            </div>
                    </div>
                </div>
            </section>

        </main>
@endsection