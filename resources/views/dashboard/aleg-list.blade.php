<div class="bg-white p-6 rounded-[24px] border border-yellow-100/50 shadow-[0_15px_30px_-5px_rgba(234,179,8,0.02)]">
    <h3 class="text-lg font-black font-display text-slate-850 mb-4 border-b border-yellow-100/60 pb-3">Status Penyerapan Kuota Pokir Anggota DPRD</h3>
    
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-slate-650">
            <thead class="text-xs text-yellow-900 uppercase bg-yellow-50/40 border-b border-yellow-100/60">
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
            <tbody class="divide-y divide-yellow-50/60">
                @forelse($statsAleg as $aleg)
                @php
                    $persen = $aleg->total_target > 0 ? ($aleg->terakomodir / $aleg->total_target) * 100 : 0;
                    $barColor = $persen >= 100 ? 'bg-green-400' : ($persen > 50 ? 'bg-yellow-400' : 'bg-yellow-300');
                @endphp
                <tr class="hover:bg-yellow-50/10 transition">
                    <td class="px-4 py-3.5 font-bold text-slate-900">{{ $aleg->anggota_dprd }}</td>
                    <td class="px-4 py-3.5 text-center font-semibold text-slate-600">
                        @if($aleg->total_target > 0)
                            {{ $aleg->total_target }} Berkas
                        @else
                            <span class="text-slate-400 italic text-xs">Belum ada pagu</span>
                        @endif
                    </td>
                    <td class="px-4 py-3.5 text-center font-black text-green-600">{{ $aleg->terakomodir }}</td>
                    <td class="px-4 py-3.5 text-center font-bold text-yellow-600">{{ $aleg->cadangan }}</td>
                    <td class="px-4 py-3.5 text-center font-medium text-slate-400">{{ $aleg->usulan_baru }}</td>
                    <td class="px-4 py-3.5 text-center">
                        @if($aleg->total_target > 0)
                            @if($aleg->sisa_kuota == 0)
                                <span class="px-3 py-1 text-xs font-bold bg-red-50 text-red-600 rounded-lg border border-red-100">Penuh</span>
                            @else
                                <span class="px-3 py-1 text-xs font-bold bg-green-50 text-green-700 rounded-lg border border-green-100">{{ $aleg->sisa_kuota }} Sisa</span>
                            @endif
                        @else
                            <span class="text-slate-300">-</span>
                        @endif
                    </td>
                    <td class="px-4 py-3.5 text-right">
                        <div class="flex items-center justify-end gap-3">
                            @if($aleg->total_target > 0)
                                <span class="font-black font-display text-slate-800">{{ round($persen, 0) }}%</span>
                                <div class="w-24 bg-yellow-50 rounded-full h-2 overflow-hidden hidden sm:block border border-yellow-100/40">
                                    <div class="{{ $barColor }} h-2 rounded-full shadow-[0_0_8px_rgba(250,204,21,0.2)]" style="width: {{ min(100, $persen) }}%"></div>
                                </div>
                            @else
                                <span class="text-slate-300">-</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-8 text-center text-slate-400">
                        Tidak ada data target pagu atau usulan untuk tahun dan tipe APBD ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>