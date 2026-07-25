<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Status Penyerapan Kuota Pokir Anggota DPRD</h3>
    
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-600">
            <thead class="text-xs text-gray-500 uppercase bg-gray-50">
                <tr>
                    <th class="px-4 py-3">Anggota DPRD / Fraksi</th>
                    <th class="px-4 py-3 text-center">Pagu Target (Kuota)</th>
                    <th class="px-4 py-3 text-center">Terakomodir</th>
                    <th class="px-4 py-3 text-center">Cadangan</th>
                    <th class="px-4 py-3 text-center">Usulan Baru</th>
                    <th class="px-4 py-3 text-center">Sisa Kuota</th>
                    <th class="px-4 py-3 text-right">Persentase Serapan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($statsAleg as $aleg)
                @php
                    $persen = $aleg->total_target > 0 ? ($aleg->terakomodir / $aleg->total_target) * 100 : 0;
                    $barColor = $persen >= 100 ? 'bg-green-500' : ($persen > 50 ? 'bg-indigo-500' : 'bg-yellow-500');
                @endphp
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3.5 font-bold text-gray-900">{{ $aleg->anggota_dprd }}</td>
                    <td class="px-4 py-3.5 text-center font-semibold text-gray-700">
                        @if($aleg->total_target > 0)
                            {{ $aleg->total_target }} Berkas
                        @else
                            <span class="text-gray-400 italic text-xs">Belum ada pagu</span>
                        @endif
                    </td>
                    <td class="px-4 py-3.5 text-center font-bold text-green-600">{{ $aleg->terakomodir }}</td>
                    <td class="px-4 py-3.5 text-center font-semibold text-yellow-600">{{ $aleg->cadangan }}</td>
                    <td class="px-4 py-3.5 text-center font-medium text-gray-400">{{ $aleg->usulan_baru }}</td>
                    <td class="px-4 py-3.5 text-center">
                        @if($aleg->total_target > 0)
                            @if($aleg->sisa_kuota == 0)
                                <span class="px-2.5 py-1 text-xs font-bold bg-red-100 text-red-800 rounded-full">Habis / Penuh</span>
                            @else
                                <span class="px-2.5 py-1 text-xs font-bold bg-green-100 text-green-800 rounded-full">{{ $aleg->sisa_kuota }} Sisa</span>
                            @endif
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-4 py-3.5 text-right">
                        <div class="flex items-center justify-end gap-2">
                            @if($aleg->total_target > 0)
                                <span class="font-bold text-gray-700">{{ round($persen, 0) }}%</span>
                                <div class="w-24 bg-gray-100 rounded-full h-2 overflow-hidden hidden sm:block">
                                    <div class="{{ $barColor }} h-2 rounded-full" style="width: {{ min(100, $persen) }}%"></div>
                                </div>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-8 text-center text-gray-400">
                        Tidak ada data target pagu atau usulan untuk tahun dan tipe APBD ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>