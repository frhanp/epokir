<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Tanda Terima Pokir</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid black; padding: 5px; text-align: left; vertical-align: top; }
        th { background-color: #f0f0f0; text-align: center; }
        
        /* Layout Tanda Tangan sesuai gambar */
        .signature-container {
            width: 100%;
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }
        .sig-box {
            width: 40%;
            text-align: center;
        }
        .date-line {
            text-align: center;
            margin-bottom: 10px;
        }
        .sig-space {
            height: 60px; /* Ruang untuk tanda tangan */
        }
        
        /* Agar saat diprint tampilan bersih */
        @media print {
            button { display: none; }
            @page { size: landscape; margin: 1cm; }
        }
    </style>
</head>
<body onload="window.print()">

    <h2 style="text-align: center;">DAFTAR USULAN POKOK-POKOK PIKIRAN (POKIR)</h2>
    
    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th>Judul Permohonan</th> <th>Alamat</th>
                <th>Yang Bermohon</th>
                <th>Identitas</th>
                <th>Anggota DPRD Pengusul</th>
                <th>Ket Berkas</th>
                <th>Ket Penerima</th>
                <th>Dinas Terkait</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pokirs as $pokir)
            <tr>
                <td style="text-align: center">{{ $loop->iteration }}</td>
                <td>{{ $pokir->judul_lengkap }}</td> 
                <td>{{ $pokir->alamat }}</td>
                <td>{{ $pokir->nama_pemohon }}</td>
                <td>{{ $pokir->identitas_pemohon }}</td>
                <td>{{ $pokir->anggota_dprd }}</td>
                <td style="text-align: center">{{ $pokir->status_berkas }}</td>
                <td style="text-align: center">{{ $pokir->operator_penerima }}</td>
                <td>{{ $pokir->opd_tujuan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="signature-container">
        <div class="sig-box">
            <br> <div>YANG MENYERAHKAN</div>
            <div>Pendamping Fraksi Golkar</div>
            <div>Set. DPRD Provinsi Gorontalo</div>
            
            <div class="sig-space"></div>
            
            <div style="font-weight: bold; text-decoration: underline;">IVHON</div>
        </div>

        <div class="sig-box">
            <div class="date-line">Gorontalo, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
            <div>YANG MENERIMA</div>
            
            <div class="sig-space"></div>
            
            <div style="border-bottom: 1px solid black; width: 80%; margin: 0 auto;">&nbsp;</div>
            <div style="text-align: left; margin-left: 10%; margin-top: 5px;">NO. HP :</div>
        </div>
    </div>

</body>
</html>