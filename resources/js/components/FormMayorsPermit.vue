<template>
    <a-modal
        title="
           Mayors Permit
        "
        v-model="modal.show"
        :width="1000"
        @cancel="closeModal()"
        :maskClosable="false"
        okText="Print"
        @ok="handleSubmit()"
    >
        <div
            :style="{
                background: '#fff',
                padding: '24px',
                minHeight: '280px',
            }"
        >
            <iframe
                class="frame-file"
                id="pdf_frame"
                height="500"
                width="100%"
                :src="pdfsrc"
                frameborder="0"
                scrolling="auto"
            ></iframe>
        </div>

        <a-modal
            v-model="modalPrint"
            :width="300"
            :maskClosable="false"
            okText="Done"
            centered
            @ok="closeModalPrint()"
            :cancelButtonProps="{ style: { display: 'none' } }"
        >
            Done Printing?
        </a-modal>
    </a-modal>
</template>
<script>
export default {
    props: {
        modal: { type: Object, default: () => ({ show: false }) },
    },
    data() {
        return {
            business_id: "",
            pdfsrc: null,
            filters: {
                business_id: "",
            },
            modalPrint: false,
        };
    },
    methods: {
        closeModal() {
            this.form.resetFields();
        },
        handleSubmit() {
            var myIframe = document.getElementById("pdf_frame").contentWindow;
            myIframe.focus();
            myIframe.print();
            this.modalPrint = true;
        },
        closeModalPrint() {
            this.modalPrint = false;
            this.$emit("refresh");
            this.pdfsrc = null;
        },
    },
    watch: {
        modal(params) {
            // this.info = {};
            if (params.show) {
                (this.filters.business_id = params.business_id),
                    axios
                        .post(
                            "/mayors-permit/view-mayors-permit",
                            { filters: this.filters },
                            {
                                responseType: "blob",
                            }
                        )
                        .then((res) => {
                            const file = new Blob([res.data], {
                                type: "application/pdf",
                            });
                            console.log(file);
                            let fileURL = URL.createObjectURL(file);
                            this.pdfsrc =
                                fileURL + "#toolbar=0&navpanes=0&scrollbar=0";
                        })
                        .catch((error) => {});
            }
        },
    },
};
</script>
<style>
#components-layout-demo-top .logo {
    width: 120px;
    height: 31px;
    background: rgba(255, 255, 255, 0.2);
    margin: 16px 24px 16px 0;
    float: left;
}
</style>
