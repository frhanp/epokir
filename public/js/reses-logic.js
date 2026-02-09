function resesApp() {
    return {
        isProcessing: false,
        
        // Data Default (Format A)
        masterConfig: [
            { title: 'PENERIMA TRANSPORT', layout: '8' },
            { title: 'KURSI', layout: '8' },
            { title: 'SOUND SYSTEM', layout: '6' },
            { title: 'MASTER OF CEREMONY (MC)', layout: '3' },
            { title: 'MAKANAN BERAT/PRASMANAN', layout: '8' },
            { title: 'SNACK RINGAN', layout: '8' },
        ],
        
        global: {
            header_type: 'standar', 
            // Deskripsi ini jadi "KOTAK SAKTI" untuk Format B & C
            deskripsi: "KUNJUNGAN DALAM RANGKA MENINJAU\nMASYARAKAT PENERIMA BANTUAN TERNAK SAPI\nDI DESA BULOTA KECAMATAN TELAGA JAYA", 
            masa_sidang: '“Kegiatan Reses Masa Persidangan Kedua Tahun 2025 - 2026”',
            dapil: 'Daerah Pemilihan (Dapil) III Kabupaten Gorontalo A',
            tanggal: 'Senin, 2 Februari 2026', 
        },
        
        sheets: [], 

        initData() {
            this.generateFromMaster();
        },

        // --- LOGIKA UTAMA GANTI FORMAT ---
        onHeaderChange() {
            const type = this.global.header_type;

            if (type === 'standar') {
                // Balik ke default 6 halaman
                this.masterConfig = [
                    { title: 'PENERIMA TRANSPORT', layout: '8' },
                    { title: 'KURSI', layout: '8' },
                    { title: 'SOUND SYSTEM', layout: '6' },
                    { title: 'MASTER OF CEREMONY (MC)', layout: '3' },
                    { title: 'MAKANAN BERAT/PRASMANAN', layout: '8' },
                    { title: 'SNACK RINGAN', layout: '8' },
                ];
            } else {
                // Format B (Tatap Muka) & C (Kunjungan)
                // OTOMATIS: 1 Halaman, Layout 8
                this.masterConfig = [
                    { title: 'DOKUMENTASI KEGIATAN', layout: '8' }
                ];
            }
            this.generateFromMaster();
        },

        generateFromMaster() {
            this.sheets = this.masterConfig.map(config => ({
                id: Date.now() + Math.random(),
                title: config.title,
                layout: config.layout,
                tanggal: this.global.tanggal, 
                photos: new Array(parseInt(config.layout)).fill(null)
            }));
        },

        getBoxHeight(layout) {
            const l = parseInt(layout);
            const type = this.global.header_type;

            if (l === 3) return '110mm'; 
            if (l === 6) return '75mm'; 
            
            // Layout 8:
            // Jika Format B atau C, tinggi kotak DIPENDEKKAN (47mm)
            // Supaya muat banyak tulisan header tanpa lompat halaman.
            if (type === 'tatap_muka' || type === 'kunjungan') return '54mm';

            // Jika Format Standar, tinggi normal (55mm)
            return '55mm'; 
        },

        addMasterItem() { 
            // KUNCI: Tidak bisa tambah halaman di Format B & C
            if (this.global.header_type !== 'standar') return;
            this.masterConfig.push({ title: 'JUDUL BARU', layout: '8' }); 
        },

        removeMasterItem(index) { 
            this.masterConfig.splice(index, 1); 
        },

        removePhoto(sheetIndex, photoIndex) {
            let newPhotos = [...this.sheets[sheetIndex].photos];
            newPhotos[photoIndex] = null;
            this.sheets[sheetIndex].photos = newPhotos;
        },

        async compressImage(file) {
            return new Promise((resolve) => {
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = (event) => {
                    const img = new Image();
                    img.src = event.target.result;
                    img.onload = () => {
                        const canvas = document.createElement('canvas');
                        const scale = Math.min(1, 1500 / img.width); 
                        canvas.width = img.width * scale;
                        canvas.height = img.height * scale;
                        const ctx = canvas.getContext('2d');
                        ctx.imageSmoothingEnabled = true;
                        ctx.imageSmoothingQuality = 'high';
                        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
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