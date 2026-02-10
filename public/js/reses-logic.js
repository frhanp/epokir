function resesApp() {
    return {
        isProcessing: false,

        masterConfig: [
            { title: "PENERIMA TRANSPORT", layout: "8" },
            { title: "KURSI", layout: "8" },
            { title: "SOUND SYSTEM", layout: "6" },
            { title: "MASTER OF CEREMONY (MC)", layout: "3" },
            { title: "MAKANAN BERAT/PRASMANAN", layout: "8" },
            { title: "SNACK RINGAN", layout: "8" },
        ],

        global: {
            header_type: "standar",
            deskripsi:
                "KUNJUNGAN DALAM RANGKA MENINJAU\nMASYARAKAT PENERIMA BANTUAN TERNAK SAPI\nDI DESA BULOTA KECAMATAN TELAGA JAYA",
            masa_sidang:
                "“Kegiatan Reses Masa Persidangan Kedua Tahun 2025 - 2026”",
            dapil: "Daerah Pemilihan (Dapil) III Kabupaten Gorontalo A",
            tanggal: "Senin, 2 Februari 2026",
        },

        sheets: [],

        initData() {
            this.generateFromMaster();
        },

        // --- UPDATE 1: LOGIKA RESET HALAMAN ---
        onHeaderChange() {
            const type = this.global.header_type;

            if (type === "standar") {
                this.masterConfig = [
                    { title: "PENERIMA TRANSPORT", layout: "8" },
                    { title: "KURSI", layout: "8" },
                    { title: "SOUND SYSTEM", layout: "6" },
                    { title: "MASTER OF CEREMONY (MC)", layout: "3" },
                    { title: "MAKANAN BERAT/PRASMANAN", layout: "8" },
                    { title: "SNACK RINGAN", layout: "8" },
                ];
            } else if (type === "tatap_muka") {
                // FORMAT B: Reset jadi 1 Halaman, Layout 6
                this.masterConfig = [
                    { title: "DOKUMENTASI TATAP MUKA", layout: "6" },
                ];
            } else {
                // FORMAT C: Reset jadi 1 Halaman, Layout 8 (Default)
                this.masterConfig = [
                    { title: "DOKUMENTASI KEGIATAN", layout: "8" },
                ];
            }
            this.generateFromMaster();
        },

        generateFromMaster() {
            this.sheets = this.masterConfig.map((config) => ({
                id: Date.now() + Math.random(),
                title: config.title,
                layout: config.layout,
                tanggal: this.global.tanggal,
                photos: new Array(parseInt(config.layout)).fill(null),
            }));
        },

        // --- UPDATE 2: LOGIKA TINGGI KOTAK ---
        getBoxHeight(layout) {
            const l = parseInt(layout);
            const type = this.global.header_type;

            // KASUS 1: Format B (Tatap Muka - 6 Kotak)
            // Kita set 70mm agar 3 baris memenuhi halaman (3x70 = 210mm)
            // Ubah dari 70mm jadi 73mm
            if (type === "tatap_muka") return "73mm";

            // KASUS 2: Format C (Kunjungan - 8 Kotak)
            // Tetap 54mm agar 4 baris muat (4x54 = 216mm)
            if (type === "kunjungan") return "54mm";

            // KASUS 3: Format A (Standar)
            if (l === 3) return "110mm";
            if (l === 6) return "75mm";
            return "55mm";
        },

        addMasterItem() {
            if (this.global.header_type !== "standar") return;
            this.masterConfig.push({ title: "JUDUL BARU", layout: "8" });
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
                        const canvas = document.createElement("canvas");
                        const scale = Math.min(1, 1500 / img.width);
                        canvas.width = img.width * scale;
                        canvas.height = img.height * scale;
                        const ctx = canvas.getContext("2d");
                        ctx.imageSmoothingEnabled = true;
                        ctx.imageSmoothingQuality = "high";
                        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                        resolve(canvas.toDataURL("image/jpeg", 0.9));
                    };
                };
            });
        },

        async handleFile(file, sheetIndex, photoIndex) {
            if (!file.type.startsWith("image/")) return;
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
            event.target.value = "";
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
            if (this.isProcessing) {
                alert("Tunggu proses gambar selesai...");
                return;
            }
            document.getElementById("form-pdf").submit();
        },
    };
}
