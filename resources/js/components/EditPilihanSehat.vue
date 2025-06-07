<template>
  <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-md space-y-4">
    <h1 class="text-3xl font-bold mb-6 text-center text-[#007AFF]">
      Edit Pilihan Sehat
    </h1>

    <form @submit.prevent="submitForm" enctype="multipart/form-data">
      <div>
        <label for="nama" class="block font-semibold mb-1">Nama</label>
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
        <label for="gambar_path" class="block font-semibold mb-1">Gambar</label>
        <input
          type="file"
          id="gambar_path"
          @change="handleFileUpload"
          class="w-full border border-gray-300 rounded px-3 py-2"
          :class="{ 'border-red-500': errors.gambar_path }"
        />
        <p v-if="errors.gambar_path" class="text-red-500 text-sm mt-1">{{ errors.gambar_path }}</p>

        <img
          v-if="form.preview"
          :src="form.preview"
          alt="Current Image"
          class="mt-2 w-32 rounded"
        />
      </div>

      <div>
        <label for="deskripsi" class="block font-semibold mb-1">Deskripsi</label>
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
        <label for="urutan" class="block font-semibold mb-1">Urutan</label>
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
        <label for="aktif" class="block font-semibold mb-1">Aktif</label>
        <select
          v-model="form.aktif"
          id="aktif"
          class="w-full border border-gray-300 rounded px-3 py-2"
          :class="{ 'border-red-500': errors.aktif }"
        >
          <option value="1">Ya</option>
          <option value="0">Tidak</option>
        </select>
        <p v-if="errors.aktif" class="text-red-500 text-sm mt-1">{{ errors.aktif }}</p>
      </div>

      <button
        type="submit"
        class="appearance-none bg-blue-400 text-white px-6 py-2 rounded font-semibold hover:bg-blue-500"
      >
        Simpan Perubahan
      </button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';
import { useToast } from 'vue-toastification';

export default {
  name: 'EditPilihanSehat',
  data() {
    return {
      id: null,
      form: {
        nama: '',
        deskripsi: '',
        gambar_path: null,
        urutan: 1,
        aktif: '1',
        preview: '',
        current_gambar_path: '',
      },
      errors: {},
      toast: useToast(),
    };
  },
  mounted() {
    // Extract ID from the URL
    const urlParts = window.location.pathname.split('/');
    this.id = urlParts[urlParts.indexOf('pilihan-sehat') + 1];
    this.fetchData();
  },
  methods: {
    async fetchData() {
      try {
        const res = await axios.get(`/admin/pilihan-sehat/${this.id}/edit`, {
          headers: {
            Accept: 'application/json',
          },
        });
        const data = res.data;
        this.form.nama = data.nama;
        this.form.deskripsi = data.deskripsi;
        this.form.urutan = data.urutan;
        this.form.aktif = String(data.aktif);
        this.form.current_gambar_path = data.gambar_path || '';
        this.form.preview = data.gambar_path
          ? `${window.location.origin}/${data.gambar_path}`
          : '';
      } catch (err) {
        console.error('Error fetching data:', err);
        this.toast.error('Gagal memuat data.');
      }
    },
    handleFileUpload(event) {
      if (event.target.files.length > 0) {
        this.form.gambar_path = event.target.files[0];
        // Create a preview of the new image
        const reader = new FileReader();
        reader.onload = (e) => {
          this.form.preview = e.target.result;
        };
        reader.readAsDataURL(this.form.gambar_path);
      } else {
        this.form.gambar_path = null;
      }
    },
    async submitForm() {
      const formData = new FormData();
      
      // Add all form fields except preview and gambar_path (handled separately)
      for (const key in this.form) {
        if (key === 'preview' || key === 'gambar_path' || key === 'current_gambar_path') continue;
        formData.append(key, this.form[key]);
      }
      
      // Only append gambar_path if a new file was selected
      if (this.form.gambar_path) {
        formData.append('gambar_path', this.form.gambar_path);
      }
      
      formData.append('_method', 'PUT');

      try {
        await axios.post(`/admin/pilihan-sehat/${this.id}`, formData);
        this.toast.success('Data berhasil diperbarui!', {
          position: 'top-right',
        });
        setTimeout(() => {
          window.location.href = '/admin/pilihan-sehat';
        }, 1500);
      } catch (error) {
        if (error.response && error.response.status === 422) {
          this.errors = error.response.data.errors || {};
        } else {
          console.error('Error submitting form:', error);
          this.toast.error('Terjadi kesalahan saat menyimpan.');
        }
      }
    },
  },
};
</script>
