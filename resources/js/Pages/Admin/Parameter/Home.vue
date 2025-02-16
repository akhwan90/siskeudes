<template>
    <LayoutDashboard>
        <SubMenuParameter/>
        <router-view></router-view>
    </LayoutDashboard>

</template>

<script>
import LayoutDashboard from './../../../components/LayoutDashboard.vue'
import SubMenuParameter from './../../../components/SubMenuParameter.vue'
import Card from './../../../components/Card.vue'

export default {
    components: {
        LayoutDashboard,
        SubMenuParameter,
        Card,
    },
    data() {
        return {
            // user: {}
        };
    },
    // async created() {
    //     try {
    //         const response = await axios.get('http://localhost:8000/api/profile', {
    //             headers: { Authorization: `Bearer ${localStorage.getItem('token')}` }
    //         });
    //         this.user = response.data;
    //     } catch (error) {
    //         this.$router.push('/login');
    //     }
    // },
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