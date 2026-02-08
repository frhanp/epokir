<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center sticky top-0 z-50">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Generator SPJ Reses (Final)') }}
            </h2>
            <button onclick="document.getElementById('btn-submit').click()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-bold text-sm shadow-md flex items-center gap-2 transition transform hover:scale-105">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                DOWNLOAD PDF
            </button>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-600 min-h-screen" x-data="resesApp()" x-init="initData()">
        
        <form id="form-pdf" action="{{ route('reses.print') }}" method="POST" target="_blank">
            @csrf

            <div class="max-w-7xl mx-auto px-4 mb-8">
                <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-yellow-500">
                    
                    <div class="mb-6 border-b pb-4 bg-yellow-50 p-4 rounded-lg">
                        <label class="text-sm font-bold text-gray-700 block mb-2">PILIH FORMAT HEADER:</label>
                        <select name="global_header_type" x-model="global.header_type" class="w-full md:w-1/2 border-gray-300 rounded font-bold text-gray-800 focus:ring-yellow-500">
                            <option value="standar">Format A: Standar (Transport, Makan, dll)</option>
                            <option value="tatap_muka">Format B: Tatap Muka (Ada Deskripsi)</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase">Masa Sidang</label>
                            <textarea name="global_masa_sidang" x-model="global.masa_sidang" rows="2" class="w-full text-sm border-gray-300 rounded focus:ring-yellow-500"></textarea>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase">Dapil / Wilayah</label>
                            <textarea name="global_dapil" x-model="global.dapil" rows="2" class="w-full text-sm border-gray-300 rounded focus:ring-yellow-500"></textarea>
                        </div>
                        
                        <div x-show="global.header_type == 'tatap_muka'" class="col-span-1 md:col-span-2 bg-blue-50 p-3 rounded border border-blue-200" x-transition>
                            <label class="text-xs font-bold text-blue-700 uppercase">Deskripsi Kegiatan (Tatap Muka)</label>
                            <textarea name="global_deskripsi" x-model="global.deskripsi" rows="2" class="w-full text-sm border-blue-300 rounded focus:ring-blue-500" placeholder="Contoh: Tatap muka dengan masyarakat Desa..."></textarea>
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="text-xs font-bold text-gray-500 uppercase">Tanggal (Otomatis ke semua halaman)</label>
                            <input type="text" name="global_tanggal" x-model="global.tanggal" class="w-full text-sm border-gray-300 rounded focus:ring-yellow-500 font-bold">
                        </div>
                    </div>

                    <div class="space-y-2 mb-4 bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-bold text-xs text-gray-500 mb-2 uppercase">Daftar Halaman:</h4>
                        <template x-for="(config, index) in masterConfig" :key="index">
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500 font-mono w-6 text-sm" x-text="index+1 + '.'"></span>
                                <input type="text" x-model="config.title" class="flex-grow text-sm border-gray-300 rounded font-bold uppercase" placeholder="JUDUL HALAMAN">
                                <select x-model="config.layout" class="text-sm border-gray-300 rounded w-40">
                                    <option value="8">8 Kotak</option>
                                    <option value="6">6 Kotak</option>
                                    <option value="3">3 Kotak</option>
                                </select>
                                <button type="button" @click="removeMasterItem(index)" class="text-red-500 hover:text-red-700 p-1">Hapus</button>
                            </div>
                        </template>
                        <button type="button" @click="addMasterItem()" class="text-sm text-blue-600 hover:underline font-bold mt-2">+ Tambah Halaman</button>
                    </div>

                    <div class="flex justify-end border-t pt-4">
                        <button type="button" @click="generateFromMaster()" class="bg-green-600 text-white px-6 py-3 rounded-lg font-bold shadow-lg hover:bg-green-700 transition flex items-center gap-2">
                            GENERATE LEMBAR KERJA
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex flex-col items-center gap-8 pb-32">
                <template x-for="(sheet, sheetIndex) in sheets" :key="sheet.id">
                    <div class="relative group/sheet">
                        <div class="bg-white shadow-2xl relative transition-all" style="width: 210mm; min-height: 297mm; padding: 10mm; padding-bottom: 20mm;">
                            
                            <div class="text-center mb-4 font-tahoma text-12pt">
                                
                                <template x-if="global.header_type == 'standar'">
                                    <div>
                                        <div class="mb-1">Lampiran Fhoto</div>
                                        <div x-text="sheet.title" class="font-bold uppercase"></div>
                                        <div x-text="global.masa_sidang"></div>
                                        <div x-text="global.dapil"></div>
                                    </div>
                                </template>

                                <template x-if="global.header_type == 'tatap_muka'">
                                    <div>
                                        <div>Lampiran</div>
                                        <div class="mb-1">Foto</div>
                                        <div x-text="global.masa_sidang"></div>
                                        <div class="mb-1">Daerah</div>
                                        <div x-text="global.dapil"></div>
                                        <div x-text="global.deskripsi" class="mt-1 font-bold"></div>
                                    </div>
                                </template>

                                <div x-text="sheet.tanggal" class="mt-1"></div>
                                
                                <input type="hidden" :name="`sheets[${sheetIndex}][title]`" :value="sheet.title">
                                <input type="hidden" :name="`sheets[${sheetIndex}][tanggal]`" :value="sheet.tanggal">
                                <input type="hidden" :name="`sheets[${sheetIndex}][layout]`" :value="sheet.layout">
                            </div>

                            <div class="grid grid-cols-2 gap-x-[5mm] gap-y-[5mm]" 
                                 @dragover.prevent="isDragging = true" 
                                 @dragleave.prevent="isDragging = false"
                                 @drop.prevent="handleBatchDrop($event, sheetIndex); isDragging = false">
                                <template x-for="(photo, photoIndex) in sheet.photos" :key="photoIndex">
                                    <div class="relative border-2 border-black bg-gray-50 group/box hover:border-blue-500 transition overflow-hidden"
                                         :class="{'col-span-2': sheet.layout == '3' && photoIndex === 0}"
                                         :style="`height: ${getBoxHeight(sheet.layout)}`">
                                        
                                        <input type="hidden" :name="`sheets[${sheetIndex}][photos][]`" :value="photo">
                                        <template x-if="photo">
                                            <div class="w-full h-full relative">
                                                <img :src="photo" class="w-full h-full object-cover">
                                                <button type="button" @click="removePhoto(sheetIndex, photoIndex)" class="absolute top-1 right-1 bg-white text-red-600 rounded-full p-1 opacity-0 group-hover/box:opacity-100 transition z-10 shadow"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                                            </div>
                                        </template>
                                        <template x-if="!photo">
                                            <div class="absolute inset-0 flex flex-col items-center justify-center text-gray-300 pointer-events-none">
                                                <span class="text-2xl font-bold" x-text="photoIndex + 1"></span>
                                                <span class="text-xs">DROP</span>
                                            </div>
                                        </template>
                                        <template x-if="!photo">
                                            <input type="file" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" @change="handleSingleFile($event, sheetIndex, photoIndex)">
                                        </template>
                                    </div>
                                </template>
                            </div>
                            <div class="absolute bottom-2 right-6 text-gray-400 text-xs font-mono">Halaman <span x-text="sheetIndex + 1"></span></div>
                        </div>
                    </div>
                </template>
            </div>
            
            <button type="button" id="btn-submit" @click="submitPDF()" class="hidden"></button>
            <div x-show="isProcessing" class="fixed inset-0 bg-black/80 flex items-center justify-center z-[60]"><div class="bg-white p-6 rounded-lg text-center"><p class="font-bold">Memproses...</p></div></div>
        </form>
    </div>
    <script src="{{ asset('js/reses-logic.js') }}"></script>
    <style>
        .font-tahoma { font-family: Tahoma, sans-serif; }
        .text-12pt { font-size: 12pt; line-height: 1.3; }
        input:focus, textarea:focus { box-shadow: none !important; border-color: transparent !important; outline: none; }
    </style>
</x-app-layout>