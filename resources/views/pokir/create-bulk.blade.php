<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Massal E-POKIR') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="bulkInput()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <form method="POST" action="{{ route('pokir.storeBulk') }}">
                @csrf

                <div class="p-6 bg-white shadow sm:rounded-lg mb-6 border-l-4 border-indigo-500">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">1. Data Umum (Header)</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <x-input-label value="Kategori Usulan" />
                            <select name="kategori_usulan" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Bantuan UMKM">Bantuan UMKM</option>
                                <option value="Bantuan IKM">Bantuan IKM</option>
                                <option value="Pembangunan Jalan">Pembangunan Jalan</option>
                                <option value="Bantuan Pertanian">Bantuan Pertanian</option>
                                <option value="Bantuan Perikanan">Bantuan Perikanan</option>
                                <option value="Beasiswa Pendidikan">Beasiswa Pendidikan</option>
                            </select>
                        </div>
                        <div>
                            <x-input-label value="OPD Tujuan" />
                            <select name="opd_tujuan" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">-- Pilih OPD --</option>
                                <option value="Dinas Koperindag">Dinas Koperindag</option>
                                <option value="Dinas PUPR">Dinas PUPR</option>
                                <option value="Dinas Pertanian">Dinas Pertanian</option>
                                <option value="Dinas Sosial">Dinas Sosial</option>
                                <option value="Dinas Pendidikan">Dinas Pendidikan</option>
                            </select>
                        </div>
                        <div>
                            <x-input-label value="Anggota DPRD Pengusul" />
                            <x-text-input name="anggota_dprd" class="mt-1 block w-full" placeholder="Nama Aleg..." required />
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-white shadow sm:rounded-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-900">2. Daftar Usulan (Detail)</h3>
                        <button type="button" @click="addRow()" class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 text-sm font-bold">
                            + Tambah Baris
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase w-48">Spesifikasi (Judul Kecil)</th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama Pemohon *</th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase">NIK / HP</th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase w-64">Alamat *</th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase">Ket Berkas</th>
                                    <th class="px-2 py-2"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <template x-for="(row, index) in rows" :key="index">
                                    <tr>
                                        <td class="px-2 py-2 text-center" x-text="index + 1"></td>
                                        
                                        <td class="px-2 py-2">
                                            <input type="text" :name="'details['+index+'][spesifikasi]'" class="w-full text-sm border-gray-300 rounded-md shadow-sm" placeholder="Cth: KIOS">
                                        </td>
                                        
                                        <td class="px-2 py-2">
                                            <input type="text" :name="'details['+index+'][nama_pemohon]'" class="w-full text-sm border-gray-300 rounded-md shadow-sm" required>
                                        </td>

                                        <td class="px-2 py-2">
                                            <input type="text" :name="'details['+index+'][identitas_pemohon]'" class="w-full text-sm border-gray-300 rounded-md shadow-sm">
                                        </td>

                                        <td class="px-2 py-2">
                                            <input type="text" :name="'details['+index+'][alamat]'" class="w-full text-sm border-gray-300 rounded-md shadow-sm" required>
                                        </td>

                                        <td class="px-2 py-2">
                                            <input type="text" :name="'details['+index+'][status_berkas]'" class="w-full text-sm border-gray-300 rounded-md shadow-sm" placeholder="1 Bundel">
                                        </td>

                                        <td class="px-2 py-2 text-center">
                                            <button type="button" @click="removeRow(index)" class="text-red-600 hover:text-red-900 font-bold">X</button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-primary-button class="w-full md:w-auto justify-center py-3 text-base">
                            {{ __('SIMPAN SEMUA DATA') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function bulkInput() {
            return {
                // Inisialisasi 5 baris kosong
                rows: [{}, {}, {}, {}, {}], 
                
                addRow() {
                    this.rows.push({});
                },
                removeRow(index) {
                    if (this.rows.length > 1) {
                        this.rows.splice(index, 1);
                    }
                }
            }
        }
    </script>
</x-app-layout> 