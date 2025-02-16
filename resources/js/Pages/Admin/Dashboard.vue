<template>
    <LayoutDashboard>
        <Card :title="'Dashboard'">
            <p>This is dashboard</p>

            <h2>Welcome, {{ user.name }}</h2>
            <p>Email: {{ user.email }}</p>
            <button @click="logout">Logout</button>
        </Card>
    </LayoutDashboard>

</template>

<script>
import axios from 'axios';
import LayoutDashboard from './../../components/LayoutDashboard.vue'
import Card from './../../components/Card.vue'

export default {
    components: {
        LayoutDashboard,
        Card,
    },
    data() {
        return {
            user: {}
        };
    },
    async created() {
        try {
            const response = await axios.get('http://localhost:8000/api/profile', {
                headers: { Authorization: `Bearer ${localStorage.getItem('token')}` }
            });
            this.user = response.data;
        } catch (error) {
            this.$router.push('/login');
        }
    },
    
};
</script>