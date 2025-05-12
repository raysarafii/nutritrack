<template>
    <!-- Hero Section -->
    <section class="relative w-full h-[400px] bg-cover bg-center flex items-center justify-center text-center text-white px-4 md:px-8"
        :style="{ backgroundImage: `url('${heroImage}')` }">
        <div class="p-4 md:p-8 rounded-lg max-w-2xl">
            <h2 class="text-xl md:text-3xl font-bold">
                Bergabunglah dalam perjalanan menuju hidup sehat dengan mengontrol gula dan kalori!
            </h2>
            <p class="mt-4 text-sm md:text-lg">
                Platform yang membantu kamu mengelola pola makan dengan lebih sehat, mengontrol gula dan kalori, 
                serta menjaga keseimbangan nutrisi untuk hidup yang lebih baik.
            </p>
            <div class="mt-6">
                <a href="#" class="bg-gradient-to-r from-[#007AFF] to-[#00D26A] text-white px-5 md:px-7 py-2 rounded-md text-sm font-semibold">Mulai Sekarang</a>
                <a href="#" class="border border-white text-white px-5 md:px-7 py-2 rounded-md text-sm font-semibold ml-2">Pelajari Selengkapnya</a>
            </div>
        </div>
    </section>

    <!-- Cards Section -->
    <section class="relative z-20 bg-white py-12 px-6">
        <h2 class="text-3xl font-bold text-center mb-6 text-[#003266]">
            Manfaat Mengelola Gula & Kalori
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <img :src="cardImages.diabetes" alt="Mencegah Diabetes" class="mb-4 w-full">
                <h3 class="font-bold text-lg text-[#003266]">Mencegah Diabetes</h3>
                <p class="text-[#003266]">Mengontrol asupan gula membantu menjaga kadar gula darah tetap stabil dan mengurangi risiko diabetes tipe 2.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <img :src="cardImages.weight" alt="Menjaga Berat Badan" class="mb-4 w-full">
                <h3 class="font-bold text-lg text-[#003266]">Menjaga Berat Badan Ideal</h3>
                <p class="text-[#003266]">Mengatur kalori dengan baik mencegah kelebihan berat badan dan obesitas.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <img :src="cardImages.energy" alt="Meningkatkan Energi" class="mb-4 w-full">
                <h3 class="font-bold text-lg text-[#003266]">Meningkatkan Energi & Kesehatan</h3>
                <p class="text-[#003266]">Pola makan seimbang membuat tubuh lebih bertenaga dan mengurangi risiko penyakit kronis.</p>
            </div>
        </div>
    </section>

   <!-- FAQ Section -->
 <section class="relative z-20 bg-white py-12 px-6 flex flex-col items-center">
    <div class="max-w-screen-md w-full">
        <h2 class="text-3xl font-bold text-center mb-8" style="font-family: 'Poppins', sans-serif;">
            Pertanyaan yang Sering Diajukan (FAQ)
        </h2>

        <div class="flex flex-col gap-6 items-center">
            <div class="bg-[#D2E7FF] p-6 rounded-lg shadow-md flex flex-row items-center space-x-4 w-full transform translate-x-4">
                <img :src="faqImages.sugar" alt="Gula" class="w-20 h-20 object-cover rounded-md">
                <div>
                    <h3 class="font-bold text-lg text-[#003266]">Mengapa penting mengontrol asupan gula dan kalori?</h3>
                    <p class="text-[#003266]">Mengontrol gula dan kalori membantu menjaga berat badan ideal, mencegah diabetes, dan meningkatkan energi sehari-hari.</p>
                </div>
            </div>

            <div class="bg-[#D2E7FF] p-6 rounded-lg shadow-md flex flex-row items-center space-x-4 w-full transform -translate-x-4">
                <div>
                    <h3 class="font-bold text-lg text-[#003266]">Berapa batas konsumsi gula harian yang disarankan?</h3>
                    <p class="text-[#003266]">WHO merekomendasikan maksimal 25 gram (6 sendok teh) per hari untuk orang dewasa agar tetap sehat.</p>
                </div>
                <img :src="faqImages.blood" alt="Batas Gula" class="w-20 h-20 object-cover rounded-md">
            </div>

            <div class="bg-[#D2E7FF] p-6 rounded-lg shadow-md flex flex-row items-center space-x-4 w-full transform translate-x-4">
                <img :src="faqImages.food" alt="Makanan Sehat" class="w-20 h-20 object-cover rounded-md">
                <div>
                    <h3 class="font-bold text-lg text-[#003266]">Apa saja makanan yang bisa membantu mengurangi konsumsi gula?</h3>
                    <p class="text-[#003266]">Sayuran hijau, biji-bijian utuh, kacang-kacangan, dan buah dengan indeks glikemik rendah seperti apel dan stroberi.</p>
                </div>
            </div>

            <div class="bg-[#D2E7FF] p-6 rounded-lg shadow-md flex flex-row items-center space-x-4 w-full transform -translate-x-4">
                <div>
                    <h3 class="font-bold text-lg text-[#003266]">Apakah semua jenis gula harus dihindari?</h3>
                    <p class="text-[#003266]">Tidak. Gula alami dari buah lebih baik dibandingkan gula tambahan yang sering ditemukan dalam makanan olahan.</p>
                </div>
                <img :src="faqImages.sugarTypes" alt="Gula Alami" class="w-20 h-20 object-cover rounded-md">
            </div>
        </div>
    </div>
</section>

<!-- Footer Section -->
<footer class="bg-[#0B3C72] text-white py-10 px-6">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Left Section -->
        <div>
            <div class="flex items-center space-x-3">
                <img :src="logo" alt="NutriTrack" class="h-30 w-auto">
                <h1 class="text-2xl font-bold bg-gradient-to-r from-[#00D26A] to-[#007AFF] bg-clip-text text-transparent">
                    NutriTrack
                </h1>
            </div>
            <h3 class="font-bold text-lg">PT. Sehat Abadi</h3>
            <p class="text-sm mt-2 leading-relaxed">
                Kami hadir untuk membantu Anda mengontrol asupan gula dan kalori dengan lebih mudah dan menyenangkan. 
                Dengan panduan yang berbasis nutrisi seimbang, kami memberikan solusi sehat untuk menjaga energi, berat badan ideal, 
                dan mencegah risiko penyakit akibat konsumsi gula berlebih.
                <br><br>
                Misi kami adalah membangun kebiasaan makan yang lebih baik melalui edukasi, perencanaan makanan, dan komunitas yang mendukung gaya hidup sehat. 
                Mari bersama-sama menjaga kesehatan dengan pilihan makanan yang cerdas dan seimbang!
            </p>

            <!-- Subscribe Section -->
            <div class="mt-4">
                <h4 class="font-semibold">Subscribe Email</h4>
                <p class="text-sm">Get the best new products in your inbox, every day.</p>
                <button class="bg-blue-400 text-white px-4 py-2 mt-2 rounded w-full">Subscribe</button>
            </div>

            <!-- Social Media Icons -->
           <div class="flex space-x-4 mt-4">
                <a href="#" class="w-12 h-12 flex items-center justify-center rounded-full bg-white text-blue-500 text-2xl hover:bg-gray-200">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="#" class="w-12 h-12 flex items-center justify-center rounded-full bg-white text-blue-500 text-2xl hover:bg-gray-200">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="w-12 h-12 flex items-center justify-center rounded-full bg-white text-blue-500 text-2xl hover:bg-gray-200">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="#" class="w-12 h-12 flex items-center justify-center rounded-full bg-white text-blue-500 text-2xl hover:bg-gray-200">
                    <i class="fab fa-tiktok"></i>
                </a>
                <a href="#" class="w-12 h-12 flex items-center justify-center rounded-full bg-white text-blue-500 text-2xl hover:bg-gray-200">
                    <i class="fab fa-x-twitter"></i>
                </a>
            </div>
        </div>

        <!-- Middle Section -->
        <div>
            <h4 class="font-semibold text-lg mb-3">Programs</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="#" class="hover:underline">Beranda</a></li>
                <li><a href="#" class="hover:underline">Tentang Kami</a></li>
                <li><a href="#" class="hover:underline">Catat Asupan</a></li>
                <li><a href="#" class="hover:underline">Pilihan Sehat</a></li>
                <li><a href="#" class="hover:underline">Konsultasi Kesehatan</a></li>
                <li><a href="#" class="hover:underline">Profil & Target</a></li>
            </ul>
        </div>

        <!-- Right Section -->
        <div>
            <h4 class="font-semibold text-lg mb-3">Partner</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="#" class="hover:underline">Grup & Forum Kesehatan</a></li>
                <li><a href="#" class="hover:underline">Kolaborasi Ahli Gizi</a></li>
            </ul>

            <h4 class="font-semibold text-lg mt-6 mb-3">Testimoni</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="#" class="hover:underline">Cerita Inspiratif</a></li>
            </ul>
        </div>
    </div>

    <!-- Copyright -->
    <div class="mt-10 text-center text-sm border-t border-gray-500 pt-4">
        © Copyright 2025. PT Sehat Abadi. All Rights Reserved
    </div>
</footer>
</template>

<script>
export default {
    name: 'HomePage',
    data() {
        return {
            heroImage: '/images/home1.png',
            logo: '/images/logo.png',
            cardImages: {
                diabetes: '/images/cardtest.png',
                weight: '/images/card6.png',
                energy: '/images/card4.png'
            },
            faqImages: {
                sugar: '/images/Frame 90.jpg',
                blood: '/images/blood.jpg',
                food: '/images/food.jpg',
                sugarTypes: '/images/sugar.jpg'
            }
        };
    },
    mounted() {
        if (!window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
            const scroller = document.querySelector(".scroller");
            if (scroller) {
                scroller.setAttribute("data-animated", true);
                const scrollerInner = scroller.querySelector(".scroller__inner");
                if (scrollerInner) {
                    const items = Array.from(scrollerInner.children);
                    items.forEach((item) => {
                        const clone = item.cloneNode(true);
                        clone.setAttribute("aria-hidden", true);
                        scrollerInner.appendChild(clone);
                    });
                }
            }
        }

        // Mobile menu toggle
        const menuBtn = document.getElementById('menu-btn');
        if (menuBtn) {
            menuBtn.addEventListener('click', function () {
                const menu = document.getElementById('menu');
                if (menu) {
                    menu.classList.toggle('hidden');
                }
            });
        }
    }
}
</script>

<style>
body {
    font-family: 'Poppins', sans-serif;
}

/* Scroller */
.scroller__inner {
    display: flex;
    gap: 1rem;
    flex-wrap: nowrap;
    width: max-content;
    animation: scroll 40s linear infinite;
}

.scroller:hover .scroller__inner {
    animation-play-state: paused;
}

@keyframes scroll {
    to {
        transform: translateX(calc(-50% - 0.5rem));
    }
}

/* Mobile Menu */
#menu {
    transition: max-height 0.3s ease-in-out;
}
</style> 