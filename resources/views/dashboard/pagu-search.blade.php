<div class="bg-white rounded-xl shadow-sm border border-gray-200 border-l-4 border-l-yellow-500 overflow-hidden relative"
    x-data="paguSearch()">

    <div class="p-8">
        <div class="max-w-3xl">
            <h3 class="text-2xl font-bold mb-2 flex items-center gap-2 text-gray-800">
                <svg class="w-7 h-7 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Cek Sebaran Program
            </h3>
            <p class="text-gray-500 mb-6 text-sm">Ketik nama barang/program (contoh: <b>Sapi</b>, <b>Jalan</b>, <b>Motor</b>) untuk melihat siapa pemilik pagunya.</p>

            <div class="relative">
                <input type="text" x-model="keyword" @input.debounce.500ms="search()"
                    class="w-full pl-5 pr-4 py-4 rounded-xl bg-gray-50 border border-gray-300 focus:border-yellow-500 focus:ring-yellow-500 text-gray-900 placeholder-gray-400 text-lg font-medium transition shadow-inner"
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
            <div class="flex items-end gap-2 mb-4 border-b border-gray-100 pb-2">
                <span class="text-gray-500 text-sm uppercase tracking-wider">Total Ditemukan:</span>
                <span class="text-3xl font-bold text-yellow-600 leading-none" x-text="totalGlobal"></span>
                <span class="text-gray-500 text-sm mb-1" x-text="results.length > 0 ? results[0].satuan : 'Unit'"></span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <template x-for="item in results" :key="item.anggota_dprd">
                    <div class="bg-yellow-50 p-4 rounded-xl border border-yellow-200 hover:border-yellow-400 transition group">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-gray-800 text-lg group-hover:text-yellow-700 transition" x-text="item.anggota_dprd"></h4>
                                <p class="text-xs text-gray-500 mt-1"><span x-text="item.total_paket"></span> Paket Kegiatan</p>
                            </div>
                            <div class="text-right">
                                <span class="block text-2xl font-bold text-gray-800" x-text="item.total_volume"></span>
                                <span class="text-[10px] uppercase text-yellow-800 bg-yellow-200 px-2 py-0.5 rounded" x-text="item.satuan"></span>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <div x-show="keyword.length > 0 && !loading && !hasResults" class="mt-6 text-gray-400 italic" style="display: none;">
            Tidak ditemukan data pagu untuk kata kunci "<span x-text="keyword"></span>".
        </div>
    </div>
</div>