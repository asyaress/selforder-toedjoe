<?php
// Nama file video (pastikan file video ada di direktori yang tepat)
$videoFile = './asset/108060.mp4';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman dengan Latar Belakang Video Redup</title>
    <!-- Link Google Fonts Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        /* CSS untuk membuat video latar belakang */
        body,
        html {
            margin: 0;
            padding: 0;
            overflow: hidden;
            width: 100%;
            height: 100%;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        /* Overlay untuk membuat video lebih redup */
        .video-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            z-index: 0;
        }

        /* Menyelaraskan konten di tengah layar */
        .content {
            position: relative;
            z-index: 1;
            color: #ffffff;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            max-width: 80%;
            cursor: pointer;
        }

        /* Responsif untuk ukuran teks */
        .content h1 {
            font-size: 6em;
            margin: 0;
            font-weight: 600;
        }

        .content p {
            font-size: 1.5em;
            font-weight: 400;
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 768px) {
            .content h1 {
                font-size: 5em;
            }

            .content p {
                font-size: 1em;
            }
        }

        /* Produk container yang mengisi layar */
        /* Produk container yang mengisi layar */
        /* Slide-in animation for the product container */
        @keyframes slideIn {
            0% {
                transform: translateY(100%);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .product-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            width: 100%;
            height: 100vh;
            /* Pastikan mengisi 100% tinggi layar */
            padding: 20px;
            box-sizing: border-box;
            z-index: 1;
            display: none;
            /* Hide products initially */
            animation: slideIn 1s ease forwards;
            /* Slide-in animation for product appearance */
            overflow: hidden;
            /* Handle overflow to prevent clipping */
            background-color: #F2E8C6;
            overflow-y: scroll;
            /* Membuat kontainer bisa di-scroll secara vertikal */
            overflow-x: hidden;
            /* Menyembunyikan scroll horizontal */
            -ms-overflow-style: none;
            /* Hides scrollbar in Internet Explorer and Edge */
            scrollbar-width: none;
            /* Hides scrollbar in Firefox */
        }

        /* Hides scrollbar in Webkit browsers (Chrome, Safari) */
        .product-container::-webkit-scrollbar {
            display: none;
        }

        /* Menambahkan warna latar belakang pada setiap produk */
        .product {
            width: calc(33.33% - 40px);
            /* Membagi ruang menjadi 3 kolom */
            padding: 20px;
            background-color: #A73121;
            /* Ganti warna latar belakang sesuai tema */
            color: #F2E8C6;
            /* Warna teks yang kontras */
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
            box-sizing: border-box;
        }

        .product img {
            width: 100%;
            /* Sesuaikan dengan lebar kontainer */
            height: auto;
            /* Jaga proporsi gambar */
            max-width: 350px;
            /* Batas maksimum lebar gambar */
            border-radius: 8px;
            /* Opsional: tambahkan radius jika ingin gambar lebih halus */
        }

        /* Efek hover untuk produk */
        .product:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        /* Responsif untuk ukuran layar kecil */
        @media (max-width: 1024px) {
            .product {
                width: calc(50% - 40px);
                /* 2 kolom pada layar sedang */
            }
        }

        @media (max-width: 768px) {
            .product {
                width: calc(50% - 40px);
                /* 2 kolom pada layar kecil */
            }
        }



        /* Animasi swipe untuk konten */
        .swipe-left {
            animation: swipeLeft 1s forwards;
        }

        @keyframes swipeLeft {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        /* Animasi jatuh dari atas */
        @keyframes fallFromTop {
            0% {
                transform: translateY(-100%);
                /* Modal mulai dari atas */
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                /* Modal bergerak ke posisi normal */
                opacity: 1;
            }
        }

        @keyframes scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        @keyframes slideDown {
            0% {
                transform: translate(-50%, -50%);
                opacity: 1;
            }

            100% {
                transform: translate(-50%, 50%);
                /* Moves down to 50% of the screen height */
                opacity: 0;
            }
        }



        /* Modal Styles */
        .modal {
            display: none;
            /* Modal disembunyikan secara default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 2;
            justify-content: center;
            align-items: center;
            animation: fallFromTop 0.5s ease-out;
            /* Terapkan animasi jatuh */
        }

        .modal-content {
            background-color: #A73121;
            color: #F2E8C6;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            width: 50%;
        }

        .modal button {
            background-color: #F2E8C6;
            color: #A73121;
            border: none;
            padding: 10px 20px;
            font-size: 1.2em;
            cursor: pointer;
            border-radius: 5px;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            /* Adjust opacity as needed */
            z-index: 2;
            /* Ensure it is behind .product-detail */
        }

        .product-detail {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: auto;
            max-width: 80%;
            max-height: 80%;
            justify-content: center;
            align-items: center;
            z-index: 3;
            flex-direction: column;
            text-align: center;
            padding: 40px;
            /* Increased padding */
            overflow-y: auto;
            overflow: hidden;
            /* Hides overflow content */
            border-radius: 20px;
            /* Increased for rounder corners */
            box-sizing: border-box;
            opacity: 1;
            /* Ensure visibility at start */
            transition: opacity 0.5s ease-out;
        }

        .product-detail.closing {
            animation: slideDown 0.5s forwards;
            /* Applies the slide-down animation */
            opacity: 0;
            /* Fade out while sliding down */
        }

        .product-detail .product-container {
            display: flex;
            flex-wrap: nowrap;
            gap: 40px;
            padding: 40px;
            max-width: 100%;
            max-height: 400px;
            overflow: hidden;
            /* Hides overflow content */
            justify-content: flex-start;
            overflow-x: scroll;
            align-items: center;
        }


        .product-detail .product {
            width: 300px;
            padding: 20px;
            background-color: #A73121;
            color: #F2E8C6;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s;
            flex: 0 0 auto;
            animation: scroll 5s linear infinite;
            /* Smooth, continuous scrolling */
        }


        .product-detail .product img {
            width: 100%;
            height: auto;
            max-width: 260px;
            /* Scales with new width */
            border-radius: 15px;
            /* Rounded edges for images */
        }

        .close-detail {
            margin-top: 10px;
            background-color: #F2E8C6;
            color: #A73121;
            padding: 8px 16px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <!-- Video Latar Belakang -->
    <video autoplay muted loop class="video-background">
        <source src="<?php echo $videoFile; ?>" type="video/mp4">
        Browser Anda tidak mendukung video.
    </video>

    <!-- Overlay untuk membuat video lebih redup -->
    <div class="video-overlay"></div>

    <!-- Konten Utama -->
    <div class="content" onclick="swipeLeft()">
        <h1>Selamat Datang</h1>
        <p>Ini adalah menu self order klik dimana saja untuk memulai</p>
    </div>

    <!-- Produk yang ditampilkan dalam barisan -->
    <div class="product-container" id="productContainer">
        <div class="product" onclick="showHvsDetail(this)">
            <h3>Cetak HVS</h3>
            <img src="./asset/hvs.png" alt="Cetak HVS">
        </div>
        <div class="product">
            <h3>Cetak HVS</h3>
            <a href="path-to-your-destination.html">
                <img src="./asset/hvs.png" alt="Cetak HVS">
            </a>
        </div>
        <div class="product">
            <h3>Cetak HVS</h3>
            <a href="path-to-your-destination.html">
                <img src="./asset/hvs.png" alt="Cetak HVS">
            </a>
        </div>
        <div class="product">
            <h3>Cetak HVS</h3>
            <a href="path-to-your-destination.html">
                <img src="./asset/hvs.png" alt="Cetak HVS">
            </a>
        </div>
        <div class="product">
            <h3>Cetak HVS</h3>
            <a href="path-to-your-destination.html">
                <img src="./asset/hvs.png" alt="Cetak HVS">
            </a>
        </div>
        <div class="product">
            <h3>Cetak HVS</h3>
            <a href="path-to-your-destination.html">
                <img src="./asset/hvs.png" alt="Cetak HVS">
            </a>
        </div>
        <div class="product">
            <h3>Cetak HVS</h3>
            <a href="path-to-your-destination.html">
                <img src="./asset/hvs.png" alt="Cetak HVS">
            </a>
        </div>
        <div class="product">
            <h3>Cetak HVS</h3>
            <a href="path-to-your-destination.html">
                <img src="./asset/hvs.png" alt="Cetak HVS">
            </a>
        </div>
        <div class="product">
            <h3>Cetak HVS</h3>
            <a href="path-to-your-destination.html">
                <img src="./asset/hvs.png" alt="Cetak HVS">
            </a>
        </div>
        <div class="product">
            <h3>Cetak HVS</h3>
            <a href="path-to-your-destination.html">
                <img src="./asset/hvs.png" alt="Cetak HVS">
            </a>
        </div>
        <div class="product">
            <h3>Cetak HVS</h3>
            <a href="path-to-your-destination.html">
                <img src="./asset/hvs.png" alt="Cetak HVS">
            </a>
        </div>
        <div class="product">
            <h3>Cetak HVS</h3>
            <a href="path-to-your-destination.html">
                <img src="./asset/hvs.png" alt="Cetak HVS">
            </a>
        </div>
        <div class="product">
            <h3>Cetak HVS</h3>
            <a href="path-to-your-destination.html">
                <img src="./asset/hvs.png" alt="Cetak HVS">
            </a>
        </div>
        <div class="product">
            <h3>Cetak HVS</h3>
            <a href="path-to-your-destination.html">
                <img src="./asset/hvs.png" alt="Cetak HVS">
            </a>
        </div>
        <div class="product">
            <h3>Cetak HVS</h3>
            <a href="path-to-your-destination.html">
                <img src="./asset/hvs.png" alt="Cetak HVS">
            </a>
        </div>
        <div class="product">
            <h3>Cetak HVS</h3>
            <a href="path-to-your-destination.html">
                <img src="./asset/hvs.png" alt="Cetak HVS">
            </a>
        </div>
    </div>
    <!-- MODAL HVS -->
    <div class="overlay" id="overlay"></div>
    <div class="product-detail" id="HVSDetail">
        <div class="product-container">
            <div class="product">
                <h3>Berwarna</h3>
                <a href="./HVS/hvswarna.php">
                    <img src="./asset/hvs.png" alt="Cetak HVS">
                </a>
            </div>
            <div class="product">
                <h3>Cetak HVS</h3>
                <a href="path-to-your-destination.html">
                    <img src="./asset/hvs.png" alt="Cetak HVS">
                </a>
            </div>

        </div>
        <button class="close-detail" onclick="closeHvsDetail()">Tutup</button>
    </div>

    <!-- Modal untuk menampilkan pesan -->
    <div class="modal" id="productModal">
        <div class="modal-content">
            <h2>Selamat Datang di <i>Self Order</i></h2>
            <p>Pastikan file anda siap cetak, jika sudah silahkan klik lanjutkan</p>
            <button onclick="closeModal()">Lanjutkan</button>
        </div>
    </div>

    <script>

        function swipeLeft() {
            // Menambahkan animasi swipe ke konten dan video
            document.querySelector('.content').classList.add('swipe-left');
            document.querySelector('.video-background').classList.add('swipe-left');
            document.querySelector('.video-overlay').classList.add('swipe-left');

            // Setelah animasi selesai, tampilkan produk dan modal
            setTimeout(() => {
                const productContainer = document.getElementById('productContainer');
                productContainer.style.display = 'flex';

                // Tampilkan modal
                showModal();

                // Menghilangkan elemen .content setelah animasi
                document.querySelector('.content').style.display = 'none';
            }, 1000); // Menunggu hingga animasi selesai sebelum menampilkan produk dan modal
        }

        function showModal() {
            document.getElementById('productModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('productModal').style.display = 'none';
        }
        function showHvsDetail(element) {
            document.getElementById('overlay').style.display = 'block';

            document.getElementById('HVSDetail').style.display = 'flex';
        }


        function closeHvsDetail() {
            const productDetail = document.getElementById('HVSDetail');
            productDetail.classList.add('closing');
            document.getElementById('overlay').style.display = 'none';
            // Wait for the animation to finish before hiding the element
            setTimeout(() => {
                productDetail.style.display = 'none'; // Hide the modal after animation
                productDetail.classList.remove('closing'); // Reset the class for next opening
                document.getElementById('overlay').style.display = 'none';
            }, 500); // Matches the duration of the animation
        }
    </script>



</body>

</html>