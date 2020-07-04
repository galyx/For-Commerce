<template>
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-4">
                    <button
                        type="button"
                        class="btn btn-primary"
                        data-toggle="modal"
                        data-target="#modalAdmins"
                    >
                        <i class="fa fa-plus"></i> Adicionar Administrador
                    </button>
                </div>

                <div class="form-group col-4">
                    <input
                        type="search"
                        class="form-control"
                        v-model="searchIn"
                        v-on:keyup="search"
                        placeholder="Busca por Nome ou Email"
                    />
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="admin_list" class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Autorização</th>
                            <th>Criado em</th>
                            <th>Alterado em</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="output in outputs" :key="output.id">
                            <td v-if="output.id !== auth.id">
                                {{ output.id }}
                            </td>
                            <td v-if="output.id !== auth.id">
                                {{ output.name }}
                            </td>
                            <td v-if="output.id !== auth.id">
                                {{ output.email }}
                            </td>
                            <td v-if="output.id !== auth.id">
                                {{ output.status | authorization }}
                            </td>
                            <td v-if="output.id !== auth.id">
                                {{ output.created_at | formatDate }}
                            </td>
                            <td v-if="output.id !== auth.id">
                                {{ output.updated_at | formatDate }}
                            </td>
                            <td v-if="output.id !== auth.id">
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
                                        title="Editar Administrador"
                                        v-on:click="modalAdminEdit(output)"
                                    >
                                        <i class="fa fa-user-edit"></i>
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-warning"
                                        v-on:click="editPassword(output)"
                                        data-tooltip="tooltip"
                                        data-placement="top"
                                        title="Alterar Senha"
                                    >
                                        <i class="fa fa-user-lock"></i>
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-danger"
                                        v-on:click="destroy(output)"
                                        data-tooltip="tooltip"
                                        data-placement="top"
                                        title="Deletar Administrador"
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

        <!-- Modal de Novo Registro -->
        <div
            class="modal fade"
            id="modalAdmins"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modalAdminsLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form @submit="addAdmin" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAdminsLabel">
                                Adicionar Administrador
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
                            <div class="form-row justify-content-center">
                                <div class="form-group col-12 col-md-8">
                                    <div class="input-group">
                                        <input
                                            type="text"
                                            v-model="name"
                                            v-bind:class="{
                                                'is-invalid': errors.name
                                            }"
                                            :disabled="disabled == 1"
                                            class="form-control"
                                            placeholder="Nome Completo"
                                        />
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span
                                                    class="fas fa-user"
                                                ></span>
                                            </div>
                                        </div>

                                        <div
                                            class="invalid-feedback"
                                            v-if="errors.name"
                                        >
                                            <strong>{{
                                                errors.name[0]
                                            }}</strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-12 col-md-8">
                                    <div class="input-group">
                                        <input
                                            type="email"
                                            v-model="email"
                                            v-bind:class="{
                                                'is-invalid': errors.email
                                            }"
                                            :disabled="disabled == 1"
                                            class="form-control"
                                            placeholder="Email"
                                        />
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span
                                                    class="fas fa-envelope"
                                                ></span>
                                            </div>
                                        </div>

                                        <div
                                            class="invalid-feedback"
                                            v-if="errors.email"
                                        >
                                            <strong>{{
                                                errors.email[0]
                                            }}</strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-12 col-md-8">
                                    <div class="input-group">
                                        <input
                                            type="password"
                                            v-model="password"
                                            v-bind:class="{
                                                'is-invalid': errors.password
                                            }"
                                            :disabled="disabled == 1"
                                            class="form-control"
                                            placeholder="Senha"
                                        />
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span
                                                    class="fas fa-user-lock"
                                                ></span>
                                            </div>
                                        </div>

                                        <div
                                            class="invalid-feedback"
                                            v-if="errors.password"
                                        >
                                            <strong>{{
                                                errors.password[0]
                                            }}</strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-12 col-md-8">
                                    <div class="input-group">
                                        <input
                                            type="password"
                                            v-model="password_confirmation"
                                            :disabled="disabled == 1"
                                            class="form-control"
                                            placeholder="Repita a Senha"
                                        />
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span
                                                    class="fas fa-user-lock"
                                                ></span>
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
                                <span class="fa fa-user-plus"></span> Registrar
                                Admin
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal de Alteração de Dados -->
        <div
            class="modal fade"
            id="modalAdminEdit"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modalAdminEditLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form @submit="editAdmin" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAdminEditLabel">
                                Editar <strong>{{ nameEdit }}</strong>
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
                            <div class="form-row justify-content-center">
                                <div class="form-group col-12 col-md-8">
                                    <div class="input-group">
                                        <input
                                            type="text"
                                            v-model="nameEdit"
                                            v-bind:class="{
                                                'is-invalid': editErrors.name
                                            }"
                                            :disabled="disabled == 1"
                                            class="form-control"
                                            placeholder="Nome Completo"
                                        />
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span
                                                    class="fas fa-user"
                                                ></span>
                                            </div>
                                        </div>

                                        <div
                                            class="invalid-feedback"
                                            v-if="editErrors.name"
                                        >
                                            <strong>{{
                                                editErrors.name[0]
                                            }}</strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-12 col-md-8">
                                    <div class="input-group">
                                        <input
                                            type="email"
                                            v-model="emailEdit"
                                            v-bind:class="{
                                                'is-invalid': editErrors.email
                                            }"
                                            :disabled="disabled == 1"
                                            class="form-control"
                                            placeholder="Email"
                                        />
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span
                                                    class="fas fa-envelope"
                                                ></span>
                                            </div>
                                        </div>

                                        <div
                                            class="invalid-feedback"
                                            v-if="editErrors.email"
                                        >
                                            <strong>{{
                                                editErrors.email[0]
                                            }}</strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-12 col-md-8">
                                    <div class="input-group">
                                        <select
                                            class="form-control"
                                            v-model="statusEdit"
                                            :disabled="disabled == 1"
                                        >
                                            <option value="0">Inativo</option>
                                            <option value="2">Suporte</option>
                                            <option value="4">Vendedor</option>
                                            <option value="6"
                                                >Financeiro</option
                                            >
                                            <option value="10"
                                                >Administrador</option
                                            >
                                        </select>

                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span
                                                    class="fas fa-address-card"
                                                ></span>
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
                                <span class="fa fa-user-edit"></span> Salvar
                                Alterações
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        axios.get("adminIndex").then(response => {
            this.auth = response.data.auth;
        });
    },
    data() {
        return {
            name: "",
            email: "",
            password: "",
            password_confirmation: "",
            idEdit: "",
            nameEdit: "",
            emailEdit: "",
            statusEdit: "",
            auth: "",
            pages: {},
            outputs: {},
            outputs2: {},
            searchIn: "",
            errors: "",
            editErrors: "",
            disabled: 0
        };
    },
    created() {
        this.getResults();
    },
    methods: {
        // Retorno paginado
        getResults(page) {
            if (typeof page === "undefined") {
                page = 1;
            }
            this.$http
                .get("adminIndex?page=" + page)
                .then(response => {
                    return response.json();
                })
                .then(data => {
                    // Paginas do admin
                    this.pages = data.adminPage;
                    // Separado por pagina
                    this.outputs = data.adminPage.data;
                    // Total para buscar por filtro
                    this.outputs2 = data.adminTotal;

                    $(function() {
                        $('[data-tooltip="tooltip"]').tooltip();
                    });
                });
        },
        // Busca filtrada
        search() {
            if (this.searchIn) {
                this.outputs = this.outputs2.filter(item => {
                    return (
                        item.name
                            .toLowerCase()
                            .startsWith(this.searchIn.toLowerCase()) ||
                        item.email
                            .toLowerCase()
                            .startsWith(this.searchIn.toLowerCase())
                    );
                });
            } else {
                this.getResults();
            }
        },
        // cadastro de admins
        addAdmin(e) {
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
                .post("adminStore", {
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
        },
        // Deletando admins
        destroy(output) {
            this.$swal({
                title: "Você tem Certeza?",
                html:
                    "Você irá deletar o <strong>" +
                    output.name +
                    "</strong> permanentemente!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sim, Delete isso!",
                cancelButtonText: "Não, Mantê-la"
            }).then(result => {
                if (result.value) {
                    axios.get("adminDestroy/" + output.id).then(response => {
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
        // Editando senha dos admins
        editPassword(output) {
            this.$swal({
                title: "Editar senha",
                html: "Alterar senha do <strong>" + output.name + "</strong>",
                input: "password",
                showCancelButton: true,
                confirmButtonText: "Salvar",
                cancelButtonText: "Cancelar",
                showLoaderOnConfirm: true,
                preConfirm: save => {
                    // console.log(save);

                    return axios
                        .post("adminPassword", {
                            id: output.id,
                            password: save
                        })
                        .then(response => {
                            return response;
                        })
                        .catch(error => {
                            this.$swal.showValidationMessage(
                                error.response.data.errors.password
                            );
                        });
                },
                allowOutsideClick: () => !this.$swal.isLoading()
            }).then(result => {
                if (result.value) {
                    this.$swal({
                        title: "Senha alterada com sucesso!",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        },
        // Modal de edição dos admins
        modalAdminEdit(output) {
            $("#modalAdminEdit").modal("show");
            this.idEdit = output.id;
            this.nameEdit = output.name;
            this.emailEdit = output.email;
            this.statusEdit = output.status;

            this.editErrors = "";
        },
        // Post para salvar alterações
        editAdmin(e) {
            e.preventDefault();
            this.disabled = 1;

            // Sweer para carregamento
            this.$swal({
                title: "Salvando Dados!",
                onBeforeOpen: () => {
                    this.$swal.showLoading();
                }
            });

            // Conexão
            axios
                .post("adminUpdate", {
                    id: this.idEdit,
                    name: this.nameEdit,
                    email: this.emailEdit,
                    status: this.statusEdit
                })
                .then(response => {
                    this.getResults();
                    // Alerta informando que foi salvo com sucesso
                    this.$swal({
                        title: "Administrador alterado com successo!",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });

                    $("#modalAdminEdit").modal("hide");

                    // Limpeza dos campos para novos cadastros
                    this.disabled = 0;
                    this.editErrors = "";
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
                    this.editErrors = error.response.data.errors;
                });
        }
    },
    filters: {
        // Filtro por autorização
        authorization(e) {
            if (e == 0) {
                return "Inativo";
            } else if (e == 2) {
                return "Suporte";
            } else if (e == 4) {
                return "Vendedor";
            } else if (e == 6) {
                return "Financeiro";
            } else if (e == 10) {
                return "Administrador";
            }
        }
    }
};
</script>
