# NutriTrack 🍽️

**NutriTrack** adalah aplikasi pelacak asupan makanan harian yang membantu pengguna mengelola konsumsi gula dan kalori.

---

## ✨ Fitur Utama

* 🔍 **Cari Makanan**: Menampilkan data kalori dan gula berdasarkan pencarian makanan dari API USDA.
* 🧾 **Catat Konsumsi Harian**: Formulir untuk mencatat makanan yang dikonsumsi per hari.
* 📊 **Ringkasan Gizi Harian**: Menampilkan total gula dan kalori yang telah dikonsumsi.

---

## 🛠️ Teknologi yang Digunakan

| Teknologi | Deskripsi |
| :--------- | :---------- |
| ![Vue.js](https://img.shields.io/badge/Vue.js-35495E?style=for-the-badge&logo=vue.js&logoColor=4FC08D) | Kerangka Kerja Frontend |
| ![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white) | Kerangka Kerja Backend |
| ![USDA API](https://img.shields.io/badge/USDA%20API-FFD700?style=for-the-badge&logo=data&logoColor=black) | API untuk data nutrisi (FoodData Central) |

---

## 🚀 Cara Menjalankan

Ikuti langkah-langkah berikut untuk menjalankan NutriTrack di perangkat Anda:

1.  **Pengaturan Basis Data**:
    * Buat database baru dengan nama **`nutri`**.
    * Import file **`nutri.sql`** yang tersedia ke basis data yang baru Anda buat.

2.  **Konfigurasi Lingkungan**:
    * Ganti nama file **`.env.example`** menjadi **`.env`**.

3.  **Instal Dependensi**:
    * Buka terminal atau command prompt Anda di direktori utama proyek.
    * Jalankan **`composer install`** untuk menginstal dependensi PHP.
    * Jalankan **`npm install`** untuk menginstal dependensi JavaScript.

4.  **Jalankan Aplikasi**:
    *Bisa dengan klik file **`start.bat`**
	* Atau *
       **`php artisan serve`**
       **`npm run dev`**

---