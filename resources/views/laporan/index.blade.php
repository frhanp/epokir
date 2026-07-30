@php
    $indonesianMonths = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];
@endphp
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight font-display">
                    Laporan Bulanan Tenaga Ahli
                </h2>
                <p class="text-sm text-slate-500">Kelola dan unduh laporan kinerja bulanan Tenaga Ahli Fraksi Golkar.</p>
            </div>
            
            <button @click="openCreateModal = true" 
                class="glow-btn inline-flex items-center px-6 py-2.5 bg-yellow-500 text-slate-900 font-extrabold rounded-xl text-xs uppercase tracking-wider transition-all duration-300 hover:scale-105 shadow-md hover:shadow-yellow-500/20">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                Buat Laporan Baru
            </button>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-50/50 min-h-screen" x-data="{ openCreateModal: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- ALERT NOTIFIKASI -->
            @if(session('success'))
                <div class="p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-sm font-semibold">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-sm font-semibold">{{ session('error') }}</span>
                </div>
            @endif

            @if(session('info'))
                <div class="p-4 bg-blue-50 border border-blue-200 text-blue-700 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-sm font-semibold">{{ session('info') }}</span>
                </div>
            @endif

            <!-- DAFTAR LAPORAN CARD -->
            <div class="bg-white rounded-[24px] border border-yellow-100/50 shadow-[0_15px_30px_-5px_rgba(234,179,8,0.02)] overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <h3 class="font-bold text-slate-800 text-base">Arsip Laporan Bulanan</h3>
                    <span class="text-xs text-slate-400 font-bold uppercase tracking-wider">{{ count($reports) }} Dokumen</span>
                </div>

                @if($reports->isEmpty())
                    <div class="p-12 text-center">
                        <div class="w-16 h-16 bg-yellow-50 rounded-2xl flex items-center justify-center text-yellow-600 mx-auto mb-4 border border-yellow-100/60">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h4 class="text-slate-800 font-bold text-lg mb-1">Belum Ada Laporan</h4>
                        <p class="text-slate-400 text-sm max-w-md mx-auto mb-6">Mulai buat laporan kinerja bulanan pertama untuk Tenaga Ahli DPRD Provinsi Gorontalo dengan menekan tombol dibawah.</p>
                        <button @click="openCreateModal = true"
                            class="inline-flex items-center px-5 py-2.5 bg-yellow-400 text-slate-900 font-extrabold rounded-xl text-xs uppercase tracking-wider transition-all duration-300 hover:scale-105">
                            Inisialisasi Laporan Baru
                        </button>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-100 bg-slate-50/20 text-slate-400 text-[10px] uppercase font-bold tracking-wider">
                                    <th class="px-6 py-4">Periode Laporan</th>
                                    <th class="px-6 py-4">Tenaga Ahli</th>
                                    <th class="px-6 py-4">Tanggal Penyerahan</th>
                                    <th class="px-6 py-4">Jumlah Hari Kerja</th>
                                    <th class="px-6 py-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($reports as $report)
                                    <tr class="hover:bg-slate-50/40 transition">
                                        <td class="px-6 py-4.5">
                                            <div class="flex items-center gap-3">
                                                <div class="p-2 bg-yellow-50 rounded-xl text-yellow-600 border border-yellow-100/40">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                </div>
                                                <div>
                                                    <span class="block text-sm font-bold text-slate-800">{{ $indonesianMonths[$report->bulan] }} {{ $report->tahun }}</span>
                                                    <span class="block text-[10px] text-slate-400 font-medium">Periode Kerja</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4.5">
                                            <span class="text-sm font-bold text-slate-700 block">{{ $report->nama_ta }}</span>
                                            <span class="text-[10px] text-slate-400 block font-medium">Tenaga Ahli Fraksi</span>
                                        </td>
                                        <td class="px-6 py-4.5 text-sm text-slate-500 font-medium">
                                            {{ $report->tanggal_laporan }}
                                        </td>
                                        <td class="px-6 py-4.5">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-100">
                                                {{ $report->items->count() }} Hari
                                            </span>
                                        </td>
                                        <td class="px-6 py-4.5 text-right">
                                            <div class="flex justify-end items-center gap-2">
                                                <!-- Edit Button -->
                                                <a href="{{ route('laporan.edit', $report->id) }}" 
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-yellow-50 text-yellow-800 font-bold border border-yellow-200/50 rounded-xl text-xs uppercase tracking-wide hover:bg-yellow-100 transition shadow-sm">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                    Edit
                                                </a>
                                                
                                                <!-- Download Button -->
                                                <a href="{{ route('laporan.export', $report->id) }}" 
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-green-50 text-green-800 font-bold border border-green-200/50 rounded-xl text-xs uppercase tracking-wide hover:bg-green-100 transition shadow-sm">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                    Unduh Word
                                                </a>
                                                
                                                <!-- Delete Button -->
                                                <form action="{{ route('laporan.destroy', $report->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan bulanan ini beserta seluruh isinya?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50 text-red-700 font-bold border border-red-200/30 rounded-xl text-xs uppercase tracking-wide hover:bg-red-100 hover:text-red-800 transition shadow-sm">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <!-- MODAL INITIALIZE LAPORAN BARU (AlpineJS) -->
        <div x-show="openCreateModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <!-- Overlay -->
                <div class="fixed inset-0 transition-opacity bg-slate-900/40 backdrop-blur-sm" @click="openCreateModal = false"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                <!-- Modal Content -->
                <div x-show="openCreateModal"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-3xl shadow-2xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-yellow-100/30">
                    
                    <form action="{{ route('laporan.store') }}" method="POST">
                        @csrf
                        <div class="px-6 pt-6 pb-4 bg-slate-50/50 border-b border-slate-100">
                            <h3 class="text-lg font-bold text-slate-800 font-display">Inisialisasi Laporan Bulanan</h3>
                            <p class="text-xs text-slate-500 mt-1">Sistem akan menyaring otomatis hari Senin, Selasa, Kamis, & Jumat.</p>
                        </div>

                        <div class="p-6 space-y-4">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Pilih Bulan</label>
                                <select name="bulan" required
                                    class="block w-full text-sm border-slate-200 rounded-xl bg-slate-50 focus:ring-yellow-400 focus:border-yellow-400 text-slate-700 py-2.5">
                                    @php
                                        $currentMonth = (int)date('n');
                                    @endphp
                                    @foreach($indonesianMonths as $num => $name)
                                        <option value="{{ $num }}" {{ $num == $currentMonth ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Pilih Tahun</label>
                                <select name="tahun" required
                                    class="block w-full text-sm border-slate-200 rounded-xl bg-slate-50 focus:ring-yellow-400 focus:border-yellow-400 text-slate-700 py-2.5">
                                    @php
                                        $currentYear = (int)date('Y');
                                    @endphp
                                    @for($y = $currentYear - 2; $y <= $currentYear + 2; $y++)
                                        <option value="{{ $y }}" {{ $y == $currentYear ? 'selected' : '' }}>{{ $y }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100 flex justify-end gap-3 rounded-b-3xl">
                            <button type="button" @click="openCreateModal = false"
                                class="px-4 py-2.5 text-xs font-bold text-slate-500 uppercase tracking-wider hover:bg-slate-100 rounded-xl transition">
                                Batal
                            </button>
                            <button type="submit"
                                class="glow-btn px-6 py-2.5 bg-yellow-500 text-slate-900 font-extrabold rounded-xl text-xs uppercase tracking-wider transition-all shadow-md">
                                Mulai Buat
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
