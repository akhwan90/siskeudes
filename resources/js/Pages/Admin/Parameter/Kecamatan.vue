<template>
    <Card :title="'Kecamatan'">
        <form @submit.prevent="submit" class="py-2">
            <Alert
                v-for="(alert, index) in alerts"
                :key="index"
                :message="alert.message"
                :type="alert.type"
                :duration="2000"
                :closable="true"
            />
            <div class="mb-2 flex">
                <label class="w-2/12">Kode Provinsi</label>
                <input v-model="data.kode_prov" ref="inputRef" type="text" class="border px-2 py-1" required :disabled="disable"/>
            </div>
            <div class="mb-2 flex">
                <label class="w-2/12">Kode Kabupaten</label>
                <input v-model="data.kode_kab" type="text" class="border px-2 py-1" required :disabled="disable"/>
            </div>
            <div class="mb-2 flex">
                <label class="w-2/12">Kode Kecamatan</label>
                <input v-model="data.kode_kec" type="text" class="border px-2 py-1" required :disabled="disable"/>
            </div>
            <div class="mb-2 flex">
                <label class="w-2/12">Nama Kecamatan</label>
                <input v-model="data.nama" type="text" class="border px-2 py-1" :disabled="disable"/>
            </div>

            <button type="button" class="bg-blue-500 text-white px-4 py-2 mr-2" v-if="disable" @click="tambah">Tambah</button>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 mr-2" v-if="!disable">{{  data.mode }}</button>
            <button type="button" class="bg-slate-400 text-white px-4 py-2 mr-2" v-if="!disable" @click="batal">Batal</button>
            <a :href="`/parameter/pemda`" class="inline-block bg-slate-400 text-white px-4 py-2">Kembali</a>
            
        </form>


        <table class="border w-full">
            <thead>
                <tr>
                    <th class="border px-2 py-2" width="10%">Kode</th>
                    <th class="border px-2 py-2" width="70%">Kecamatan</th>
                    <th class="border px-2 py-2" width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in datas" :key="item.kode_gabung">
                    <td class="border px-2 py-1">{{ item.kode_gabung }}</td>
                    <td class="border px-2 py-1">{{ item.nama }}</td>
                    <td class="border px-2 py-1">
                        <a class="inline-block bg-blue-400 px-2 hover:bg-blue-600 py-1 mr-2" :href="`/parameter/desa/${item.kode_prov}/${item.kode_kab}/${item.kode_kec}`">Desa</a>
                        <a class="inline-block bg-slate-400 px-2 hover:bg-slate-600 py-1 mr-2" href="#" @click.prevent="edit(item)">Edit</a>
                        <a class="inline-block bg-red-400 px-2 hover:bg-red-600 py-1 mr-2" href="#" @click.prevent="remove(item)">Hapus</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </Card>
</template>

<script>
import LayoutDashboard from '@/components/LayoutDashboard.vue'
import SubMenuParameter from '@/components/SubMenuParameter.vue'
import Card from '@/components/Card.vue'
import Alert from '@/components/Alert.vue'
import { objectToFormData } from "@/utils/objectToFormdata.js"; // Import helper
import { ref } from "vue";

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
            datas: [],
            data: {
                kode_prov: null,
                kode_kab: null,
                kode_kec: null,
                kode_gabung: null,
                nama: null,
                mode: 'create',
            },
            alerts: [],
        };
    },
    created() {
    },
    mounted() {
        this.data.kode_prov = this.$route.params.kdProv;
        this.data.kode_kab = this.$route.params.kdKab;
        this.loadData();
    },
    methods: {
        tambah() {
            // const inputRef = ref(null);
            this.disable =!this.disable;
            this.data.mode = 'create';
            // inputRef.value?.focus();
        },
        edit(item) {
            this.data.kode_kec = item.kode_kec;
            this.data.nama = item.nama;
            this.data.kode_gabung = item.kode_gabung;
            this.data.mode = 'update';
            this.disable =!this.disable;
        },
        batal() {
            this.disable =!this.disable;
            this.data.kode_kec = null;
            this.data.nama = null;
            // this.loadData();
        },
        async remove(item) {
            if (confirm("Anda yakin")) {
                try {
                    await axios.delete(`/admin/parameter/kecamatan/${item.kode_prov}/${this.data.kode_kab}/remove/${item.kode_kec}`, {
                        headers: { Authorization: `Bearer ${localStorage.getItem('token')}` }
                    });
                    this.loadData();
                    this.alerts.push({message: 'Data berhasil dihapus', type:'success'});
                } catch (error) {
                    this.alerts.push({message: error.response.data.message, type: 'error'});
                }
            }
        },  
        async loadData() {
            try {
                const response = await axios.get(`/admin/parameter/kecamatan/${this.data.kode_prov}/${this.data.kode_kab}`, {
                    headers: { Authorization: `Bearer ${localStorage.getItem('token')}` }
                });
                this.datas = response.data.datas;
            } catch (error) {
                console.error(error);
            }
        },
        async submit() {
            const formData = objectToFormData(this.data);

            try {
                const response = await axios.post(`/admin/parameter/kecamatan/${this.data.kode_prov}/${this.data.kode_kab}/save`, formData, {
                    "Content-Type": "multipart/form-data",
                    headers: { Authorization: `Bearer ${localStorage.getItem('token')}` }
                });                
                this.loadData();
                this.data.kode_kec = null;
                this.data.nama = null;
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