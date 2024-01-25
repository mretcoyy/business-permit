<template>
    <MainLayout>
        <a-card>
            <h1>Announcements</h1>
          
            <a-textarea v-model="data" :rows="4" allow-clear large/>
            <div style="display:flex; justify-content: end;">
                <a-button
                    size='large'
                    type="primary" 
                    @click="handleSearch"
                    style="margin-top:10px; "
                >
                    Send
                </a-button>
            </div>
        </a-card>
      
    </MainLayout>
</template>
<script>
import MainLayout from "../../layouts/MainLayout";

const data = [];

export default {
    data() {
        return {
            data,
        };
    },
    components: {
        MainLayout,
    },
    methods: {
    },
    mounted() {
    },
};
</script>
