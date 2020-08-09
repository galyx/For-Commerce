<template>
    <section>
        <!-- Categorias -->
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between">
                    <div v-if="!categorie" class="col-4">
                        <button
                            type="button"
                            class="btn btn-primary"
                            v-on:click="addCategorie"
                        >
                            <i class="fa fa-plus"></i> Nova Categoria Principal
                        </button>
                    </div>
                    <div v-if="categorie" class="col-4">
                        <h3>Categoria: {{ categorie.name | uppercase }}</h3>
                        <span v-if="nivel != 0">Nivel: {{nivel}} <span v-if="nivel == 5">Maximo</span></span>
                    </div>
                    <div class="col-4">
                        <button
                            type="button"
                            class="btn btn-danger"
                            v-on:click="trashCategorie"
                            v-if="trashAll.length >= 1"
                        >
                            <i class="fa fa-trash"></i> Apagar Selecionados
                        </button>
                    </div>
                    <div v-if="categorie" class="col-4">
                        <button
                            type="button"
                            class="btn btn-info"
                            v-on:click="returnCategorie(categorie), maxNivel('-')"
                        >
                            <i class="fa fa-arrow-left"></i> Voltar
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
                                            :disabled="nivel == 5"
                                            v-on:click="
                                                addSubCategorie(outputCategorie)
                                            "
                                        >
                                            <i class="fa fa-plus"></i>
                                            Nova Sub Categoria
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-secondary"
                                            :disabled="nivel == 5"
                                            v-on:click="
                                                getResultCategories(
                                                    outputCategorie
                                                ), maxNivel('+')
                                            "
                                        >
                                            <i class="fa fa-eye"></i>
                                            {{
                                                outputCategorie
                                                    .children_categories.length
                                            }}
                                            Sub Categorias
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
            outputCategories: {},
            categorie: {},
            nivel: 0,
            disabled: 0
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
        getResultCategories(outputCategorie = null) {
            this.categorie = outputCategorie !== null ? outputCategorie : "";
            const categorie_id =
                outputCategorie !== null
                    ? "categorieIndex/" + outputCategorie.id
                    : "categorieIndex";

            axios.get(categorie_id).then(response => {
                // Busca as categorias
                this.outputCategories = response.data.categories;

                $(function() {
                    $('[data-tooltip="tooltip"]').tooltip();
                });
            });
        },
        returnCategorie(categorie = null) {
            if (categorie !== null) {
                axios
                    .get("categorieIndex/" + categorie.categorie_id)

                    .then(response => {
                        if (categorie.categorie_id !== null) {
                            this.outputCategories = response.data.categories;
                            this.categorie = response.data.categorie[0];
                        } else {
                            this.categorie = "";
                            this.getResultCategories();
                        }

                        $(function() {
                            $('[data-tooltip="tooltip"]').tooltip();
                        });
                    });
            }
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
                            "Maximo 10 Categorias podem estar registradas como principais.",
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
                    const categorie_id =
                        this.categorie !== ""
                            ? "categorieIndex/" + this.categorie.id
                            : "categorieIndex";

                    axios.get(categorie_id).then(response => {
                        this.outputCategories = response.data.categories;
                    });

                    this.$swal({
                        title: "Categoria registrada com successo",
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
                    const categorie_id =
                        this.categorie !== ""
                            ? "categorieIndex/" + this.categorie.id
                            : "categorieIndex";

                    axios.get(categorie_id).then(response => {
                        this.outputCategories = response.data.categories;
                    });

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
                            "Maximo 15 Categorias podem estar registradas.",
                        icon: "error",
                        showConfirmButton: true
                    });
                }
            });
        },
        maxNivel(valor){
            if(valor == '+') {this.nivel += 1;}

            if(valor == '-') {this.nivel -= 1;}
        }
    },
    filters: {
        uppercase: function(value) {
            if (!value) return "";
            return value.charAt(0).toUpperCase() + value.slice(1);
        }
    }
};
</script>
