-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2023 at 07:00 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tracker_coffee`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_telp` varchar(20) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_address` text NOT NULL,
  `admin_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `username`, `password`, `admin_name`, `admin_telp`, `admin_email`, `admin_address`, `admin_image`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'Miftahudin Aldi Saputra', '083893271424', 'miftafree3@gmail.com', 'Gang Annur 2 Rt 05, Rw 01 ,Kelurahan Poris Plawad Utara, Kecamatan Cipondoh, Tangerang', 'img1687139920.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(25) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `image`) VALUES
(1, 'Coffee', 'coffee-icon.png'),
(2, 'Tea', 'tea-icon.png'),
(3, 'Drink', 'drink-icon.png'),
(4, 'Food', 'food-icon.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembayaran`
--

CREATE TABLE `tbl_pembayaran` (
  `id` int(11) NOT NULL,
  `kd_bayar` char(6) NOT NULL,
  `user` varchar(255) NOT NULL,
  `telp` varchar(30) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `menu` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `metode_bayar` varchar(30) NOT NULL,
  `total_pembayaran` varchar(255) NOT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pembayaran`
--

INSERT INTO `tbl_pembayaran` (`id`, `kd_bayar`, `user`, `telp`, `alamat`, `menu`, `catatan`, `metode_bayar`, `total_pembayaran`, `bukti_pembayaran`, `payment_status`) VALUES
(26, '', 'mifta', '083893271424', 'Gang Annur 2 RT 05 ,RW 01, Kecamatan Cipondoh, Kelurahan Poris Plawad Utara', 'Matcha Tea = 1', 'wfwfw', 'dana', '50000', 'img1684564719.png', 'Pembayaran Success'),
(27, '', 'yanto', '089622437765', 'Komplek Pdk, Kecamatan Cipondoh', '                    Green Tea=3                   ', 'knknkn', 'dana', '95000', 'img1684573540.png', 'Pembayaran Success'),
(31, 'BYR003', 'yanto', '089622437765', 'Komplek Pdk, Kecamatan Cipondoh', '                    Caramel Macchiato=4           ', 'bffdg', 'dana', '251000', 'img1684573715.png', 'Pembayaran Success'),
(32, 'BYR004', 'yanto', '089622437765', 'Komplek Pdk, Kecamatan Cipondoh', '                    Thai Tea=2                    ', 'kon', 'dana', '80000', 'img1684573932.png', 'Pembayaran Success'),
(33, 'BYR005', 'mifta', '083893271424', 'Gang Annur 2 RT 05 ,RW 01, Kecamatan Cipondoh, Kelurahan Poris Plawad Utara', '                    Thai Tea=1                ', 'dkkd', 'gopay', '20000', 'img1684672354.png', 'Pembayaran Success'),
(35, 'BYR006', 'Sambo', '089456783321', 'Jalan Kebayoran Lama No. 21', '                    Americano=3                ', 'cepat atau saya tembak', 'ovo', '75000', 'img1684673554.jpeg', 'Pembayaran Success'),
(37, 'BYR008', 'mifta', '083893271424', 'Gang Annur 2 RT 05 ,RW 01, Kecamatan Cipondoh, Kelurahan Poris Plawad Utara', '            Espresso=4                      Green Tea=2          ', 'ker3en', 'dana', '130000', 'img1684721452.jpg', 'Pembayaran Success'),
(38, 'BYR009', 'mifta', '083893271424', 'Gang Annur 2 RT 05 ,RW 01, Kecamatan Cipondoh, Kelurahan Poris Plawad Utara', '            Latte Macchiato=2                      Flat White=1          ', 'mantap', 'dana', '74000', 'img1684900709.jpg', 'Pembayaran Success'),
(45, 'BYR010', 'yanto', '089622437765', 'Komplek Pdk, Kecamatan Cipondoh', '            French Fries=2                      Avocado Juice=2          ', 'cepet', 'dana', '120000', 'img1687083038.jpg', 'Pembayaran Success'),
(46, 'BYR011', 'Sambo', '089456783321', 'Jalan Kebayoran Lama No. 21', '            Cappuccino=2                      Flat White=2                      Beef Burger=3          ', 'mantap', 'gopay', '219000', 'img1687149051.jpg', 'Pembayaran Success'),
(47, 'BYR012', 'wahyu123', '085773811187', 'Prm. Daon ', '            Beef Burger=3                      Flat White=5          ', 'gg\r\n', 'dana', '229000', 'img1687313654.jpg', 'Menunggu Proses'),
(49, 'BYR013', 'agung', '083738398', 'gang jambu', '            Espresso=3                      Beef Burger=2          ', 'dwd', 'dana', '146000', 'img1687319971.jpg', 'Pembayaran Success'),
(50, 'BYR014', 'agung', '083738398', 'gang jambu', '            Cappuccino=5          ', 'gass', 'dana', '125000', 'img1688529919.jpg', 'Menunggu Proses');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pemesanan`
--

CREATE TABLE `tbl_pemesanan` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `name_menu` varchar(30) NOT NULL,
  `price_menu` varchar(30) NOT NULL,
  `qty` int(100) NOT NULL,
  `image_menu` varchar(255) NOT NULL,
  `payment_status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pemesanan`
--

INSERT INTO `tbl_pemesanan` (`id`, `user`, `name_menu`, `price_menu`, `qty`, `image_menu`, `payment_status`) VALUES
(62, 'wahyu123', 'Beef Burger', '43000', 3, 'img1687070532.jpg', 'Menunggu Proses'),
(63, 'wahyu123', 'Flat White', '20000', 5, 'flat-white.jpg', 'Menunggu Proses'),
(73, 'agung', 'Cappuccino', '25000', 5, 'cappucino.jpg', 'Menunggu Proses'),
(119, 'mifta', 'Espresso', '20000', 2, 'espresso.jpg', NULL),
(127, 'yanto', 'Green Tea', '25000', 2, 'greentea.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` int(11) NOT NULL,
  `stock` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `product_image` varchar(100) NOT NULL,
  `product_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `category_id`, `product_name`, `product_price`, `stock`, `product_description`, `product_image`, `product_status`) VALUES
(1, 1, 'Flat White', 20000, '95', 'Flat White umumnya disajikan dalam cangkir keramik dengan piring. Susu berbusa dan berbusa seperti halnya untuk latte tetapi ditahan kembali menjadi sekitar 20 mm (0,79 in) mikrofoam, menciptakan meniskus. Perbedaan ukuran lapisan busa berbeda antar wilayah, dengan beberapa lebih suka sesedikit 1 mm (0, 039 in). Kunci minuman adalah crema yang dibujuk ke dalam meniskus sehingga menghasilkan warna coklat gelap yang seragam di bagian atas minuman. Membiarkan minuman berdiri sebelum minum meningkatkan pengalaman saat meniskus mengental dan menambah tekstur pada setiap tegukan, menghasilkan cincin sip / tanda pasang yang berbeda saat minuman dikonsumsi. ', 'flat-white.jpg', 1),
(2, 1, 'Espresso', 20000, '87', 'Espreso adalah jenis kopi yang dihasilkan dengan mengekstraksi biji kopi yang sudah digiling dengan menyemburkan air panas di bawah tekanan tinggi. Espresso berasal dari Bahasa Italia yang berarti express atau \"cepat\" karena dibuat untuk disajikan dengan segera kepada pelanggan.', 'espresso.jpg', 1),
(3, 1, 'Cappuccino', 25000, '90', 'Cappuccino adalah minuman khas Italia yang terdiri dari 1/3 espresso, 1/3 susu steamed, dan 1/3 buih susu. Pada dasarnya, minuman ini adalah campuran dari espresso dan susu seperti minuman-minuman berbasis espresso lainnya. Sepintas, sajian cappuccino hampir tampak serupa dengan minuman latte.', 'cappucino.jpg', 1),
(4, 1, 'Americano', 25000, '98', 'Americano adalah minuman kopi espresso dengan tambahan air panas. Namanya diambil dari cara orang Amerika meminum espresso. Konon, penyebutan americano adalah sebagai lelucon dan ejekan terhadap orang-orang Amerika yang suka espresso-nya dibuat lebih encer. Americano dibuat dari satu atau dua shot espresso, kemudian ditambahkan air panas di atasnya.', 'americano.jpg', 1),
(5, 1, 'Latte Macchiato', 27000, '97', 'latte macchiato adalah susu yang di-steam, espresso, dan foam dengan rasio 2:1:1.', 'latte-macchiato.jpg', 1),
(6, 1, 'Caramel Macchiato', 30000, '98', 'Caramel macchiato adalah salah satu jenis minuman dari kopi yang mengandung espresso, steamed milk, sirup vanilla, dan saus karamel. Minuman ini memiliki rasa yang cenderung manis karena hanya mengandung sedikit kadar kopi.', 'caramel-macchiato.jpg', 1),
(7, 2, 'Tea', 20000, '98', 'Tea adalah minuman yang mengandung kafeina, sebuah infusi yang dibuat dengan cara menyeduh daun, pucuk daun, atau tangkai daun yang dikeringkan dari tanaman Camellia sinensis dengan air panas.', 'img1680410708.jpg', 1),
(8, 2, 'Green Tea', 25000, '93', 'Green Tea dibuat dari daun teh dengan cara dikukus. Untuk membuat teh hijau, daun teh segera dikeringkan dan dipanaskan untuk mencegah daun terfermentasi.', 'greentea.jpg', 1),
(9, 2, 'Thai Tea', 20000, '100', 'Thai Tea merupakan perpaduan dari beberapa jenis rempah seperti biji asam jawa yang dimemarkan, bunga lawang, air distilasi bunga jeruk, pewarna, dan rempah lainnya.\r\n\r\nInilah yang menyebabkan warna Thai Tea berubah menjadi oranye setelah dicampur dengan susu.\r\n\r\nThai tea mengandalkan perpaduan susu kental manis serta susu evaporasi.', 'thaitea.jpg', 1),
(10, 2, 'Lemon Tea', 20000, '100', 'Lemon tea adalah minuman yang menyegarkan yang dibuat dengan menambahkan perasan lemon ke dalam teh. Lemon tea rendah kalori dan gula serta merupakan sumber yang baik dari vitamin dan mineral seperti vitamin C, folat, kalium, lutein, dan fosfor. Minum lemon tea dapat membantu meningkatkan sistem kekebalan tubuh Anda, menurunkan tekanan darah, dan mengurangi risiko penyakit kronis seperti kanker dan diabetes. Lemon tea juga dapat membantu Anda menurunkan berat badan dengan mengurangi retensi air dan meningkatkan kesehatan saluran kemih.', 'lemon-tea.jpg', 1),
(13, 2, 'Matcha Tea', 30000, '100', 'Matcha adalah bubuk halus daun teh hijau yang ditanam dan diproses secara khusus, secara tradisional dikonsumsi di Asia Timur. Tanaman teh hijau yang digunakan untuk matcha ditanam di bawah naungan selama tiga hingga empat minggu sebelum panen; Batang dan vena dihilangkan selama pemrosesan. Selama pertumbuhan teduh, tanaman Camellia sinensis menghasilkan lebih banyak theanine dan kafein. Bentuk bubuk matcha dikonsumsi berbeda dari daun teh atau kantong teh, karena tersuspensi dalam cairan, biasanya air atau susu.', 'matchatea.jpeg', 1),
(14, 2, 'Golden Milk Tea', 35000, '98', 'Golden Milk Tea adalah minuman yang terbuat dari susu dan rempah-rempah seperti kunyit, kayu manis, jahe, dan merica hitam. Minuman ini dikenal karena khasiatnya yang dapat membantu mengurangi peradangan dan meningkatkan kesehatan otak.', 'goldenmilktea.jpeg', 1),
(16, 3, 'Aqua', 10000, '100', 'Air mineral AQUA berasal dari sumber mata air yang terpilih, serta memiliki Tiga Perlindungan, yaitu; melindungi ekosistem sumber airnya, menjaga kealamian mineralnya, serta diproses secara saksama untuk menjaga keasliannya sampai ke tangan anda.', 'img1686917007.jpg', 1),
(17, 3, 'Pearly Taro Soya Milk', 37000, '100', 'Pearly Taro Soya Milk adalah perpaduan unik dari bubuk talas & susu kedelai dengan sirup gula dengan cita rasa yang sangat khas', 'img1686917497.jpg', 1),
(18, 3, 'Chocolate', 33000, '94', 'Cokelat terbuat dari biji biji kakao yang difermentasi dan dipanggang. Kernel digiling untuk membentuk cairan pucat cokelat liquor, yang dapat dikeraskan dalam cetakan untuk membentuk pahit (memanggang) cokelat, ditekan untuk mengurangi kandungan cocoa butter dan kemudian dihancurkan untuk membuat bubuk kakao, atau dicampur dengan gula dan cocoa butter tambahan untuk membuat manis (makan) cokelat. Penambahan susu kering atau pekat ke cokelat manis menghasilkan cokelat susu.', 'img1687069839.jpg', 1),
(19, 4, 'Beef Burger', 43000, '98', 'Beff Burger adalah makanan yang terdiri dari isian — biasanya patty daging giling, biasanya daging sapi — ditempatkan di dalam irisan roti atau roti gulung. Hamburger sering disajikan dengan keju, selada, tomat, bawang, acar, bacon, atau cabai; bumbu seperti saus tomat, mustard, mayones, relish, atau \"saus spesial\" dan sering ditempatkan di atas roti biji wijen.', 'img1687070532.jpg', 1),
(20, 4, 'Fried Banana', 25000, '100', 'Pisang goreng yang sehat dan renyah adalah salah satu resep pisang terbaik! Pisang goreng ini karamel dan manis. Sajikan dengan sirup maple atau saus cokelat sebagai hidangan penutup atau camilan.', 'img1687071379.jpg', 1),
(21, 4, 'French Fries', 35000, '100', 'French fries, juga disebut chips, finger chips, fries, atau French pommes frites, lauk atau camilan yang biasanya terbuat dari kentang goreng yang telah dipotong menjadi berbagai bentuk, terutama potongan tipis. Kentang goreng sering diasinkan dan disajikan dengan barang-barang lain, termasuk saus tomat, mayones, atau cuka.', 'img1687071499.jpg', 1),
(22, 4, 'Club Sandwich', 45000, '100', 'Sandwich klub, juga disebut sandwich clubhouse, adalah sandwich yang terdiri dari roti (dipanggang secara tradisional), irisan unggas yang dimasak, bacon goreng, selada, tomat, dan mayones. Ini sering dipotong menjadi empat bagian atau dua bagian dan disatukan oleh tongkat koktail. Versi modern sering memiliki dua lapisan yang dipisahkan oleh sepotong roti tambahan.', 'img1687073367.jpg', 1),
(23, 3, 'Avocado Juice', 25000, '100', 'Jus alpukat adalah jenis jus sederhana yang mencakup esensi alpukat. Alpukat, yang telah bergantian diklasifikasikan atau dianggap sebagai buah atau sayuran, telah dikenal untuk membantu dengan berbagai gangguan kesehatan. Membuatnya menjadi jus alpukat adalah cara yang enak dan mudah untuk mendapatkan lebih banyak makanan ini dalam diet.', 'img1687073899.jpg', 1),
(25, 4, 'Croquette', 29000, '100', 'Croquette adalah gulungan goreng yang berasal dari masakan Prancis, terdiri dari pengikat tebal yang dikombinasikan dengan isian, yang kemudian dilapisi tepung roti. Disajikan sebagai lauk, camilan, atau makanan cepat saji di seluruh dunia.\r\n\r\nPengikatnya biasanya berupa béchamel tebal atau saus cokelat, kentang tumbuk, tepung terigu atau roti gandum. Pengikat dapat dicampur dengan atau diisi dengan isian. Tambalan khas termasuk daging cincang halus, makanan laut, keju, nasi, jamur, dan berbagai sayuran, yang dapat dikombinasikan dengan bumbu seperti bumbu dan rempah-rempah. Kroket manis dapat menggunakan pengikat krim kue dan diisi dengan buah.\r\n\r\nCroquette juga dapat dibentuk dalam bentuk lain, seperti cakram, oval, atau bola.', 'img1687074626.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `name_user` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `name_user`, `username`, `password`, `alamat`, `no_telp`) VALUES
(1, 'Miftahudin Aldi Saputra', 'mifta', '827ccb0eea8a706c4c34a16891f84e7b', 'Gang Annur 2 RT 05 ,RW 01, Kecamatan Cipondoh, Kelurahan Poris Plawad Utara', '083893271424'),
(2, 'yanto kurniawan', 'yanto', '827ccb0eea8a706c4c34a16891f84e7b', 'Komplek Pdk, Kecamatan Cipondoh', '089622437765'),
(3, 'Ferdi Sambo', 'Sambo', '827ccb0eea8a706c4c34a16891f84e7b', 'Jalan Kebayoran Lama No. 21', '089456783321'),
(4, 'wahyu', 'wahyu123', '827ccb0eea8a706c4c34a16891f84e7b', 'Prm. Daon ', '085773811187'),
(5, 'agung', 'agung', '827ccb0eea8a706c4c34a16891f84e7b', 'gang jambu', '083738398');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kd_bayar` (`kd_bayar`);

--
-- Indexes for table `tbl_pemesanan`
--
ALTER TABLE `tbl_pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tbl_pemesanan`
--
ALTER TABLE `tbl_pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
