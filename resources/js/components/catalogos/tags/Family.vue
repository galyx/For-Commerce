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
                            v-on:click="addFamily"
                        >
                            <i class="fa fa-plus"></i> Nova Família
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
                                <th>Nome da Família</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="output in outputs" :key="output.id">
                                <td>{{ output.name }}</td>
                                <td>
                                    <div
                                        class="btn-group"
                                        role="group"
                                        aria-label="Botões de ações"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-primary"
                                            v-on:click="editFamily(output)"
                                        >
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-danger"
                                            v-on:click="destroy(output)"
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
                .get("familyIndex?page=" + page)
                .then(response => {
                    return response.json();
                })
                .then(data => {
                    // Paginas do admin
                    this.pages = data.familyPage;
                    // Separado por pagina
                    this.outputs = data.familyPage.data;
                    // Total para buscar por filtro
                    this.outputs2 = data.familyTotal;

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
        addFamily() {
            this.$swal({
                title: "Nome da Família",
                input: "text",
                showCancelButton: true,
                confirmButtonText: "Salvar",
                cancelButtonText: "Cancelar",
                showLoaderOnConfirm: true,
                preConfirm: save => {
                    if (save) {
                        return axios
                            .post("familyStore", {
                                name: save
                            })
                            .then(response => {
                                return response.data.status;
                            });
                    } else {
                        this.$swal.showValidationMessage(
                            "Campo Família não pode estar vazio"
                        );
                    }
                },
                allowOutsideClick: () => !this.$swal.isLoading()
            }).then(result => {
                if (result.value == 200) {
                    this.getResults();

                    this.$swal({
                        title: "Família registrada com successo",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        },
        destroy(output) {
            this.$swal({
                title: "Você tem Certeza?",
                html:
                    "Você irá deletar a família <strong>" +
                    output.name +
                    "</strong> permanentemente!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sim, Delete isso!",
                cancelButtonText: "Não, Mantê-la"
            }).then(result => {
                if (result.value) {
                    axios.get("familyDestroy/" + output.id).then(response => {
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
        editFamily(output) {
            this.$swal({
                title: "Nome da Marca",
                input: "text",
                inputValue: output.name,
                showCancelButton: true,
                confirmButtonText: "Salvar",
                cancelButtonText: "Cancelar",
                showLoaderOnConfirm: true,
                preConfirm: save => {
                    if (save) {
                        return axios
                            .post("familyUpdate", {
                                id: output.id,
                                name: save
                            })
                            .then(response => {
                                return response;
                            });
                    } else {
                        this.$swal.showValidationMessage(
                            "Campo Famíla não pode estar vazio"
                        );
                    }
                },
                allowOutsideClick: () => !this.$swal.isLoading()
            }).then(result => {
                if (result.value) {
                    this.getResults();

                    this.$swal({
                        title: "Família registrada com successo",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        }
    },
    filters: {}
};
</script>
