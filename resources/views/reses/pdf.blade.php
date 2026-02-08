<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan SPJ</title>
    <style>
        /* Margin: Atas/Kiri/Kanan 10mm. Bawah 5mm. */
        @page { margin: 10mm; margin-bottom: 5mm; margin-left: 10mm; margin-right: 10mm; }
        
        body { 
            /* GANTI FONT DI SINI */
            /* Kita pakai Helvetica/Arial agar terbaca Sans-Serif (Bersih) di PDF */
            font-family: 'Helvetica', 'Arial', sans-serif; 
            font-size: 12pt; 
        }
        
        .page-container { page-break-after: always; width: 100%; }
        .page-container:last-child { page-break-after: avoid; }

        .header { text-align: center; margin-bottom: 5mm; }
        .header h1 { font-size: 12pt; font-weight: normal; margin: 0; }
        .header h2 { font-size: 12pt; font-weight: bold; text-transform: uppercase; margin: 2px 0; }
        .header p { margin: 1px 0; font-size: 12pt; }

        /* TABEL UTAMA */
        .grid-table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse; 
            margin-left: -2.5mm; 
            margin-right: -2.5mm;
        }

        .grid-table td {
            padding: 2.5mm; /* GAP */
            vertical-align: top;
        }

        /* INNER BOX */
        .photo-box {
            border: 2px solid #000;
            background-color: #fff;
            width: 100%;
            position: relative;
            overflow: hidden;
            display: block;
        }

        .photo-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* --- TINGGI BOX (SAFE MODE) --- */
        
        /* Layout 8: 4 Baris */
        .h-55mm { height: 55mm; } 
        
        /* Layout 6: 3 Baris */
        .h-75mm { height: 75mm; } 
        
        /* Layout 3: 2 Baris */
        .h-110mm { height: 110mm; }

        .empty-text { 
            text-align: center; 
            color: #ccc; 
            font-weight: bold; 
            font-size: 20px; 
            line-height: 100%;
            padding-top: 25%;
        }
    </style>
</head>
<body>

    @foreach($sheets as $sheet)
    <div class="page-container">
        
        <div class="header">
            <h1>Lampiran Fhoto</h1>
            <h2>{{ $sheet['title'] ?? 'KEGIATAN' }}</h2>
            <p>{{ $global_masa_sidang }}</p>
            <p>{{ $global_dapil }}</p>
            <p>{{ $sheet['tanggal'] ?? '' }}</p>
        </div>

        <table class="grid-table">
            @php 
                $photos = $sheet['photos'];
                $layout = (int)$sheet['layout'];
            @endphp

            {{-- === LOGIC LAYOUT 3 KOTAK (2 BARIS) === --}}
            @if($layout == 3)
                <tr>
                    <td colspan="2">
                        <div class="photo-box h-110mm">
                            @if(!empty($photos[0])) <img src="{{ $photos[0] }}" class="photo-img" style="height: 110mm;"> 
                            @else <div class="empty-text">1</div> @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="50%">
                        <div class="photo-box h-110mm">
                            @if(!empty($photos[1])) <img src="{{ $photos[1] }}" class="photo-img" style="height: 110mm;"> 
                            @else <div class="empty-text">2</div> @endif
                        </div>
                    </td>
                    <td width="50%">
                        <div class="photo-box h-110mm">
                            @if(!empty($photos[2])) <img src="{{ $photos[2] }}" class="photo-img" style="height: 110mm;"> 
                            @else <div class="empty-text">3</div> @endif
                        </div>
                    </td>
                </tr>

            {{-- === LOGIC LAYOUT 6 & 8 === --}}
            @else
                @php
                    // Pilih tinggi berdasarkan layout
                    $heightClass = ($layout == 6) ? 'h-75mm' : 'h-55mm';
                    $imgHeight = ($layout == 6) ? '75mm' : '55mm';
                @endphp

                @for($i = 0; $i < count($photos); $i += 2)
                <tr>
                    <td width="50%">
                        <div class="photo-box {{ $heightClass }}">
                            @if(!empty($photos[$i])) <img src="{{ $photos[$i] }}" class="photo-img" style="height: {{ $imgHeight }};"> 
                            @else <div class="empty-text">{{ $i + 1 }}</div> @endif
                        </div>
                    </td>
                    <td width="50%">
                        <div class="photo-box {{ $heightClass }}">
                            @if(isset($photos[$i+1]) && !empty($photos[$i+1])) 
                                <img src="{{ $photos[$i+1] }}" class="photo-img" style="height: {{ $imgHeight }};"> 
                            @elseif($i+1 < $layout) 
                                <div class="empty-text">{{ $i + 2 }}</div>
                            @endif
                        </div>
                    </td>
                </tr>
                @endfor
            @endif
        </table>
    </div>
    @endforeach

</body>
</html>