<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Executive Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- FILTER PANEL -->
            <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200">
                <form method="GET" action="{{ route('dashboard') }}" class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Executive Dashboard E-POKIR</h3>
                        <p class="text-xs text-gray-500">Statistik terintegrasi untuk Tahun Anggaran <span class="font-bold text-indigo-600">{{ $selectedTahun }}</span> ({{ $selectedTipe }}).</p>
                    </div>
                    <div class="flex items-center gap-3 w-full md:w-auto">
                        <div class="w-1/2 md:w-36">
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Tahun Anggaran</label>
                            <select name="tahun" onchange="this.form.submit()"
                                class="block w-full text-sm border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                @foreach ($yearsRange as $yr)
                                    <option value="{{ $yr }}" {{ $yr == $selectedTahun ? 'selected' : '' }}>{{ $yr }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-1/2 md:w-44">
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Tipe APBD</label>
                            <select name="tipe" onchange="this.form.submit()"
                                class="block w-full text-sm border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="Induk" {{ $selectedTipe == 'Induk' ? 'selected' : '' }}>APBD Induk</option>
                                <option value="Perubahan" {{ $selectedTipe == 'Perubahan' ? 'selected' : '' }}>APBD Perubahan</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            @include('dashboard.pagu-search')

            @include('dashboard.stats')

            @include('dashboard.charts')

            @include('dashboard.aleg-list')

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Logic Pencarian Pagu (AlpineJS)
        function paguSearch() {
            return {
                keyword: '',
                results: [],
                totalGlobal: 0,
                loading: false,
                get hasResults() { return this.results.length > 0; },
                async search() {
                    if (this.keyword.length < 2) { this.results = []; return; }
                    this.loading = true;
                    try {
                        let response = await fetch(`{{ route('api.cek_pagu') }}?keyword=${this.keyword}&tahun={{ $selectedTahun }}&tipe={{ $selectedTipe }}`);
                        let json = await response.json();
                        this.results = json.data;
                        this.totalGlobal = json.total_global;
                    } catch (e) { console.error(e); }
                    this.loading = false;
                }
            }
        }

        // Logic Chart.js
        document.addEventListener('DOMContentLoaded', function() {
            const ctxKategori = document.getElementById('kategoriChart').getContext('2d');
            new Chart(ctxKategori, {
                type: 'doughnut',
                data: {
                    labels: @json($labelKategori),
                    datasets: [{
                        data: @json($dataKategori),
                        backgroundColor: ['#4F46E5', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#EC4899'],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'right', labels: { boxWidth: 12, font: { size: 11 } } } },
                    cutout: '70%',
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