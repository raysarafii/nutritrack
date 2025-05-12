<template>
    <!-- Root Element -->
    <div class="w-full md:w-3/4 px-8 py-12">
        <h2 class="text-2xl font-bold text-left mb-6">Login Page</h2>

        <form @submit.prevent="login" class="space-y-4">
            <div v-if="errors.length" class="bg-red-500 text-white p-3 rounded-lg">
                <ul>
                    <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
                </ul>
            </div>

            <div>
                <label for="email" class="text-gray-600 text-sm block mb-1">Email</label>
                <input type="email" id="email" v-model="formData.email" placeholder="Email" 
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label for="password" class="text-gray-600 text-sm block mb-1">Password</label>
                <input type="password" id="password" v-model="formData.password" placeholder="Password" 
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <button type="submit" 
                class="w-full p-3 text-white font-bold rounded-lg bg-gradient-to-r from-[#007AFF] to-[#00D26A] shadow-md hover:opacity-90 transition duration-300">
                Login
            </button>

            <p class="text-gray-600 text-xs text-left mt-2">
                Belum punya akun? <a href="/register" class="text-blue-500 font-bold">Register</a>
            </p>
        </form>

        <div class="mt-6 text-center">
            <button class="w-full p-3 border border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-100">
                <img :src="googleIconUrl" alt="Google" class="w-7 h-7 mr-2">
                Sign In with Google
            </button>
        </div>
    </div>
</template>

<script>
import { useToast } from 'vue-toastification';

export default {
    name: 'LoginForm',
    data() {
        return {
            formData: {
                email: '',
                password: ''
            },
            errors: [],
            logoUrl: '/images/logo.png',
            foodImageUrl: '/images/healthy-food.png',
            googleIconUrl: '/images/google-icon.png'
        };
    },
    setup() {
        const toast = useToast();
        return { toast };
    },
    methods: {
        login() {
            this.errors = [];

            if (!this.formData.email) this.errors.push('Email is required');
            if (!this.formData.password) this.errors.push('Password is required');

            if (this.errors.length === 0) {
                const formData = new FormData();
                formData.append('email', this.formData.email);
                formData.append('password', this.formData.password);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                fetch('/login', {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    redirect: 'follow'
                })
                .then(response => {
                    if (response.redirected) {
                        window.location.href = response.url;
                    } else {
                        return response.json();
                    }
                })
                .then(data => {
                    if (data && data.errors) {
                        for (const key in data.errors) {
                            this.errors.push(data.errors[key]);
                        }
                        this.toast.error('Login failed. Please check your credentials.');
                    }
                })
                .catch(error => {
                    this.toast.error('An error occurred during login.');
                    console.error('Login error:', error);
                });
            } else {
                this.toast.error('Please fix the errors in the form.');
            }
        }
    }
};
</script>
