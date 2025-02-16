<template>
    <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex items-center gap-4">
            <!-- Logo -->
            <div class="text-xl font-bold">siskeudes</div>

            <!-- Desktop Menu -->
            <ul class="hidden md:flex space-x-6">
                <li><a href="/parameter" class="hover:text-gray-200">Parameter</a></li>

                <!-- Dropdown -->
                <!-- <li class="relative">
                    <button @click="toggleDropdown" class="hover:text-gray-200 flex items-center">
                        Services
                        <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <ul v-if="dropdownOpen" @mouseleave="closeDropdown"
                        class="absolute left-0 mt-2 bg-white text-black shadow-lg w-40">
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-200">Web Development</a></li>
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-200">Mobile Apps</a></li>
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-200">SEO Services</a></li>
                    </ul>
                </li> -->
                

            </ul>

            <a href="#" @click.prevent="logout" class="hover:text-gray-200">Logout</a>

            <!-- Mobile Menu Button -->
            <button @click="toggleMobileMenu" class="md:hidden">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            dropdownOpen: false,
            mobileMenuOpen: false,
        };
    },
    methods: {
        toggleDropdown() {
            this.dropdownOpen = !this.dropdownOpen;
        },
        closeDropdown() {
            this.dropdownOpen = false;
        },
        toggleMobileMenu() {
            this.mobileMenuOpen = !this.mobileMenuOpen;
        },
        logout() {
            axios.post('/logout', {}, {
                headers: { Authorization: `Bearer ${localStorage.getItem('token')}` }
            }).then(() => {
                localStorage.removeItem('token');
                this.$router.push('/login');
            });
        }
    },
};
</script>
