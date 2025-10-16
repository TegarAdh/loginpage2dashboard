<?php
// Set timezone ke Waktu Indonesia Barat
date_default_timezone_set('Asia/Jakarta');
// Set locale ke Bahasa Indonesia untuk nama hari dan bulan
setlocale(LC_TIME, 'id_ID.utf8', 'id_ID');

// --- BIODATA DIRI ---
$biodata = [
    "nama" => "Tegar Adhi Nugraha Christ During",
    "nim" => "4222301032",
    "prodi" => "Teknologi Rekayasa Robotika",
    "jurusan" => "Teknik Elektro",
    "pbl_project" => "Kontes Robot Sepak Bola Indonesia Beroda (KRSBI-B)",
    "image_url" => "https://avatars.githubusercontent.com/u/190075099?s=400&u=c0bc65ccc71f0a1a85a02dc840c89d8578aa9f7a&v=4"
];

// --- DAFTAR SENSOR DENGAN NILAI DUMMY ---
$sensors = [
    [
        "nama" => "Stereo Camera",
        "fungsi" => "Penglihatan 3D & Estimasi Jarak",
        "nilai" => "Aktif | Jarak: " . rand(5, 150) / 10 . " m",
        "image_url" => "https://cdn.shopify.com/s/files/1/0699/6927/products/Zed2ifacedawn.png?v=1742567417"
    ],
    [
        "nama" => "Proximity",
        "fungsi" => "Deteksi Objek (bola)",
        "nilai" => (rand(0, 1) == 1) ? "Objek Terdeteksi" : "Aman",
        "image_url" => "https://musbikhin.com/wp-content/uploads/2023/04/Proximity-Sensor-E18-D80nk-sensor.jpg"
    ],
    [
        "nama" => "Sensor Lidar",
        "fungsi" => "Pemetaan Lingkungan (360°)",
        "nilai" => rand(5, 15) . " Hz | " . number_format(rand(15000, 40000)) . " titik/detik",
        "image_url" => "https://www.bdtronics.com/pub/media/catalog/product/s/p/sparkfunrplidara2m8360laserrangescanner-sparkfun-sparkfun-3547-13-b_jpg_92.jpg"
    ],
    [
        "nama" => "Sensor IMU",
        "fungsi" => "Orientasi & Gerakan (Gyro + Accel)",
        "nilai" => "Roll: " . rand(-90, 90) . "°, Pitch: " . rand(-90, 90) . "°",
        "image_url" => "https://www.active-robots.com/media/catalog/product/cache/original/sparkfun-9dof-razor-imu-m0.jpg"
    ]
];

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - <?= htmlspecialchars($biodata['nama']) ?></title>
    <!-- Memuat Tailwind CSS dari CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Memuat Google Fonts untuk tampilan yang lebih baik -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Menggunakan font Inter sebagai default */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #111827; /* bg-gray-900 */
        }
        /* Efek gradasi pada teks heading */
        .gradient-text {
            background: linear-gradient(90deg, #38bdf8, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="text-gray-200 p-4 sm:p-8">

    <div class="max-w-5xl mx-auto space-y-8">

        <!-- Header -->
        <header class="text-center">
            <h1 class="text-4xl font-bold gradient-text">Dashboard Monitoring PBL</h1>
            <p class="text-gray-400 mt-2">Project Based Learning | <?= htmlspecialchars($biodata['pbl_project']) ?></p>
        </header>

        <!-- Bagian Biodata & Waktu -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- 1. Kartu Biodata -->
            <div class="md:col-span-2 bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-700">
                <h2 class="text-2xl font-semibold mb-4 border-b border-gray-600 pb-2 text-sky-400">Biodata Mahasiswa</h2>
                <!-- Layout diubah untuk menampung gambar -->
                <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6">
                    <img src="<?= htmlspecialchars($biodata['image_url']) ?>" alt="Foto Profil" class="w-32 h-32 rounded-full border-4 border-gray-700 flex-shrink-0">
                    <div class="space-y-3 text-lg text-center sm:text-left">
                        <p><strong class="font-medium text-gray-400 w-24 inline-block">Nama</strong>: <?= htmlspecialchars($biodata['nama']) ?></p>
                        <p><strong class="font-medium text-gray-400 w-24 inline-block">NIM</strong>: <?= htmlspecialchars($biodata['nim']) ?></p>
                        <p><strong class="font-medium text-gray-400 w-24 inline-block">Prodi</strong>: <?= htmlspecialchars($biodata['prodi']) ?></p>
                        <p><strong class="font-medium text-gray-400 w-24 inline-block">Jurusan</strong>: <?= htmlspecialchars($biodata['jurusan']) ?></p>
                    </div>
                </div>
            </div>

            <!-- 2. Kartu Waktu Saat Ini -->
            <div class="bg-gray-800 p-6 rounded-xl shadow-lg flex flex-col justify-center items-center border border-gray-700">
                <h2 class="text-2xl font-semibold mb-3 text-sky-400">Waktu Saat Ini</h2>
                <div class="text-center">
                    <p id="waktu-hari" class="text-xl font-medium"><?= strftime('%A') ?></p>
                    <p id="waktu-tanggal" class="text-lg text-gray-400"><?= strftime('%d %B %Y') ?></p>
                    <p id="waktu-jam" class="text-5xl font-bold my-2 tracking-wider gradient-text"><?= date('H:i:s') ?></p>
                </div>
            </div>

        </div>

        <!-- 3. Tabel Data Sensor -->
        <div class="bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-700">
            <h2 class="text-2xl font-semibold mb-4 text-sky-400">Data Sensor (Nilai Dummy)</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-700 text-gray-300 uppercase text-sm">
                        <tr>
                            <th class="p-4 rounded-tl-lg">No.</th>
                            <!-- Kolom baru untuk gambar -->
                            <th class="p-4">Gambar</th>
                            <th class="p-4">Nama Sensor</th>
                            <th class="p-4">Fungsi</th>
                            <th class="p-4 rounded-tr-lg">Nilai Terbaca</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sensors as $index => $sensor): ?>
                        <tr class="border-b border-gray-700 hover:bg-gray-700/50">
                            <td class="p-4 font-medium align-middle"><?= $index + 1 ?></td>
                            <td class="p-4 align-middle">
                                <!-- Menampilkan gambar sensor -->
                                <img src="<?= htmlspecialchars($sensor['image_url']) ?>" alt="Gambar <?= htmlspecialchars($sensor['nama']) ?>" class="w-24 h-auto rounded-lg object-cover">
                            </td>
                            <td class="p-4 font-semibold text-sky-300 align-middle"><?= htmlspecialchars($sensor['nama']) ?></td>
                            <td class="p-4 align-middle"><?= htmlspecialchars($sensor['fungsi']) ?></td>
                            <td class="p-4 font-mono text-lg align-middle"><?= htmlspecialchars($sensor['nilai']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- JavaScript untuk jam real-time -->
    <script>
        function updateTime() {
            const now = new Date();
            const optionsDate = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const locale = 'id-ID';

            // Mendapatkan komponen waktu
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');

            // Memperbarui elemen HTML
            document.getElementById('waktu-hari').textContent = new Intl.DateTimeFormat(locale, { weekday: 'long' }).format(now);
            document.getElementById('waktu-tanggal').textContent = new Intl.DateTimeFormat(locale, { year: 'numeric', month: 'long', day: 'numeric' }).format(now);
            document.getElementById('waktu-jam').textContent = `${hours}:${minutes}:${seconds}`;
        }
        // Memperbarui waktu setiap detik
        setInterval(updateTime, 1000);
        // Memanggil fungsi saat halaman pertama kali dimuat
        updateTime();
    </script>

</body>
</html>

