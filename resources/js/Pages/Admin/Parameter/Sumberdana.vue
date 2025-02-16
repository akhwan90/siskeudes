<template>
    <Card :title="'Sumber Dana'">
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
                <label class="w-2/12">No. Urut</label>
                <input v-model="data.urutan" ref="urutan" type="number" class="border px-2 py-1" required :disabled="disable" tabindex="-1"/>
            </div>
            <div class="mb-2 flex">
                <label class="w-2/12">Kode</label>
                <input v-model="data.kode" type="text" class="border px-2 py-1" required :disabled="disable"/>
            </div>
            <div class="mb-2 flex">
                <label class="w-2/12">Nama</label>
                <input v-model="data.nama" type="text" class="border px-2 py-1 w-8/12" :disabled="disable"/>
            </div>

            <button type="button" class="bg-blue-500 text-white px-4 py-2 mr-2" v-if="disable" @click="tambah">Tambah</button>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 mr-2" v-if="!disable">{{  data.mode }}</button>
            <button type="button" class="bg-slate-400 text-white px-4 py-2 mr-2" v-if="!disable" @click="batal">Batal</button>
            
        </form>


        <table class="border w-full">
            <thead>
                <tr>
                    <th class="border px-2 py-2" width="10%">Urutan</th>
                    <th class="border px-2 py-2" width="10%">Kode</th>
                    <th class="border px-2 py-2" width="60%">Sumber dana</th>
                    <th class="border px-2 py-2" width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in datas" :key="item.kode_gabung">
                    <td class="border px-2 py-1">{{ item.urutan }}</td>
                    <td class="border px-2 py-1">{{ item.kode }}</td>
                    <td class="border px-2 py-1">{{ item.nama }}</td>
                    <td class="border px-2 py-1">
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
                kode: null,
                urutan: null,
                nama: null,
                mode: 'create',
            },
            alerts: [],
        };
    },
    created() {
    },
    mounted() {
        this.loadData();
    },
    methods: {
        tambah() {
            // const inputRef = ref(null);
            this.disable = false;
            this.data.mode = 'create';
            this.$nextTick(() => {
                this.$refs.urutan.focus();
            });
        },
        edit(item) {
            this.data.kode = item.kode;
            this.data.nama = item.nama;
            this.data.urutan = item.urutan;
            this.data.mode = 'update';
            this.disable = false;
            this.$nextTick(() => {
                this.$refs.urutan.focus();
            });
        },
        batal() {
            this.disable = true;
            this.data.kode = null;
            this.data.urutan = null;
            this.data.nama = null;
            // this.loadData();
        },
        async loadData() {
            try {
                const response = await axios.get(`/admin/parameter/sumberdana`, {
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
                const response = await axios.post(`/admin/parameter/sumberdana/save`, formData, {
                    "Content-Type": "multipart/form-data",
                    headers: { Authorization: `Bearer ${localStorage.getItem('token')}` }
                });                
                this.loadData();
                this.batal();
                this.alerts.push({message: 'Data berhasil disimpan', type: 'success'});
            } catch (error) {
                this.alerts.push({message: error.response.data.message, type: 'error'});
            }
            
            this.disable = true;
        },
        async remove(item) {
            if (confirm("Anda yakin")) {
                try {
                    await axios.delete(`/admin/parameter/sumberdana/remove/${item.kode}`, {
                        headers: { Authorization: `Bearer ${localStorage.getItem('token')}` }
                    });
                    this.loadData();
                    this.alerts.push({message: 'Data berhasil dihapus', type:'success'});
                } catch (error) {
                    this.alerts.push({message: error.response.data.message, type: 'error'});
                }
            }
        },  
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