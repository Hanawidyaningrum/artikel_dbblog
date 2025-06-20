-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 20, 2025 at 05:53 AM
-- Server version: 9.0.1
-- PHP Version: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `artikel_dbblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int NOT NULL,
  `date` varchar(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `date`, `title`, `content`, `picture`) VALUES
(37, '2025-06-18 22:26:43', 'Rambu Solo’ dan Tongkonan: Simbol Kehidupan Suku Toraja', '<p class=\"first-paragraph\" style=\"-webkit-text-stroke-width:0px;background-color:rgb(255, 255, 255);color:rgb(68, 68, 68);font-family:&quot;Segoe UI&quot;, Tahoma, Geneva, Verdana, sans-serif;font-size:0.95rem;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;font-weight:400;letter-spacing:normal;line-height:1.6;margin-top:0px !important;orphans:2;text-align:justify;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\">Suku Toraja, yang mendiami wilayah pegunungan di Sulawesi Selatan, dikenal dengan kebudayaan unik dan kaya makna.<br>Dua simbol paling mencolok dari kehidupan mereka adalah Rambu Solo’ dan Tongkonan tradisi dan bangunan adat yang mencerminkan nilai spiritual, sosial, dan filosofi hidup masyarakat Toraja.<br><br>&nbsp;</p><div class=\"more-content\" style=\"-webkit-text-stroke-width:0px;background-color:rgb(255, 255, 255);color:rgb(51, 51, 51);display:block;font-family:&quot;Segoe UI&quot;, Tahoma, Geneva, Verdana, sans-serif;font-size:16px;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;font-weight:400;letter-spacing:normal;orphans:2;text-align:justify;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\"><h2>Rambu Solo’: Perjalanan Jiwa Menuju Alam Leluhur</h2><p>Rambu Solo’ adalah upacara pemakaman adat Toraja yang dianggap sebagai ritual paling sakral. Bagi masyarakat Toraja, kematian bukanlah akhir, melainkan perpindahan ke kehidupan selanjutnya. Upacara ini dilakukan dengan penuh penghormatan dan bisa berlangsung berhari-hari, tergantung pada status sosial almarhum.</p><p>Prosesi Rambu Solo’ meliputi penyembelihan kerbau, musik tradisional, tarian, hingga arak-arakan peti jenazah menuju tempat pemakaman di tebing batu. Patung Tau-Tau sering ditempatkan di dekat makam sebagai simbol arwah yang menjaga dan mendampingi keluarga yang ditinggalkan.</p><h2>Tongkonan: Rumah Adat yang Menyimpan Sejarah</h2><p>Tongkonan adalah rumah adat suku Toraja yang berbentuk seperti perahu terbalik. Rumah ini tidak hanya berfungsi sebagai tempat tinggal, tetapi juga sebagai pusat keluarga, tempat berkumpul, serta simbol kehormatan dan identitas sosial. Setiap Tongkonan diwariskan secara turun-temurun dan menyimpan silsilah serta cerita leluhur dalam ukiran-ukiran kayunya.</p><p>Letak Tongkonan biasanya menghadap ke utara sebagai simbol kehidupan, sedangkan lumbung padi berada di seberangnya sebagai penyeimbang. Dengan desain dan makna yang mendalam, Tongkonan menjadi lambang keterikatan masyarakat Toraja dengan alam, leluhur, dan kebersamaan.</p><h2>Kesimpulan</h2><p>Kebudayaan Suku Toraja mencerminkan keterikatan yang kuat antara kehidupan, kematian, dan warisan leluhur. Melalui upacara Rambu Solo’ dan bangunan adat Tongkonan, masyarakat Toraja menunjukkan penghormatan mendalam terhadap nilai spiritual, sosial, dan filosofi hidup mereka. Kedua simbol ini menjadi identitas budaya yang kaya makna dan diwariskan dari generasi ke generasi, menjadikan Toraja sebagai salah satu kebudayaan yang unik dan bernilai tinggi di Indonesia.</p></div>', '6852dab3bee79.jpg'),
(38, '2025-06-18 22:32:01', 'Menari di Kabut: Romantika Fajar di Gunung Bromo', '<p class=\"first-paragraph\" style=\"-webkit-text-stroke-width:0px;background-color:rgb(255, 255, 255);color:rgb(68, 68, 68);font-family:&quot;Segoe UI&quot;, Tahoma, Geneva, Verdana, sans-serif;font-size:0.95rem;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;font-weight:400;letter-spacing:normal;line-height:1.6;margin-top:0px !important;orphans:2;text-align:justify;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\">Gunung Bromo adalah salah satu destinasi wisata paling ikonik di Indonesia, yang terletak di kawasan Taman Nasional Bromo Tengger Semeru, Jawa Timur. Dengan ketinggian 2.329 meter di atas permukaan laut, Gunung Bromo masih tergolong gunung berapi aktif, namun keindahan alam dan keunikan budayanya terus menarik perhatian wisatawan lokal maupun mancanegara. Keunikan ini memberikan nama \"Batu Bengkung\" pada pantai tersebut.<br>&nbsp;</p><div class=\"more-content\" style=\"-webkit-text-stroke-width:0px;background-color:rgb(255, 255, 255);color:rgb(51, 51, 51);display:block;font-family:&quot;Segoe UI&quot;, Tahoma, Geneva, Verdana, sans-serif;font-size:16px;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;font-weight:400;letter-spacing:normal;orphans:2;text-align:justify;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\"><h2>Pesona Alam yang Memuakau</h2><p>Gunung Bromo terkenal dengan pemandangan matahari terbitnya yang spektakuler. Dari puncak Penanjakan, wisatawan dapat menyaksikan panorama sunrise dengan latar belakang Gunung Semeru yang gagah dan kepulan asap dari kawah Bromo. Lautan pasir yang luas dan gurun berwarna coklat keabu-abuan memberikan nuansa seperti berada di luar negeri.</p><h2>Kawah Bromo dan Lautan Pasir</h2><p>Kawah Bromo bisa dicapai dengan berjalan kaki atau menunggang kuda dari area parkir Jeep. Setibanya di tangga menuju kawah, pengunjung harus menaiki sekitar 250 anak tangga untuk melihat langsung isi kawah yang terus mengeluarkan asap putih. Sementara itu, Lautan Pasir Bromo yang luas menciptakan lanskap dramatis yang memikat hati.</p><h2>Akses dan Fasilitas</h2><p>Gunung Bromo dapat diakses dari beberapa jalur, seperti melalui Probolinggo, Pasuruan, atau Malang.Jalur paling populer adalah via Cemoro Lawang, desa terakhir sebelum memasuki area Bromo. Tersedia berbagai penginapan, warung makan, hingga jasa sewa Jeep untuk mengelilingi kawasan Taman Nasional.</p><h2>Kesimpulan</h2><p>Gunung Bromo merupakan destinasi wisata alam yang menawarkan pesona luar biasa, mulai dari panorama matahari terbit, kawah aktif, hingga lautan pasir yang unik. Terletak di Taman Nasional Bromo Tengger Semeru, gunung ini tidak hanya menyuguhkan keindahan alam, tetapi juga pengalaman budaya dan petualangan yang tak terlupakan. Akses yang cukup mudah dan fasilitas yang memadai menjadikan Bromo sebagai tujuan favorit wisatawan dari dalam maupun luar negeri.</p></div>', '6852dbf1d224c.jpg'),
(39, '2025-06-18 22:33:31', 'Peran Teknologi dalam Meningkatkan Kualitas Pembelajaran', '<p class=\"first-paragraph\" style=\"-webkit-text-stroke-width:0px;background-color:rgb(255, 255, 255);color:rgb(68, 68, 68);font-family:&quot;Segoe UI&quot;, Tahoma, Geneva, Verdana, sans-serif;font-size:0.95rem;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;font-weight:400;letter-spacing:normal;line-height:1.6;margin-top:0px !important;orphans:2;text-align:justify;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\">Di era digital yang semakin berkembang pesat, teknologi tidak hanya mengubah cara kita berkomunikasi, bekerja, dan berbelanja, tetapi juga telah merevolusi dunia pendidikan. Penggunaan teknologi dalam proses pembelajaran telah membawa banyak perubahan positif, mulai dari kemudahan akses informasi hingga terciptanya metode belajar yang lebih interaktif dan efektif. Hal ini menunjukkan bahwa teknologi memiliki peran yang sangat penting dalam meningkatkan kualitas pembelajaran di berbagai jenjang pendidikan.</p><div class=\"more-content\" style=\"-webkit-text-stroke-width:0px;background-color:rgb(255, 255, 255);color:rgb(51, 51, 51);display:block;font-family:&quot;Segoe UI&quot;, Tahoma, Geneva, Verdana, sans-serif;font-size:16px;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;font-weight:400;letter-spacing:normal;orphans:2;text-align:justify;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\"><h2>Pembelajaran Lebih Fleksibel dan Aksesibel</h2><p>Salah satu dampak paling nyata dari kemajuan teknologi dalam pendidikan adalah fleksibilitas belajar. Dengan adanya internet dan platform pembelajaran online, siswa kini bisa belajar dari mana saja dan kapan saja. Aplikasi seperti Google Classroom, Zoom, Moodle, atau Ruangguru memungkinkan siswa dan guru untuk tetap terhubung meskipun berada di lokasi yang berbeda.</p><p>Teknologi juga membantu menjangkau wilayah-wilayah terpencil yang sebelumnya sulit mendapatkan akses pendidikan. Dengan bantuan perangkat seperti tablet dan jaringan internet, anak-anak di daerah pelosok dapat menikmati materi pembelajaran yang sama dengan mereka yang berada di kota besar.</p><h2>Meningkatkan Interaktivitas dan Minat Belajar</h2><p>Berbeda dengan metode konvensional yang hanya mengandalkan ceramah di kelas, teknologi memungkinkan terciptanya pembelajaran yang lebih interaktif dan menyenangkan. Penggunaan video, animasi, game edukatif, dan simulasi virtual dapat membantu siswa memahami konsep-konsep sulit dengan lebih mudah.</p><p>Selain itu, siswa juga bisa belajar dengan kecepatan masing-masing. Mereka dapat mengulang materi yang belum dipahami atau memperdalam topik tertentu secara mandiri. Hal ini sangat membantu dalam menciptakan pembelajaran yang berpusat pada siswa (student-centered learning).</p><h2>Mendukung Guru dalam Proses Pengajaran</h2><p>Teknologi bukan hanya menguntungkan siswa, tetapi juga mempermudah kerja guru. Guru dapat menggunakan berbagai aplikasi untuk menyusun materi ajar, membuat kuis otomatis, memantau perkembangan siswa, hingga melakukan evaluasi pembelajaran secara efisien.</p><p>Dengan adanya sumber belajar digital yang melimpah, guru juga bisa lebih kreatif dalam mengajar. Mereka bisa menggabungkan berbagai media seperti teks, gambar, audio, dan video untuk memperkaya pengalaman belajar siswa.</p><h2>Tantangan dalam Penerapan Teknologi Pendidikan</h2><p>Meskipun manfaatnya besar, penerapan teknologi dalam pendidikan tidak lepas dari tantangan. Masalah utama yang sering muncul adalah keterbatasan infrastruktur, terutama di daerah yang belum memiliki akses internet stabil atau perangkat digital yang memadai. Selain itu, tidak semua guru dan siswa memiliki keterampilan digital yang cukup untuk memanfaatkan teknologi secara optimal.</p><p>Ada juga kekhawatiran mengenai ketergantungan terhadap teknologi, kurangnya interaksi sosial langsung, serta potensi gangguan fokus akibat terlalu banyaknya distraksi digital.</p><h2>Kesimpulan</h2><p>Teknologi telah membuka banyak peluang untuk meningkatkan kualitas pembelajaran. Dari penyediaan akses yang lebih luas hingga terciptanya metode belajar yang lebih interaktif, teknologi menjadi alat penting dalam mendukung pendidikan masa kini. Namun, agar manfaatnya bisa dirasakan secara merata, perlu adanya kolaborasi antara pemerintah, sekolah, guru, dan masyarakat untuk mengatasi tantangan yang ada. Dengan begitu, teknologi benar-benar bisa menjadi jembatan menuju pendidikan yang lebih baik, inklusif, dan berkualitas.</p></div>', '6852dc4b7ae19.jpeg'),
(40, '2025-06-19 03:40:10', 'Teknologi Blockchain di Luar Dunia Kripto: Solusi Transparansi Global', '<p data-start=\"237\" data-end=\"656\">Selama ini, banyak orang mengenal blockchain hanya sebatas sebagai fondasi mata uang kripto seperti Bitcoin atau Ethereum. Namun, teknologi ini jauh lebih luas dari sekadar transaksi digital. Blockchain hadir sebagai salah satu inovasi paling revolusioner dalam dunia teknologi informasi—memberikan solusi atas persoalan transparansi, kepercayaan, dan keamanan data yang selama ini menjadi tantangan di berbagai sektor.</p><h3 data-start=\"658\" data-end=\"681\">Apa Itu Blockchain?</h3><p data-start=\"683\" data-end=\"1073\">Secara sederhana, blockchain adalah sistem pencatatan digital yang terdistribusi dan tidak dapat diubah tanpa persetujuan mayoritas jaringan. Setiap blok data saling terhubung satu sama lain dalam urutan kronologis, membentuk sebuah rantai (chain). Karena data disimpan secara terdesentralisasi di banyak komputer (node), maka hampir tidak mungkin memanipulasi informasi yang telah dicatat.</p><h3 data-start=\"1075\" data-end=\"1121\">Mengapa Blockchain Penting di Luar Kripto?</h3><p data-start=\"1123\" data-end=\"1371\">Keunggulan blockchain terletak pada tiga prinsip utama: <strong data-start=\"1179\" data-end=\"1195\">transparansi</strong>, <strong data-start=\"1197\" data-end=\"1211\">integritas</strong>, dan <strong data-start=\"1217\" data-end=\"1229\">keamanan</strong>. Tiga hal ini sangat dibutuhkan dalam sistem digital modern, terutama di bidang yang rentan terhadap korupsi, penipuan, atau manipulasi data.</p><p data-start=\"1373\" data-end=\"1462\">Mari kita lihat bagaimana teknologi ini diimplementasikan dalam sektor-sektor non-kripto.</p><h5>1. <strong data-start=\"1476\" data-end=\"1515\">Pemerintahan dan Tata Kelola Publik</strong></h5><p data-start=\"1517\" data-end=\"1836\">Beberapa negara mulai menerapkan blockchain untuk menciptakan pemerintahan yang lebih transparan. Misalnya, pencatatan suara dalam pemilu bisa dilakukan secara digital dan tercatat permanen di blockchain, sehingga tidak bisa diubah atau direkayasa. Hal ini meningkatkan kepercayaan masyarakat terhadap proses demokrasi.</p><p data-start=\"1838\" data-end=\"2009\">Contoh lainnya adalah pengelolaan data kependudukan atau sertifikat tanah. Dengan blockchain, proses birokrasi yang panjang bisa dipangkas dan data lebih sulit dipalsukan.</p><h5>2. <strong data-start=\"2023\" data-end=\"2052\">Rantai Pasok dan Logistik</strong></h5><p data-start=\"2054\" data-end=\"2409\">Dalam industri makanan, farmasi, hingga produk elektronik, keaslian produk menjadi isu penting. Blockchain memungkinkan setiap tahapan distribusi barang tercatat dan dapat dilacak. Konsumen bisa mengetahui asal-usul produk yang mereka beli, apakah daging tersebut berasal dari peternakan bersertifikat? Apakah obat tersebut melewati jalur distribusi resmi?</p><p data-start=\"2411\" data-end=\"2579\">Contoh nyata: Walmart menggunakan blockchain untuk melacak asal buah-buahan, dan perusahaan seperti IBM telah mengembangkan sistem blockchain untuk rantai pasok global.</p><h5>3. <strong data-start=\"2593\" data-end=\"2622\">Kesehatan dan Rekam Medis</strong></h5><p data-start=\"2624\" data-end=\"2839\">Data kesehatan adalah aset yang sangat pribadi sekaligus penting. Blockchain memungkinkan rekam medis tersimpan dengan aman, hanya dapat diakses oleh pihak yang berwenang, dan memiliki histori akses yang transparan.</p><p data-start=\"2841\" data-end=\"3014\">Bayangkan seorang pasien bisa berpindah rumah sakit tanpa harus membawa dokumen fisik, karena data kesehatannya telah tersimpan secara aman dan universal melalui blockchain.</p><h5>4. <strong data-start=\"3028\" data-end=\"3058\">Pendidikan dan Sertifikasi</strong></h5><p data-start=\"3060\" data-end=\"3304\">Ijazah dan sertifikat digital kini juga mulai menggunakan blockchain. Universitas dan lembaga pelatihan dapat mencatatkan sertifikat di blockchain agar tidak mudah dipalsukan. Pemberi kerja pun bisa memverifikasi keaslian dokumen secara instan.</p><p data-start=\"3306\" data-end=\"3388\">Ini menjadi solusi untuk mengatasi maraknya pemalsuan ijazah dan kredensial palsu.</p><h5>5. <strong data-start=\"3402\" data-end=\"3453\">Hak Kekayaan Intelektual dan Seni Digital (NFT)</strong></h5><p data-start=\"3455\" data-end=\"3744\">Di luar kripto, NFT (Non-Fungible Token) merupakan bagian dari blockchain yang mengubah cara kita memandang seni dan kepemilikan digital. Dengan NFT, karya seni, musik, atau bahkan tulisan bisa dilindungi hak ciptanya dan diperjualbelikan dengan bukti kepemilikan yang tak bisa dipalsukan.</p><p data-start=\"3746\" data-end=\"3901\">Meskipun tren NFT sempat menuai kontroversi, potensinya sebagai alat pelindung hak cipta sangat besar jika diterapkan dengan etika dan regulasi yang tepat.</p><h3 data-start=\"3908\" data-end=\"3936\">Tantangan dan Masa Depan</h3><p data-start=\"3938\" data-end=\"4068\">Tentu saja, tidak semua hal bisa langsung berjalan mulus. Beberapa tantangan yang dihadapi dalam penerapan blockchain antara lain:</p><ul data-start=\"4070\" data-end=\"4247\"><li data-start=\"4070\" data-end=\"4146\"><p data-start=\"4072\" data-end=\"4146\"><strong data-start=\"4072\" data-end=\"4105\">Kurangnya pemahaman teknologi</strong> di tingkat pemerintahan atau organisasi.</p></li><li data-start=\"4147\" data-end=\"4195\"><p data-start=\"4149\" data-end=\"4195\"><strong data-start=\"4149\" data-end=\"4184\">Kebutuhan infrastruktur digital</strong> yang kuat.</p></li><li data-start=\"4196\" data-end=\"4247\"><p data-start=\"4198\" data-end=\"4247\"><strong data-start=\"4198\" data-end=\"4224\">Regulasi dan kebijakan</strong> yang masih berkembang.</p></li></ul><p data-start=\"4249\" data-end=\"4473\">Namun demikian, masa depan blockchain tampak menjanjikan. Seiring meningkatnya kebutuhan akan sistem yang lebih transparan dan bebas manipulasi, teknologi ini bisa menjadi fondasi sistem digital di berbagai bidang kehidupan.</p><h2 data-start=\"4480\" data-end=\"4490\">Penutup</h2><p data-start=\"4492\" data-end=\"4808\">Blockchain bukan sekadar teknologi di balik Bitcoin. Ia adalah alat revolusioner yang berpotensi membawa perubahan besar dalam tata kelola informasi dan kepercayaan di era digital. Di masa depan, semakin banyak sektor akan memanfaatkan blockchain untuk membangun sistem yang lebih adil, terbuka, dan dapat dipercaya.</p><p data-start=\"4810\" data-end=\"4901\">Di luar dunia kripto, blockchain adalah solusi untuk membangun dunia yang lebih transparan.</p>', '6853242a2b357.jpg'),
(41, '2025-06-19 03:44:34', 'Pendidikan Bukan Sekadar Nilai: Mengasah Karakter di Tengah Tekanan Akademik', '<p data-start=\"246\" data-end=\"631\">Dalam sistem pendidikan yang kerap berorientasi pada angka ranking, nilai ujian, dan sertifikat, sering kali esensi sejati dari pendidikan terabaikan. Banyak siswa, guru, bahkan orang tua terpaku pada hasil akademik, seolah nilai adalah satu-satunya tolak ukur keberhasilan. Padahal, pendidikan sejatinya memiliki misi yang lebih besar, yaitu membentuk karakter dan kepribadian yang utuh.</p><h3 data-start=\"633\" data-end=\"673\">Tekanan Akademik yang Semakin Tinggi</h3><p data-start=\"675\" data-end=\"1011\">Tak bisa dipungkiri, era sekarang adalah era kompetisi. Sejak usia dini, anak-anak sudah dituntut untuk unggul: ikut les tambahan, lomba ini-itu, hingga mengumpulkan portofolio untuk ke jenjang lebih tinggi. Di balik semua itu, tak jarang siswa mengalami stres, cemas, bahkan kehilangan semangat belajar karena terlalu fokus pada nilai.</p><p data-start=\"1013\" data-end=\"1204\">Tekanan ini juga berdampak pada cara sekolah menjalankan pembelajaran. Materi sering dikejar demi ujian, bukan dipahami mendalam. Nilai menjadi tujuan akhir, bukan proses belajar itu sendiri.</p><h3 data-start=\"1211\" data-end=\"1264\">Pendidikan Karakter: Pilar yang Sering Terlupakan</h3><p data-start=\"1266\" data-end=\"1533\">Pendidikan karakter bukanlah konsep baru. Ki Hajar Dewantara pun telah menekankan pentingnya pendidikan yang menumbuhkan <em data-start=\"1391\" data-end=\"1415\"><i>cipta, rasa, dan karsa</i></em>. Karakter seperti kejujuran, disiplin, tanggung jawab, empati, dan kerja sama adalah fondasi penting dalam kehidupan.</p><p data-start=\"1535\" data-end=\"1764\">Bayangkan seseorang dengan nilai sempurna namun tidak memiliki integritas, apakah ia bisa menjadi pemimpin yang baik? Atau siswa yang pintar tapi tak tahu cara menghargai perbedaan, apakah ia bisa menjadi warga global yang toleran?</p><p data-start=\"1766\" data-end=\"1873\">Nilai tinggi tanpa karakter hanya menciptakan pribadi yang rapuh saat menghadapi tantangan kehidupan nyata.</p><h3 data-start=\"1880\" data-end=\"1920\">Menyeimbangkan Nilai dan Nilai-nilai</h3><p data-start=\"1922\" data-end=\"2088\">Yang dibutuhkan bukan menghapus target akademik, melainkan menciptakan keseimbangan. Berikut beberapa pendekatan yang bisa dilakukan dalam sistem pendidikan kita:</p><h5>1. <strong data-start=\"2098\" data-end=\"2132\">Menerapkan Pendidikan Holistik</strong></h5><p data-start=\"2133\" data-end=\"2346\">Sekolah perlu merancang kurikulum yang tidak hanya fokus pada kognitif, tetapi juga afektif dan psikomotorik. Kegiatan seperti diskusi etika, proyek sosial, dan refleksi pribadi bisa dimasukkan dalam pembelajaran.</p><h5>2. <strong data-start=\"2356\" data-end=\"2398\">Peran Guru sebagai Pembimbing Karakter</strong></h5><p data-start=\"2399\" data-end=\"2603\">Guru bukan hanya pengajar mata pelajaran, tapi juga teladan nilai-nilai kehidupan. Cara guru berbicara, bersikap, dan memberi contoh akan membekas dalam diri siswa lebih dari sekadar teori di papan tulis.</p><h5>3. <strong data-start=\"2613\" data-end=\"2639\">Mengubah Cara Evaluasi</strong></h5><p data-start=\"2640\" data-end=\"2807\">Daripada hanya menguji hafalan, evaluasi bisa dilakukan melalui penilaian proyek, portofolio, atau refleksi diri. Dengan begitu, proses belajar menjadi lebih bermakna.</p><h5>4. <strong data-start=\"2817\" data-end=\"2853\">Peran Orang Tua yang Lebih Bijak</strong></h5><p data-start=\"2854\" data-end=\"3013\">Orang tua juga berperan besar. Memberi dukungan tanpa menekan, mendampingi tanpa membandingkan, serta menghargai proses belajar lebih dari sekadar hasil akhir.</p><h3 data-start=\"3020\" data-end=\"3050\">Pendidikan untuk Kehidupan</h3><p data-start=\"3052\" data-end=\"3283\">Pada akhirnya, pendidikan bukanlah perlombaan menuju nilai tertinggi, tapi perjalanan membentuk manusia seutuhnya. Anak-anak bukan mesin pencetak angka, melainkan individu yang sedang tumbuh dengan segala potensi dan kekurangannya.</p><p data-start=\"3285\" data-end=\"3509\">Kita butuh generasi yang tidak hanya cerdas secara intelektual, tapi juga matang secara emosional, kuat secara mental, dan baik secara moral. Karena di dunia nyata, yang diuji bukan hanya pengetahuan, tetapi juga <em data-start=\"3498\" data-end=\"3508\"><i>karakter</i></em>.</p><h3 data-start=\"3516\" data-end=\"3527\">Penutup</h3><p data-start=\"3529\" data-end=\"3800\">Masa depan bangsa tidak ditentukan oleh ranking tertinggi di kelas, tetapi oleh generasi yang mampu berpikir jernih, bersikap jujur, bekerja sama, dan bertindak dengan hati nurani. Sudah waktunya kita menyadari bahwa pendidikan bukan sekadar nilai tetapi nilai-nilai.</p>', '68532532212c5.jpg'),
(42, '2025-06-19 06:12:21', 'Batik Lasem: Warisan Budaya Tionghoa Jawa di Pantura yang Terlupakan', '<p data-start=\"237\" data-end=\"561\">Di pesisir utara Jawa, tepatnya di sebuah kota kecil bernama Lasem, Kabupaten Rembang, Jawa Tengah, tersimpan warisan budaya yang begitu kaya namun kian terlupakan: Batik Lasem. Bukan sekadar kain, batik ini adalah kisah pertemuan dua peradaban Jawa dan Tionghoa yang terekam melalui warna, motif, dan filosofi mendalam.</p><h3 data-start=\"563\" data-end=\"605\">Lasem: Kota Kecil, Jejak Sejarah Besar</h3><p data-start=\"607\" data-end=\"927\">Lasem dikenal sebagai kota tua dengan sejarah panjang. Ia menjadi salah satu pintu masuk awal imigran Tionghoa ke Nusantara pada abad ke-14. Di kota ini, akulturasi budaya tumbuh dengan damai. Masyarakat Tionghoa dan Jawa hidup berdampingan, saling memengaruhi dalam adat, kuliner, dan juga seni, termasuk seni membatik.</p><p data-start=\"929\" data-end=\"1079\">Dari situlah Batik Lasem lahirmemadukan estetika Tionghoa yang cerah dan simbolik dengan kearifan lokal Jawa yang lembut dan penuh makna.</p><p data-start=\"929\" data-end=\"1079\">&nbsp;</p><h3 data-start=\"1086\" data-end=\"1111\">Ciri Khas Batik Lasem</h3><p data-start=\"1113\" data-end=\"1154\">Apa yang membuat Batik Lasem begitu unik?</p><h5>1. <strong data-start=\"1164\" data-end=\"1206\">Warna Merah Menyala (Merah Darah Ayam)</strong></h5><p data-start=\"1207\" data-end=\"1497\">Salah satu ciri paling mencolok adalah warna merah yang khas, disebut <em data-start=\"1277\" data-end=\"1297\"><i>abang getih pithik</i></em> (merah darah ayam). Warna ini berasal dari teknik pewarnaan khusus yang konon hanya bisa dihasilkan oleh air sumur Lasem. Warna merah dalam budaya Tionghoa melambangkan keberuntungan dan kebahagiaan.</p><h5>2. <strong data-start=\"1507\" data-end=\"1527\">Motif Akulturasi</strong></h5><p data-start=\"1528\" data-end=\"1786\">Motif-motif Batik Lasem mencerminkan akulturasi dua budaya. Kita bisa menemukan simbol naga, burung phoenix, bunga teratai, hingga awan dan ombak khas Tionghoa, dipadukan dengan motif parang, ceplok, dan tumbuhan lokal ala batik tradisional Jawa.</p><h5>3. <strong data-start=\"1796\" data-end=\"1829\">Dikerjakan Secara Tradisional</strong></h5><p data-start=\"1830\" data-end=\"2017\">Meski kini ada batik cetak, banyak pengrajin Batik Lasem yang masih bertahan menggunakan teknik batik tulis proses yang memakan waktu, namun menghasilkan detail dan nilai seni tinggi.</p><h3 data-start=\"2024\" data-end=\"2056\">Simbol-Simbol yang Berbicara&nbsp;</h3><p data-start=\"2058\" data-end=\"2116\">Setiap motif Batik Lasem punya makna tersendiri. Misalnya:</p><ul data-start=\"2118\" data-end=\"2374\"><li data-start=\"2118\" data-end=\"2207\"><p data-start=\"2120\" data-end=\"2207\"><strong data-start=\"2120\" data-end=\"2141\">Motif Burung Hong</strong> melambangkan keharmonisan dan keberuntungan dalam rumah tangga.</p></li><li data-start=\"2208\" data-end=\"2306\"><p data-start=\"2210\" data-end=\"2306\"><strong data-start=\"2210\" data-end=\"2234\">Motif Awan dan Ombak</strong> melambangkan perjalanan hidup dan harapan akan masa depan yang cerah.</p></li><li data-start=\"2307\" data-end=\"2374\"><p data-start=\"2309\" data-end=\"2374\"><strong data-start=\"2309\" data-end=\"2323\">Motif Naga</strong> mencerminkan kekuatan, perlindungan, dan wibawa.</p></li></ul><p data-start=\"2376\" data-end=\"2482\">Dengan begitu, mengenakan Batik Lasem bukan hanya soal estetika, tapi juga menyandang filosofi yang dalam.</p><h3 data-start=\"2489\" data-end=\"2517\">Warisan yang Terlupakan?</h3><p data-start=\"2519\" data-end=\"2825\">Sayangnya, meskipun memiliki nilai historis dan artistik tinggi, Batik Lasem sering kali kalah pamor dibandingkan batik dari Solo, Yogyakarta, atau Pekalongan. Banyak generasi muda bahkan belum pernah mendengar namanya. Padahal, keberadaannya menjadi saksi hidup hubungan harmonis antarbudaya di Indonesia.</p><p data-start=\"2827\" data-end=\"2872\">Beberapa tantangan yang dihadapi antara lain:</p><ul data-start=\"2874\" data-end=\"3017\"><li data-start=\"2874\" data-end=\"2919\"><p data-start=\"2876\" data-end=\"2919\">Kurangnya promosi di tingkat nasional</p></li><li data-start=\"2920\" data-end=\"2966\"><p data-start=\"2922\" data-end=\"2966\">Keterbatasan regenerasi pengrajin muda</p></li><li data-start=\"2967\" data-end=\"3017\"><p data-start=\"2969\" data-end=\"3017\">Gempuran batik cetak massal yang lebih murah</p></li></ul><h3 data-start=\"3024\" data-end=\"3045\">Upaya Pelestarian</h3><p data-start=\"3047\" data-end=\"3172\">Meski demikian, harapan belum padam. Kini, sejumlah komunitas dan pegiat budaya mulai mengangkat kembali Batik Lasem melalui:</p><ul data-start=\"3174\" data-end=\"3312\"><li data-start=\"3174\" data-end=\"3205\"><p data-start=\"3176\" data-end=\"3205\">Pameran seni dan fesyen</p></li><li data-start=\"3206\" data-end=\"3248\"><p data-start=\"3208\" data-end=\"3248\">Pelatihan membatik untuk anak muda</p></li><li data-start=\"3249\" data-end=\"3312\"><p data-start=\"3251\" data-end=\"3312\">Digitalisasi promosi melalui media sosial dan marketplace</p></li></ul><p data-start=\"3314\" data-end=\"3456\">Bahkan sejumlah desainer nasional mulai melirik motif Lasem sebagai identitas lokal yang unik dan layak ditampilkan di panggung internasional.</p><h2 data-start=\"3463\" data-end=\"3473\">Penutup</h2><p data-start=\"3475\" data-end=\"3720\">Batik Lasem bukan hanya kain, ia adalah jejak sejarah, simbol toleransi, dan bukti indahnya akulturasi budaya di Indonesia. Di tengah derasnya arus modernitas, menjaga Batik Lasem berarti menjaga sebagian identitas bangsa yang nyaris hilang.</p><p data-start=\"3722\" data-end=\"3896\">Mengenal dan mengenakan Batik Lasem adalah langkah kecil yang punya makna besar: kita ikut menjaga cerita, warna, dan warisan budaya yang telah hidup selama berabad-abad.</p>', '685347d5080f3.jpg'),
(43, '2025-06-19 08:49:52', 'Labuan Bajo: Gerbang Menuju Surga Tersembunyi di Timur Indonesia', '<p data-start=\"229\" data-end=\"558\">Jika Indonesia adalah lukisan besar karya alam, maka Labuan Bajo adalah salah satu goresan terindahnya. Kota kecil yang terletak di ujung barat Pulau Flores, Nusa Tenggara Timur ini, dulu hanyalah kampung nelayan sederhana. Kini, ia menjelma menjadi gerbang menuju petualangan alam, budaya, dan laut yang luar biasa memesona.</p><h3 data-start=\"560\" data-end=\"588\">Surga yang Mulai Terjaga</h3><p data-start=\"590\" data-end=\"880\">Labuan Bajo bukan tempat yang sekadar cantik untuk difoto. Ia adalah destinasi yang menyimpan keajaiban di setiap sudutnya. Dari laut biru yang jernih hingga bukit-bukit karst yang membelah cakrawala, setiap pengalaman di sini terasa seperti memasuki dunia yang belum banyak disentuh waktu.</p><p data-start=\"882\" data-end=\"1159\">Meski dikenal sebagai pintu masuk ke Taman Nasional Komodo, Labuan Bajo punya pesonanya sendiri. Jalan-jalan kecil dengan deretan kafe, dermaga penuh kapal pinisi, dan senyum ramah warga lokal menjadikan kota ini tempat yang hangat untuk dijelajahi, bukan hanya disinggahi.</p><h5>1. Taman Nasional Komodo: Rumah Naga Purba</h5><p data-start=\"1214\" data-end=\"1478\">Tak lengkap ke Labuan Bajo tanpa menginjakkan kaki di Pulau Komodo dan Rinca, dua pulau utama tempat tinggal Komodo, reptil raksasa terakhir di dunia. Melihat mereka secara langsung di habitat aslinya adalah pengalaman yang tak bisa dibandingkan dengan apa pun.</p><p data-start=\"1480\" data-end=\"1786\">Selain itu, taman nasional ini juga menawarkan trekking menyusuri bukit-bukit kering, pantai-pantai berpasir putih, dan teluk-teluk tersembunyi. Pemandangan dari atas Pulau Padar, dengan tiga teluk membentuk gradasi warna biru dan hijau, adalah salah satu ikon paling terkenal dari Indonesia Timur.</p><h5>2. Surga Bawah Laut yang Nyaris Tak Tersentuh</h5><p data-start=\"1844\" data-end=\"2202\">Labuan Bajo adalah impian bagi para penyelam. Perairannya termasuk dalam Coral Triangle, kawasan laut dengan keanekaragaman hayati laut tertinggi di dunia. Spot diving dan snorkeling seperti Manta Point, Batu Bolong, atau Siaba Besar menyajikan pemandangan karang yang hidup, ikan warna-warni, dan bahkan pari manta yang megah meluncur di bawah laut.</p><p data-start=\"2204\" data-end=\"2329\">Bagi pemula, banyak juga operator tur yang menyediakan pelatihan dan alat untuk pengalaman snorkeling yang aman dan berkesan.</p><h5>3. Pulau-pulau Eksotis: Jelajah Tanpa Batas</h5><p data-start=\"2385\" data-end=\"2486\">Setiap pulau di sekitar Labuan Bajo memiliki keunikan tersendiri. Beberapa yang tak boleh dilewatkan:</p><ul data-start=\"2488\" data-end=\"2836\"><li data-start=\"2488\" data-end=\"2545\"><p data-start=\"2490\" data-end=\"2545\">Pulau Kanawa: pantai putih dan air sebening kaca.</p></li><li data-start=\"2546\" data-end=\"2626\"><p data-start=\"2548\" data-end=\"2626\">Pulau Kelor: sempurna untuk pendakian ringan dengan panorama laut lepas.</p></li><li data-start=\"2627\" data-end=\"2733\"><p data-start=\"2629\" data-end=\"2733\">Pulau Kalong: saksi ribuan kelelawar keluar dari hutan mangrove saat senja—spektakuler dan mistis.</p></li><li data-start=\"2734\" data-end=\"2836\"><p data-start=\"2736\" data-end=\"2836\">Pink Beach: pasir merah muda yang langka, hasil perpaduan pasir putih dan serpihan karang merah.</p></li></ul><h5>4. Kehangatan Budaya dan Hidangan Khas</h5><p data-start=\"2887\" data-end=\"3113\">Di balik kemewahan alamnya, Labuan Bajo juga menyimpan budaya Flores yang kaya dan hangat. Kamu bisa berinteraksi langsung dengan masyarakat lokal, melihat kerajinan tangan, hingga menyaksikan tarian tradisional Manggarai.</p><p data-start=\"3115\" data-end=\"3264\">Dan tentu saja, jangan lewatkan kuliner lokal seperti ikan bakar segar, sambal khas Flores, jagung bose, atau se’i sapi yang gurih dan smoky.</p><h5>5. Menyatu dengan Alam</h5><p data-start=\"3299\" data-end=\"3625\">Salah satu keistimewaan Labuan Bajo adalah kemampuannya membuatmu merasa kecil di hadapan alam, tapi bukan karena takut, melainkan karena takjub. Sunrise dari atas bukit, suara ombak di malam hari, dan langit penuh bintang yang membentang bebas, semuanya seolah berkata: “Kau sedang berada di salah satu tempat terbaik di bumi.”</p><p data-start=\"3299\" data-end=\"3625\">&nbsp;</p><h2 data-start=\"3632\" data-end=\"3672\">Kesimpulan</h2><p data-start=\"3674\" data-end=\"3908\">Labuan Bajo bukan hanya soal tempat-tempat indah. Ia adalah tentang perjalanan kembali ke alam, tentang merenung dalam diam di antara pulau-pulau sunyi, dan tentang menemukan makna baru dari kata “melihat” dan “merasakan.”</p><p data-start=\"3910\" data-end=\"4128\">Sebagai gerbang ke surga tersembunyi di timur Indonesia, Labuan Bajo mengajak setiap pelancong bukan hanya untuk berlibur, tetapi untuk menghargai alam, budaya, dan waktu yang berjalan lebih pelan tapi lebih dalam.</p>', '68536cc0be79b.jpg'),
(44, '2025-06-20 11:04:14', 'Strategi Efektif Belajar Mandiri bagi Mahasiswa', '<p data-start=\"156\" data-end=\"702\">Belajar mandiri merupakan keterampilan penting yang harus dimiliki oleh setiap mahasiswa, terutama di era digital saat ini yang menyediakan akses informasi tanpa batas. Kemampuan untuk mengatur waktu, menetapkan tujuan belajar, dan mengevaluasi hasil pembelajaran secara mandiri menjadi faktor utama keberhasilan akademik di perguruan tinggi. Namun, tidak semua mahasiswa terbiasa dan terlatih untuk belajar secara mandiri. Oleh karena itu, diperlukan strategi yang tepat agar proses belajar mandiri berjalan efektif dan memberikan hasil optimal.</p><h5><strong data-start=\"709\" data-end=\"752\">1. Menetapkan Tujuan Belajar yang Jelas</strong></h5><p data-start=\"753\" data-end=\"1064\">Langkah awal dalam belajar mandiri adalah menetapkan tujuan yang spesifik dan realistis. Mahasiswa harus mengetahui apa yang ingin dicapai dari proses belajar tersebut, baik jangka pendek (misalnya memahami satu topik dalam satu hari) maupun jangka panjang (seperti lulus dengan nilai A dalam satu mata kuliah).</p><h5><strong data-start=\"1071\" data-end=\"1113\">2. Menyusun Jadwal Belajar Terstruktur</strong></h5><p data-start=\"1114\" data-end=\"1382\">Membuat jadwal belajar membantu mahasiswa membagi waktu antara kuliah, tugas, dan kegiatan lainnya. Jadwal yang konsisten akan melatih kedisiplinan dan mencegah penundaan (prokrastinasi). Jadwal ini sebaiknya fleksibel namun tetap memiliki target harian atau mingguan.</p><h5><strong data-start=\"1389\" data-end=\"1438\">3. Menciptakan Lingkungan Belajar yang Nyaman</strong></h5><p data-start=\"1439\" data-end=\"1682\">Lingkungan yang kondusif seperti ruangan yang tenang, bebas gangguan, serta pencahayaan dan posisi duduk yang baik akan mendukung konsentrasi. Jika belajar dilakukan secara daring, pastikan koneksi internet stabil dan perangkat berfungsi baik.</p><h5><strong data-start=\"1689\" data-end=\"1742\">4. Memanfaatkan Teknologi dan Sumber Daya Digital</strong></h5><p data-start=\"1743\" data-end=\"2044\">Mahasiswa dapat menggunakan berbagai aplikasi pembelajaran seperti Google Scholar, Coursera, Khan Academy, atau YouTube Edu untuk memperkaya materi. Selain itu, penggunaan aplikasi pencatat, pengatur waktu (timer), dan flashcard digital seperti Anki atau Quizlet bisa meningkatkan efektivitas belajar.</p><h5><strong data-start=\"2051\" data-end=\"2090\">5. Menggunakan Metode Belajar Aktif</strong></h5><p data-start=\"2091\" data-end=\"2334\">Daripada sekadar membaca, mahasiswa bisa menggunakan metode seperti membuat ringkasan, mengajarkan materi kepada orang lain, membuat mind map, atau menyelesaikan soal latihan. Belajar aktif akan membuat materi lebih mudah dipahami dan diingat.</p><h5><strong data-start=\"2341\" data-end=\"2386\">6. Melakukan Evaluasi Diri Secara Berkala</strong></h5><p data-start=\"2387\" data-end=\"2632\">Evaluasi membantu mahasiswa mengetahui sejauh mana pencapaian mereka dan bagian mana yang masih perlu ditingkatkan. Refleksi bisa dilakukan dengan mencatat progres belajar, mengisi jurnal harian, atau berdiskusi dengan dosen/pembimbing akademik.</p><h5><strong data-start=\"2639\" data-end=\"2687\">7. Menjaga Keseimbangan dan Kesehatan Mental</strong></h5><p data-start=\"2688\" data-end=\"2898\">Mahasiswa juga perlu menjaga keseimbangan antara belajar dan aktivitas lainnya. Berolahraga, bersosialisasi, serta memiliki waktu istirahat yang cukup sangat penting untuk menjaga motivasi dan kesehatan mental.</p><h4><strong data-start=\"2909\" data-end=\"2923\">Kesimpulan</strong></h4><p data-start=\"2924\" data-end=\"3262\">Belajar mandiri bukan hanya tentang duduk dan membaca buku, melainkan proses aktif yang memerlukan perencanaan, disiplin, dan refleksi. Dengan strategi yang tepat, mahasiswa tidak hanya akan meraih prestasi akademik yang baik, tetapi juga mengembangkan kemampuan belajar sepanjang hayat yang sangat berguna di dunia kerja dan kehidupan.</p>', '6854ddbea1979.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `article_author`
--

CREATE TABLE `article_author` (
  `article_id` int NOT NULL,
  `author_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article_author`
--

INSERT INTO `article_author` (`article_id`, `author_id`) VALUES
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1);

-- --------------------------------------------------------

--
-- Table structure for table `article_category`
--

CREATE TABLE `article_category` (
  `article_id` int NOT NULL,
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article_category`
--

INSERT INTO `article_category` (`article_id`, `category_id`) VALUES
(38, 4),
(43, 4),
(39, 5),
(40, 5),
(41, 6),
(44, 6),
(37, 7),
(42, 7);

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `nickname`, `email`, `password`) VALUES
(1, 'Hana', 'hanawidyaningrum212@gmail.com', '$2y$10$PVxsDqCXIYDb8DZycetLS.BR9k.Sj9kxzbDz5zzhxWhIcO.nxM9TO');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(4, 'wisata', 'Kategori yang mencangkup berbagai wisata, seperti alam dan tempat destinasi.'),
(5, 'Teknologi & Inovasi', 'Teknologi & Inovasi adalah penerapan ide dan pengetahuan untuk menciptakan solusi baru yang meningkatkan efisiensi, kualitas hidup, dan kemajuan di berbagai bidang.'),
(6, 'Pendidikan', 'Kategori ini menyajikan berbagai informasi, inspirasi, dan wawasan seputar dunia belajar dan pengajaran. Di sini, ilmu pengetahuan tumbuh, ide berkembang, dan semangat belajar tak pernah padam.'),
(7, 'Budaya', 'Kategori yang mencangkup berbagai Budaya Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pesan` text COLLATE utf8mb4_unicode_ci,
  `tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`id`, `nama`, `email`, `pesan`, `tanggal`) VALUES
(1, 'Amoeralune', 'Amoeeralune@gmail.com', 'Sangat Menarik', '2025-06-20 05:53:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article_author`
--
ALTER TABLE `article_author`
  ADD PRIMARY KEY (`article_id`,`author_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `article_category`
--
ALTER TABLE `article_category`
  ADD PRIMARY KEY (`article_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article_author`
--
ALTER TABLE `article_author`
  ADD CONSTRAINT `article_author_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `article_author_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `article_category`
--
ALTER TABLE `article_category`
  ADD CONSTRAINT `article_category_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `article_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
