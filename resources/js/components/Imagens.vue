<template>
    <section>
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between">
                    <div class="col-6">
                        <button
                            type="button"
                            class="btn btn-primary"
                            data-toggle="modal"
                            data-target="#modalImagens"
                        >
                            <i class="fa fa-image"></i> Adicionar Imagens
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body max-height-image">
                <div class="row justify-content-center">
                    <div class="col-auto text-center" v-for="image in images" :key="image">
                        <div class="card-image">
                            <!-- <div class="card-tiulo-image">fff</div> -->
                            <div class="card-body-image"><img :src="image.path" alt="Imagem" /></div>
                            <!-- <div class="card-footer-image">qqq</div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div
            id="modalImagens"
            class="modal fade"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modalImagensLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalImagensLabel">
                            Arraste e Solte a Imagem
                        </h5>
                        
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="fechar"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body view-files-upload">
                        <button type="button" class="btn btn-success mb-3"
                            :disabled="!fileRecordsForUpload.length"
                            @click="uploadFiles()"
                        >
                            Salvar {{ fileRecordsForUpload.length }} Imagens
                        </button>
                        <VueFileAgent
                            ref="vueFileAgent"
                            :theme="'list'"
                            :linkable="true"
                            :multiple="true"
                            :deletable="true"
                            :meta="true"
                            :editable="true"
                            :accept="'image/*'"
                            :maxSize="'100MB'"
                            :helpText="'Escolha as imagens para subir'"
                            :errorText="{
                                type: 'Arquivo Inválido. Somente Imagens',
                                size: 'Imagem não pode passar de 100MB'
                            }"
                            @select="filesSelected($event)"
                            @beforedelete="onBeforeDelete($event)"
                            @delete="fileDeleted($event)"
                            v-model="fileRecords"
                        ></VueFileAgent>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    mounted() {},
    data() {
        return {
            images: {},
            fileRecords: [],
            uploadUrl: "imageStore",
            uploadHeaders: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content")
            },
            fileRecordsForUpload: []
        };
    },
    created() {
        this.getImages();
    },
    methods: {
        getImages(){
            axios.get("imageIndex").then((result) => {
                this.images = result.data;
            });
        },
        uploadFiles: function() {
            // Using the default uploader. You may use another uploader instead.
            this.$refs.vueFileAgent.upload(
                this.uploadUrl,
                this.uploadHeaders,
                this.fileRecordsForUpload
            );
            this.fileRecordsForUpload = [];
        },
        filesSelected: function(fileRecordsNewlySelected) {
            var validFileRecords = fileRecordsNewlySelected.filter(
                fileRecord => !fileRecord.error
            );
            this.fileRecordsForUpload = this.fileRecordsForUpload.concat(
                validFileRecords
            );
        },
        onBeforeDelete: function(fileRecord) {
            var i = this.fileRecordsForUpload.indexOf(fileRecord);
            this.fileRecordsForUpload.splice(i, 1);
            this.$refs.vueFileAgent.deleteFileRecord(fileRecord);
        },
        fileDeleted: function(fileRecord) {
            var i = this.fileRecordsForUpload.indexOf(fileRecord);
            this.fileRecordsForUpload.splice(i, 1);
        }
    },
    filters: {}
};
</script>
