@extends('superadmin.layouts.app')

@section('content')
    {{-- ========================== MAIN CONTENT ========================== --}}
        <main class="box-border flex-1 w-full px-[30px] py-6">
            <section class="box-border grid grid-cols-2 gap-6 mb-[22px]">
                <a href="#" class="box-border min-h-[80px] px-7 py-6 border border-[#E6E6E6] shadow-sm rounded-2xl bg-white flex items-center text-[#000000] text-[22px] leading-[1.2] font-extrabold no-underline">Tambah Akun</a>
                <a href="#" class="box-border min-h-[80px] px-7 py-6 border border-[#E6E6E6] shadow-sm rounded-2xl bg-white flex items-center text-[#000000] text-[22px] leading-[1.2] font-extrabold no-underline">Edit Data Akun</a>
            </section>

            <section class="box-border border border-[#E6E6E6] shadow-sm rounded-2xl bg-white overflow-hidden">
                <div class="box-border px-7 pb-[18px] pt-6">
                    <h1 class="box-border m-0 text-[#000000] text-[22px] leading-[1.2] font-extrabold">Daftar Pengguna</h1>
                </div>

                <div class="box-border min-h-[360px] m-0 border-t border-[#E6E6E6] rounded-[14px] overflow-x-auto">
                    <table class="box-border w-full min-w-[760px] border-collapse">
                        <thead>
                            <tr>
                                <th class="box-border px-6 py-[18px] text-left text-[#767676] text-[13px] leading-[1.2] font-extrabold">Nama Lengkap</th>
                                <th class="box-border px-6 py-[18px] text-left text-[#767676] text-[13px] leading-[1.2] font-extrabold">NIM</th>
                                <th class="box-border px-6 py-[18px] text-left text-[#767676] text-[13px] leading-[1.2] font-extrabold">Prodi</th>
                                <th class="box-border px-6 py-[18px] text-left text-[#767676] text-[13px] leading-[1.2] font-extrabold">Fakultas</th>
                                <th class="box-border px-6 py-[18px] text-left text-[#767676] text-[13px] leading-[1.2] font-extrabold">Divisi</th>
                                <th class="box-border px-6 py-[18px] text-left text-[#767676] text-[13px] leading-[1.2] font-extrabold">Tim</th>
                                <th class="box-border w-[72px] px-6 py-[18px] text-center text-[#111827]">
                                    <svg class="box-border w-5 h-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-label="WhatsApp">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 8.7c.3-.7.5-.8.9-.8h.7c.2 0 .4.1.5.4l.7 1.6c.1.3.1.5-.1.7l-.5.6c.6 1.1 1.5 2 2.7 2.7l.6-.5c.2-.2.5-.2.7-.1l1.6.7c.3.1.4.3.4.5v.7c0 .4-.1.7-.8.9-.5.2-1 .3-1.5.3-3.7 0-7.1-3.4-7.1-7.1 0-.5.1-1 .3-1.5z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9 9 0 1 0-7.8-4.5L3 21l4.6-1.2A9 9 0 0 0 12 21z"/>
                                    </svg>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-[#E6E6E6] hover:bg-gray-50 transition-colors">
                                <td class="box-border px-6 py-4 text-[#111827] text-sm font-semibold">Ihza Dzikrullah</td>
                                <td class="box-border px-6 py-4 text-[#767676] text-sm">M0521028</td>
                                <td class="box-border px-6 py-4 text-[#767676] text-sm">Informatika</td>
                                <td class="box-border px-6 py-4 text-[#767676] text-sm">Fatisda</td>
                                <td class="box-border px-6 py-4 text-[#767676] text-sm">Programming</td>
                                <td class="box-border px-6 py-4 text-[#767676] text-sm">Tim A</td>
                                <td class="box-border w-[72px] px-6 py-4 text-center">
                                    <a href="#" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-green-100 text-green-600 hover:bg-green-200 transition-colors" title="WhatsApp">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 8.7c.3-.7.5-.8.9-.8h.7c.2 0 .4.1.5.4l.7 1.6c.1.3.1.5-.1.7l-.5.6c.6 1.1 1.5 2 2.7 2.7l.6-.5c.2-.2.5-.2.7-.1l1.6.7c.3.1.4.3.4.5v.7c0 .4-.1.7-.8.9-.5.2-1 .3-1.5.3-3.7 0-7.1-3.4-7.1-7.1 0-.5.1-1 .3-1.5z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9 9 0 1 0-7.8-4.5L3 21l4.6-1.2A9 9 0 0 0 12 21z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            <tr class="border-b border-[#E6E6E6] hover:bg-gray-50 transition-colors">
                                <td class="box-border px-6 py-4 text-[#111827] text-sm font-semibold">Budi Santoso</td>
                                <td class="box-border px-6 py-4 text-[#767676] text-sm">M0521015</td>
                                <td class="box-border px-6 py-4 text-[#767676] text-sm">Informatika</td>
                                <td class="box-border px-6 py-4 text-[#767676] text-sm">Fatisda</td>
                                <td class="box-border px-6 py-4 text-[#767676] text-sm">Mekanik</td>
                                <td class="box-border px-6 py-4 text-[#767676] text-sm">Tim B</td>
                                <td class="box-border w-[72px] px-6 py-4 text-center">
                                    <a href="#" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-green-100 text-green-600 hover:bg-green-200 transition-colors" title="WhatsApp">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 8.7c.3-.7.5-.8.9-.8h.7c.2 0 .4.1.5.4l.7 1.6c.1.3.1.5-.1.7l-.5.6c.6 1.1 1.5 2 2.7 2.7l.6-.5c.2-.2.5-.2.7-.1l1.6.7c.3.1.4.3.4.5v.7c0 .4-.1.7-.8.9-.5.2-1 .3-1.5.3-3.7 0-7.1-3.4-7.1-7.1 0-.5.1-1 .3-1.5z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9 9 0 1 0-7.8-4.5L3 21l4.6-1.2A9 9 0 0 0 12 21z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="box-border px-6 py-4 text-[#111827] text-sm font-semibold">Siti Aminah</td>
                                <td class="box-border px-6 py-4 text-[#767676] text-sm">M0521042</td>
                                <td class="box-border px-6 py-4 text-[#767676] text-sm">Informatika</td>
                                <td class="box-border px-6 py-4 text-[#767676] text-sm">Fatisda</td>
                                <td class="box-border px-6 py-4 text-[#767676] text-sm">Elektronika</td>
                                <td class="box-border px-6 py-4 text-[#767676] text-sm">Tim C</td>
                                <td class="box-border w-[72px] px-6 py-4 text-center">
                                    <a href="#" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-green-100 text-green-600 hover:bg-green-200 transition-colors" title="WhatsApp">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 8.7c.3-.7.5-.8.9-.8h.7c.2 0 .4.1.5.4l.7 1.6c.1.3.1.5-.1.7l-.5.6c.6 1.1 1.5 2 2.7 2.7l.6-.5c.2-.2.5-.2.7-.1l1.6.7c.3.1.4.3.4.5v.7c0 .4-.1.7-.8.9-.5.2-1 .3-1.5.3-3.7 0-7.1-3.4-7.1-7.1 0-.5.1-1 .3-1.5z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9 9 0 1 0-7.8-4.5L3 21l4.6-1.2A9 9 0 0 0 12 21z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
@endsection