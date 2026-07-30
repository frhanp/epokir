<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <a href="{{ route('laporan.index') }}" class="text-xs text-slate-400 hover:text-slate-600 transition flex items-center font-bold uppercase tracking-wider gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                        Kembali ke Arsip
                    </a>
                </div>
                @php
                    $indonesianMonths = [
                        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                    ];
                @endphp
                <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight font-display">
                    Edit Laporan Periode {{ $indonesianMonths[$laporan->bulan] }} {{ $laporan->tahun }}
                </h2>
                <p class="text-xs text-slate-500">Isi kegiatan harian di bawah. Sistem menyimpan draf Anda secara otomatis.</p>
            </div>

            <div class="flex items-center gap-3 w-full sm:w-auto">
                <!-- Status Save Draf -->
                <div id="save-status-container" class="text-xs font-semibold px-3 py-1.5 rounded-xl border flex items-center gap-2 transition bg-white border-slate-100 text-slate-400">
                    <span class="relative flex h-2 w-2" id="status-pulse" style="display:none;">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-yellow-500"></span>
                    </span>
                    <span id="save-status-text">Semua perubahan disimpan</span>
                </div>

                <a href="{{ route('laporan.export', $laporan->id) }}" 
                    class="glow-btn inline-flex items-center px-6 py-2.5 bg-yellow-500 text-slate-900 font-extrabold rounded-xl text-xs uppercase tracking-wider transition-all duration-300 hover:scale-105 shadow-md hover:shadow-yellow-500/20 shrink-0">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Unduh Word
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen" x-data="laporanEditor()" x-init="initEditor()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- POPUP RESTORE DRAFT LOKAL -->
            <div x-show="showRestoreAlert" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 -translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="p-4 bg-yellow-50 border border-yellow-250/40 text-yellow-855 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-3 shadow-md"
                 style="display: none;">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-yellow-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <div>
                        <span class="text-sm font-bold block">Draf Lokal Ditemukan!</span>
                        <span class="text-xs text-yellow-700">Terdapat data tersimpan di browser Anda yang belum disinkronkan ke server.</span>
                    </div>
                </div>
                <div class="flex items-center gap-2 self-end sm:self-auto">
                    <button type="button" @click="ignoreLocalDraft()" class="px-3 py-1.5 text-[11px] font-bold text-slate-500 hover:bg-yellow-100 rounded-lg transition uppercase tracking-wider">
                        Abaikan
                    </button>
                    <button type="button" @click="restoreLocalDraft()" class="px-3.5 py-1.5 bg-yellow-500 hover:bg-yellow-600 text-slate-900 font-extrabold text-[11px] rounded-lg shadow-sm transition uppercase tracking-wider">
                        Pulihkan Data
                    </button>
                </div>
            </div>

            <!-- METADATA & CONFIGURATION -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- KOLOM 1: DETAIL TENAGA AHLI & SURAT -->
                <div class="lg:col-span-2 bg-white p-6 rounded-[24px] border border-yellow-100/50 shadow-[0_15px_30px_-5px_rgba(234,179,8,0.02)] space-y-6">
                    <div class="border-b border-slate-100 pb-4">
                        <h3 class="font-bold text-slate-800 text-base font-display">Identitas & Informasi Surat</h3>
                        <p class="text-xs text-slate-400">Sesuaikan data yang akan tercetak di lembar cover letter Word.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Nama Tenaga Ahli</label>
                            <input type="text" x-model="form.nama_ta" @input.debounce.1000ms="triggerSave()"
                                class="block w-full text-sm border-slate-200 rounded-xl bg-slate-50/50 focus:ring-yellow-400 focus:border-yellow-400 text-slate-700 font-bold py-2.5">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Jabatan Tenaga Ahli</label>
                            <input type="text" x-model="form.jabatan_ta" @input.debounce.1000ms="triggerSave()"
                                class="block w-full text-sm border-slate-200 rounded-xl bg-slate-50/50 focus:ring-yellow-400 focus:border-yellow-400 text-slate-700 py-2.5">
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Tujuan Surat / Penerima (Yth)</label>
                            <textarea x-model="form.yth" rows="3" @input.debounce.1000ms="triggerSave()"
                                class="block w-full text-sm border-slate-200 rounded-xl bg-slate-50/50 focus:ring-yellow-400 focus:border-yellow-400 text-slate-700 py-2"></textarea>
                        </div>
                    </div>
                </div>

                <!-- KOLOM 2: METADATA & FOOTER -->
                <div class="bg-white p-6 rounded-[24px] border border-yellow-100/50 shadow-[0_15px_30px_-5px_rgba(234,179,8,0.02)] space-y-6 flex flex-col justify-between">
                    <div class="space-y-6">
                        <div class="border-b border-slate-100 pb-4">
                            <h3 class="font-bold text-slate-800 text-base font-display">Tembusan & Tanggal Surat</h3>
                            <p class="text-xs text-slate-400">Detail pelengkap di bagian kaki dokumen Word.</p>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Tempat & Tanggal Laporan</label>
                            <input type="text" x-model="form.tanggal_laporan" @input.debounce.1000ms="triggerSave()"
                                class="block w-full text-sm border-slate-200 rounded-xl bg-slate-50/50 focus:ring-yellow-400 focus:border-yellow-400 text-slate-700 font-bold py-2.5"
                                placeholder="Gorontalo, 3 Agustus 2026">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Tembusan Surat</label>
                            <textarea x-model="form.tembusan" rows="3" @input.debounce.1000ms="triggerSave()"
                                class="block w-full text-sm border-slate-200 rounded-xl bg-slate-50/50 focus:ring-yellow-400 focus:border-yellow-400 text-slate-700 py-2"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TABLE OF ACTIVITIES -->
            <div class="bg-white rounded-[24px] border border-yellow-100/50 shadow-[0_15px_30px_-5px_rgba(234,179,8,0.02)] overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h3 class="font-bold text-slate-800 text-base font-display">Tabel Pelaksanaan Kegiatan</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Filter aktif: Hanya hari Senin, Selasa, Kamis, dan Jumat.</p>
                    </div>
                    <div class="text-xs bg-yellow-50 text-yellow-800 px-3 py-1 rounded-full font-bold border border-yellow-200/50 shrink-0">
                        {{ $laporan->items->count() }} Hari Kegiatan Terdaftar
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-100 bg-slate-50/20 text-slate-400 text-[10px] uppercase font-bold tracking-wider">
                                <th class="px-6 py-4 w-16 text-center">No</th>
                                <th class="px-6 py-4 w-52">Hari & Tanggal</th>
                                <th class="px-6 py-4">Uraian Pelaksanaan Kegiatan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <template x-for="(item, index) in form.items" :key="item.id">
                                <tr class="hover:bg-slate-50/20 transition">
                                    <td class="px-6 py-4 text-center font-bold text-slate-500 text-sm" x-text="item.no_urut"></td>
                                    <td class="px-6 py-4">
                                        <span class="block text-sm font-bold text-slate-800" x-text="formatDateString(item.tanggal, item.hari)"></span>
                                        <span class="block text-[10px] uppercase font-extrabold tracking-wide" :class="getDayBadgeClass(item.hari)" x-text="item.hari"></span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <textarea x-model="item.kegiatan" rows="2" @input.debounce.1000ms="triggerSave()"
                                            class="block w-full text-sm border-slate-200 rounded-xl bg-slate-50/10 focus:ring-yellow-400 focus:border-yellow-400 text-slate-700 py-2 focus:bg-white placeholder-slate-350"
                                            placeholder="Ketik uraian kegiatan pada hari ini..."></textarea>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <div class="p-6 border-t border-slate-100 bg-slate-50/30 flex justify-between items-center">
                    <span class="text-xs text-slate-400">Terakhir disinkronkan ke server: <span class="font-bold text-slate-500" x-text="lastSavedTime">Belum disimpan</span></span>
                    
                    <button type="button" @click="triggerSave(true)" 
                        class="px-5 py-2 bg-slate-900 text-white font-bold rounded-xl text-xs uppercase tracking-wider transition hover:bg-slate-850 shadow-sm">
                        Simpan Manual
                    </button>
                </div>
            </div>

            <!-- SARAN / MASUKAN SECTION -->
            <div class="bg-white rounded-[24px] border border-yellow-100/50 shadow-[0_15px_30px_-5px_rgba(234,179,8,0.02)] overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                    <div>
                        <h3 class="font-bold text-slate-800 text-base font-display">IV. Saran / Masukan</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Kelola poin-poin rekomendasi yang akan tercetak di bagian akhir laporan.</p>
                    </div>
                    <button type="button" @click="addSaranPoint()"
                        class="inline-flex items-center px-4 py-2 bg-yellow-50 text-yellow-800 font-bold border border-yellow-200/50 rounded-xl text-xs uppercase tracking-wider hover:bg-yellow-100 transition shadow-sm gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Saran
                    </button>
                </div>

                <div class="p-6 space-y-4">
                    <template x-for="(saranText, idx) in form.saran" :key="idx">
                        <div class="flex gap-3 items-start bg-slate-50/50 p-4 rounded-2xl border border-slate-100">
                            <!-- Number Badge -->
                            <div class="w-8 h-8 rounded-xl bg-yellow-100/50 border border-yellow-200/30 text-yellow-800 flex items-center justify-center font-bold text-sm shrink-0" x-text="idx + 1"></div>
                            
                            <!-- Textarea -->
                            <div class="flex-grow">
                                <textarea x-model="form.saran[idx]" rows="2" @input.debounce.1000ms="triggerSave()"
                                    class="block w-full text-sm border-slate-200 rounded-xl bg-white focus:ring-yellow-400 focus:border-yellow-400 text-slate-700 py-2 placeholder-slate-350"
                                    placeholder="Ketik poin saran/masukan disini..."></textarea>
                            </div>

                            <!-- Delete Button -->
                            <button type="button" @click="removeSaranPoint(idx)" 
                                class="p-2.5 rounded-xl text-red-500 hover:bg-red-50 hover:text-red-700 transition border border-transparent hover:border-red-100/30 shrink-0">
                                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </template>

                    <template x-if="!form.saran || form.saran.length === 0">
                        <div class="text-center py-6 text-slate-400 text-sm font-medium">
                            Belum ada poin saran/masukan. Klik "Tambah Saran" untuk membuat.
                        </div>
                    </template>
                </div>
            </div>

        </div>
    </div>

    <!-- Script Logika Editor dengan Autosave & LocalStorage -->
    <script>
        function laporanEditor() {
            return {
                form: {
                    id: @json($laporan->id),
                    nama_ta: @json($laporan->nama_ta),
                    jabatan_ta: @json($laporan->jabatan_ta),
                    tanggal_laporan: @json($laporan->tanggal_laporan),
                    yth: @json($laporan->yth),
                    tembusan: @json($laporan->tembusan),
                    saran: @json($laporan->saran ?? []),
                    items: @json($laporan->items)
                },
                lastSavedTime: '{{ $laporan->updated_at->timezone("Asia/Makassar")->format("H:i:s") }}',
                showRestoreAlert: false,
                isSaving: false,

                initEditor() {
                    // Cek draf lokal di localStorage
                    const localDraft = localStorage.getItem(`laporan_draft_${this.form.id}`);
                    if (localDraft) {
                        const parsed = JSON.parse(localDraft);
                        // Bandingkan timestamp draf lokal dengan waktu update server
                        // Jika ada perubahan yang berbeda secara signifikan, tawarkan restore
                        if (parsed.timestamp > new Date('{{ $laporan->updated_at->toIso8601String() }}').getTime()) {
                            // Bandingkan isi draf lokal dengan form server saat ini untuk mendeteksi apakah ada beda data
                            if (JSON.stringify(parsed.form) !== JSON.stringify(this.form)) {
                                this.showRestoreAlert = true;
                            }
                        }
                    }
                },

                // Konversi tanggal string (Y-m-d) ke format lokal Indonesia (e.g. 2 Juli 2026)
                formatDateString(dateStr, dayName) {
                    if (!dateStr) return '';
                    const date = new Date(dateStr);
                    const day = date.getDate();
                    
                    const months = [
                        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                    ];
                    
                    return `${day} ${months[date.getMonth()]} ${date.getFullYear()}`;
                },

                getDayBadgeClass(day) {
                    const classes = {
                        'Senin': 'text-blue-600',
                        'Selasa': 'text-purple-600',
                        'Kamis': 'text-amber-600',
                        'Jumat': 'text-green-600'
                    };
                    return classes[day] || 'text-slate-400';
                },

                addSaranPoint() {
                    if (!this.form.saran) {
                        this.form.saran = [];
                    }
                    this.form.saran.push('');
                    this.triggerSave();
                },

                removeSaranPoint(idx) {
                    if (confirm('Apakah Anda yakin ingin menghapus poin saran ini?')) {
                        this.form.saran.splice(idx, 1);
                        this.triggerSave();
                    }
                },

                // Menjalankan proses autosave ke server
                async triggerSave(isManual = false) {
                    this.updateSaveStatus('saving');
                    this.isSaving = true;

                    // Simpan backup ke localStorage terlebih dahulu sebagai langkah protektif
                    this.saveToLocalStorage();

                    try {
                        const response = await fetch('{{ route("laporan.update") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(this.form)
                        });

                        const result = await response.json();

                        if (result.success) {
                            this.lastSavedTime = result.updated_at;
                            this.updateSaveStatus('saved', result.updated_at);
                            
                            // Jika berhasil tersimpan di server, hapus/bersihkan draf di localStorage
                            localStorage.removeItem(`laporan_draft_${this.form.id}`);
                            this.showRestoreAlert = false;
                        } else {
                            this.updateSaveStatus('error');
                            console.error('Autosave error:', result.message);
                        }
                    } catch (error) {
                        // Jika koneksi internet terputus
                        this.updateSaveStatus('offline');
                        console.warn('Gagal koneksi ke server, draf disimpan di memori browser lokal:', error);
                    } finally {
                        this.isSaving = false;
                    }
                },

                // Simpan draf ke localStorage
                saveToLocalStorage() {
                    const dataToSave = {
                        form: this.form,
                        timestamp: new Date().getTime()
                    };
                    localStorage.setItem(`laporan_draft_${this.form.id}`, JSON.stringify(dataToSave));
                },

                // Mengembalikan data dari draf lokal
                restoreLocalDraft() {
                    const localDraft = localStorage.getItem(`laporan_draft_${this.form.id}`);
                    if (localDraft) {
                        const parsed = JSON.parse(localDraft);
                        this.form = parsed.form;
                        this.showRestoreAlert = false;
                        this.updateSaveStatus('saved_local');
                        // Trigger upload ke database agar tersinkronisasi kembali
                        this.triggerSave();
                    }
                },

                // Mengabaikan draf lokal dan menghapusnya
                ignoreLocalDraft() {
                    localStorage.removeItem(`laporan_draft_${this.form.id}`);
                    this.showRestoreAlert = false;
                },

                // Memperbarui UI status penyimpanan
                updateSaveStatus(status, time = '') {
                    const container = document.getElementById('save-status-container');
                    const pulse = document.getElementById('status-pulse');
                    const text = document.getElementById('save-status-text');

                    if (!container) return;

                    // Reset classes
                    container.className = "text-xs font-semibold px-3 py-1.5 rounded-xl border flex items-center gap-2 transition";
                    pulse.style.display = "none";

                    if (status === 'saving') {
                        container.classList.add('bg-yellow-50', 'border-yellow-200/50', 'text-yellow-700');
                        pulse.style.display = "inline-flex";
                        text.textContent = "Menyimpan draf...";
                    } 
                    else if (status === 'saved') {
                        container.classList.add('bg-green-50', 'border-green-200/50', 'text-green-700');
                        text.textContent = `Draf disimpan otomatis pukul ${time}`;
                    } 
                    else if (status === 'saved_local') {
                        container.classList.add('bg-blue-50', 'border-blue-200/50', 'text-blue-700');
                        text.textContent = "Draf dipulihkan dari browser";
                    }
                    else if (status === 'offline') {
                        container.classList.add('bg-blue-50', 'border-blue-200/50', 'text-blue-700');
                        text.textContent = "Koneksi terputus! Backup draf disimpan di browser.";
                    } 
                    else if (status === 'error') {
                        container.classList.add('bg-red-50', 'border-red-200/50', 'text-red-700');
                        text.textContent = "Gagal menyimpan draf ke database!";
                    }
                }
            };
        }
    </script>

    <style>
        /* Hilangkan default style input saat fokus */
        input:focus, textarea:focus, select:focus { 
            outline: none; 
            border-color: #eab308 !important; /* Yellow-500 */
            box-shadow: 0 0 0 1px #eab308 !important;
        }
    </style>
</x-app-layout>
