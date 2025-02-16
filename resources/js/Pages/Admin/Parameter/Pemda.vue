<template>
    <Card :title="'Pemda'">
            <form @submit.prevent="submit" class="py-2">
                <Alert
                    v-for="(alert, index) in alerts"
                    :key="index"
                    :message="alert.message"
                    :type="alert.type"
                    :duration="2000"
                    :closable="true"
                />

                <div class="mb-2">
                    <label class="block">Name</label>
                    <input v-model="data.nama" type="text" class="border px-2 py-1" required :disabled="disable"/>
                </div>
                <div class="mb-2">
                    <label class="block">Alamat</label>
                    <input v-model="data.alamat" type="text" class="border px-2 py-1" required :disabled="disable"/>
                </div>
                <div class="mb-2">
                    <label class="block">Ibukota</label>
                    <input v-model="data.ibukota" type="text" class="border px-2 py-1" required :disabled="disable"/>
                </div>
                <div class="mb-2">
                    <label class="block">Nama Bupati</label>
                    <input v-model="data.nama_bupati" type="text" class="border px-2 py-1" :disabled="disable"/>
                </div>
                <div class="mb-2">
                    <label class="block">Jabatan Bupati</label>
                    <input v-model="data.jabatan_bupati" type="text" class="border px-2 py-1" :disabled="disable"/>
                </div>


                <button type="button" class="bg-blue-500 text-white px-4 py-2 mr-2" v-if="disable" @click="edit">Edit</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 mr-2" v-if="!disable">Simpan</button>
                <a class="inline-block bg-blue-500 text-white px-4 py-2" :href="`/parameter/kecamatan/${data.kode_prov}/${data.kode_kab}`">Kecamatan</a>
            </form>
    </Card>
</template>

<script>
import LayoutDashboard from '@/components/LayoutDashboard.vue'
import SubMenuParameter from '@/components/SubMenuParameter.vue'
import Card from '@/components/Card.vue'
import Alert from '@/components/Alert.vue'
import { objectToFormData } from "@/utils/objectToFormdata.js"; // Import helper


import axios from 'axios';

export default {
    components: {
        LayoutDashboard,
        SubMenuParameter,
        Card,
        Alert,
    },
    data() {
        return {
            disable: true,
            data: {},
            alerts: [],
        };
    },
    async created() {
        this.loadData();
    },
    methods: {
        edit() {
            this.disable =!this.disable;
        },
        async loadData() {
            try {
                const response = await axios.get('/admin/parameter/pemda', {
                    headers: { Authorization: `Bearer ${localStorage.getItem('token')}` }
                });
                this.data = response.data.data;
            } catch (error) {
                console.error(error);
            }
        },
        async submit() {
            const formData = objectToFormData(this.data);

            try {
                const response = await axios.post('/admin/parameter/pemda/save', formData, {
                    "Content-Type": "multipart/form-data",
                    headers: { Authorization: `Bearer ${localStorage.getItem('token')}` }
                });                
                this.loadData();
                this.alerts.push({message: 'Data berhasil disimpan', type: 'success'});
            } catch (error) {
                this.alerts.push({message: error.response.data.message, type: 'error'});
            }
            
            this.disable = true;
        }
    }
    // methods: {
    //     logout() {
    //         axios.post('http://localhost:8000/api/logout', {}, {
    //             headers: { Authorization: `Bearer ${localStorage.getItem('token')}` }
    //         }).then(() => {
    //             localStorage.removeItem('token');
    //             this.$router.push('/login');
    //         });
    //     }
    // }
};
</script>