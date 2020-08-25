<template>
    <section>
        <!-- Categorias -->
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between">
                    <div class="col-4">
                        <button
                            type="button"
                            class="btn btn-primary"
                            data-toggle="modal"
                            data-target="#modalColors"
                        >
                            <i class="fa fa-plus"></i> Novo Catalogo de Cores
                        </button>
                    </div>

                    <div class="form-group col-4">
                        <input
                            type="search"
                            class="form-control"
                            v-model="searchIn"
                            v-on:keyup="search"
                            placeholder="Busca por Nome"
                        />
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nome do Catalogo</th>
                                <th>Total de Cores no Catalogo</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="output in outputs" :key="output.id">
                                <td>{{ output.name }}</td>
                                <td>{{ output.catalog | filterLength }}</td>
                                <td>
                                    <div
                                        class="btn-group"
                                        role="group"
                                        aria-label="Botões de ações"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-primary"
                                            data-tooltip="tooltip"
                                            data-placement="top"
                                            v-on:click="modalColorEdit(output)"
                                        >
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-danger"
                                            v-on:click="destroy(output)"
                                            data-tooltip="tooltip"
                                            data-placement="top"
                                        >
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <pagination
                    v-if="!searchIn"
                    :data="pages"
                    @pagination-change-page="getResults"
                ></pagination>
            </div>
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
                                        v-bind:class="{
                                            'is-invalid': error_catalogs.name
                                        }"
                                        :disabled="disabled == 1"
                                        v-model="name"
                                        placeholder="Nome do Catalogo"
                                    />
                                </div>

                                <div class="form-group col-12">
                                    <verte
                                        v-model="color_code"
                                        picker="square"
                                        model="rgb"
                                    ></verte>
                                </div>
                                <div class="form-group col-12">
                                    <div class="input-group">
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="color_name"
                                            v-bind:class="[
                                                {
                                                    'is-invalid': error_color_name
                                                },
                                                {
                                                    'is-invalid':
                                                        error_catalogs.catalogs
                                                }
                                            ]"
                                            :disabled="disabled == 1"
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
                                            :key="catalog.color_code"
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
                                                    v-on:click="
                                                        colorRemove(catalog)
                                                    "
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

        <!-- Modal de Novo Registro -->
        <div
            class="modal fade"
            id="modalColorEdit"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modalColorEditLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content bg-secondary">
                    <form @submit="editCatalog" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalColorEditLabel">
                                Editar Catalogo de Cores
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
                                        v-bind:class="{
                                            'is-invalid': editErrorCatalog.name
                                        }"
                                        :disabled="disabled == 1"
                                        v-model="nameEdit"
                                        placeholder="Nome do Catalogo"
                                    />
                                </div>

                                <div class="form-group col-12">
                                    <verte
                                        v-model="color_codeEdit"
                                        picker="square"
                                        model="rgb"
                                    ></verte>
                                </div>
                                <div class="form-group col-12">
                                    <div class="input-group">
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="color_nameEdit"
                                            v-bind:class="[
                                                {
                                                    'is-invalid': editErrorName
                                                },
                                                {
                                                    'is-invalid':
                                                        editErrorCatalog.catalogs
                                                }
                                            ]"
                                            :disabled="disabled == 1"
                                            placeholder="Nome da cor"
                                        />
                                        <span class="input-group-append">
                                            <button
                                                type="button"
                                                class="btn btn-primary"
                                                v-on:click="addEditColor"
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
                                            v-for="catalogsEdit in catalogEdit"
                                            :key="catalogsEdit.color_code"
                                        >
                                            <div
                                                v-bind:style="{
                                                    'background-color':
                                                        catalogsEdit.color_code,
                                                    width: '40px',
                                                    height: '40px',
                                                    'border-radius': '50%'
                                                }"
                                            ></div>
                                            <div class="my-auto">
                                                {{ catalogsEdit.color_name }}
                                            </div>
                                            <div class="my-auto">
                                                <button
                                                    type="button"
                                                    class="btn btn-danger"
                                                    v-on:click="
                                                        colorRemoveEdit(
                                                            catalogsEdit
                                                        )
                                                    "
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
            outputs: {},
            outputs2: {},
            searchIn: "",
            pages: {},
            name: "",
            catalogs: [],
            color_code: "",
            color_name: "",
            error_catalogs: "",
            error_color_name: 0,
            idEdit: "",
            nameEdit: "",
            catalogEdit: [],
            color_codeEdit: "",
            color_nameEdit: "",
            editErrorCatalog: "",
            editErrorName: 0,
            disabled: 0
        };
    },
    created() {
        this.getResults();
    },
    methods: {
        getResults(page) {
            if (typeof page === "undefined") {
                page = 1;
            }
            this.$http
                .get("colorIndex?page=" + page)
                .then(response => {
                    return response.json();
                })
                .then(data => {
                    // Paginas do admin
                    this.pages = data.colorPage;
                    // Separado por pagina
                    this.outputs = data.colorPage.data;
                    // Total para buscar por filtro
                    this.outputs2 = data.colorTotal;

                    // $(function() {
                    //     $('[data-tooltip="tooltip"]').tooltip();
                    // });
                });
        },
        search() {
            if (this.searchIn) {
                this.outputs = this.outputs2.filter(item => {
                    return item.name
                        .toLowerCase()
                        .startsWith(this.searchIn.toLowerCase());
                });
            } else {
                this.getResults();
            }
        },
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
        colorRemove(catalog) {
            this.catalogs.splice(this.catalogs.indexOf(catalog), 1);
        },
        addCatalog(e) {
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
                    catalogs: this.catalogs
                })
                .then(response => {
                    this.getResults();
                    this.$swal({
                        title: "Catalogo de cores criado com successo!",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });

                    // Limpeza dos campos para novos cadastros
                    this.disabled = 0;
                    this.name = "";
                    this.color_name = "";
                    this.catalogs = [];
                    this.error_catalogs = "";
                    this.error_color_name = 0;
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
                    this.error_catalogs = error.response.data.errors;
                });
        },
        destroy(output) {
            this.$swal({
                title: "Você tem Certeza?",
                html:
                    "Você irá deletar o Catalogo <strong>" +
                    output.name +
                    "</strong> permanentemente!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sim, Delete isso!",
                cancelButtonText: "Não, Mantê-la"
            }).then(result => {
                if (result.value) {
                    axios.get("colorDestroy/" + output.id).then(response => {
                        this.getResults();
                        this.$swal({
                            title: "Deletado!",
                            html:
                                "<strong>" +
                                output.name +
                                "</strong> Deletado com sucesso.",
                            icon: "success"
                        });
                    });
                }
            });
        },
        modalColorEdit(output) {
            $("#modalColorEdit").modal("show");
            this.idEdit = output.id;
            this.nameEdit = output.name;
            this.catalogEdit = output.catalog;

            this.editErrorCatalog = "";
            this.editErrorName = 0;
        },
        addEditColor() {
            // Fazemos uma verificação se existe um nome para adicionar a cor para que não fique em branco
            if (this.color_nameEdit) {
                // Faz um push para que não sobrescreva o que ja foi adicionado
                this.catalogEdit.push({
                    color_code: this.color_codeEdit,
                    color_name: this.color_nameEdit
                });
                this.color_nameEdit = "";
                this.editErrorName = 0;
            } else {
                this.editErrorName = 1;
            }
        },
        colorRemoveEdit(catalog) {
            this.catalogEdit.splice(this.catalogEdit.indexOf(catalog), 1);
        },
        editCatalog(e) {
            e.preventDefault();
            this.disabled = 1;

            // Sweet para carregamento
            this.$swal({
                title: "Atualizando Dados!",
                onBeforeOpen: () => {
                    this.$swal.showLoading();
                }
            });

            // Conexão
            axios
                .post("colorUpdate", {
                    id: this.idEdit,
                    name: this.nameEdit,
                    catalogs: this.catalogEdit
                })
                .then(response => {
                    this.getResults();
                    this.$swal({
                        title: "Catalogo de cores atualizado com successo!",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });

                    // Limpeza dos campos para novos cadastros
                    this.disabled = 0;
                    this.editErrorCatalog = "";
                    this.editErrorName = 0;
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
                    this.editErrorCatalog = error.response.data.errors;
                });
        }
    },
    filters: {
        filterLength(item) {
            return item.length;
        }
    }
};
</script>
