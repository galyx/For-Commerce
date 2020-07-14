<template>
    <!-- Dados do Perfil -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Dados do perfil</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Nome:</td>
                            <th>{{ auth.name }}</th>
                            <td>
                                <button
                                    type="button"
                                    class="btn btn-primary"
                                    v-on:click="name(auth)"
                                >
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <th>{{ auth.email }}</th>
                            <td>
                                <button
                                    type="button"
                                    class="btn btn-primary"
                                    v-on:click="email(auth)"
                                >
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Senha</td>
                            <th>********</th>
                            <td>
                                <button
                                    type="button"
                                    class="btn btn-primary"
                                    v-on:click="password(auth)"
                                >
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {},
    data() {
        return {
            auth: {}
        };
    },
    created() {
        this.getAuth();
    },
    methods: {
        getAuth() {
            axios.get("adminIndex").then(response => {
                this.auth = response.data.auth;
            });
        },
        name(auth) {
            this.$swal({
                title: "Editar Nome",
                input: "text",
                inputValue: auth.name,
                showCancelButton: true,
                confirmButtonText: "Salvar",
                cancelButtonText: "Cancelar",
                showLoaderOnConfirm: true,
                preConfirm: save => {
                    if (save) {
                        return axios
                            .post("perfilUpdate", {
                                id: auth.id,
                                name: save
                            })
                            .then(response => {
                                return response;
                            })
                            .catch(error => {
                                this.$swal.showValidationMessage(
                                    error.response.data.errors.name
                                );
                            });
                    } else {
                        this.$swal.showValidationMessage(
                            "Campo nome não pode estar vazio"
                        );
                    }
                },
                allowOutsideClick: () => !this.$swal.isLoading()
            }).then(result => {
                if (result.value) {
                    this.getAuth();

                    this.$swal({
                        title: "Nome alterada com sucesso!",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        },
        email(auth) {
            this.$swal({
                title: "Editar Email",
                input: "text",
                inputValue: auth.email,
                showCancelButton: true,
                confirmButtonText: "Salvar",
                cancelButtonText: "Cancelar",
                showLoaderOnConfirm: true,
                preConfirm: save => {
                    if (save) {
                        return axios
                            .post("perfilUpdate", {
                                id: auth.id,
                                email: save
                            })
                            .then(response => {
                                return response;
                            })
                            .catch(error => {
                                this.$swal.showValidationMessage(
                                    error.response.data.errors.email
                                );
                            });
                    } else {
                        this.$swal.showValidationMessage(
                            "Campo email não pode estar vazio"
                        );
                    }
                },
                allowOutsideClick: () => !this.$swal.isLoading()
            }).then(result => {
                if (result.value) {
                    this.getAuth();

                    this.$swal({
                        title: "Nome alterada com sucesso!",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        },
        password(auth) {
            this.$swal
                .mixin({
                    input: "password",
                    confirmButtonText: "Proximo &rarr;",
                    showCancelButton: true,
                    progressSteps: ["1", "2", "3"]
                })
                .queue(["Senha antiga", "Nova senha", "Confirme a senha"])
                .then(result => {
                    if (result.value) {
                        axios
                            .post("perfilUpdate", {
                                id: auth.id,
                                current_password: result.value[0],
                                password: result.value[1],
                                password_confirmation: result.value[2]
                            })
                            .then(response => {
                                if (response.data.status == 200) {
                                    this.getAuth();

                                    this.$swal({
                                        title: "Senha Alterada com sucesso!",
                                        icon: "success",
                                        showConfirmButton: true
                                    });
                                }

                                if (response.data.status == 500) {
                                    this.$swal({
                                        title: "Senha Antiga invalida!",
                                        icon: "error",
                                        showConfirmButton: true
                                    });
                                }
                            })
                            .catch(error => {
                                if (error.response.data.errors.password) {
                                    this.$swal({
                                        title:
                                            error.response.data.errors.password,
                                        icon: "error",
                                        showConfirmButton: true
                                    });
                                }
                            });
                    }
                });
        }
    },
    filters: {}
};
</script>
