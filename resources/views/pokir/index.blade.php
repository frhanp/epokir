<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar E-POKIR') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 bg-white shadow sm:rounded-lg">
                <form method="GET" action="{{ route('pokir.index') }}">
                    <div class="flex flex-col md:flex-row gap-4 items-end">
                        
                        <div class="w-full md:w-1/4">
                            <x-input-label value="Filter Kategori" />
                            <select name="kategori_usulan" class="mt-1 block w-full text-sm border-gray-300 rounded-md shadow-sm">
                                <option value="">Semua Kategori</option>
                                <option value="Bantuan UMKM" {{ request('kategori_usulan') == 'Bantuan UMKM' ? 'selected' : '' }}>Bantuan UMKM</option>
                                <option value="Bantuan IKM" {{ request('kategori_usulan') == 'Bantuan IKM' ? 'selected' : '' }}>Bantuan IKM</option>
                                <option value="Pembangunan Jalan" {{ request('kategori_usulan') == 'Pembangunan Jalan' ? 'selected' : '' }}>Pembangunan Jalan</option>
                                <option value="Bantuan Pertanian" {{ request('kategori_usulan') == 'Bantuan Pertanian' ? 'selected' : '' }}>Bantuan Pertanian</option>
                            </select>
                        </div>

                        <div class="w-full md:w-1/4">
                            <x-input-label value="Filter OPD" />
                            <select name="opd_tujuan" class="mt-1 block w-full text-sm border-gray-300 rounded-md shadow-sm">
                                <option value="">Semua OPD</option>
                                <option value="Dinas Koperindag" {{ request('opd_tujuan') == 'Dinas Koperindag' ? 'selected' : '' }}>Dinas Koperindag</option>
                                <option value="Dinas PUPR" {{ request('opd_tujuan') == 'Dinas PUPR' ? 'selected' : '' }}>Dinas PUPR</option>
                                <option value="Dinas Pertanian" {{ request('opd_tujuan') == 'Dinas Pertanian' ? 'selected' : '' }}>Dinas Pertanian</option>
                            </select>
                        </div>

                        <div class="w-full md:w-1/4">
                            <x-input-label value="Cari Nama Aleg" />
                            <x-text-input name="anggota_dprd" value="{{ request('anggota_dprd') }}" class="mt-1 block w-full text-sm" placeholder="Nama Aleg..." />
                        </div>

                        <div class="w-full md:w-auto pb-0.5">
                            <x-primary-button type="submit" class="h-10">Cari / Filter</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                <div class="p-4 border-b border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="text-gray-600">
                        Menampilkan <strong>{{ $pokirs->count() }}</strong> data
                        @if(request('kategori_usulan')) <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">Kat: {{ request('kategori_usulan') }}</span> @endif
                        @if(request('opd_tujuan')) <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">OPD: {{ request('opd_tujuan') }}</span> @endif
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('pokir.print', request()->query()) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300">
                            Cetak
                        </a>
                        
                        <a href="{{ route('pokir.export', request()->query()) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500">
                            Excel
                        </a>

                        <a href="{{ route('pokir.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                            + Input Baru
                        </a>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemohon</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aleg</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">OPD</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($pokirs as $index => $pokir)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $pokir->judul_lengkap }}</div>
                                    <div class="text-xs text-gray-500">{{ $pokir->alamat }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $pokir->nama_pemohon }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $pokir->anggota_dprd }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $pokir->opd_tujuan }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $pokir->status_berkas ?? '-' }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data ditemukan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t border-gray-200">
                    {{ $pokirs->withQueryString()->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>