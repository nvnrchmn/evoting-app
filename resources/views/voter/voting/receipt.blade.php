<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Sertifikat Bukti Voting</title>
    <style>
        /* Impor font DejaVu Sans untuk dukungan karakter yang lebih luas, penting untuk PDF */
        @font-face {
            font-family: 'DejaVu Sans';
            src: url('{{ public_path('fonts/DejaVuSans.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'DejaVu Sans';
            src: url('{{ public_path('fonts/DejaVuSans-Bold.ttf') }}') format('truetype');
            font-weight: bold;
            font-style: normal;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            text-align: center;
            padding: 20px;
            line-height: 1.6;
            background-color: #f0f0f0;
            /* Latar belakang abu-abu muda */
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            max-height: 100vh;
        }

        .certificate-container {
            /* Lebar yang disesuaikan agar pas di kertas A4 potret (sekitar 210mm lebar fisik) */
            /* Dengan padding 50px di setiap sisi, total lebar konten adalah 600px - 100px = 500px */
            width: 575px;
            /* Lebar total kontainer */
            padding: 40px;
            /* Padding internal sertifikat, sedikit dikurangi */
            border: 2px solid #ccc;
            border-radius: 15px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: center;
            overflow: hidden;
            box-sizing: border-box;
            /* Pastikan padding termasuk dalam lebar total */
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 80px;
            color: rgba(0, 0, 0, 0.05);
            font-weight: bold;
            pointer-events: none;
            z-index: 0;
            white-space: nowrap;
        }

        .logo {
            width: 120px;
            /* Logo diperbesar 3x */
            margin-bottom: 15px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .main-title {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .sub-title {
            font-size: 16px;
            color: #777;
            margin-bottom: 30px;
            font-style: italic;
        }

        .data-section {
            background-color: #f9f9f9;
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 20px 20px;
            /* Padding sedikit dikurangi */
            margin-bottom: 35px;
            text-align: left;
        }

        .data-row {
            display: flex;
            margin-bottom: 10px;
            /* Jarak antar baris data sedikit dikurangi */
            align-items: baseline;
        }

        .data-label {
            font-weight: bold;
            color: #444;
            flex-basis: 150px;
            /* Lebar label sedikit dikurangi agar tidak over */
            flex-shrink: 0;
            text-align: right;
            padding-right: 15px;
        }

        .data-value {
            color: #222;
            flex-grow: 1;
            font-size: 15px;
            word-wrap: break-word;
            /* Memastikan teks panjang pecah baris */
        }

        .acknowledgement {
            font-size: 13px;
            color: #666;
            margin-top: 30px;
            /* Jarak atas pengakuan sedikit dikurangi */
            line-height: 1.8;
            padding: 0 20px;
            /* Tambahkan padding horizontal agar tidak terlalu lebar */
        }

        .system-note {
            font-size: 12px;
            color: #999;
            margin-top: 20px;
            font-style: italic;
            padding: 0 20px;
            /* Tambahkan padding horizontal agar tidak terlalu lebar */
        }
    </style>
</head>

<body>
    <div class="certificate-container">
        {{-- Watermark opsional --}}
        <div class="watermark">E-Voting App</div>

        {{-- Logo (diperbesar 3x) --}}
        <img src="{{ public_path('./images/logo.png') }}" class="logo" alt="Logo E-Voting">

        <div class="main-title">Sertifikat Bukti Voting</div>
        <div class="sub-title">Sistem Pemilihan Ketua & Wakil Berbasis Digital</div>

        <div class="data-section">
            <div class="data-row">
                <span class="data-label">Nama Pemilih:</span>
                <span class="data-value">{{ $user->name }}</span>
            </div>
            <div class="data-row">
                <span class="data-label">Email Pemilih:</span>
                <span class="data-value">{{ $user->email }}</span>
            </div>
            {{-- Anda bisa mengaktifkan baris ini jika data $vote tersedia --}}
            {{-- <div class="data-row">
                <span class="data-label">ID Voting:</span>
                <span class="data-value">#{{ $vote->id }}</span>
            </div> --}}
            <div class="data-row">
                <span class="data-label">Waktu Voting:</span>
                <span class="data-value">{{ $timestamp }}</span>
            </div>
            {{-- <div class="data-row">
                <span class="data-label">Pilihan Kandidat:</span>
                <span class="data-value">{{ $vote->candidate_name ?? 'Data tidak tersedia' }}</span>
            </div> --}}
            {{-- <div class="data-row">
                <span class="data-label">ID Kandidat:</span>
                <span class="data-value">{{ $vote->candidate_id }}</span>
            </div> --}}
        </div>
        <div style="text-align: center; margin-top: 30px;">
            <p>Scan QR Code untuk melihat detail hasil voting:</p>
            <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code">
        </div>

        <div class="acknowledgement">
            Dengan ini menyatakan bahwa pemilih di atas telah berhasil menggunakan hak suara mereka dalam pemilihan
            secara **sah dan tercatat** dalam sistem E-Voting Digital.
            Terima kasih atas partisipasi Anda yang berharga dalam proses demokrasi ini.
        </div>

        <div class="system-note">
            Sertifikat ini dibuat secara otomatis oleh sistem e-voting pada {{ date('d M Y H:i:s') }}.
            Mohon simpan sebagai bukti partisipasi Anda.
        </div>
    </div>
</body>

</html>