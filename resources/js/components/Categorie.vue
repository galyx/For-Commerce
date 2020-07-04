<template>
    <section>
        <!-- Categorias -->
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between">
                    <div class="col-12">
                        <button
                            type="button"
                            class="btn btn-primary"
                            v-on:click="addCategorie"
                        >
                            <i class="fa fa-plus"></i> Nova Categoria Principal
                        </button>

                        <button
                            type="button"
                            class="btn btn-danger"
                            v-on:click="trashCategorie"
                            v-if="trashAll.length >= 1"
                        >
                            <i class="fa fa-trash"></i> Apagar Selecionados
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="admin_list" class="table table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <input
                                        @click="
                                            toggle($event, outputCategories)
                                        "
                                        type="checkbox"
                                        v-model="trash"
                                        class="form-control"
                                    />
                                </th>
                                <th>Nome</th>
                                <th>Ações Primarias</th>
                                <th>Ações Secundarias</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="outputCategorie in outputCategories"
                                :key="outputCategorie.id"
                            >
                                <td>
                                    <input
                                        v-model="trashAll"
                                        type="checkbox"
                                        class="form-control"
                                        :value="outputCategorie.id"
                                    />
                                </td>
                                <td>
                                    {{ outputCategorie.name }}
                                </td>
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
                                            title="Adicionar categorias"
                                            v-on:click="
                                                addSubCategorie(outputCategorie)
                                            "
                                        >
                                            <i class="fa fa-ad"></i>
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-secondary"
                                            data-tooltip="tooltip"
                                            data-placement="top"
                                            title="Visualizar categorias"
                                            
                                        >
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
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
                                            title="Editar Categoria"
                                            v-on:click="
                                                categorieEdit(outputCategorie)
                                            "
                                        >
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-danger"
                                            v-on:click="
                                                destroyCategorie(
                                                    outputCategorie
                                                )
                                            "
                                            data-tooltip="tooltip"
                                            data-placement="top"
                                            title="Deletar Categoria"
                                        >
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
            trashAll: [],
            trash: false,
            outputCategories: {}
        };
    },
    created() {
        this.getResultCategories();
    },
    methods: {
        toggle(e, categories) {
            const addAll = e.target.checked;
            var ids = categories.map(l => l.id);
            if (addAll) {
                this.trashAll = this.trashAll
                    .concat(ids)
                    .filter((el, i, arr) => arr.indexOf(el) == i);
            } else {
                this.trashAll = this.trashAll.filter(
                    categorie => !ids.includes(categorie)
                );
            }
        },
        getResultCategories() {
            axios
                .get("categorieIndex")

                .then(data => {
                    this.outputCategories = data.data;

                    $(function() {
                        $('[data-tooltip="tooltip"]').tooltip();
                    });
                });
        },
        // Adicionando nova categorie
        addCategorie() {
            this.$swal({
                title: "Nome da Categoria",
                input: "text",
                showCancelButton: true,
                confirmButtonText: "Salvar",
                cancelButtonText: "Cancelar",
                showLoaderOnConfirm: true,
                preConfirm: save => {
                    if (save) {
                        return axios
                            .post("categorieStore", {
                                categorie: save
                            })
                            .then(response => {
                                return response.data.status;
                            });
                    } else {
                        this.$swal.showValidationMessage(
                            "Campo categoria não pode estar vazio"
                        );
                    }
                },
                allowOutsideClick: () => !this.$swal.isLoading()
            }).then(result => {
                if (result.value == 200) {
                    this.getResultCategories();

                    this.$swal({
                        title: "Categoria registrada com successo",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }

                if (result.value == 201) {
                    this.$swal({
                        title:
                            "Maximo 8 Categorias podem estar registradas como principais.",
                        icon: "error",
                        showConfirmButton: true
                    });
                }
            });
        },
        // Editando nome da Categoria
        categorieEdit(outputCategorie) {
            this.$swal({
                title: "Nome da Categoria",
                input: "text",
                inputValue: outputCategorie.name,
                showCancelButton: true,
                confirmButtonText: "Salvar",
                cancelButtonText: "Cancelar",
                showLoaderOnConfirm: true,
                preConfirm: save => {
                    if (save) {
                        return axios
                            .post("categorieUpdate", {
                                id: outputCategorie.id,
                                categorie: save
                            })
                            .then(response => {
                                return response;
                            });
                    } else {
                        this.$swal.showValidationMessage(
                            "Campo categoria não pode estar vazio"
                        );
                    }
                },
                allowOutsideClick: () => !this.$swal.isLoading()
            }).then(result => {
                if (result.value) {
                    this.getResultCategories();

                    this.$swal({
                        title: "Categoria alterada com sucesso!",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        },
        // Deletando Categorias
        destroyCategorie(outputCategorie) {
            this.$swal({
                title: "Você tem Certeza?",
                html:
                    "Você irá deletar a Categoria <strong>" +
                    outputCategorie.name +
                    "</strong> permanentemente!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sim, Delete isso!",
                cancelButtonText: "Não, Mantê-la"
            }).then(result => {
                if (result.value) {
                    axios
                        .get("categorieDestroy/" + outputCategorie.id)
                        .then(response => {
                            this.getResultCategories();
                            this.$swal({
                                title: "Deletado!",
                                html:
                                    "<strong>" +
                                    outputCategorie.name +
                                    "</strong> Deletado com sucesso.",
                                icon: "success"
                            });
                        });
                }
            });
        },
        // Apagando categorias em massa
        trashCategorie() {
            this.$swal({
                title: "Você tem Certeza?",
                html:
                    "Você irá apagar " +
                    this.trashAll.length +
                    " Categorias permanentemente!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sim, Delete isso!",
                cancelButtonText: "Não, Mantê-la"
            }).then(result => {
                if (result.value) {
                    axios
                        .get("categorieDestroy/" + this.trashAll)
                        .then(response => {
                            this.trashAll = [];
                            this.trash = false;
                            this.getResultCategories();

                            this.$swal({
                                title: "Deletado!",
                                html:
                                    this.trashAll.lenght +
                                    " Categorias apagados com sucesso.",
                                icon: "success"
                            });
                        });
                }
            });
        },
        // Sub Categorias
        addSubCategorie(outputCategorie) {
            this.$swal({
                title: "Nome da Categoria",
                input: "text",
                showCancelButton: true,
                confirmButtonText: "Salvar",
                cancelButtonText: "Cancelar",
                showLoaderOnConfirm: true,
                preConfirm: save => {
                    if (save) {
                        return axios
                            .post("categorieStore", {
                                categorie_id: outputCategorie.id,
                                categorie: save
                            })
                            .then(response => {
                                return response.data.status;
                            });
                    } else {
                        this.$swal.showValidationMessage(
                            "Campo categoria não pode estar vazio"
                        );
                    }
                },
                allowOutsideClick: () => !this.$swal.isLoading()
            }).then(result => {
                if (result.value == 200) {
                    this.getResultCategories();

                    this.$swal({
                        title: "Categoria registrada com successo",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }

                if (result.value == 201) {
                    this.$swal({
                        title:
                            "Maximo 15 Categorias podem estar registradas na principal.",
                        icon: "error",
                        showConfirmButton: true
                    });
                }
            });
        }
    },
    filters: {}
};
</script>
