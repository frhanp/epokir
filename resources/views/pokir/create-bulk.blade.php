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

                <div class="p-6 bg-white shadow-sm sm:rounded-lg mb-6 border-l-4 border-indigo-600">
                    <div class="flex items-center justify-between mb-5 border-b pb-2">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5 text-indigo-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                            1. Data Umum (Header)
                        </h3>
                        <span class="text-xs font-medium text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                            Data ini akan diterapkan ke semua usulan di bawah
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div>
                            <x-input-label value="Kategori Usulan" class="mb-1" />
                            <div class="relative">
                                <select name="kategori_usulan"
                                    class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm"
                                    required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($kategoris as $kat)
                                        <option value="{{ $kat->nama_kategori }}">{{ $kat->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <x-input-label value="OPD Tujuan" class="mb-1" />
                            <select name="opd_tujuan"
                                class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm"
                                required>
                                <option value="">-- Pilih OPD --</option>
                                @foreach ($opds as $opd)
                                    <option value="{{ $opd->nama_dinas }}">{{ $opd->nama_dinas }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label value="Anggota DPRD Pengusul" class="mb-1" />
                            <select name="anggota_dprd"
                                class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm"
                                required>
                                <option value="">-- Pilih Aleg --</option>
                                @foreach ($alegs as $aleg)
                                    <option value="{{ $aleg->nama }}">{{ $aleg->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label value="Penerima (Operator)" class="mb-1" />
                            <x-text-input name="operator_penerima"
                                class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm"
                                placeholder="Nama Operator (Opsional)" />
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-white shadow sm:rounded-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-900">2. Daftar Usulan (Detail)</h3>
                        <button type="button" @click="addRow()"
                            class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 text-sm font-bold">
                            + Tambah Baris
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase w-48">
                                        Spesifikasi (Judul Kecil)</th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama
                                        Pemohon *</th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase">NIK / HP
                                    </th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase w-64">
                                        Alamat *</th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase">Ket
                                        Berkas</th>
                                    <th class="px-2 py-2"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <template x-for="(row, index) in rows" :key="index">
                                    <tr>
                                        <td class="px-2 py-2 text-center" x-text="index + 1"></td>

                                        <td class="px-2 py-2">
                                            <input type="text" :name="'details[' + index + '][spesifikasi]'"
                                                class="w-full text-sm border-gray-300 rounded-md shadow-sm"
                                                placeholder="Cth: KIOS">
                                        </td>

                                        <td class="px-2 py-2">
                                            <input type="text" :name="'details[' + index + '][nama_pemohon]'"
                                                class="w-full text-sm border-gray-300 rounded-md shadow-sm" required>
                                        </td>

                                        <td class="px-2 py-2">
                                            <input type="text" :name="'details[' + index + '][identitas_pemohon]'"
                                                class="w-full text-sm border-gray-300 rounded-md shadow-sm">
                                        </td>

                                        <td class="px-2 py-2">
                                            <input type="text" :name="'details[' + index + '][alamat]'"
                                                class="w-full text-sm border-gray-300 rounded-md shadow-sm" required>
                                        </td>

                                        <td class="px-2 py-2">
                                            <input type="text" :name="'details[' + index + '][status_berkas]'"
                                                class="w-full text-sm border-gray-300 rounded-md shadow-sm"
                                                placeholder="1 Proposal">
                                        </td>

                                        <td class="px-2 py-2 text-center">
                                            <button type="button" @click="removeRow(index)"
                                                class="text-red-600 hover:text-red-900 font-bold">X</button>
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
