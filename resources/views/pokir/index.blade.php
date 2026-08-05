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
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 items-end">
                        
                        <div>
                            <x-input-label value="Cari Kata Kunci" />
                            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Pemohon, alamat, kategori, dll..." class="mt-1 block w-full text-sm border-gray-300 rounded-md shadow-sm h-[38px]">
                        </div>

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
                            <x-input-label value="Status Sistem" />
                            <select name="status_sistem" class="mt-1 block w-full text-sm border-gray-300 rounded-md shadow-sm">
                                <option value="">Semua Status</option>
                                <option value="Terakomodir" {{ request('status_sistem') == 'Terakomodir' ? 'selected' : '' }}>Terakomodir</option>
                                <option value="Cadangan" {{ request('status_sistem') == 'Cadangan' ? 'selected' : '' }}>Cadangan</option>
                                <option value="Usulan Baru" {{ request('status_sistem') == 'Usulan Baru' ? 'selected' : '' }}>Usulan Baru</option>
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
                            <x-primary-button type="submit" class="h-[38px] w-full flex justify-center items-center gap-2">
                                <i class="bi bi-search text-base"></i>
                                Cari / Filter
                            </x-primary-button>
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
                            <i class="bi bi-database text-2xl"></i>
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
                                    <i class="bi bi-upload text-lg"></i>
                                    PROSES IMPORT
                                </button>
                            </div>
                        </div>
                    </form>
                    <p class="text-xs text-gray-400 mt-3 flex items-center gap-1.5 font-medium">
                        <i class="bi bi-info-circle text-base text-indigo-500"></i>
                        Format kolom wajib: No, Judul Permohonan, Alamat, Yang Bermohon, Identitas, Anggota DPRD Pengusul, Ket Berkas, Ket Penerima, Dinas Terkait.
                    </p>
                </div>
            </div>
            @endif

            <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                <div class="p-4 border-b border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="text-gray-600">
                        Menampilkan <strong>{{ $pokirs->count() }}</strong> data
                        @if(request('keyword')) <span class="text-xs bg-gray-100 text-gray-800 px-2 py-1 rounded">Cari: "{{ request('keyword') }}"</span> @endif
                        @if(request('kategori_usulan')) <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">Kat: {{ request('kategori_usulan') }}</span> @endif
                        @if(request('opd_tujuan')) <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">OPD: {{ request('opd_tujuan') }}</span> @endif
                        @if(request('status_sistem')) <span class="text-xs bg-purple-100 text-purple-800 px-2 py-1 rounded">Status: {{ request('status_sistem') }}</span> @endif
                    </div>

                    <div class="flex items-center gap-2 flex-wrap">
                        <span id="selection-status" class="text-xs bg-indigo-50 border border-indigo-100 text-indigo-700 px-3 py-2 rounded-md font-bold hidden">0 item terpilih</span>
                        
                        @if(!auth()->user()->isReadOnly())
                        <form action="{{ route('pokir.bulkDestroy') }}" method="POST" id="bulk-delete-form" class="inline">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="ids" id="bulk-delete-ids" value="">
                            <button type="submit" id="bulk-delete-btn" onclick="confirmDelete(this, 'Anda akan menghapus usulan Pokir yang terpilih secara massal!')" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 transition shadow-sm hidden">
                                <i class="bi bi-trash text-sm"></i>
                                Hapus Terpilih
                            </button>
                        </form>

                        <form action="{{ route('pokir.realign') }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menyelaraskan ulang seluruh usulan Pokir dengan Master Pagu?')">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 transition shadow-sm">
                                <i class="bi bi-arrow-repeat text-sm"></i>
                                Sinkronisasi Pagu
                            </button>
                        </form>
                        @endif

                        <a href="{{ route('pokir.print', request()->query()) }}" id="print-btn" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 transition shadow-sm">
                            <i class="bi bi-printer text-sm"></i>
                            Cetak
                        </a>
                        
                        <a href="{{ route('pokir.export', request()->query()) }}" id="export-btn" class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 transition shadow-sm">
                            <i class="bi bi-download text-sm"></i>
                            Excel
                        </a>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-10">
                                    <input type="checkbox" id="select-all" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul & Alamat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemohon</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penyerahan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aleg & OPD</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status Berkas</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status Sistem</th>
                                @if(!auth()->user()->isReadOnly())
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-20">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($pokirs as $index => $pokir)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-4 whitespace-nowrap text-center">
                                    <input type="checkbox" name="selected_ids[]" value="{{ $pokir->id }}" class="pokir-checkbox rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-gray-500 text-sm">
                                    {{ $pokirs->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-semibold text-gray-900">{{ $pokir->judul_lengkap }}</div>
                                    <div class="text-xs text-gray-500 mt-0.5">{{ $pokir->alamat }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <div class="font-bold text-gray-800">{{ $pokir->nama_pemohon }}</div>
                                    <div class="text-xs text-gray-400 mt-0.5">{{ $pokir->identitas_pemohon ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-600 space-y-1">
                                    <div>Tgl: <span class="font-semibold text-gray-800">{{ $pokir->tanggal_penerimaan ? date('d-m-Y', strtotime($pokir->tanggal_penerimaan)) : '-' }}</span></div>
                                    <div>Tipe: <span class="font-bold text-indigo-600">{{ $pokir->tipe_apbd }} {{ $pokir->tahun_anggaran }}</span></div>
                                    @if($pokir->keterangan_upload)
                                        <div class="text-gray-400 italic mt-0.5">"{{ $pokir->keterangan_upload }}"</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <div class="font-semibold text-gray-800">{{ $pokir->anggota_dprd }}</div>
                                    <div class="text-xs text-gray-500 mt-0.5">{{ $pokir->opd_tujuan }}</div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-2.5 py-1 inline-flex items-center gap-1 text-[11px] font-bold rounded-full bg-blue-50 text-blue-700 border border-blue-200">
                                        <i class="bi bi-file-earmark-text text-[13px]"></i>
                                        {{ $pokir->status_berkas ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($pokir->status_sistem === 'Terakomodir')
                                        <span class="px-2.5 py-1 inline-flex items-center gap-1.5 text-[11px] font-bold rounded-full bg-green-50 text-green-700 border border-green-200" title="Terakomodir di Master Pagu">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                            Terakomodir
                                        </span>
                                    @elseif($pokir->status_sistem === 'Cadangan')
                                        <span class="px-2.5 py-1 inline-flex items-center gap-1.5 text-[11px] font-bold rounded-full bg-yellow-50 text-yellow-700 border border-yellow-200" title="Kuota Pagu Penuh">
                                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 animate-pulse"></span>
                                            Cadangan
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 inline-flex items-center gap-1.5 text-[11px] font-bold rounded-full bg-slate-50 text-slate-600 border border-slate-200" title="Tidak ada Pagu yang cocok">
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                            Usulan Baru
                                        </span>
                                    @endif
                                </td>
                                @if(!auth()->user()->isReadOnly())
                                <td class="px-6 py-4 text-center whitespace-nowrap text-sm font-medium">
                                    <form action="{{ route('pokir.destroy', $pokir->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="confirmDelete(this, 'Apakah Anda yakin ingin menghapus usulan ini?')" class="p-2 bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-800 rounded-xl transition shadow-sm" title="Hapus Usulan">
                                            <i class="bi bi-trash text-base"></i>
                                        </button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{{ auth()->user()->isReadOnly() ? 8 : 9 }}" class="px-6 py-4 text-center text-gray-500">Tidak ada data ditemukan.</td>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            const rowCheckboxes = document.querySelectorAll('.pokir-checkbox');
            const selectionStatus = document.getElementById('selection-status');
            const printBtn = document.getElementById('print-btn');
            const exportBtn = document.getElementById('export-btn');
            const bulkDeleteBtn = document.getElementById('bulk-delete-btn');
            const bulkDeleteIds = document.getElementById('bulk-delete-ids');

            const originalPrintHref = printBtn ? printBtn.getAttribute('href') : '';
            const originalExportHref = exportBtn ? exportBtn.getAttribute('href') : '';

            function updateSelectionState() {
                const checkedCount = document.querySelectorAll('.pokir-checkbox:checked').length;
                
                if (checkedCount > 0) {
                    if (selectionStatus) {
                        selectionStatus.textContent = `${checkedCount} item terpilih`;
                        selectionStatus.classList.remove('hidden');
                    }

                    const ids = Array.from(document.querySelectorAll('.pokir-checkbox:checked')).map(cb => cb.value).join(',');

                    if (printBtn && originalPrintHref) {
                        const printUrl = new URL(originalPrintHref, window.location.origin);
                        printUrl.searchParams.set('ids', ids);
                        printBtn.setAttribute('href', printUrl.toString());
                    }

                    if (exportBtn && originalExportHref) {
                        const exportUrl = new URL(originalExportHref, window.location.origin);
                        exportUrl.searchParams.set('ids', ids);
                        exportBtn.setAttribute('href', exportUrl.toString());
                    }

                    if (bulkDeleteBtn) {
                        bulkDeleteBtn.classList.remove('hidden');
                    }
                    if (bulkDeleteIds) {
                        bulkDeleteIds.value = ids;
                    }
                } else {
                    if (selectionStatus) {
                        selectionStatus.classList.add('hidden');
                    }

                    if (printBtn) printBtn.setAttribute('href', originalPrintHref);
                    if (exportBtn) exportBtn.setAttribute('href', originalExportHref);

                    if (bulkDeleteBtn) {
                        bulkDeleteBtn.classList.add('hidden');
                    }
                    if (bulkDeleteIds) {
                        bulkDeleteIds.value = '';
                    }
                }
            }

            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    rowCheckboxes.forEach(cb => {
                        cb.checked = selectAllCheckbox.checked;
                    });
                    updateSelectionState();
                });
            }

            rowCheckboxes.forEach(cb => {
                cb.addEventListener('change', function() {
                    if (!this.checked) {
                        if (selectAllCheckbox) selectAllCheckbox.checked = false;
                    } else {
                        const allChecked = Array.from(rowCheckboxes).every(c => c.checked);
                        if (selectAllCheckbox) selectAllCheckbox.checked = allChecked;
                    }
                    updateSelectionState();
                });
            });
        });
    </script>
</x-app-layout>