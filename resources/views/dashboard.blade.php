<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Executive Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- FILTER PANEL -->
            <div class="p-6 bg-white rounded-[24px] border border-yellow-100/50 shadow-[0_15px_30px_-5px_rgba(234,179,8,0.02)]">
                <form method="GET" action="{{ route('dashboard') }}" class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div>
                        <h3 class="text-lg font-black font-display text-slate-800">Executive Dashboard E-POKIR</h3>
                        <p class="text-xs text-slate-500">Statistik terintegrasi untuk Tahun Anggaran <span class="font-bold text-yellow-600">{{ $selectedTahun }}</span> ({{ $selectedTipe }}).</p>
                    </div>
                    <div class="flex items-center gap-3 w-full md:w-auto">
                        <div class="w-1/2 md:w-36">
                            <label class="block text-[10px] uppercase font-bold tracking-wider text-slate-400 mb-1.5">Tahun Anggaran</label>
                            <select name="tahun" onchange="this.form.submit()"
                                class="block w-full text-sm border-yellow-100/60 rounded-xl bg-yellow-50/10 focus:ring-yellow-400 focus:border-yellow-400 text-slate-700">
                                @foreach ($yearsRange as $yr)
                                    <option value="{{ $yr }}" {{ $yr == $selectedTahun ? 'selected' : '' }}>{{ $yr }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-1/2 md:w-44">
                            <label class="block text-[10px] uppercase font-bold tracking-wider text-slate-400 mb-1.5">Tipe APBD</label>
                            <select name="tipe" onchange="this.form.submit()"
                                class="block w-full text-sm border-yellow-100/60 rounded-xl bg-yellow-50/10 focus:ring-yellow-400 focus:border-yellow-400 text-slate-700">
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
                        backgroundColor: ['#F59E0B', '#FBBF24', '#FCD34D', '#FDE68A', '#FEF08A', '#EAB308'],
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