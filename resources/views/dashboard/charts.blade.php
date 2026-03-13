<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-xl shadow-sm lg:col-span-1">
        <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Distribusi Kategori</h3>
        <div class="relative h-64">
            <canvas id="kategoriChart"></canvas>
        </div>
        <p class="text-xs text-center text-gray-400 mt-2">Proporsi usulan berdasarkan jenis kategori</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm lg:col-span-2">
        <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2 flex justify-between">
            <span>Peringkat Usulan OPD</span>
            <span class="text-sm font-normal text-gray-500 bg-gray-100 px-2 py-1 rounded">Top Active</span>
        </h3>
        
        <div class="overflow-y-auto h-64 pr-2 custom-scrollbar">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-500 uppercase bg-gray-50 sticky top-0">
                    <tr>
                        <th class="px-4 py-2">Nama Dinas (OPD)</th>
                        <th class="px-4 py-2 text-right">Jumlah</th>
                        <th class="px-4 py-2 text-right">Persentase</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($statsOpd as $opd)
                    @php 
                        $persen = $totalUsulan > 0 ? ($opd->total / $totalUsulan) * 100 : 0;
                    @endphp
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-700">{{ $opd->opd_tujuan }}</td>
                        <td class="px-4 py-3 text-right font-bold text-indigo-600">{{ $opd->total }}</td>
                        <td class="px-4 py-3 text-right text-gray-500">{{ round($persen, 1) }}%</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>