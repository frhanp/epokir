<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-[24px] border border-yellow-100/50 shadow-[0_15px_30px_-5px_rgba(234,179,8,0.02)] lg:col-span-1">
        <h3 class="text-lg font-black font-display text-slate-850 mb-4 border-b border-yellow-100/60 pb-3">Distribusi Kategori</h3>
        <div class="relative h-64">
            <canvas id="kategoriChart"></canvas>
        </div>
        <p class="text-[10px] text-center text-slate-400 font-bold uppercase tracking-wider mt-4">Proporsi usulan berdasarkan jenis kategori</p>
    </div>

    <div class="bg-white p-6 rounded-[24px] border border-yellow-100/50 shadow-[0_15px_30px_-5px_rgba(234,179,8,0.02)] lg:col-span-2">
        <h3 class="text-lg font-black font-display text-slate-850 mb-4 border-b border-yellow-100/60 pb-3 flex justify-between items-center">
            <span>Peringkat Usulan OPD</span>
            <span class="text-xs font-bold text-yellow-700 bg-yellow-50 border border-yellow-100/40 px-3 py-1 rounded-full uppercase tracking-wider">Top Active</span>
        </h3>
        
        <div class="overflow-y-auto h-64 pr-2 custom-scrollbar">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-yellow-900 uppercase bg-yellow-50/40 sticky top-0 border-b border-yellow-100/60">
                    <tr>
                        <th class="px-4 py-2.5">Nama Dinas (OPD)</th>
                        <th class="px-4 py-2.5 text-right">Jumlah</th>
                        <th class="px-4 py-2.5 text-right">Persentase</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-yellow-50/60">
                    @foreach($statsOpd as $opd)
                    @php 
                        $persen = $totalUsulan > 0 ? ($opd->total / $totalUsulan) * 100 : 0;
                    @endphp
                    <tr class="hover:bg-yellow-50/10">
                        <td class="px-4 py-3 font-medium text-slate-700">{{ $opd->opd_tujuan }}</td>
                        <td class="px-4 py-3 text-right font-black font-display text-yellow-600">{{ $opd->total }}</td>
                        <td class="px-4 py-3 text-right text-slate-400 font-medium">{{ round($persen, 1) }}%</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>