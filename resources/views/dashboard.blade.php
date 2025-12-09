<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Executive Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-indigo-500 flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Total Usulan Masuk</p>
                        <h3 class="text-3xl font-bold text-gray-800">{{ $totalUsulan }}</h3>
                    </div>
                    <div class="p-3 bg-indigo-50 rounded-full text-indigo-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-green-500 flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">OPD Terlibat</p>
                        <h3 class="text-3xl font-bold text-gray-800">{{ $totalOpd }}</h3>
                    </div>
                    <div class="p-3 bg-green-50 rounded-full text-green-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-orange-500 flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Aleg Pengusul</p>
                        <h3 class="text-3xl font-bold text-gray-800">{{ $totalAleg }}</h3>
                    </div>
                    <div class="p-3 bg-orange-50 rounded-full text-orange-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>
            </div>

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
                                    $persen = ($opd->total / $totalUsulan) * 100;
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

            <div class="bg-white p-6 rounded-xl shadow-sm">
                <h3 class="text-lg font-bold text-gray-800 mb-6 border-b pb-2">Perolehan Usulan Anggota DPRD</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    @foreach($statsAleg as $aleg)
                    @php
                        // Menghitung lebar progress bar (relatif terhadap nilai tertinggi)
                        $width = ($aleg->total / $maxAleg) * 100;
                        // Warna progress bar dinamis (Top 3 beda warna)
                        $colorClass = $loop->iteration <= 3 ? 'bg-indigo-500' : 'bg-gray-400';
                    @endphp
                    <div class="flex items-center group">
                        <div class="w-1/3 text-sm font-medium text-gray-700 truncate pr-2" title="{{ $aleg->anggota_dprd }}">
                            {{ $aleg->anggota_dprd }}
                        </div>
                        
                        <div class="w-full bg-gray-100 rounded-full h-4 mr-3 relative overflow-hidden">
                            <div class="{{ $colorClass }} h-4 rounded-full transition-all duration-1000 ease-out group-hover:bg-indigo-600" style="width: {{ $width }}%"></div>
                        </div>
                        
                        <div class="w-10 text-right text-sm font-bold text-gray-800">{{ $aleg->total }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Setup Donut Chart Kategori
            const ctxKategori = document.getElementById('kategoriChart').getContext('2d');
            new Chart(ctxKategori, {
                type: 'doughnut', // Ganti jadi doughnut biar lebih modern drpd pie
                data: {
                    labels: @json($labelKategori),
                    datasets: [{
                        data: @json($dataKategori),
                        backgroundColor: [
                            '#4F46E5', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#EC4899'
                        ],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'right', labels: { boxWidth: 12, font: { size: 11 } } }
                    },
                    cutout: '70%', // Bikin lubang tengah lebih besar (Modern Look)
                }
            });
        });
    </script>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #9ca3af; }
    </style>
</x-app-layout>