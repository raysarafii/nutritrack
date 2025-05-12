import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/js/app.js',
        'resources/js/login.js',
        'resources/js/register.js',
        'resources/js/profile.js',
        'resources/js/password.js',
        'resources/js/laporan.js',
        'resources/js/asupan.js',
        'resources/js/pilihansehat.js'
      ],
      refresh: true,
    }),
    vue(),
  ],
});
