<template>
  <div>
    <h1 class="text-3xl sm:text-4xl text-center font-bold bg-gradient-to-r from-[#007AFF] to-[#00D26A] bg-clip-text text-transparent mb-6 font-['Poppins']">
      Input Data Konsumsi Harianmu!
    </h1>

    <div class="grid grid-cols-6 md:grid-cols-1 gap-6">
      <div class="md:col-span-2 bg-white rounded-2xl shadow p-6">
        <h2 class="text-xl font-semibold mb-2">Catatan Asupan</h2>
        <p class="text-sm text-gray-500 mb-6">Isi data konsumsi makanan/minuman kamu di bawah ini</p>

        <form @submit.prevent="submitAsupan" class="space-y-4 w-full">
          <div class="grid grid-cols-1 sm:grid-cols-3 items-center gap-4">
            <label class="font-semibold text-[#003266] text-md">Makanan / Minuman</label>
            <input 
              type="text" 
              v-model="asupan.nama"
              class="sm:col-span-2 border border-blue-400 rounded-xl px-4 py-2 w-full" 
            />
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-3 items-center gap-4">
            <label class="font-semibold text-[#003266] text-md">Kadar Gula</label>
            <input 
              type="text" 
              v-model="asupan.kadar_gula"
              class="sm:col-span-2 border border-blue-400 rounded-xl px-4 py-2 w-full" 
            />
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-3 items-center gap-4">
            <label class="font-semibold text-[#003266] text-md">Kadar Kalori</label>
            <input 
              type="text" 
              v-model="asupan.kadar_kalori"
              class="sm:col-span-2 border border-blue-400 rounded-xl px-4 py-2 w-full" 
            />
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-3 items-center gap-4">
            <label class="font-semibold text-[#003266] text-md">Tanggal Konsumsi</label>
            <input 
              type="date" 
              v-model="asupan.tanggal_konsumsi"
              class="sm:col-span-2 border border-blue-400 rounded-xl px-4 py-2 w-full" 
            />
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-3 items-center gap-4">
            <label class="font-semibold text-[#003266] text-md">Waktu Konsumsi</label>
            <input 
              type="text" 
              v-model="asupan.waktu_konsumsi"
              class="sm:col-span-2 border border-blue-400 rounded-xl px-4 py-2 w-full" 
            />
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-3 items-center gap-4">
            <label class="font-semibold text-[#003266] text-md">Catatan</label>
            <input 
              type="text" 
              v-model="asupan.catatan"
              class="sm:col-span-2 border border-blue-400 rounded-xl px-4 py-2 w-full" 
            />
          </div>

          <div class="flex flex-col sm:flex-row justify-between gap-4 pt-4">
            <a 
              href="/dashboard" 
              class="px-6 py-2 rounded-xl border border-blue-300 text-blue-600 hover:bg-blue-50 transition w-full sm:w-auto text-center"
            >
              Kembali
            </a>
            <button 
              type="submit"
              class="px-6 py-2 rounded-xl text-white bg-gradient-to-r from-blue-500 to-green-400 hover:opacity-90 transition w-full sm:w-auto"
              :disabled="isSubmitting"
            >
              {{ isSubmitting ? 'Menyimpan...' : 'Simpan' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { reactive, ref, onMounted } from 'vue';
import { useToast } from 'vue-toastification';
import axios from 'axios';

// Set up axios to include CSRF token
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
const token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
  axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found');
}

export default {
  setup() {
    const toast = useToast();
    const isSubmitting = ref(false);
    
    const asupan = reactive({
      nama: 'Teh Manis',
      kadar_gula: '15g',
      kadar_kalori: '60 kcal',
      tanggal_konsumsi: new Date().toISOString().split('T')[0], // Today's date in YYYY-MM-DD format
      waktu_konsumsi: 'Pagi',
      catatan: 'Minum dengan sarapan'
    });
    
    const submitAsupan = async () => {
      isSubmitting.value = true;
      
      try {
        const formData = new FormData();
        formData.append('nama', asupan.nama);
        formData.append('kadar_gula', asupan.kadar_gula);
        formData.append('kadar_kalori', asupan.kadar_kalori);
        formData.append('tanggal_konsumsi', asupan.tanggal_konsumsi);
        formData.append('waktu_konsumsi', asupan.waktu_konsumsi);
        formData.append('catatan', asupan.catatan);
        
        await axios.post('/asupan', formData);
        toast.success('Asupan berhasil disimpan');
        asupan.nama = 'Teh Manis';
        asupan.kadar_gula = '15g';
        asupan.kadar_kalori = '60 kcal';
        asupan.tanggal_konsumsi = new Date().toISOString().split('T')[0];
        asupan.waktu_konsumsi = 'Pagi';
        asupan.catatan = 'Minum dengan sarapan';
      } catch (error) {
        if (error.response && error.response.data && error.response.data.errors) {
          const firstError = Object.values(error.response.data.errors)[0][0];
          toast.error(firstError);
        } else {
          toast.error('Terjadi kesalahan saat menyimpan asupan');
        }
        console.error(error);
      } finally {
        isSubmitting.value = false;
      }
    };
    
    return {
      asupan,
      isSubmitting,
      submitAsupan
    };
  }
}
</script> 