@extends('admin.layouts.app')

@section('content')
        {{-- ========================== MAIN CONTENT ========================== --}}
    <main class="flex-1 px-4 sm:px-6 lg:px-8 pb-6 space-y-6">
        @if(session('success'))
            <div id="successAlert" class="mb-4 box-border bg-[#DEF7EC] border border-[#31C48D] text-[#03543F] px-4 py-3 rounded-lg relative" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="document.getElementById('successAlert').style.display='none'">
                    <svg class="fill-current h-6 w-6 text-[#03543F]" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
        @endif

        @if($errors->any())
            <div id="errorAlert" class="mb-4 box-border bg-[#FDE8E8] border border-[#F98080] text-[#9B1C1C] px-4 py-3 rounded-lg relative" role="alert">
                <strong class="font-bold">Gagal!</strong>
                <span class="block sm:inline">{{ $errors->first() }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="document.getElementById('errorAlert').style.display='none'">
                    <svg class="fill-current h-6 w-6 text-[#9B1C1C]" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
        @endif

            <section class="box-border grid grid-cols-2 gap-6 mb-[22px]">
                <button type="button" onclick="openAddAccountModal()" class="box-border cursor-pointer min-h-[80px] px-7 py-6 border border-[#E6E6E6] shadow-sm rounded-2xl bg-white hover:bg-gray-50 transition-colors flex items-center text-[#000000] text-[22px] leading-[1.2] font-extrabold no-underline">Tambah Akun</button>
                <button type="button" onclick="openEditAccountModal()" class="box-border cursor-pointer min-h-[80px] px-7 py-6 border border-[#E6E6E6] shadow-sm rounded-2xl bg-white hover:bg-gray-50 transition-colors flex items-center text-[#000000] text-[22px] leading-[1.2] font-extrabold no-underline">Edit Data Akun</button>
            </section>

<!-- Modal Background -->
<div id="addAccountModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <!-- Modal Content -->
    <div class="bg-white rounded-2xl w-full max-w-md p-6 relative">
        <button onclick="closeAddAccountModal()" class="absolute top-4 right-4 text-gray-500 hover:text-black">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <h2 class="text-xl font-extrabold mb-5 text-black">Tambah Akun</h2>
        <form action="{{ route('admin.manageRole.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                <p class="text-xs text-gray-500 mt-1">Kosongkan jika akun sudah terdaftar</p>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Hak Akses (Role)</label>
                <select name="role" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" required>
                    <option value="" disabled selected>Pilih Role...</option>
                    @foreach(\App\Models\Role::where('role_name', '!=', 'superadmin')->get() as $role)
                        <option value="{{ $role->id_role }}">{{ ucfirst(str_replace('_', ' ', $role->role_name)) }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="w-full bg-[#2F8F4E] hover:bg-[#26703c] text-white font-semibold py-3 rounded-lg transition-colors cursor-pointer">Tambah Akun</button>
        </form>
    </div>
</div>

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
                            @forelse ($users as $user)
                            <tr class="border-b border-[#E6E6E6] hover:bg-gray-50 transition-colors">
                                <td class="box-border px-6 py-[18px] text-[#111827] text-sm leading-[1.35] font-semibold">{{ $user['name'] }}</td>
                                <td class="box-border px-6 py-[18px] text-[#4B5563] text-sm leading-[1.35]">{{ $user['nim'] }}</td>
                                <td class="box-border px-6 py-[18px] text-[#4B5563] text-sm leading-[1.35]">{{ $user['prodi'] }}</td>
                                <td class="box-border px-6 py-[18px] text-[#4B5563] text-sm leading-[1.35]">{{ $user['fakultas'] }}</td>
                                <td class="box-border px-6 py-[18px] text-[#4B5563] text-sm leading-[1.35]">{{ $user['divisi'] }}</td>
                                <td class="box-border px-6 py-[18px] text-[#4B5563] text-sm leading-[1.35]">{{ $user['tim'] }}</td>
                                <td class="box-border px-6 py-[18px] text-center text-[#4B5563] text-sm leading-[1.35]">
                                    {{ $user['no_hp'] }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="box-border h-[260px] p-0 text-center text-gray-500">Tidak ada pengguna ditemukan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

<!-- Edit Account Modal -->
<div id="editAccountModal" class="fixed inset-0 z-50 flex items-start justify-center hidden bg-black bg-opacity-50 pt-10">
    <div id="editModalContent" class="bg-white rounded-2xl w-full max-w-2xl p-6 relative max-h-[90vh]">
        <button onclick="closeEditAccountModal()" class="absolute top-4 right-4 text-gray-500 hover:text-black cursor-pointer">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <h2 class="text-xl font-extrabold mb-5 text-black">Edit Data Akun</h2>
        <form action="{{ route('admin.manageRole.update') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Pengguna</label>
                <select id="editUserSelect" name="id_user" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" required onchange="populateEditForm(this.value)">
                    <option value="" disabled selected>Pilih Pengguna yang ingin diedit...</option>
                    @foreach($users as $user)
                        <option value="{{ $user['id_user'] }}">{{ $user['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div id="editFormFields" class="hidden">
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" id="edit_name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Username GitHub</label>
                        <input type="text" id="edit_username_github" name="username_github" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
                        <input type="password" id="edit_password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah password</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">NIM</label>
                        <input type="text" id="edit_nim" name="nim" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Prodi</label>
                        <input type="text" id="edit_prodi" name="prodi" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Fakultas</label>
                        <input type="text" id="edit_fakultas" name="fakultas" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">No HP</label>
                        <input type="text" id="edit_no_hp" name="no_hp" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Divisi</label>
                        <select id="edit_division_id" name="division_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            <option value="">Tidak ada Divisi</option>
                            @foreach($divisions as $division)
                                <option value="{{ $division->id_division }}">{{ $division->division_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tim</label>
                        <select id="edit_team_id" name="team_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            <option value="">Tidak ada Tim</option>
                            @foreach($teams as $team)
                                <option value="{{ $team->id_team }}">{{ $team->team_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6 col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Hak Akses (Role)</label>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach($rolesList as $role)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="roles[]" value="{{ $role->id_role }}" class="edit-role-checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">{{ ucfirst(str_replace('_', ' ', $role->role_name)) }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="flex gap-4">
                    <button type="submit" class="w-full bg-[#008CFF] hover:bg-[#0070cc] text-white font-semibold py-3 rounded-lg transition-colors cursor-pointer">Simpan Perubahan</button>
                    <button type="button" onclick="confirmDeleteAccount()" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-lg transition-colors cursor-pointer">Hapus Akun</button>
                </div>
            </div>
        </form>

        <form id="deleteAccountForm" action="{{ route('admin.manageRole.destroy') }}" method="POST" class="hidden">
            @csrf
            <input type="hidden" name="id_user" id="delete_id_user">
        </form>
    </div>
</div>

<script>
    const usersData = @json($users);

    function openAddAccountModal() {
        document.getElementById('addAccountModal').classList.remove('hidden');
    }
    function closeAddAccountModal() {
        document.getElementById('addAccountModal').classList.add('hidden');
    }

    function openEditAccountModal() {
        document.getElementById('editAccountModal').classList.remove('hidden');
        document.getElementById('editAccountModal').classList.remove('items-center');
        document.getElementById('editAccountModal').classList.add('items-start', 'pt-10');
        document.getElementById('editUserSelect').value = '';
        document.getElementById('editFormFields').classList.add('hidden');
        document.getElementById('editModalContent').classList.remove('overflow-y-auto');
    }
    function closeEditAccountModal() {
        document.getElementById('editAccountModal').classList.add('hidden');
    }

    function populateEditForm(userId) {
        if (!userId) return;
        
        const user = usersData.find(u => u.id_user == userId);
        if (user) {
            document.getElementById('edit_name').value = user.name || '';
            document.getElementById('edit_username_github').value = user.username_github || '';
            document.getElementById('edit_nim').value = (user.nim !== '-' ? user.nim : '');
            document.getElementById('edit_prodi').value = (user.prodi !== '-' ? user.prodi : '');
            document.getElementById('edit_fakultas').value = (user.fakultas !== '-' ? user.fakultas : '');
            document.getElementById('edit_no_hp').value = (user.no_hp !== '-' ? user.no_hp : '');
            document.getElementById('edit_division_id').value = user.divisi_id || '';
            document.getElementById('edit_team_id').value = user.tim_id || '';
            document.getElementById('edit_password').value = ''; // Always empty

            // Populate roles checkboxes
            const roleCheckboxes = document.querySelectorAll('.edit-role-checkbox');
            roleCheckboxes.forEach(cb => {
                cb.checked = user.roles && user.roles.includes(parseInt(cb.value));
            });

            document.getElementById('delete_id_user').value = userId;

            document.getElementById('editFormFields').classList.remove('hidden');
            document.getElementById('editModalContent').classList.add('overflow-y-auto');
            document.getElementById('editAccountModal').classList.remove('items-start', 'pt-10');
            document.getElementById('editAccountModal').classList.add('items-center');
        }
    }

    function confirmDeleteAccount() {
        if (confirm('Apakah Anda yakin ingin menghapus akun ini? Tindakan ini tidak dapat dibatalkan.')) {
            document.getElementById('deleteAccountForm').submit();
        }
    }
</script>
@endsection