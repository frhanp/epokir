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
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 items-end">
                        
                        <div>
                            <x-input-label value="Filter Kategori" />
                            <select name="kategori_usulan" class="mt-1 block w-full text-sm border-gray-300 rounded-md shadow-sm">
                                <option value="">Semua Kategori</option>
                                @foreach($kategoris as $kat)
                                    <option value="{{ $kat }}" {{ request('kategori_usulan') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label value="Filter OPD" />
                            <select name="opd_tujuan" class="mt-1 block w-full text-sm border-gray-300 rounded-md shadow-sm">
                                <option value="">Semua OPD</option>
                                @foreach($opds as $opd)
                                    <option value="{{ $opd }}" {{ request('opd_tujuan') == $opd ? 'selected' : '' }}>{{ $opd }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label value="Filter Aleg" />
                            <select name="anggota_dprd" class="mt-1 block w-full text-sm border-gray-300 rounded-md shadow-sm">
                                <option value="">Semua Aleg</option>
                                @foreach($alegs as $aleg)
                                    <option value="{{ $aleg }}" {{ request('anggota_dprd') == $aleg ? 'selected' : '' }}>{{ $aleg }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label value="Tahun Anggaran" />
                            <select name="tahun_anggaran" class="mt-1 block w-full text-sm border-gray-300 rounded-md shadow-sm">
                                <option value="">Semua Tahun</option>
                                @foreach($yearsRange as $yr)
                                    <option value="{{ $yr }}" {{ request('tahun_anggaran') == $yr ? 'selected' : '' }}>{{ $yr }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label value="Tipe APBD" />
                            <select name="tipe_apbd" class="mt-1 block w-full text-sm border-gray-300 rounded-md shadow-sm">
                                <option value="">Semua Tipe</option>
                                <option value="Induk" {{ request('tipe_apbd') == 'Induk' ? 'selected' : '' }}>APBD Induk</option>
                                <option value="Perubahan" {{ request('tipe_apbd') == 'Perubahan' ? 'selected' : '' }}>APBD Perubahan</option>
                            </select>
                        </div>

                        <div class="pb-0.5">
                            <x-primary-button type="submit" class="h-10 w-full flex justify-center">Cari / Filter</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>

            @if(!auth()->user()->isReadOnly())
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div
                    class="bg-indigo-50 px-6 py-4 border-b border-indigo-100 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-indigo-200 text-indigo-700 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Database Berkas Usulan</h3>
                            <p class="text-xs text-indigo-700 font-medium">Upload File Excel Usulan (.xlsx)</p>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <form action="{{ route('pokir.import') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih File Excel Usulan</label>
                                <input type="file" name="file_excel" required
                                    class="block w-full text-sm text-gray-500
                                          file:mr-4 file:py-2 file:px-3
                                          file:rounded-lg file:border-0
                                          file:text-sm file:font-bold
                                          file:bg-indigo-100 file:text-indigo-800
                                          hover:file:bg-indigo-200 transition cursor-pointer border border-gray-300 rounded-lg p-1">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Penerimaan</label>
                                <input type="date" name="tanggal_penerimaan" value="{{ date('Y-m-d') }}" required
                                    class="block w-full text-sm border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun Anggaran</label>
                                <select name="tahun_anggaran" required
                                    class="block w-full text-sm border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="2026" selected>2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe APBD</label>
                                <select name="tipe_apbd" required
                                    class="block w-full text-sm border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="Induk" selected>APBD Induk</option>
                                    <option value="Perubahan">APBD Perubahan</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                            <div class="md:col-span-3">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Keterangan / Catatan Upload</label>
                                <input type="text" name="keterangan_upload" placeholder="Contoh: Penyerahan Beasiswa Gelombang 1"
                                    class="block w-full text-sm border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div class="md:col-span-1">
                                <button type="submit"
                                    class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-bold shadow-md transition w-full flex justify-center items-center gap-2 h-10">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                    </svg>
                                    PROSES IMPORT
                                </button>
                            </div>
                        </div>
                    </form>
                    <p class="text-xs text-gray-400 mt-3 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Format kolom wajib: No, Judul Permohonan, Alamat, Yang Bermohon, Identitas, Anggota DPRD Pengusul, Ket Berkas, Ket Penerima, Dinas Terkait.
                    </p>
                </div>
            </div>
            @endif

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

                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul & Alamat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemohon</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penyerahan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aleg & OPD</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status Berkas</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status Sistem</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($pokirs as $index => $pokir)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-gray-500 text-sm">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $pokir->judul_lengkap }}</div>
                                    <div class="text-xs text-gray-500">{{ $pokir->alamat }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <div class="font-semibold">{{ $pokir->nama_pemohon }}</div>
                                    <div class="text-xs text-gray-400">{{ $pokir->identitas_pemohon ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-600 space-y-1">
                                    <div>Tgl: <span class="font-semibold">{{ $pokir->tanggal_penerimaan ? date('d-m-Y', strtotime($pokir->tanggal_penerimaan)) : '-' }}</span></div>
                                    <div>Tipe: <span class="font-bold text-indigo-600">{{ $pokir->tipe_apbd }} {{ $pokir->tahun_anggaran }}</span></div>
                                    @if($pokir->keterangan_upload)
                                        <div class="text-gray-400 italic">"{{ $pokir->keterangan_upload }}"</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <div class="font-semibold text-gray-800">{{ $pokir->anggota_dprd }}</div>
                                    <div class="text-xs text-gray-500">{{ $pokir->opd_tujuan }}</div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $pokir->status_berkas ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($pokir->status_sistem === 'Terakomodir')
                                        <span class="px-2 inline-flex text-xs leading-5 font-bold rounded-full bg-green-100 text-green-800" title="Terakomodir di Master Pagu">
                                            Terakomodir
                                        </span>
                                    @elseif($pokir->status_sistem === 'Cadangan')
                                        <span class="px-2 inline-flex text-xs leading-5 font-bold rounded-full bg-yellow-100 text-yellow-800" title="Kuota Pagu Penuh">
                                            Cadangan
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-bold rounded-full bg-gray-100 text-gray-800" title="Tidak ada Pagu yang cocok">
                                            Usulan Baru
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada data ditemukan.</td>
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