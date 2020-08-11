<template>
    <section>
        <!-- Categorias -->
        <div class="card">
            <div class="card-header">
                <button
                    type="button"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#modalColors"
                >
                    <i class="fa fa-plus"></i> Novo Catalogo de Cores
                </button>
            </div>
            <div class="card-body"></div>
        </div>

        <!-- Modal de Novo Registro -->
        <div
            class="modal fade"
            id="modalColors"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modalColorsLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content bg-secondary">
                    <form method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalColorsLabel">
                                Novo Catalogo de Cores
                            </h5>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Fechar"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <input type="text" class="form-control" v-model="name" placeholder="Nome do Catalogo">
                                </div>

                                <div class="form-group col-12 col-md-6 col-lg-4">
                                    <div id="color-picker" class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                        </span>
                                        <input type="text" name="color_code" class="form-control" value="#000">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button
                                type="submit"
                                class="btn btn-primary"
                                :disabled="disabled == 1"
                            >
                                <span class="fa fa-save"></span>
                                Registrar Cores
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
$(function () {
    $('#color-picker').colorpicker({
        format: 'auto'
    });
});

export default {
    mounted() {},
    data() {
        return {
            disabled: 0
        };
    },
    created() {},
    methods: {},
    filters: {}
};
</script>
