<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight border-l-4 border-yellow-500 pl-4">
            {{ __('Manajemen User') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ showModal: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Card Header & Button Tambah -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-yellow-50 px-6 py-4 border-b border-yellow-100 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-yellow-200 text-yellow-700 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Daftar Pengguna Sistem</h3>
                            <p class="text-xs text-yellow-700 font-medium">Kelola hak akses pengguna aplikasi E-POKIR</p>
                        </div>
                    </div>

                    <button @click="showModal = true" type="button"
                        class="flex items-center gap-2 px-5 py-2.5 bg-yellow-500 text-white text-sm font-bold rounded-lg hover:bg-yellow-600 shadow-md transition transform hover:-translate-y-0.5">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                            </path>
                        </svg>
                        Tambah User Baru
                    </button>
                </div>

                <!-- Tampilan Error Validasi (jika ada) -->
                @if ($errors->any())
                    <div class="p-6 bg-red-50 border-b border-red-150 text-red-800 text-sm">
                        <div class="font-bold mb-2">Mohon perbaiki kesalahan berikut:</div>
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Tabel User -->
                <div class="p-6 overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-gray-700 uppercase bg-yellow-50 border-b border-yellow-100">
                            <tr>
                                <th class="px-6 py-3 w-12 text-center">No</th>
                                <th class="px-6 py-3">Nama</th>
                                <th class="px-6 py-3">Email</th>
                                <th class="px-6 py-3 text-center">Role / Hak Akses</th>
                                <th class="px-6 py-3">Tanggal Dibuat</th>
                                <th class="px-6 py-3 text-center w-28">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($users as $index => $u)
                                <tr class="hover:bg-yellow-50/30 transition duration-150">
                                    <td class="px-6 py-4 text-center">{{ $index + $users->firstItem() }}</td>
                                    <td class="px-6 py-4 font-semibold text-gray-900">{{ $u->name }}</td>
                                    <td class="px-6 py-4">{{ $u->email }}</td>
                                    <td class="px-6 py-4 text-center">
                                        @if($u->role === 'admin')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800 border border-yellow-250">
                                                Admin (Full Access)
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-800 border border-gray-300">
                                                Read-Only (Hanya Baca)
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-gray-500">{{ $u->created_at->format('d M Y H:i') }}</td>
                                    <td class="px-6 py-4 text-center">
                                        @if($u->id !== auth()->user()->id)
                                            <form action="{{ route('users.destroy', $u->id) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="button" 
                                                    onclick="confirmDelete(this, 'Hapus user {{ $u->name }} dari sistem?')"
                                                    class="text-red-500 hover:text-red-700 p-1.5 rounded-lg hover:bg-red-50 transition"
                                                    title="Hapus User">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-xs text-gray-400 italic">Akun Anda</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-gray-400">
                                        Tidak ada data user.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($users->hasPages())
                    <div class="px-6 py-4 border-t border-gray-150">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>

        </div>

        <!-- Modal Tambah User -->
        <div x-show="showModal" style="display: none;"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-65 backdrop-blur-sm px-4"
            x-transition>
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-0 relative overflow-hidden">
                <div class="bg-yellow-400 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-white">Tambah Pengguna Baru</h3>
                    <button @click="showModal = false" class="text-yellow-100 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="p-6">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="name" placeholder="Masukkan nama lengkap" required
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Alamat Email</label>
                                <input type="email" name="email" placeholder="contoh@domain.com" required
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Role / Hak Akses</label>
                                <select name="role" required
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                                    <option value="admin">Admin (Full Access - Tambah, Edit, Hapus)</option>
                                    <option value="read-only">Read-Only (Hanya Baca)</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Password</label>
                                <input type="password" name="password" required placeholder="Minimal 8 karakter"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" required placeholder="Ulangi password"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end gap-3">
                            <button @click="showModal = false" type="button"
                                class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 font-medium">Batal</button>
                            <button type="submit"
                                class="px-5 py-2.5 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 font-bold shadow-md">
                                Tambah User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
