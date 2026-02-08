<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan SPJ</title>
    <style>
        @page { margin: 10mm; margin-bottom: 5mm; margin-left: 10mm; margin-right: 10mm; }
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 12pt; }
        
        .page-container { page-break-after: always; width: 100%; }
        .page-container:last-child { page-break-after: avoid; }

        .header { text-align: center; margin-bottom: 5mm; }
        .header p { margin: 1px 0; font-size: 12pt; }
        .h-bold { font-weight: bold; text-transform: uppercase; }

        .grid-table { width: 100%; table-layout: fixed; border-collapse: collapse; margin-left: -2.5mm; margin-right: -2.5mm; }
        .grid-table td { padding: 2.5mm; vertical-align: top; }

        /* BORDER DIUBAH KE 3PX SESUAI REQUEST */
        .photo-box { border: 3px solid #000; background-color: #fff; width: 100%; position: relative; overflow: hidden; display: block; }
        .photo-img { width: 100%; height: 100%; object-fit: cover; display: block; }
        
        /* --- TINGGI BOX --- */
        .h-55mm { height: 55mm; } /* Standar 8 Kotak */
        .h-48mm { height: 48mm; } /* KHUSUS Format B (Header Tinggi) */
        
        .h-75mm { height: 75mm; } /* 6 Kotak */
        .h-110mm { height: 110mm; } /* 3 Kotak */

        .empty-text { text-align: center; color: #ccc; font-weight: bold; font-size: 20px; padding-top: 25%; }
    </style>
</head>
<body>

    @foreach($sheets as $sheet)
    <div class="page-container">
        
        <div class="header">
            @if($global_header_type == 'standar')
                <p>Lampiran Fhoto</p>
                <p class="h-bold">{{ $sheet['title'] ?? 'KEGIATAN' }}</p>
                <p>{{ $global_masa_sidang }}</p>
                <p>{{ $global_dapil }}</p>
                <p>{{ $sheet['tanggal'] ?? '' }}</p>
            @elseif($global_header_type == 'tatap_muka')
                <p>Lampiran</p>
                <p>Foto</p>
                <p>{{ $global_masa_sidang }}</p>
                <p>Daerah</p>
                <p>{{ $global_dapil }}</p>
                <p class="h-bold">{{ $global_deskripsi }}</p>
                <p>{{ $sheet['tanggal'] ?? '' }}</p>
            @endif
        </div>

        <table class="grid-table">
            @php 
                $photos = $sheet['photos'];
                $layout = (int)$sheet['layout'];
            @endphp

            @if($layout == 3)
                {{-- LAYOUT 3 KOTAK --}}
                <tr>
                    <td colspan="2"><div class="photo-box h-110mm">@if(!empty($photos[0])) <img src="{{ $photos[0] }}" class="photo-img"> @else <div class="empty-text">1</div> @endif</div></td>
                </tr>
                <tr>
                    <td width="50%"><div class="photo-box h-110mm">@if(!empty($photos[1])) <img src="{{ $photos[1] }}" class="photo-img"> @else <div class="empty-text">2</div> @endif</div></td>
                    <td width="50%"><div class="photo-box h-110mm">@if(!empty($photos[2])) <img src="{{ $photos[2] }}" class="photo-img"> @else <div class="empty-text">3</div> @endif</div></td>
                </tr>
            @else
                {{-- LAYOUT 6 & 8 --}}
                @php 
                    // LOGIKA TINGGI BOX:
                    if ($layout == 6) {
                        $heightClass = 'h-75mm';
                    } else {
                        // Jika Layout 8: Cek Header Type
                        // Kalau 'tatap_muka', header tinggi -> kotak harus pendek (48mm)
                        // Kalau 'standar', header pendek -> kotak standar (55mm)
                        $heightClass = ($global_header_type == 'tatap_muka') ? 'h-48mm' : 'h-55mm';
                    }
                @endphp

                @for($i = 0; $i < count($photos); $i += 2)
                <tr>
                    <td width="50%"><div class="photo-box {{ $heightClass }}">@if(!empty($photos[$i])) <img src="{{ $photos[$i] }}" class="photo-img"> @else <div class="empty-text">{{ $i + 1 }}</div> @endif</div></td>
                    <td width="50%"><div class="photo-box {{ $heightClass }}">@if(isset($photos[$i+1]) && !empty($photos[$i+1])) <img src="{{ $photos[$i+1] }}" class="photo-img"> @elseif($i+1 < $layout) <div class="empty-text">{{ $i + 2 }}</div> @endif</div></td>
                </tr>
                @endfor
            @endif
        </table>
    </div>
    @endforeach

</body>
</html>