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
                    <form @submit="addCatalog" method="post">
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
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="name"
                                        placeholder="Nome do Catalogo"
                                    />
                                </div>

                                <div class="form-group col-12">
                                    <verte
                                        v-model="color_code"
                                        :picker="square"
                                        :model="rgb"
                                    ></verte>
                                </div>
                                <div class="form-group col-12">
                                    <div class="input-group">
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="color_name"
                                            v-bind:class="{
                                                'is-invalid': error_color_name
                                            }"
                                            placeholder="Nome da cor"
                                        />
                                        <span class="input-group-append">
                                            <button
                                                type="button"
                                                class="btn btn-primary"
                                                v-on:click="addColor"
                                            >
                                                <i class="fa fa-plus"
                                                    >Adicionar</i
                                                >
                                            </button>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <h3>Cores Adicionadas</h3>
                                </div>
                                <div class="col-12">
                                    <div class="color-box">
                                        <div
                                            class="color-label d-flex justify-content-between"
                                            v-for="catalog in catalogs"
                                            :key="catalog"
                                        >
                                            <div
                                                v-bind:style="{
                                                    'background-color':
                                                        catalog.color_code,
                                                    width: '40px',
                                                    height: '40px',
                                                    'border-radius': '50%'
                                                }"
                                            ></div>
                                            <div class="my-auto">
                                                {{ catalog.color_name }}
                                            </div>
                                            <div class="my-auto">
                                                <button
                                                    type="button"
                                                    class="btn btn-danger"
                                                    v-on:click="colorRemove(catalog)"
                                                >
                                                    <i class="fa fa-times"></i>
                                                    Remover
                                                </button>
                                            </div>
                                        </div>
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
                                Registrar Catalogo
                            </button>
                        </div>
                    </form>
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
            name: "",
            catalogs: [],
            color_code: "",
            color_name: "",
            error_color_name: 0,
            disabled: 0
        };
    },
    created() {},
    methods: {
        addColor() {
            // Fazemos uma verificação se existe um nome para adicionar a cor para que não fique em branco
            if (this.color_name) {
                // Faz um push para que não sobrescreva o que ja foi adicionado
                this.catalogs.push({
                    color_code: this.color_code,
                    color_name: this.color_name
                });
                // Limpa os campos quando termina de adicionar para um novo nome
                this.color_name = "";
                this.error_color_name = 0;
            } else {
                this.error_color_name = 1;
            }
        },
        colorRemove(catalog){
            this.catalogs.splice(this.catalogs.indexOf(catalog), 1);
        },
        addCatalog(){
            e.preventDefault();
            this.disabled = 1;

            // Sweet para carregamento
            this.$swal({
                title: "Salvando Dados!",
                onBeforeOpen: () => {
                    this.$swal.showLoading();
                }
            });

            // Conexão
            axios
                .post("colorStore", {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                })
                .then(response => {
                    this.getResults();
                    this.$swal({
                        title: "Administrador criado com successo!",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });

                    // Limpeza dos campos para novos cadastros
                    this.disabled = 0;
                    this.name = "";
                    this.email = "";
                    this.password = "";
                    this.password_confirmation = "";
                    this.errors = "";
                })
                .catch(error => {
                    this.$swal({
                        title: "Oops...",
                        html: "Algo deu errado",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1000
                    });

                    this.disabled = 0;
                    this.errors = error.response.data.errors;
                });
        }
    },
    filters: {}
};
</script>
