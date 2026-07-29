<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight border-l-4 border-yellow-500 pl-4">
            {{ __('Master Rencana Kerja (Pagu Indikatif)') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ showModal: false, defaultAleg: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(!auth()->user()->isReadOnly())
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div
                    class="bg-yellow-50 px-6 py-4 border-b border-yellow-100 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-yellow-200 text-yellow-700 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Database Pagu Anggaran</h3>
                            <p class="text-xs text-yellow-700 font-medium">Upload File Excel (.xlsx)</p>
                        </div>
                    </div>

                    <button @click="defaultAleg = ''; showModal = true" type="button"
                        class="flex items-center gap-2 px-5 py-2.5 bg-yellow-500 text-white text-sm font-bold rounded-lg hover:bg-yellow-600 shadow-md transition transform hover:-translate-y-0.5">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Input Manual
                    </button>
                </div>

                <div class="p-6">
                    <form action="{{ route('plans.import') }}" method="POST" enctype="multipart/form-data"
                        class="flex flex-col md:flex-row gap-4 items-end">
                        @csrf
                        <div class="w-full md:w-1/3">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih File Excel Pagu</label>
                            <input type="file" name="file_excel" required
                                class="block w-full text-sm text-gray-500
                                      file:mr-4 file:py-2.5 file:px-4
                                      file:rounded-lg file:border-0
                                      file:text-sm file:font-bold
                                      file:bg-yellow-100 file:text-yellow-800
                                      hover:file:bg-yellow-200 transition cursor-pointer border border-gray-300 rounded-lg">
                        </div>
                        <div class="w-full md:w-1/4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun Anggaran</label>
                            <select name="tahun_anggaran" required
                                class="block w-full text-sm border-gray-300 rounded-lg focus:ring-yellow-500 focus:border-yellow-500">
                                @foreach ($yearsRange as $yr)
                                    <option value="{{ $yr }}" {{ $yr == $selectedTahun ? 'selected' : '' }}>{{ $yr }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full md:w-1/4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe APBD</label>
                            <select name="tipe_apbd" required
                                class="block w-full text-sm border-gray-300 rounded-lg focus:ring-yellow-500 focus:border-yellow-500">
                                <option value="Induk" {{ $selectedTipe == 'Induk' ? 'selected' : '' }}>APBD Induk</option>
                                <option value="Perubahan" {{ $selectedTipe == 'Perubahan' ? 'selected' : '' }}>APBD Perubahan</option>
                            </select>
                        </div>
                        <button type="submit"
                            class="px-6 py-2.5 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 font-bold shadow-md transition w-full md:w-auto flex justify-center items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                            PROSES IMPORT
                        </button>
                    </form>
                    <p class="text-xs text-gray-400 mt-3 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Format kolom wajib: No, Program, Volume, Satuan, Harga, Total, OPD, Aleg.
                    </p>
                </div>
            </div>
            @endif

            <div class="space-y-4">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <h3 class="text-lg font-bold text-gray-800 border-l-4 border-yellow-500 pl-3">Daftar Pagu Tersedia
                        (Per Fraksi/Aleg)</h3>
                    <div class="flex items-center gap-4 flex-wrap">
                        <div class="flex items-center gap-2">
                            <label for="filter-tahun" class="text-sm font-semibold text-gray-700">Tahun:</label>
                            <select id="filter-tahun" onchange="window.location.href = '{{ route('plans.index') }}?tahun=' + this.value + '&tipe={{ $selectedTipe }}'"
                                class="text-sm font-bold bg-yellow-100 text-yellow-800 border-yellow-300 rounded-lg focus:ring-yellow-500 focus:border-yellow-500 px-3 py-1">
                                @foreach ($yearsRange as $yr)
                                    <option value="{{ $yr }}" {{ $yr == $selectedTahun ? 'selected' : '' }}>{{ $yr }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center gap-2">
                            <label for="filter-tipe" class="text-sm font-semibold text-gray-700">Tipe APBD:</label>
                            <select id="filter-tipe" onchange="window.location.href = '{{ route('plans.index') }}?tahun={{ $selectedTahun }}&tipe=' + this.value"
                                class="text-sm font-bold bg-yellow-100 text-yellow-800 border-yellow-300 rounded-lg focus:ring-yellow-500 focus:border-yellow-500 px-3 py-1">
                                <option value="Induk" {{ $selectedTipe == 'Induk' ? 'selected' : '' }}>APBD Induk</option>
                                <option value="Perubahan" {{ $selectedTipe == 'Perubahan' ? 'selected' : '' }}>APBD Perubahan</option>
                            </select>
                        </div>
                    </div>
                </div>

                @forelse($groupedPlans as $alegName => $plans)
                    @php
                        $totalPaguAleg = $plans->sum('pagu_total');
                        $totalPaket = $plans->count();
                    @endphp

                    <details
                        class="group bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 transition-all duration-300">
                        <summary
                            class="flex items-center justify-between cursor-pointer p-5 bg-white hover:bg-yellow-50 transition border-b border-transparent group-open:border-yellow-200">
                            <div class="flex items-center gap-4">
                                <div
                                    class="bg-gray-100 p-2 rounded-full group-open:bg-yellow-200 group-open:text-yellow-800 transition">
                                    <svg class="w-5 h-5 text-gray-500 transition transform group-open:rotate-90 group-open:text-yellow-800"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 text-lg">{{ $alegName }}</h4>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span
                                            class="text-xs font-semibold bg-gray-100 text-gray-600 px-2 py-0.5 rounded">{{ $totalPaket }}
                                            Kegiatan</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-6">
                                <div class="text-right hidden sm:block">
                                    <span class="block text-base font-bold text-yellow-600">
                                        Rp {{ number_format($totalPaguAleg, 0, ',', '.') }}
                                    </span>
                                    <span class="text-xs text-gray-400 uppercase tracking-wider">Total Pagu</span>
                                </div>

                                @if(!auth()->user()->isReadOnly())
                                <form action="{{ route('plans.destroyAleg') }}" method="POST">
                                    @csrf @method('DELETE')
                                    <input type="hidden" name="anggota_dprd" value="{{ $alegName }}">
                                    <input type="hidden" name="tahun_anggaran" value="{{ $selectedTahun }}">
                                    <input type="hidden" name="tipe_apbd" value="{{ $selectedTipe }}">
                                    <button type="button"
                                        onclick="confirmDelete(this, 'Hapus SEMUA data pagu milik {{ $alegName }} untuk tahun {{ $selectedTahun }} ({{ $selectedTipe }})?')"
                                        class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-full transition"
                                        title="Hapus Semua">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </summary>

                        <div class="p-5 border-t border-yellow-100 bg-gray-50/50">

                            @if(!auth()->user()->isReadOnly())
                            <div class="mb-4 flex justify-end">
                                <button @click="defaultAleg = '{{ $alegName }}'; showModal = true" type="button"
                                    class="text-xs flex items-center gap-1 bg-yellow-100 text-yellow-800 px-4 py-2 rounded-lg hover:bg-yellow-200 font-bold border border-yellow-300 transition shadow-sm">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Tambah Kegiatan {{ $alegName }}
                                </button>
                            </div>
                            @endif

                            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                                <div class="overflow-x-auto">
                                    <table class="w-full text-sm text-left text-gray-600">
                                        <thead
                                            class="text-xs text-gray-700 uppercase bg-yellow-50 border-b border-yellow-100">
                                            <tr>
                                                <th class="px-4 py-3 w-10 text-center">No</th>
                                                <th class="px-4 py-3 w-1/3">Program Kegiatan</th>
                                                <th class="px-4 py-3 text-center">Volume</th>
                                                <th class="px-4 py-3 text-right">Harga Satuan</th>
                                                <th class="px-4 py-3 text-right">Pagu Total</th>
                                                <th class="px-4 py-3 w-1/6">OPD</th>
                                                @if(!auth()->user()->isReadOnly())
                                                <th class="px-4 py-3 text-center w-28">Aksi</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100">
                                            @foreach ($plans as $plan)
                                                <tr class="hover:bg-yellow-50/50 transition duration-150"
                                                    x-data="{ isEditing: false }">
                                                    <form id="row-form-{{ $plan->id }}"
                                                        action="{{ route('plans.update', $plan->id) }}"
                                                        method="POST" class="hidden">
                                                        @csrf @method('PUT')
                                                    </form>
 
                                                    <td class="px-4 py-3 text-center">{{ $loop->iteration }}</td>
 
                                                    <td class="px-4 py-3">
                                                        <span x-show="!isEditing"
                                                            class="leading-relaxed">{{ $plan->nama_kegiatan }}</span>
                                                        <textarea x-show="isEditing" name="nama_kegiatan" form="row-form-{{ $plan->id }}" rows="2"
                                                            class="w-full text-xs border-yellow-300 rounded focus:ring-yellow-500 focus:border-yellow-500">{{ $plan->nama_kegiatan }}</textarea>
                                                    </td>
 
                                                    <td class="px-4 py-3 text-center">
                                                        <span x-show="!isEditing"
                                                            class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs font-bold">{{ $plan->volume_target }}
                                                            {{ $plan->satuan }}</span>
                                                        <div x-show="isEditing" class="flex gap-1 justify-center">
                                                            <input type="number" name="volume_target"
                                                                form="row-form-{{ $plan->id }}"
                                                                value="{{ $plan->volume_target }}"
                                                                class="w-12 text-xs border-yellow-300 rounded text-center focus:ring-yellow-500 focus:border-yellow-500">
                                                            <input type="text" name="satuan"
                                                                form="row-form-{{ $plan->id }}"
                                                                value="{{ $plan->satuan }}"
                                                                class="w-14 text-xs border-yellow-300 rounded focus:ring-yellow-500 focus:border-yellow-500">
                                                        </div>
                                                    </td>
 
                                                    <td class="px-4 py-3 text-right text-gray-500">
                                                        <span
                                                            x-show="!isEditing">{{ number_format($plan->harga_satuan, 0, ',', '.') }}</span>
                                                        <input x-show="isEditing" type="text" name="harga_satuan"
                                                            form="row-form-{{ $plan->id }}" autocomplete="off"
                                                            x-init="$el.value = '{{ number_format($plan->harga_satuan, 0, ',', '.') }}'"
                                                            value="{{ number_format($plan->harga_satuan, 0, ',', '.') }}"
                                                            oninput="formatRupiah(this)"
                                                            class="w-28 text-xs border-yellow-300 rounded text-right focus:ring-yellow-500 focus:border-yellow-500">
                                                    </td>
 
                                                    <td class="px-4 py-3 text-right font-bold text-yellow-700">
                                                        {{ number_format($plan->pagu_total, 0, ',', '.') }}</td>

                                                    <td class="px-4 py-3">
                                                        <span x-show="!isEditing"
                                                            class="font-medium text-gray-900 block truncate"
                                                            title="{{ $plan->opd_tujuan }}">{{ $plan->opd_tujuan }}</span>
                                                        <input x-show="isEditing" type="text" name="opd_tujuan"
                                                            form="row-form-{{ $plan->id }}"
                                                            value="{{ $plan->opd_tujuan }}"
                                                            class="w-full text-xs border-yellow-300 rounded focus:ring-yellow-500 focus:border-yellow-500">
                                                    </td>

                                                    @if(!auth()->user()->isReadOnly())
                                                    <td class="px-4 py-3 text-center">
                                                        <div x-show="!isEditing"
                                                            class="flex items-center justify-center gap-2">
                                                            <button @click="isEditing = true" type="button"
                                                                class="text-yellow-500 hover:text-yellow-700 p-1 rounded hover:bg-yellow-100"
                                                                title="Edit"><svg class="w-5 h-5" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                                    </path>
                                                                </svg></button>
                                                            <form action="{{ route('plans.destroy', $plan->id) }}"
                                                                method="POST">
                                                                @csrf @method('DELETE')
                                                                <button type="button" onclick="confirmDelete(this)"
                                                                    class="text-red-400 hover:text-red-600 p-1 rounded hover:bg-red-50"
                                                                    title="Hapus"><svg class="w-5 h-5"
                                                                        fill="none" stroke="currentColor"
                                                                        viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                                        </path>
                                                                    </svg></button>
                                                            </form>
                                                        </div>
                                                        <div x-show="isEditing"
                                                            class="flex items-center justify-center gap-2"
                                                            style="display: none;">
                                                            <button
                                                                onclick="document.getElementById('row-form-{{ $plan->id }}').submit()"
                                                                type="button"
                                                                class="text-green-600 hover:text-green-800 bg-green-100 p-1 rounded-full"
                                                                title="Simpan"><svg class="w-6 h-6" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M5 13l4 4L19 7"></path>
                                                                </svg></button>
                                                            <button @click="isEditing = false" type="button"
                                                                class="text-gray-400 hover:text-gray-600 bg-gray-100 p-1 rounded-full"
                                                                title="Batal"><svg class="w-6 h-6" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                                </svg></button>
                                                        </div>
                                                    </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </details>
                @empty
                    <div
                        class="p-10 bg-white rounded-xl text-center text-gray-400 shadow-sm border border-dashed border-gray-300">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <p class="text-lg font-semibold text-gray-500">Belum ada data pagu.</p>
                        <p class="text-sm">Silakan import Excel atau input manual.</p>
                    </div>
                @endforelse
            </div>
        </div>

        @if(!auth()->user()->isReadOnly())
        <div x-show="showModal" style="display: none;"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60 backdrop-blur-sm px-4"
            x-transition>
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-0 relative overflow-hidden">
                <div class="bg-yellow-400 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-white">Tambah Pagu Manual</h3>
                    <button @click="showModal = false" class="text-yellow-100 hover:text-white"><svg class="w-6 h-6"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg></button>
                </div>

                <div class="p-6">
                    <form action="{{ route('plans.store') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Tahun Anggaran</label>
                                <select name="tahun_anggaran" required
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                                    @foreach ($yearsRange as $yr)
                                        <option value="{{ $yr }}" {{ $yr == $selectedTahun ? 'selected' : '' }}>{{ $yr }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Tipe APBD</label>
                                <select name="tipe_apbd" required
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                                    <option value="Induk" {{ $selectedTipe == 'Induk' ? 'selected' : '' }}>APBD Induk</option>
                                    <option value="Perubahan" {{ $selectedTipe == 'Perubahan' ? 'selected' : '' }}>APBD Perubahan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Nama Anggota DPRD /
                                    Fraksi</label>
                                <input type="text" name="anggota_dprd" x-model="defaultAleg"
                                    placeholder="Contoh: Budi Santoso" required
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 bg-yellow-50 font-medium text-gray-900">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">OPD Tujuan</label>
                                <input type="text" name="opd_tujuan" placeholder="Contoh: Dinas PUPR" required
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Nama Program /
                                    Kegiatan</label>
                                <textarea name="nama_kegiatan" rows="3" placeholder="Contoh: Pembangunan Jalan Tani..." required
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500"></textarea>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Volume</label>
                                    <input type="number" name="volume_target" placeholder="10" required
                                        class="w-full border-gray-300 rounded-lg shadow-sm text-center focus:ring-yellow-500 focus:border-yellow-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Satuan</label>
                                    <input type="text" name="satuan" placeholder="Paket/Unit" required
                                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Harga Satuan (Rp)</label>
                                <input type="text" name="harga_satuan" oninput="formatRupiah(this)"
                                    placeholder="0" required
                                    class="w-full border-gray-300 rounded-lg shadow-sm text-right font-mono text-lg font-bold text-yellow-600 focus:ring-yellow-500 focus:border-yellow-500">
                            </div>
                        </div>
                        <div class="mt-8 flex justify-end gap-3">
                            <button @click="showModal = false" type="button"
                                class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 font-medium">Batal</button>
                            <button type="submit"
                                class="px-5 py-2.5 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 font-bold shadow-md">Simpan
                                Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </div>

    <script>
        function formatRupiah(input) {
            let value = input.value.replace(/\D/g, '');
            if (value !== '') {
                input.value = new Intl.NumberFormat('id-ID').format(value);
            } else {
                input.value = '';
            }
        }
    </script>
</x-app-layout>
