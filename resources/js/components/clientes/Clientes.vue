<template>
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-4">
                    <h3 class="card-title">Dados dos clientes</h3>
                </div>

                <div class="form-group col-4">
                    <input
                        type="search"
                        class="form-control"
                        v-model="searchIn"
                        v-on:keyup="search"
                        placeholder="Busca por Nome, Email ou CPF"
                    />
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Data de Nascimento</th>
                            <th>CPF</th>
                            <th>Celular</th>
                            <th>Telefone</th>
                            <th>Data do Registro</th>
                            <th>Data de Alteração</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="output in outputs" :key="output.id">
                            <td>{{ output.name }}</td>
                            <td>{{ output.email }}</td>
                            <td>{{ output.birth | formatDate }}</td>
                            <td>{{ output.cpf }}</td>
                            <td>{{ output.cel }}</td>
                            <td>{{ output.fone }}</td>
                            <td>{{ output.created_at | formatDate }}</td>
                            <td>{{ output.updated_at | formatDate }}</td>
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
                                        title="Visualizar Endereço"
                                        v-on:click="modalAdress(output)"
                                    >
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <pagination
            v-if="!searchIn"
            :data="pages"
            @pagination-change-page="getCustomers"
        ></pagination>

        <!-- Modal de Endereços -->
        <div
            class="modal fade"
            id="modalAdress"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modalAdressLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAdressLabel">
                            Endereços
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
                        <div
                            class="col-12"
                            v-for="address in addresses"
                            :key="address.id"
                        >
                            <h3 class="mb-3">Endereço</h3>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    Cep: {{ address.cep }}
                                </li>
                                <li class="list-group-item">
                                    Cidade: {{ address.cidade }} - UF:
                                    {{ address.uf }}
                                </li>
                                <li class="list-group-item">
                                    Bairro: {{ address.bairro }}
                                </li>
                                <li class="list-group-item">
                                    {{ address.rua }} - Nº {{ address.numero }}
                                </li>
                                <li class="list-group-item">
                                    Complemento: {{ address.complemento }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Fechar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {},
    data() {
        return {
            outputs: "",
            outputs2: {},
            addresses: "",
            pages: {},
            searchIn: ""
        };
    },
    created() {
        this.getCustomers();
    },
    methods: {
        getCustomers(page) {
            if (typeof page === "undefined") {
                page = 1;
            }
            this.$http
                .get("clienteIndex?page=" + page)
                .then(response => {
                    return response.json();
                })
                .then(data => {
                    // Paginas
                    this.pages = data;
                    // Separado por pagina
                    this.outputs = data.data;
                    // Total de busca por filtro
                    this.outputs2 = data.data;

                    $(function() {
                        $('[data-tooltip="tooltip"]').tooltip();
                    });
                });
        },
        search() {
            if (this.searchIn) {
                this.outputs = this.outputs2.filter(item => {
                    if(item.cpf !== null){
                        return (
                            item.name
                                .toLowerCase()
                                .startsWith(this.searchIn.toLowerCase()) ||
                            item.email
                                .toLowerCase()
                                .startsWith(this.searchIn.toLowerCase()) ||
                            item.cpf.replaceAll(/[\.\-]/g,'').startsWith(this.searchIn.replaceAll(/[\.\-]/g,''))
                        );
                    }else{
                        return (
                            item.name
                                .toLowerCase()
                                .startsWith(this.searchIn.toLowerCase()) ||
                            item.email
                                .toLowerCase()
                                .startsWith(this.searchIn.toLowerCase())
                        );
                    }
                    
                });
            } else {
                this.getCustomers();
            }
        },
        modalAdress(output) {
            $("#modalAdress").modal("show");

            this.addresses = output.addresses;
        }
    },
    filters: {}
};
</script>
