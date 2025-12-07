<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Usulan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="POST" action="{{ route('pokir.store') }}" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Detail Usulan</h3>
                        </div>

                        <div>
                            <x-input-label for="kategori" value="Kategori Usulan" />
                            <select id="kategori" name="kategori_usulan" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
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
                            <x-input-label for="spesifikasi" value="Spesifikasi (Opsional)" />
                            <x-text-input id="spesifikasi" name="spesifikasi" class="mt-1 block w-full" placeholder="Cth: KIOS / Bengkel" />
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label for="opd" value="OPD Tujuan" />
                            <select id="opd" name="opd_tujuan" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">-- Pilih OPD --</option>
                                <option value="Dinas Koperindag">Dinas Koperindag</option>
                                <option value="Dinas PUPR">Dinas PUPR</option>
                                <option value="Dinas Pertanian">Dinas Pertanian</option>
                                <option value="Dinas Sosial">Dinas Sosial</option>
                                <option value="Dinas Pendidikan">Dinas Pendidikan</option>
                            </select>
                        </div>

                        <div class="md:col-span-2 mt-4">
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Data Pemohon</h3>
                        </div>

                        <div>
                            <x-input-label for="pemohon" value="Nama Pemohon" />
                            <x-text-input id="pemohon" name="nama_pemohon" class="mt-1 block w-full" required />
                        </div>
                        <div>
                            <x-input-label for="identitas" value="Identitas (NIK/HP)" />
                            <x-text-input id="identitas" name="identitas_pemohon" class="mt-1 block w-full" />
                        </div>
                        <div class="md:col-span-2">
                            <x-input-label for="alamat" value="Alamat Lengkap" />
                            <textarea id="alamat" name="alamat" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="2" required></textarea>
                        </div>

                        <div class="md:col-span-2 mt-4">
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Data Internal</h3>
                        </div>

                        <div>
                            <x-input-label for="aleg" value="Anggota DPRD Pengusul" />
                            <x-text-input id="aleg" name="anggota_dprd" class="mt-1 block w-full" required />
                        </div>
                        <div>
                            <x-input-label for="berkas" value="Ket Berkas" />
                            <x-text-input id="berkas" name="status_berkas" class="mt-1 block w-full" placeholder="Cth: 1 Bundel" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4 mt-6 border-t pt-4">
                        <a href="{{ route('pokir.index') }}" class="text-gray-600 hover:text-gray-900">Batal</a>
                        <x-primary-button>{{ __('Simpan Data') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>