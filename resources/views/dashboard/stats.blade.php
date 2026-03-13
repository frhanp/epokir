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