<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan SPJ</title>
    <style>
        @page {
            margin: 10mm;
            margin-bottom: 5mm;
            margin-left: 10mm;
            margin-right: 10mm;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12pt;
        }

        .page-container {
            page-break-after: always;
            width: 100%;
        }

        .page-container:last-child {
            page-break-after: avoid;
        }

        .header {
            text-align: center;
            margin-bottom: 5mm;
        }

        .header p {
            margin: 1px 0;
            font-size: 12pt;
            line-height: 1.3;
        }

        .h-bold {
            font-weight: bold;
            text-transform: uppercase;
        }

        .grid-table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            margin-left: -2.5mm;
            margin-right: -2.5mm;
        }

        .grid-table td {
            padding: 2.5mm;
            vertical-align: top;
        }

        .photo-box {
            border: 3px solid #000;
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

        /* Tinggi Kotak */
        .h-55mm {
            height: 55mm;
        }

        /* Standar */
        .h-47mm {
            height: 54mm;
        }

        /* Format B/C (Lebih pendek biar header muat) */
        .h-75mm {
            height: 75mm;
        }

        .h-110mm {
            height: 110mm;
        }

        .empty-text {
            text-align: center;
            color: #ccc;
            font-weight: bold;
            font-size: 20px;
            padding-top: 25%;
        }
    </style>
</head>

<body>

    @foreach ($sheets as $sheet)
        <div class="page-container">

            <div class="header">
                {{-- FORMAT A: STANDAR --}}
                @if ($global_header_type == 'standar')
                    <p>Lampiran Fhoto</p>
                    <p class="h-bold">{{ $sheet['title'] ?? 'KEGIATAN' }}</p>
                    <p>{{ $global_masa_sidang }}</p>
                    <p>{{ $global_dapil }}</p>
                    <p>{{ $sheet['tanggal'] ?? '' }}</p>

                    {{-- FORMAT B: TATAP MUKA (FIX DAPIL) --}}
                @elseif($global_header_type == 'tatap_muka')
                    <p>Lampiran Foto</p>
                    <p>{{ $global_masa_sidang }}</p>

                    {{-- TAMBAHAN BARIS DAPIL --}}
                    <p>{{ $global_dapil }}</p>

                    <p class="h-bold">{!! nl2br(e($global_deskripsi)) !!}</p>
                    <p>{{ $sheet['tanggal'] ?? '' }}</p> {{-- Baris 4: Tanggal --}}

                    {{-- FORMAT C: KUNJUNGAN --}}
                @elseif($global_header_type == 'kunjungan')
                    <p>Lampiran Foto</p>
                    <p class="h-bold">{!! nl2br(e($global_deskripsi)) !!}</p>
                    <p>{{ $sheet['tanggal'] ?? '' }}</p>
                @endif
            </div>

            <table class="grid-table">
                @php
                    $photos = $sheet['photos'];
                    $layout = (int) $sheet['layout'];
                @endphp

                @if ($layout == 3)
                    <tr>
                        <td colspan="2">
                            <div class="photo-box h-110mm">
                                @if (!empty($photos[0]))
                                    <img src="{{ $photos[0] }}" class="photo-img">
                                @else
                                    <div class="empty-text">1</div>
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                            <div class="photo-box h-110mm">
                                @if (!empty($photos[1]))
                                    <img src="{{ $photos[1] }}" class="photo-img">
                                @else
                                    <div class="empty-text">2</div>
                                @endif
                            </div>
                        </td>
                        <td width="50%">
                            <div class="photo-box h-110mm">
                                @if (!empty($photos[2]))
                                    <img src="{{ $photos[2] }}" class="photo-img">
                                @else
                                    <div class="empty-text">3</div>
                                @endif
                            </div>
                        </td>
                    </tr>
                @else
                    @php
                        // Tentukan tinggi kotak
                        if ($layout == 6) {
                            $heightClass = 'h-75mm';
                        } else {
                            // Jika bukan standar (B/C), pakai 47mm
                            $heightClass = $global_header_type != 'standar' ? 'h-47mm' : 'h-55mm';
                        }
                    @endphp

                    @for ($i = 0; $i < count($photos); $i += 2)
                        <tr>
                            <td width="50%">
                                <div class="photo-box {{ $heightClass }}">
                                    @if (!empty($photos[$i]))
                                        <img src="{{ $photos[$i] }}" class="photo-img">
                                    @else
                                        <div class="empty-text">{{ $i + 1 }}</div>
                                    @endif
                                </div>
                            </td>
                            <td width="50%">
                                <div class="photo-box {{ $heightClass }}">
                                    @if (isset($photos[$i + 1]) && !empty($photos[$i + 1]))
                                        <img src="{{ $photos[$i + 1] }}" class="photo-img">
                                    @elseif($i + 1 < $layout)
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
