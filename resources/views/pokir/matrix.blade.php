<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Matriks Realisasi & Analisis Gap Pokir') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- FILTER PANEL -->
            <div class="p-6 bg-white shadow sm:rounded-lg border border-gray-200">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 8.293A1 1 0 013 7.586V4z"></path>
                    </svg>
                    Filter Matriks Realisasi
                </h3>
                <form method="GET" action="{{ route('pokir.matrix') }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 items-end">
                        <div>
                            <x-input-label value="Pilih Anggota DPRD" />
                            <select name="anggota_dprd" required class="mt-1 block w-full text-sm border-gray-300 rounded-md shadow-sm">
                                @foreach($alegs as $aleg)
                                    <option value="{{ $aleg }}" {{ $selectedAleg == $aleg ? 'selected' : '' }}>{{ $aleg }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label value="Tahun Anggaran" />
                            <select name="tahun_anggaran" required class="mt-1 block w-full text-sm border-gray-300 rounded-md shadow-sm">
                                @foreach($yearsRange as $yr)
                                    <option value="{{ $yr }}" {{ $selectedTahun == $yr ? 'selected' : '' }}>{{ $yr }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label value="Tipe APBD" />
                            <select name="tipe_apbd" required class="mt-1 block w-full text-sm border-gray-300 rounded-md shadow-sm">
                                <option value="Induk" {{ $selectedTipe == 'Induk' ? 'selected' : '' }}>APBD Induk</option>
                                <option value="Perubahan" {{ $selectedTipe == 'Perubahan' ? 'selected' : '' }}>APBD Perubahan</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label value="Filter OPD (Opsional)" />
                            <select name="opd_tujuan" class="mt-1 block w-full text-sm border-gray-300 rounded-md shadow-sm">
                                <option value="">Semua OPD</option>
                                @foreach($opds as $opd)
                                    <option value="{{ $opd }}" {{ request('opd_tujuan') == $opd ? 'selected' : '' }}>{{ $opd }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label value="Pencarian Kegiatan" />
                            <input type="text" name="nama_kegiatan" value="{{ request('nama_kegiatan') }}" placeholder="Contoh: Beasiswa..." 
                                class="mt-1 block w-full text-sm border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end gap-2">
                        <a href="{{ route('pokir.matrix') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-semibold rounded-lg transition">
                            Reset Filter
                        </a>
                        <a href="{{ route('pokir.matrix.export', request()->query()) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 transition shadow-sm h-10">
                            Export Excel
                        </a>
                        <x-primary-button type="submit" class="h-10">Tampilkan Matriks</x-primary-button>
                    </div>
                </form>
            </div>

            <!-- STATS MATRIKS -->
            @php
                $totalTargetVolume = $plans->sum('volume_target');
                $totalTerakomodir = $plans->flatMap->pokirs->where('status_sistem', 'Terakomodir')->count();
                $totalCadangan = $plans->flatMap->pokirs->where('status_sistem', 'Cadangan')->count();
                $totalOrphans = $orphans->count();
                $sisaKuotaGlobal = max(0, $totalTargetVolume - $totalTerakomodir);
            @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-indigo-500">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Target Kuota</p>
                    <h4 class="text-2xl font-bold text-gray-800 mt-1">{{ $totalTargetVolume }} Berkas</h4>
                </div>
                <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-green-500">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Terakomodir</p>
                    <h4 class="text-2xl font-bold text-green-600 mt-1">{{ $totalTerakomodir }} Usulan</h4>
                </div>
                <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-yellow-500">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Cadangan</p>
                    <h4 class="text-2xl font-bold text-yellow-600 mt-1">{{ $totalCadangan }} Usulan</h4>
                </div>
                <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-red-500">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Belum Terpenuhi (Shortage)</p>
                    <h4 class="text-2xl font-bold text-red-600 mt-1">{{ $sisaKuotaGlobal }} Kuota</h4>
                </div>
                <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-gray-500">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Usulan Tanpa Pagu</p>
                    <h4 class="text-2xl font-bold text-gray-700 mt-1">{{ $totalOrphans }} Usulan</h4>
                </div>
            </div>

            <!-- DETAIL MATRIKS PAGU -->
            <div class="bg-white shadow sm:rounded-lg border border-gray-200 overflow-hidden">
                <div class="bg-indigo-50 px-6 py-4 border-b border-indigo-100 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Daftar Pagu Anggaran & Realisasi Usulan</h3>
                        <p class="text-xs text-indigo-700 font-semibold">{{ $selectedAleg }} • Tahun Anggaran {{ $selectedTahun }} ({{ $selectedTipe }})</p>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    @forelse($plans as $plan)
                        @php
                            $linkedPokirs = $plan->pokirs;
                            $terakomodirCount = $linkedPokirs->where('status_sistem', 'Terakomodir')->count();
                            $cadanganCount = $linkedPokirs->where('status_sistem', 'Cadangan')->count();
                            $sisaKuota = max(0, $plan->volume_target - $terakomodirCount);
                        @endphp
                        <div class="border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                            <!-- HEADER PAGU -->
                            <div class="bg-gray-50 px-5 py-4 border-b border-gray-200 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2">
                                        <span class="px-2 py-0.5 text-xs font-bold bg-indigo-100 text-indigo-800 rounded">
                                            {{ $plan->opd_tujuan }}
                                        </span>
                                        <span class="text-sm font-semibold text-gray-500">
                                            Volume Target: {{ $plan->volume_target }} {{ $plan->satuan }}
                                        </span>
                                    </div>
                                    <h4 class="text-base font-bold text-gray-800 leading-snug">
                                        {{ $plan->nama_kegiatan }}
                                    </h4>
                                </div>
                                <div class="flex flex-wrap items-center gap-2 lg:text-right">
                                    <div>
                                        <span class="text-xs text-gray-400 block">Total Pagu</span>
                                        <span class="text-sm font-extrabold text-yellow-600">Rp {{ number_format($plan->pagu_total, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="border-l pl-3 ml-1">
                                        <span class="text-xs text-gray-400 block">Status Penyerapan</span>
                                        @if($sisaKuota == 0)
                                            <span class="px-2.5 py-1 text-xs font-bold bg-green-100 text-green-800 rounded-full flex items-center gap-1">
                                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Lengkap
                                            </span>
                                        @elseif($terakomodirCount > 0)
                                            <span class="px-2.5 py-1 text-xs font-bold bg-yellow-100 text-yellow-800 rounded-full flex items-center gap-1">
                                                <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span> Terserap Sebagian (Sisa {{ $sisaKuota }})
                                            </span>
                                        @else
                                            <span class="px-2.5 py-1 text-xs font-bold bg-red-100 text-red-800 rounded-full flex items-center gap-1">
                                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Belum Terserap (Butuh {{ $plan->volume_target }})
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- REALISASI USULAN WARGA -->
                            <div class="p-4 bg-white">
                                <h5 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Daftar Usulan Warga Terhubung (Realisasi):</h5>
                                @if($linkedPokirs->count() > 0)
                                    <div class="overflow-x-auto">
                                        <table class="w-full text-xs text-left text-gray-600">
                                            <thead class="bg-gray-50 text-gray-500 uppercase text-[10px] tracking-wider">
                                                <tr>
                                                    <th class="px-4 py-2 w-10 text-center">No</th>
                                                    <th class="px-4 py-2">Judul Permohonan</th>
                                                    <th class="px-4 py-2">Pemohon & Alamat</th>
                                                    <th class="px-4 py-2 text-center">Tanggal Penerimaan</th>
                                                    <th class="px-4 py-2 text-center w-36">Status Sistem</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-100">
                                                @foreach($linkedPokirs as $idx => $pokir)
                                                    <tr class="hover:bg-gray-50">
                                                        <td class="px-4 py-2.5 text-center text-gray-400 font-medium">{{ $idx + 1 }}</td>
                                                        <td class="px-4 py-2.5 font-bold text-gray-800">{{ $pokir->kategori_usulan }}</td>
                                                        <td class="px-4 py-2.5">
                                                            <div class="font-medium text-gray-700">{{ $pokir->nama_pemohon }}</div>
                                                            <div class="text-[10px] text-gray-400">{{ $pokir->alamat }}</div>
                                                        </td>
                                                        <td class="px-4 py-2.5 text-center text-gray-500">
                                                            {{ $pokir->tanggal_penerimaan ? date('d-m-Y', strtotime($pokir->tanggal_penerimaan)) : '-' }}
                                                        </td>
                                                        <td class="px-4 py-2.5 text-center">
                                                            @if($pokir->status_sistem == 'Terakomodir')
                                                                <span class="px-2 py-0.5 font-bold rounded-full bg-green-100 text-green-800">Terakomodir</span>
                                                            @else
                                                                <span class="px-2 py-0.5 font-bold rounded-full bg-yellow-100 text-yellow-800">Cadangan (Kelebihan)</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="p-4 bg-red-50 text-red-700 text-xs rounded-lg font-medium flex items-center gap-2">
                                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                        </svg>
                                        Matriks Gap: Belum ada usulan warga yang terakomodir untuk program pagu ini. (Kekurangan {{ $plan->volume_target }} berkas).
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center text-gray-500">
                            Tidak ada rencana kerja/master pagu yang sesuai dengan filter pencarian Anda.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- USULAN TANPA PAGU (GAP/LEBIH) -->
            <div class="bg-white shadow sm:rounded-lg border border-gray-200 overflow-hidden">
                <div class="bg-red-50 px-6 py-4 border-b border-red-100">
                    <h3 class="text-lg font-bold text-red-800 flex items-center gap-2">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Usulan Tanpa Pagu (Orphan Proposals / Usulan Baru)
                    </h3>
                    <p class="text-xs text-red-700 font-medium">Usulan berikut terdaftar untuk Anggota DPRD {{ $selectedAleg }} tetapi tidak memiliki Master Pagu (Rencana Kerja) yang sesuai untuk Tahun & Tipe APBD ini.</p>
                </div>

                <div class="p-6">
                    @if($orphans->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-xs text-left text-gray-600">
                                <thead class="bg-gray-50 text-gray-500 uppercase">
                                    <tr>
                                        <th class="px-4 py-3 w-10 text-center">No</th>
                                        <th class="px-4 py-3">Dinas Terkait (OPD)</th>
                                        <th class="px-4 py-3">Judul Usulan</th>
                                        <th class="px-4 py-3">Nama Pemohon & Alamat</th>
                                        <th class="px-4 py-3 text-center">Tgl Penerimaan</th>
                                        <th class="px-4 py-3 text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($orphans as $idx => $orphan)
                                        <tr class="hover:bg-red-50/20 transition">
                                            <td class="px-4 py-3 text-center text-gray-400 font-medium">{{ $idx + 1 }}</td>
                                            <td class="px-4 py-3 font-semibold text-indigo-700">{{ $orphan->opd_tujuan }}</td>
                                            <td class="px-4 py-3 font-bold text-gray-800">{{ $orphan->kategori_usulan }}</td>
                                            <td class="px-4 py-3">
                                                <div class="font-medium text-gray-700">{{ $orphan->nama_pemohon }}</div>
                                                <div class="text-[10px] text-gray-400">{{ $orphan->alamat }}</div>
                                            </td>
                                            <td class="px-4 py-3 text-center text-gray-500">
                                                {{ $orphan->tanggal_penerimaan ? date('d-m-Y', strtotime($orphan->tanggal_penerimaan)) : '-' }}
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                <span class="px-2.5 py-1 text-[10px] font-bold bg-gray-100 text-gray-700 rounded-full border border-gray-300">
                                                    {{ $orphan->status_sistem }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-6 text-center text-green-700 bg-green-50 rounded-xl font-semibold text-sm flex items-center justify-center gap-2">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Hebat! Tidak ada usulan tanpa pagu. Semua berkas usulan terpetakan pada Master Pagu yang tersedia.
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
