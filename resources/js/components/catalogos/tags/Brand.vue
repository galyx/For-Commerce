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
                            v-on:click="addBrands"
                        >
                            <i class="fa fa-plus"></i> Novo Marca
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
                                <th>Nome da Marca</th>
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
                                            v-on:click="editBrand(output)"
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
                .get("brandIndex?page=" + page)
                .then(response => {
                    return response.json();
                })
                .then(data => {
                    // Paginas do admin
                    this.pages = data.brandPage;
                    // Separado por pagina
                    this.outputs = data.brandPage.data;
                    // Total para buscar por filtro
                    this.outputs2 = data.brandTotal;

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
        addBrands() {
            this.$swal({
                title: "Nome da Marca",
                input: "text",
                showCancelButton: true,
                confirmButtonText: "Salvar",
                cancelButtonText: "Cancelar",
                showLoaderOnConfirm: true,
                preConfirm: save => {
                    if (save) {
                        return axios
                            .post("brandStore", {
                                name: save
                            })
                            .then(response => {
                                return response.data.status;
                            });
                    } else {
                        this.$swal.showValidationMessage(
                            "Campo Marca não pode estar vazio"
                        );
                    }
                },
                allowOutsideClick: () => !this.$swal.isLoading()
            }).then(result => {
                if (result.value == 200) {
                    this.getResults();

                    this.$swal({
                        title: "Marca registrada com successo",
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
                    "Você irá deletar a marca <strong>" +
                    output.name +
                    "</strong> permanentemente!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sim, Delete isso!",
                cancelButtonText: "Não, Mantê-la"
            }).then(result => {
                if (result.value) {
                    axios.get("brandDestroy/" + output.id).then(response => {
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
        editBrand(output) {
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
                            .post("brandUpdate", {
                                id: output.id,
                                name: save
                            })
                            .then(response => {
                                return response;
                            });
                    } else {
                        this.$swal.showValidationMessage(
                            "Campo marca não pode estar vazio"
                        );
                    }
                },
                allowOutsideClick: () => !this.$swal.isLoading()
            }).then(result => {
                if (result.value) {
                    this.getResults();

                    this.$swal({
                        title: "Marca registrada com successo",
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
