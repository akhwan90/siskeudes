<template>
    <LayoutLogin>
        <div class="w-1/4 border p-4">
            <form @submit.prevent="login">
                <div class="mb-2 w-full">
                    <label for="email" class="block">Email:</label>
                    <input type="email" class="border px-2 py-1 w-full" id="email" v-model="email" required />
                </div>

                <div class="mb-2">
                    <label for="password" class="block">Password:</label>
                    <input type="password" class="border px-2 py-1 w-full" id="password" v-model="password" required />
                </div>

                <button class="p-2 bg-green-600 hover:bg-green-400 text-white w-full">Login</button>
                <p v-if="errorMessage" class="text-red-600 mt-3">{{ errorMessage }}</p>
            </form>
        </div>
    </LayoutLogin>
</template>

<script>
import axios from 'axios';
import LayoutLogin from '@/components/LayoutLogin.vue'

export default {
    components: { 
        LayoutLogin,
    },
    data() {
        return {
            email: '',
            password: '',
            errorMessage: '',
        };
    },
    methods: {
        async login() {
            try {
                const response = await axios.post('/login', {
                    email: this.email,
                    password: this.password,
                });

                localStorage.setItem('token', response.data.access_token);
                axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.access_token}`;

                this.$router.push('/dashboard');
            } catch (error) {
                this.errorMessage = "Email atau password salah!";
            }
        }
    }
};
</script>