<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kop Surat Universitas Ibnu Sina</title>

    <style>
      body {
        font-family: Arial, sans-serif;
        margin: 20px;
      }

      .kop-surat {
        text-align: center;
        margin-bottom: 20px;
      }

      .kop-surat img {
        float: left;
        width: 100px;
        margin-right: 10px;
      }

      .kop-surat h1 {
        font-size: 20px;
        font-weight: bold;
        margin: 0;
        color: green;
      }

      .kop-surat h2 {
        font-size: 36px;
        margin: 0;
        color: green;
      }

      .kop-surat h3 {
        font-size: 24px;
        margin: 0;
        color: red;
      }

      .kop-surat p {
        font-size: 16px;
        margin: 5px 0;
        color: black;
        margin-left: 110px;
      }

      .kop-surat .contact-info {
        margin-top: 5px;
        font-size: 14px;
      }

      .kop-surat hr {
        border: none;
        border-top: 3px solid green;
        margin: 2px 0;
      }

      .kop-surat hr.thin {
        border-top: 1px solid green;
      }

      .letter-header {
        width: 100%;
        margin-bottom: 20px;
      }

      .letter-header td {
        vertical-align: top;
      }

      .letter-header .left {
        text-align: left;
      }

      .letter-header .right {
        text-align: right;
      }

      .subject {
        margin-top: 20px;
        font-weight: bold;
      }

      .content {
        margin-top: 20px;
        text-align: justify;
      }

      .details-table {
        margin: 20px 0;
        margin-left: 50px;
      }

      .details-table td {
        padding: 5px 0;
      }

      .details-table td:first-child {
        width: 150px;
      }

      .details-table td:nth-child(2) {
        width: 10px;
      }

      .footer {
        margin-top: 40px;
      }

      .signature-section {
        margin-top: 40px;
        position: relative;
        width: 100%;
        height: 150px;
        text-align: left;
      }

      .signature-section img.stamp {
        width: 230px;
        opacity: 1;
        position: relative;
        margin-left: -130px;
        margin-top: -20px;
      }

      .signature-section img.cap {
        width: 150px;
        opacity: 1;
        position: relative;
        margin-left: -80px;
        margin-top: -30px;
        margin-bottom: -10px;
      }

      .signature-section .text {
        position: absolute;
        top: 20px;
        right: 0;
        text-align: left;
      }

      .signature-section .text p {
        margin: 0;
        font-size: 14px;
      }

      .signature-section .text strong {
        font-size: 14px;
        margin-bottom: 200px;
      }

      .footer {
        font-size: 14px;
      }

      .signature-section .tembusan {
        float: left;
        /* Tembusan di sebelah kiri */
        margin-left: 0;
        /* Menjaga tembusan di tepi kiri */
        text-align: left;
        /* Text di-align ke kiri */
      }
    </style>

  </head>

  <body onload="window.print()">
    <?php
    use Carbon\Carbon;
    
    // Mendapatkan nama bulan dalam format 'M Y'
    $bulan = Carbon::now()->format('F Y');
    
    // Membuat peta daftar nama bulan ke angka Romawi
    $petaRomawi = [
        'January' => 'I',
        'February' => 'II',
        'March' => 'III',
        'April' => 'IV',
        'May' => 'V',
        'June' => 'VI',
        'July' => 'VII',
        'August' => 'VIII',
        'September' => 'IX',
        'October' => 'X',
        'November' => 'XI',
        'December' => 'XII',
    ];
    
    // Memetakan nama bulan ke angka Romawi
    $bulanRomawi = $petaRomawi[date('F', strtotime($bulan))];
    ?>

    <!-- Kop Surat Section -->
    <div class="kop-surat">
      <!-- Logo Universitas Ibnu Sina -->
      <img src="{{ asset('assets/img/surat/logouis.png') }}" alt="Logo Universitas Ibnu Sina">

      <!-- Informasi Universitas -->
      <div class="text-center">
        <h1>YAYASAN PENDIDIKAN IBNU SINA BATAM (YAPISTA)</h1>
        <h2>UNIVERSITAS IBNU SINA (UIS)</h2>
        <h3>FAKULTAS SAINS DAN TEKNOLOGI</h3>
        <p>Jalan Teuku Umar, Lubuk Baja Kota Batam Indonesia Telp. 0778 425391</p>
        <p>Email: fakultas.teknik@uis.ac.id | Website: fst.uis.ac.id</p>
      </div>

      <!-- Garis Pembatas -->
      <hr>
      <hr class="thin">
    </div>

    <!-- Letter Content Section -->

    <table class="letter-header">
      <tr>
        <td class="left">Nomor</td>
        <td>:</td>
        <td>{{ $surat->kodepro }}/KE/FST-UIS/YAPISTA/{{ $bulanRomawi }}/{{ \Carbon\Carbon::now()->format('Y') }}</td>
        <td class="right" id="tanggal"></td>

      </tr>
      <tr>
        <td class="left">Lampiran</td>
        <td>:</td>
        <td>-</td>
      </tr>
      <tr>
        <td class="left">Perihal</td>
        <td>:</td>
        @if ($surat->jenis_surat == 'surat kp')
          <td><strong>Permohonan Kerja Praktek</strong></td>
        @else
          <td class="left"><strong>Permohonan Izin Penelitian</strong></td>
        @endif
      </tr>
    </table>


    <div class="subject" style="line-height: 1.5; margin-top: 20px;">
        <p style="margin: 0;">Kepada Yth.</p>
        <p style="margin: 0;">{{ $surat->tujuan }}</p>
        <p style="margin: 0;">di</p>
        <p style="margin: 0;">- Tempat</p>
      </div>
      

    @if ($surat->jenis_surat == 'surat kp')
      <div class="content">
        <p>
          Bersama ini kami sampaikan bahwa berdasarkan Peraturan Akademik di Fakultas
          Teknik Universitas Ibnu Sina, dimana setiap Mahasiswa yang telah lulus minimal
          120 SKS diwajibkan mengikuti Kerja Praktek di Perusahaan. Untuk itu kami mohon
          kesediaan Bapak / Ibu kiranya dapat menerima Mahasiswa kami untuk melakukan
          Kerja Praktek selama 3 (tiga) bulan pada Perusahaan yang Bapak / Ibu Pimpin.
          Adapun mahasiswa yang dimaksud sebagai berikut :
        </p>
      </div>

      <table class="details-table">
        <tr>
          <td>Nama Mahasiswa</td>
          <td>:</td>
          <td>{{ $surat->user->name }}</td>
        </tr>
        <tr>
          <td>NPM</td>
          <td>:</td>
          <td>{{ $surat->user->no_unik }}</td>
        </tr>
        <tr>
          <td>Program Studi</td>
          <td>:</td>
          <td>{{ $surat->user->prodi }}</td>
        </tr>
      </table>
    @else
      <div class="content">
        <p>
          Bersama ini kami sampaikan bahwa sehubungan dengan rencana penelitian dalam penyelesaian skripsi Mahasiswa,
          untuk itu kami mengharapkan kepada Bapak/Ibu kiranya dapat memberikan izin penelitian pada perusahaan/instansi
          yang Bapak/Ibu pimpin. Adapun Mahasiswa yang dimaksud sebagai berikut:
        </p>
      </div>

      <table class="details-table">
        <tr>
          <td>Nama Mahasiswa</td>
          <td>:</td>
          <td>{{ $surat->user->name }}</td>
        </tr>
        <tr>
          <td>NPM</td>
          <td>:</td>
          <td>{{ $surat->user->no_unik }}</td>
        </tr>
        <tr>
          <td>Program Studi</td>
          <td>:</td>
          <td>{{ $surat->user->prodi }}</td>
        </tr>
        <tr>
          <td>Judul</td>
          <td>:</td>
          <td>{{ $surat->judul_penelitian }}</td>
        </tr>
      </table>
    @endif

    <div class="content">
      <p>
        Demikianlah surat permohonan ini kami buat, atas bantuan dan kerjasamanya diucapkan terima kasih.
      </p>
    </div>

    <!-- Signature Section with Stamp -->
    <div class="signature-section">
      <div class="text" style="text-align: left; margin-top: 20px;">
        <p style="margin: 0;">Dekan Fakultas Sains dan Teknologi</p>
        <p style="margin: 0;">Universitas Ibnu Sina</p>
        <div
          style="display: flex; flex-direction: column; justify-content: left; align-items: center; margin-top: 15px;">

          <!-- Cap and Signature -->
          <div style="display: flex; justify-content: center; align-items: center; margin-bottom: -10px;">
            <img src="{{ asset('assets/img/surat/sanusi.png') }}" alt="Tanda Tangan" class="stamp"  style="width: 250px; position: absolute; z-index: 1; margin-top: 40px;">
            <img src="{{ asset('assets/img/surat/cap_fst.png') }}" alt="Stempel" class="cap" style="width: 110px; position: absolute; left: 40px; top: 50px; opacity: 0.8; z-index: 0;">
          </div>

          <!-- Name and NIP -->
          <div style="display: flex; align-items: center; text-align: left; margin-top: 80px;">
            <!-- paraf dekan II -->
            <img src="{{ asset('assets/img/surat/okta.png') }}" alt="Paraf" class="paraf"
              style="width: 15px; margin-right: 5px; margin-left: -30px">

            <!-- nama dekan -->
            <div>
              <p style="margin: 0; font-weight: bold; text-decoration: underline;">Ir. Sanusi, ST., M.Eng., Ph.D., IPM
              </p>
              <p style="margin: 0;">NIP. 7770517640</p>
            </div>

          </div>
        </div>
      </div>
    </div>

    <!-- Footer Section -->
    <div class="footer">
      <p>Tembusan:</p>
      <p style="margin-left: 25px; margin-bottom: 30px;">- Arsip</p>
    </div>



    <script>
      document.addEventListener("DOMContentLoaded", function() {
        // Array nama bulan dalam bahasa Indonesia
        var bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
          "November", "Desember"
        ];

        // Mendapatkan tanggal saat ini
        var tanggalSekarang = new Date();
        var tanggal = tanggalSekarang.getDate();
        var namaBulan = bulan[tanggalSekarang.getMonth()];
        var tahun = tanggalSekarang.getFullYear();

        // Format tanggal: Batam, 07 November 2023
        var tanggalIndonesia = `Batam, ${tanggal} ${namaBulan} ${tahun}`;

        // Menyisipkan tanggal ke dalam elemen dengan id 'tanggal'
        document.getElementById("tanggal").textContent = tanggalIndonesia;
      });
    </script>

  </body>

</html>
