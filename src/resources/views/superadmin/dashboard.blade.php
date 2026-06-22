@extends('superadmin.layouts.app')

@section('content')
    {{-- ========================== MAIN CONTENT ========================== --}}
        <main class="flex-1 px-4 sm:px-6 lg:px-8 pb-6 space-y-6">

            {{-- ========== USER INFO SECTION ========== --}}
            <section id="user-info-section">
                <div class="bg-white rounded-xl border border-[#E6E6E6] p-5 sm:p-6">
                    <h1 class="text-lg font-bold text-gray-900 mb-4">User Info</h1>

                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

                        {{-- Card 1: Total user --}}
                        <div class="flex items-center gap-4 rounded-lg border border-[#E6E6E6] bg-white p-4 sm:p-5 hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 rounded-full bg-blue-100 text-[#008CFF] flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v1.2c0 .7.5 1.2 1.2 1.2h16.8c.7 0 1.2-.5 1.2-1.2v-1.2c0-3.2-6.4-4.8-9.6-4.8z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-[#969696] font-medium">Total user</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $totalUsers }}</p>
                            </div>
                        </div>

                        {{-- Card 2: Teams --}}
                        <div class="flex items-center gap-4 rounded-lg border border-[#E6E6E6] bg-white p-4 sm:p-5 hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 rounded-full bg-pink-100 text-pink-500 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-[#969696] font-medium">Teams</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $totalTeams }}</p>
                            </div>
                        </div>

                        {{-- Card 3: Online --}}
                        <div class="flex items-center gap-4 rounded-lg border border-[#E6E6E6] bg-white p-4 sm:p-5 hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 rounded-full bg-green-100 text-green-500 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-[#969696] font-medium">Online</p>
                                <p class="text-2xl font-bold text-green-500">{{ $onlineUsers }}</p>
                            </div>
                        </div>

                        {{-- Card 4: Pending --}}
                        <div class="flex items-center gap-4 rounded-lg border border-[#E6E6E6] bg-white p-4 sm:p-5 hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 rounded-full bg-gray-100 text-[#969696] flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M6 2v6h.01L6 8.01 10 12 6 16l.01.01H6V22h12v-5.99h-.01L18 16l-4-4 4-3.99-.01-.01H18V2H6zm10 14.5V20H8v-3.5l4-4 4 4zm-4-5l-4-4V4h8v3.5l-4 4z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-[#969696] font-medium">Pending</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $pendingUsers }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            {{-- ========== ASSIGNED ROLES SECTION ========== --}}
            <section id="assigned-roles-section">
                <div class="bg-white rounded-xl border border-[#E6E6E6] p-5 sm:p-6">
                    <h1 class="text-lg font-bold text-gray-900 mb-4">Assigned roles</h1>

                    {{-- Responsive Table Wrapper --}}
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-[#E6E6E6]">
                                    <th class="px-4 py-3 text-xs font-semibold text-[#969696] uppercase tracking-wider">Roles</th>
                                    <th class="px-4 py-3 text-xs font-semibold text-[#969696] uppercase tracking-wider">Assigned user</th>
                                    <th class="px-4 py-3 text-xs font-semibold text-[#969696] uppercase tracking-wider">Last Modified</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                <tr class="border-b border-[#E6E6E6] hover:bg-[#F5F7FA]/50 transition-colors last:border-0">
                                    <td class="px-4 py-3 text-sm font-bold text-gray-900">{{ \App\Models\Role::label($role->role_name) }}</td>
                                    <td class="px-4 py-3 text-sm text-[#969696]">{{ $role->users_count }}</td>
                                    <td class="px-4 py-3 text-sm text-[#969696]">{{ $role->updated_at ? \Carbon\Carbon::parse($role->updated_at)->format('d F Y') : '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

        </main>
@endsection