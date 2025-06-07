<template>
  <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-md space-y-4">
    <h1 class="text-3xl font-bold mb-6 text-center text-[#007AFF]">Tambah Pilihan Sehat</h1>

    <form @submit.prevent="submitForm" enctype="multipart/form-data">
      <!-- Form fields (same as before) -->
      <div>
        <label class="block font-semibold mb-1" for="judul">Judul</label>
        <input
          v-model="form.judul"
          type="text"
          id="judul"
          class="w-full border border-gray-300 rounded px-3 py-2"
          :class="{ 'border-red-500': errors.judul }"
        />
        <p v-if="errors.judul" class="text-red-500 text-sm mt-1">{{ errors.judul }}</p>
      </div>

      <div>
        <label class="block font-semibold mb-1" for="kategori">Kategori</label>
        <select
          v-model="form.kategori"
          id="kategori"
          class="w-full border border-gray-300 rounded px-3 py-2"
          :class="{ 'border-red-500': errors.kategori }"
        >
          <option value="">-- Pilih Kategori --</option>
          <option v-for="item in kategoriOptions" :key="item" :value="item">{{ item }}</option>
        </select>
        <p v-if="errors.kategori" class="text-red-500 text-sm mt-1">{{ errors.kategori }}</p>
      </div>

      <div>
        <label class="block font-semibold mb-1" for="gambar_path">Gambar</label>
        <input
          type="file"
          id="gambar_path"
          @change="handleFileUpload"
          class="w-full border border-gray-300 rounded px-3 py-2"
          :class="{ 'border-red-500': errors.gambar_path }"
        />
        <p v-if="errors.gambar_path" class="text-red-500 text-sm mt-1">{{ errors.gambar_path }}</p>
      </div>

      <div>
        <label class="block font-semibold mb-1" for="nama">Nama</label>
        <input
          v-model="form.nama"
          type="text"
          id="nama"
          class="w-full border border-gray-300 rounded px-3 py-2"
          :class="{ 'border-red-500': errors.nama }"
        />
        <p v-if="errors.nama" class="text-red-500 text-sm mt-1">{{ errors.nama }}</p>
      </div>

      <div>
        <label class="block font-semibold mb-1" for="deskripsi">Deskripsi</label>
        <textarea
          v-model="form.deskripsi"
          id="deskripsi"
          rows="4"
          class="w-full border border-gray-300 rounded px-3 py-2"
          :class="{ 'border-red-500': errors.deskripsi }"
        ></textarea>
        <p v-if="errors.deskripsi" class="text-red-500 text-sm mt-1">{{ errors.deskripsi }}</p>
      </div>

      <div>
        <label class="block font-semibold mb-1" for="urutan">Urutan</label>
        <input
          v-model.number="form.urutan"
          type="number"
          id="urutan"
          class="w-full border border-gray-300 rounded px-3 py-2"
          :class="{ 'border-red-500': errors.urutan }"
        />
        <p v-if="errors.urutan" class="text-red-500 text-sm mt-1">{{ errors.urutan }}</p>
      </div>

      <div>
        <label class="block font-semibold mb-1" for="aktif">Status</label>
        <select
          v-model="form.aktif"
          id="aktif"
          class="w-full border border-gray-300 rounded px-3 py-2"
          :class="{ 'border-red-500': errors.aktif }"
        >
          <option value="1">Aktif</option>
          <option value="0">Tidak Aktif</option>
        </select>
        <p v-if="errors.aktif" class="text-red-500 text-sm mt-1">{{ errors.aktif }}</p>
      </div>

      <div class="text-center">
        <button
          type="submit"
          class="bg-[#007AFF] text-white px-6 py-2 rounded hover:bg-blue-600 transition"
        >
          Simpan
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import { useToast } from 'vue-toastification';
import axios from 'axios';

export default {
  name: 'TambahPilihanSehat',
  data() {
    return {
      form: {
        judul: '',
        kategori: '',
        gambar_path: null,
        nama: '',
        deskripsi: '',
        urutan: 1,
        aktif: '1',
      },
      errors: {},
      kategoriOptions: ['Minuman', 'Buah', 'Sayur', 'Protein', 'Karbohidrat'],
      toast: useToast(), // inisialisasi toast
    };
  },
  methods: {
    handleFileUpload(event) {
      this.form.gambar_path = event.target.files[0];
    },
    async submitForm() {
      const formData = new FormData();
      for (const key in this.form) {
        formData.append(key, this.form[key]);
      }

      try {
        await axios.post('/admin/pilihan-sehat', formData);

        this.toast.success('Data berhasil ditambahkan!', {
          position: 'top-right',
          timeout: 3000,
        });

        setTimeout(() => {
          window.location.href = '/admin/pilihan-sehat';
        }, 1500);
      } catch (error) {
        if (error.response && error.response.status === 422) {
          this.errors = error.response.data.errors || {};
        } else {
          this.toast.error('Terjadi kesalahan saat menyimpan data.', {
            position: 'top-right',
            timeout: 3000,
          });
        }
      }
    },
  },
};
</script>


<style scoped>
/* Optional custom styles */
</style>
