function resesApp() {
    return {
        isProcessing: false,
        
        // --- MASTER CONFIG (TEMPLATE DEFAULT) ---
        // Daftar ini akan muncul otomatis saat halaman dibuka
        masterConfig: [
            { title: 'PENERIMA TRANSPORT', layout: '8' },
            { title: 'KURSI', layout: '8' },
            { title: 'SOUND SYSTEM', layout: '6' },
            { title: 'MASTER OF CEREMONY (MC)', layout: '3' },
            { title: 'MAKANAN BERAT/PRASMANAN', layout: '8' },
            { title: 'SNACK RINGAN', layout: '8' },
        ],
        
        // Setting Global Default
        global: {
            masa_sidang: '“Kegiatan Reses Masa Persidangan Kedua Tahun 2025 - 2026”',
            dapil: 'Daerah Pemilihan (Dapil) III Kabupaten Gorontalo A',
            // Tanggal dikosongkan agar user dipaksa isi di input global
            tanggal: 'Senin, 2 Februari 2026', 
        },
        
        sheets: [], 

        initData() {
            this.generateFromMaster();
        },

        // Generate Halaman berdasarkan Master Config
        generateFromMaster() {
            this.sheets = this.masterConfig.map(config => ({
                id: Date.now() + Math.random(),
                title: config.title,
                layout: config.layout,
                tanggal: this.global.tanggal, // Mengambil tanggal dari Global
                photos: new Array(parseInt(config.layout)).fill(null)
            }));
        },

        // --- RUMUS TINGGI "SAFE MODE" (Agar Muat 1 Halaman PDF) ---
        getBoxHeight(layout) {
            const l = parseInt(layout);
            // Layout 3: 2 Baris @ 110mm (Total 220mm)
            if (l === 3) return '110mm'; 
            // Layout 6: 3 Baris @ 75mm (Total 225mm)
            if (l === 6) return '75mm'; 
            // Layout 8: 4 Baris @ 55mm (Total 220mm)
            return '55mm'; 
        },

        // Fitur Tambahan
        addMasterItem() { 
            this.masterConfig.push({ title: 'JUDUL BARU', layout: '8' }); 
        },
        
        removeMasterItem(index) { 
            this.masterConfig.splice(index, 1); 
        },
        
        removeSheet(index) { 
            if (confirm("Hapus halaman ini?")) this.sheets.splice(index, 1); 
        },
        
        removePhoto(sheetIndex, photoIndex) {
            let newPhotos = [...this.sheets[sheetIndex].photos];
            newPhotos[photoIndex] = null;
            this.sheets[sheetIndex].photos = newPhotos;
        },

        // --- KOMPRESI GAMBAR (HIGH QUALITY) ---
        async compressImage(file) {
            return new Promise((resolve) => {
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = (event) => {
                    const img = new Image();
                    img.src = event.target.result;
                    img.onload = () => {
                        const canvas = document.createElement('canvas');
                        // Max width 1500px (Tajam untuk cetak A4)
                        const scale = Math.min(1, 1500 / img.width); 
                        canvas.width = img.width * scale;
                        canvas.height = img.height * scale;
                        
                        const ctx = canvas.getContext('2d');
                        ctx.imageSmoothingEnabled = true;
                        ctx.imageSmoothingQuality = 'high';
                        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                        
                        // Output JPEG Quality 0.9
                        resolve(canvas.toDataURL('image/jpeg', 0.9));
                    }
                }
            });
        },

        async handleFile(file, sheetIndex, photoIndex) {
            if (!file.type.startsWith('image/')) return;
            this.isProcessing = true;
            try {
                const url = await this.compressImage(file); 
                let newPhotos = [...this.sheets[sheetIndex].photos];
                newPhotos[photoIndex] = url;
                this.sheets[sheetIndex].photos = newPhotos;
            } catch (e) {}
            this.isProcessing = false;
        },

        async handleSingleFile(event, sheetIndex, photoIndex) {
            const file = event.target.files[0];
            if (file) await this.handleFile(file, sheetIndex, photoIndex);
            event.target.value = '';
        },

        async handleBatchDrop(event, sheetIndex) {
            const files = event.dataTransfer.files;
            if (files.length === 0) return;
            this.isProcessing = true;
            let fileIdx = 0;
            let sheet = this.sheets[sheetIndex];
            
            for (let i = 0; i < sheet.photos.length; i++) {
                if (sheet.photos[i] === null && fileIdx < files.length) {
                    await this.handleFile(files[fileIdx], sheetIndex, i);
                    fileIdx++;
                }
            }
            this.isProcessing = false;
        },

        submitPDF() {
            if(this.isProcessing) { alert("Tunggu proses gambar selesai..."); return; }
            document.getElementById('form-pdf').submit();
        }
    }
}