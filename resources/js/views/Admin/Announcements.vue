<template>
    <MainLayout>
        <a-card>
            <h1>Announcements</h1>
          
            <a-textarea v-model="data.message" :rows="4" value="" allow-clear large/>
            <div style="display:flex; justify-content: end;">
                <a-button
                    size='large'
                    type="primary" 
                    @click="sendNotification"
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
            data: {
                message: ''
            },
        };
    },
    components: {
        MainLayout,
    },
    methods: {
        async sendNotification() {
            try {
                return await axios(
                    {
                        method: "POST",
                        url: "/admin/send-announcement",
                        data: this.data,
                    },
                );
                this.emitDone();

            } catch (e) {
                this.isLoading = false;
                this.$error({
                    title: "Something went wrong!",
                });
            } finally {
                this.isLoading = false;
            }
           
        }
    },
    mounted() {
    },
};
</script>
