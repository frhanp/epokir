<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight tracking-tight">
                    Generator SPJ Reses
                </h2>
                <p class="text-sm text-gray-500">Buat laporan dokumentasi PDF dengan format standar.</p>
            </div>
            
            <button onclick="document.getElementById('btn-submit').click()" 
                class="inline-flex items-center px-6 py-2.5 bg-gray-900 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition shadow-sm gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                DOWNLOAD PDF
            </button>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen font-sans" x-data="resesApp()" x-init="initData()">
        
        <form id="form-pdf" action="{{ route('reses.print') }}" method="POST" target="_blank">
            @csrf

            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mb-10">
                
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wide">Pengaturan Dokumen</h3>
                    </div>

                    <div class="p-6 md:p-8 space-y-6">
                        
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Pilih Format Header</label>
                            <div class="relative">
                                <select name="global_header_type" x-model="global.header_type" @change="onHeaderChange()" 
                                    class="block w-full pl-3 pr-10 py-2.5 text-base border-gray-300 focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm rounded-lg shadow-sm">
                                    <option value="standar">Format A: Standar (Banyak Halaman)</option>
                                    <option value="tatap_muka">Format B: Tatap Muka (1 Halaman)</option>
                                    <option value="kunjungan">Format C: Kunjungan (1 Halaman)</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <div x-show="['standar', 'tatap_muka'].includes(global.header_type)">
                                <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Masa Sidang</label>
                                <textarea name="global_masa_sidang" x-model="global.masa_sidang" rows="2" class="shadow-sm focus:ring-yellow-500 focus:border-yellow-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                            </div>

                            <div x-show="['standar', 'tatap_muka'].includes(global.header_type)">
                                <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Dapil / Wilayah</label>
                                <textarea name="global_dapil" x-model="global.dapil" rows="2" class="shadow-sm focus:ring-yellow-500 focus:border-yellow-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                            </div>

                            <div x-show="['tatap_muka', 'kunjungan'].includes(global.header_type)" class="col-span-1 md:col-span-2 bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                                <div class="flex justify-between items-center mb-2">
                                    <label class="block text-xs font-bold text-yellow-800 uppercase">Konten Deskripsi</label>
                                    <span class="text-[10px] text-yellow-600 bg-yellow-100 px-2 py-0.5 rounded-full">Tekan Enter untuk baris baru</span>
                                </div>
                                <textarea name="global_deskripsi" x-model="global.deskripsi" rows="4" 
                                    class="shadow-sm focus:ring-yellow-500 focus:border-yellow-500 block w-full sm:text-sm border-yellow-300 rounded-md font-medium text-gray-800 placeholder-yellow-800/50" 
                                    placeholder="Ketik keterangan kegiatan disini..."></textarea>
                            </div>

                            <div class="col-span-1 md:col-span-2">
                                <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Tanggal (Footer)</label>
                                <input type="text" name="global_tanggal" x-model="global.tanggal" class="shadow-sm focus:ring-yellow-500 focus:border-yellow-500 block w-full sm:text-sm border-gray-300 rounded-md font-bold text-gray-700">
                            </div>
                        </div>

                        <div class="border-t border-gray-100 pt-6 mt-6">
                            <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">Daftar Halaman</h4>
                            
                            <div class="space-y-3">
                                <template x-for="(config, index) in masterConfig" :key="index">
                                    <div class="flex items-center gap-3 bg-gray-50 p-3 rounded-lg border border-gray-200">
                                        <div class="w-8 h-8 rounded bg-white text-gray-500 border border-gray-200 flex items-center justify-center font-mono text-xs" x-text="index+1"></div>

                                        <div class="flex-grow">
                                            <input type="text" x-model="config.title" 
                                                class="block w-full border-0 p-0 text-gray-900 placeholder-gray-400 focus:ring-0 sm:text-sm font-bold bg-transparent uppercase" 
                                                placeholder="JUDUL HALAMAN">
                                        </div>

                                        <select x-model="config.layout" :disabled="global.header_type != 'standar'" 
                                            class="block w-32 pl-3 pr-8 py-1 text-xs border-gray-300 focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 rounded-md shadow-sm disabled:bg-gray-100 disabled:text-gray-400">
                                            <option value="8">8 Kotak</option>
                                            <option value="6">6 Kotak</option>
                                            <option value="3">3 Kotak</option>
                                        </select>

                                        <button type="button" x-show="global.header_type == 'standar'" @click="removeMasterItem(index)" 
                                            class="text-gray-400 hover:text-red-600 transition p-1">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </div>
                                </template>
                            </div>

                            <button type="button" x-show="global.header_type == 'standar'" @click="addMasterItem()" 
                                class="mt-4 w-full flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition">
                                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Tambah Halaman
                            </button>
                        </div>

                        <div class="flex justify-end pt-4 border-t border-gray-200">
                             <button type="button" @click="generateFromMaster()" 
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                Generate / Refresh Lembar Kerja
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gray-100 py-12 border-t border-gray-200 shadow-inner">
                <div class="max-w-7xl mx-auto px-4 text-center">
                    <h3 class="text-lg font-bold text-gray-400 uppercase tracking-widest mb-8">Preview Dokumen</h3>
                    
                    <div class="flex flex-col items-center gap-12">
                        <template x-for="(sheet, sheetIndex) in sheets" :key="sheet.id">
                            
                            <div class="relative group/sheet transition-transform">
                                
                                <div class="bg-white shadow-2xl relative mx-auto" style="width: 210mm; min-height: 297mm; padding: 10mm; padding-bottom: 20mm;">
                                    
                                    <div class="text-center mb-6 font-tahoma text-12pt leading-tight">
                                        
                                        <template x-if="global.header_type == 'standar'">
                                            <div>
                                                <div class="mb-1 text-black">Lampiran Fhoto</div>
                                                <div x-text="sheet.title" class="font-bold uppercase text-black"></div>
                                                <div x-text="global.masa_sidang" class="text-black"></div>
                                                <div x-text="global.dapil" class="text-black"></div>
                                                <div x-text="sheet.tanggal" class="mt-1 text-black"></div>
                                            </div>
                                        </template>

                                        <template x-if="global.header_type == 'tatap_muka'">
                                            <div>
                                                <div class="mb-1 text-black">Lampiran Foto</div>
                                                <div x-text="global.masa_sidang" class="text-black"></div>
                                                <div x-text="global.dapil" class="text-black"></div>
                                                <div class="font-bold uppercase text-black" style="white-space: pre-wrap;" x-text="global.deskripsi"></div>
                                                <div x-text="sheet.tanggal" class="mt-1 text-black"></div>
                                            </div>
                                        </template>

                                        <template x-if="global.header_type == 'kunjungan'">
                                            <div>
                                                <div class="mb-1 text-black">Lampiran Foto</div>
                                                <div class="font-bold uppercase text-black" style="white-space: pre-wrap;" x-text="global.deskripsi"></div>
                                                <div x-text="sheet.tanggal" class="mt-1 text-black"></div>
                                            </div>
                                        </template>

                                        <input type="hidden" :name="`sheets[${sheetIndex}][title]`" :value="sheet.title">
                                        <input type="hidden" :name="`sheets[${sheetIndex}][tanggal]`" :value="sheet.tanggal">
                                        <input type="hidden" :name="`sheets[${sheetIndex}][layout]`" :value="sheet.layout">
                                    </div>

                                    <div class="grid grid-cols-2 gap-x-[5mm] gap-y-[5mm]" 
                                         @dragover.prevent="isDragging = true" 
                                         @dragleave.prevent="isDragging = false"
                                         @drop.prevent="handleBatchDrop($event, sheetIndex); isDragging = false">
                                        
                                        <template x-for="(photo, photoIndex) in sheet.photos" :key="photoIndex">
                                            <div class="relative border-2 border-dashed border-gray-300 bg-gray-50 hover:bg-blue-50 hover:border-blue-400 transition-all overflow-hidden group/box"
                                                 :class="{'col-span-2': sheet.layout == '3' && photoIndex === 0}"
                                                 :style="`height: ${getBoxHeight(sheet.layout)}`">
                                                
                                                <input type="hidden" :name="`sheets[${sheetIndex}][photos][]`" :value="photo">
                                                
                                                <template x-if="photo">
                                                    <div class="w-full h-full relative">
                                                        <img :src="photo" class="w-full h-full object-cover">
                                                        <button type="button" @click="removePhoto(sheetIndex, photoIndex)" 
                                                            class="absolute top-1 right-1 bg-white text-red-600 rounded-full p-1 opacity-0 group-hover/box:opacity-100 transition shadow-sm hover:bg-red-50">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                        </button>
                                                    </div>
                                                </template>

                                                <template x-if="!photo">
                                                    <div class="absolute inset-0 flex flex-col items-center justify-center text-gray-300 pointer-events-none">
                                                        <span class="text-2xl font-bold opacity-25" x-text="photoIndex + 1"></span>
                                                        <span class="text-[10px] font-bold uppercase mt-1 opacity-50">Drop Foto</span>
                                                    </div>
                                                </template>

                                                <template x-if="!photo">
                                                    <input type="file" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" @change="handleSingleFile($event, sheetIndex, photoIndex)">
                                                </template>
                                            </div>
                                        </template>
                                    </div>

                                    <div class="absolute bottom-4 right-8 text-gray-300 text-xs font-mono font-bold">HALAMAN <span x-text="sheetIndex + 1"></span></div>
                                </div>
                                <div class="mt-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Lembar Kerja <span x-text="sheetIndex + 1"></span></div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <button type="button" id="btn-submit" @click="submitPDF()" class="hidden"></button>
            <div x-show="isProcessing" class="fixed inset-0 bg-black/50 flex items-center justify-center z-[100]" style="display: none;">
                <div class="bg-white p-6 rounded-lg shadow-xl flex flex-col items-center">
                    <svg class="animate-spin h-8 w-8 text-gray-600 mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <p class="font-bold text-gray-700">Sedang Memproses PDF...</p>
                </div>
            </div>
            
        </form>
    </div>

    <script src="{{ asset('js/reses-logic.js') }}"></script>
    <style>
        .font-tahoma { font-family: Tahoma, sans-serif; }
        .text-12pt { font-size: 12pt; line-height: 1.3; }
        
        /* Hilangkan default style input saat fokus agar lebih clean */
        input:focus, textarea:focus, select:focus { 
            outline: none; 
            border-color: #eab308; /* Yellow-500 */
            box-shadow: 0 0 0 1px #eab308;
        }
    </style>
</x-app-layout>