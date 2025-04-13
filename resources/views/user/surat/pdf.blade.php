<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $surat->nomor_surat ?? 'Surat' }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            margin: 0;
            padding: 2cm;
        }
        .header {
            text-align: center;
            margin-bottom: 1cm;
            border-bottom: 3px solid #000;
            padding-bottom: 0.5cm;
        }
        .header h1 {
            font-size: 16pt;
            margin: 0;
            text-transform: uppercase;
        }
        .header p {
            margin: 5px 0;
        }
        .content {
            margin-bottom: 1cm;
        }
        .meta {
            margin-bottom: 1cm;
        }
        .meta table {
            width: 100%;
        }
        .meta td {
            padding: 3px 0;
            vertical-align: top;
        }
        .right-align {
            text-align: right;
        }
        .footer {
            margin-top: 2cm;
        }
        .signature {
            float: right;
            width: 40%;
            text-align: center;
        }
        .signature-space {
            height: 2cm;
        }
        .clearfix {
            clear: both;
        }
        .stamp {
            position: relative;
        }
        .stamp img {
            position: absolute;
            top: -1cm;
            right: 2cm;
            opacity: 0.8;
            width: 3cm;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Universitas Bahaudin Mudhary Madura</h1>
        <p>Jl. Pendidikan No. 123, Kota Sample, Indonesia</p>
        <p>Telepon: (021) 1234567 | Email: info@universitassample.ac.id</p>
    </div>

    <div class="meta">
        <table>
            <tr>
                <td style="width: 100px;">Nomor</td>
                <td>: {{ $surat->nomor_surat }}</td>
                <td class="right-align">{{ $surat->created_at->format('d F Y') }}</td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td>: {{ $surat->lampiran ? '1 berkas' : '-' }}</td>
                <td></td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td>: {{ $surat->perihal }}</td>
                <td></td>
            </tr>
        </table>
    </div>

    <div class="recipient">
        <p>Kepada Yth.<br>
        {{ $surat->tujuan }}<br>
        di Tempat</p>
    </div>

    <div class="content">
        {!! $surat->isi_surat !!}
    </div>

    <div class="footer">
        <div class="signature">
            <p>Hormat kami,</p>
            <div class="signature-space"></div>
            @if($surat->status == 'disetujui')
            <div class="stamp">
                <!-- If you have a digital stamp image -->
                <!-- <img src="path_to_stamp" alt="Digital Stamp"> -->
            </div>
            @endif
            <p><strong>{{ $surat->user->name ?? auth()->user()->name }}</strong><br>
            {{ $surat->user->nim ?? 'NIM/ID User' }}</p>
        </div>
        <div class="clearfix"></div>
    </div>
</body>
</html>