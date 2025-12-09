<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Rencana Kerja (Pagu Indikatif)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <h3 class="text-lg font-bold mb-4 text-indigo-700">Import Database Pagu (Excel)</h3>
                <form action="{{ route('plans.import') }}" method="POST" enctype="multipart/form-data" class="flex flex-col md:flex-row gap-4 items-end">
                    @csrf
                    <div class="w-full md:w-1/2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Upload File Excel (.xlsx)</label>
                        <input type="file" name="file_excel" required
                            class="block w-full text-sm text-gray-500
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-md file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 font-bold transition">
                        PROSES IMPORT
                    </button>
                </form>
                <p class="text-xs text-gray-400 mt-2">*Format kolom harus sesuai: No, Program, Volume, Satuan, Harga, Total, OPD, Aleg.</p>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="space-y-4">
                    <h3 class="text-lg font-bold text-gray-800">Daftar Pagu Tersedia (Per Fraksi/Aleg)</h3>
                
                    @forelse($groupedPlans as $alegName => $plans)
                        @php
                            $totalPaguAleg = $plans->sum('pagu_total');
                            $totalPaket = $plans->count();
                        @endphp
                
                        <details class="group bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                            
                            <summary class="flex items-center justify-between cursor-pointer p-4 bg-gray-50 hover:bg-indigo-50 transition">
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-gray-500 transition group-open:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    
                                    <div>
                                        <h4 class="font-bold text-gray-800">{{ $alegName }}</h4>
                                        <span class="text-xs text-gray-500">{{ $totalPaket }} Program Kegiatan</span>
                                    </div>
                                </div>
                
                                <div class="text-right">
                                    <span class="block text-sm font-bold text-indigo-700">
                                        Rp {{ number_format($totalPaguAleg, 0, ',', '.') }}
                                    </span>
                                    <span class="text-xs text-gray-400">Total Pagu</span>
                                </div>
                            </summary>
                
                            <div class="p-4 border-t border-gray-200">
                                <div class="overflow-x-auto">
                                    <table class="w-full text-sm text-left text-gray-500">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                            <tr>
                                                <th class="px-4 py-2 w-10">No</th>
                                                <th class="px-4 py-2">OPD</th>
                                                <th class="px-4 py-2">Program Kegiatan</th>
                                                <th class="px-4 py-2 text-center">Volume</th>
                                                <th class="px-4 py-2 text-right">Harga Satuan</th>
                                                <th class="px-4 py-2 text-right">Pagu Total</th>
                                                <th class="px-4 py-2 text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            @foreach($plans as $index => $plan)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                                <td class="px-4 py-2 font-medium text-gray-900">{{ $plan->opd_tujuan }}</td>
                                                <td class="px-4 py-2">
                                                    {{ $plan->nama_kegiatan }}
                                                </td>
                                                <td class="px-4 py-2 text-center">
                                                    {{ $plan->volume_target }} {{ $plan->satuan }}
                                                </td>
                                                <td class="px-4 py-2 text-right">
                                                    {{ number_format($plan->harga_satuan, 0, ',', '.') }}
                                                </td>
                                                <td class="px-4 py-2 text-right font-bold text-gray-700">
                                                    {{ number_format($plan->pagu_total, 0, ',', '.') }}
                                                </td>
                                                <td class="px-4 py-2 text-center">
                                                    @if($plan->sisa_kuota > 0)
                                                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2 py-0.5 rounded">
                                                            Sisa: {{ $plan->sisa_kuota }}
                                                        </span>
                                                    @else
                                                        <span class="bg-red-100 text-red-800 text-xs font-semibold px-2 py-0.5 rounded">
                                                            PENUH
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </details>
                
                    @empty
                        <div class="p-6 bg-white rounded-lg text-center text-gray-400 shadow-sm">
                            Belum ada data pagu. Silakan import Excel terlebih dahulu.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>