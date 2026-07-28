<div class="bg-white rounded-[24px] border border-yellow-100/50 shadow-[0_15px_30px_-5px_rgba(234,179,8,0.03)] overflow-hidden relative"
    x-data="paguSearch()">

    <div class="p-8">
        <div class="max-w-3xl">
            <h3 class="text-2xl font-black font-display mb-2 flex items-center gap-2 text-slate-850">
                <svg class="w-7 h-7 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Cek Sebaran Program
            </h3>
            <p class="text-slate-500 mb-6 text-sm">Ketik nama barang/program (contoh: <b>Sapi</b>, <b>Jalan</b>, <b>Motor</b>) untuk melihat siapa pemilik pagunya.</p>

            <div class="relative">
                <input type="text" x-model="keyword" @input.debounce.500ms="search()"
                    class="w-full pl-5 pr-4 py-4 rounded-2xl bg-yellow-50/20 border border-yellow-100/60 focus:border-yellow-400 focus:ring-yellow-400 text-slate-800 placeholder-slate-400 text-lg font-medium transition shadow-inner"
                    placeholder="Ketik kata kunci pencarian...">

                <div x-show="loading" class="absolute right-4 top-4" style="display: none;">
                    <svg class="animate-spin h-6 w-6 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div x-show="hasResults" x-transition class="mt-8" style="display: none;">
            <div class="flex items-end gap-2 mb-4 border-b border-yellow-100/60 pb-2">
                <span class="text-slate-400 text-xs font-bold uppercase tracking-wider">Total Ditemukan:</span>
                <span class="text-3xl font-black text-yellow-600 leading-none font-display" x-text="totalGlobal"></span>
                <span class="text-slate-500 text-sm mb-1" x-text="results.length > 0 ? results[0].satuan : 'Unit'"></span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <template x-for="item in results" :key="item.anggota_dprd">
                    <div class="bg-yellow-50/30 p-5 rounded-2xl border border-yellow-100/80 hover:border-yellow-350 hover:bg-yellow-50 transition group">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-slate-800 text-md group-hover:text-yellow-750 transition" x-text="item.anggota_dprd"></h4>
                                <p class="text-xs text-slate-400 mt-1"><span class="font-bold text-yellow-600" x-text="item.total_paket"></span> Paket Kegiatan</p>
                            </div>
                            <div class="text-right">
                                <span class="block text-2xl font-black text-slate-800 font-display leading-none" x-text="item.total_volume"></span>
                                <span class="inline-block mt-2 text-[9px] uppercase font-bold text-yellow-700 bg-yellow-100 border border-yellow-200/40 px-2 py-0.5 rounded-lg" x-text="item.satuan"></span>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <div x-show="keyword.length > 0 && !loading && !hasResults" class="mt-6 text-slate-400 italic text-sm" style="display: none;">
            Tidak ditemukan data pagu untuk kata kunci "<span x-text="keyword"></span>" pada Tahun {{ $selectedTahun }} ({{ $selectedTipe }}).
        </div>
    </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('paguSearch', () => ({
        keyword: '',
        results: [],
        totalGlobal: 0,
        loading: false,
        hasResults: false,
        tahun: '{{ $selectedTahun ?? 2026 }}',
        tipe: '{{ $selectedTipe ?? "Induk" }}',

        async search() {
            if (this.keyword.length < 2) {
                this.hasResults = false;
                this.results = [];
                return;
            }
            
            this.loading = true;
            try {
                // Fetch dengan menyertakan param tahun dan tipe yang aktif di Dashboard
                const response = await fetch(`/api/cek-pagu?keyword=${this.keyword}&tahun=${this.tahun}&tipe=${this.tipe}`);
                const data = await response.json();
                
                this.results = data.data;
                this.totalGlobal = data.total_global;
                this.hasResults = this.results.length > 0;
            } catch (error) {
                console.error("Error fetching data:", error);
            } finally {
                this.loading = false;
            }
        }
    }));
});
</script>