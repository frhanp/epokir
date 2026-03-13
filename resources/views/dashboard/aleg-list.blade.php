<div class="bg-white p-6 rounded-xl shadow-sm">
    <h3 class="text-lg font-bold text-gray-800 mb-6 border-b pb-2">Perolehan Usulan Anggota DPRD</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
        @foreach($statsAleg as $aleg)
        @php
            $width = $maxAleg > 0 ? ($aleg->total / $maxAleg) * 100 : 0;
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