<template>
    <section>
        <!-- Produtos -->
        <div class="card">
            <div class="card-header">
                <button
                    type="button"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#modalProducts"
                >
                    <i class="fa fa-plus"></i> Novo Produto
                </button>
            </div>
            <div class="card-body"></div>
        </div>

        <!-- Modal de Novo Registro -->
        <div
            class="modal fade"
            id="modalProducts"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modalProductsLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <form method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalProductsLabel">
                                Novo Produto
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
                                <div class="form-group col-4">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Codigo do Produto"
                                    />
                                </div>
                                <div class="form-group col-8">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Nome do Produto"
                                    />
                                </div>

                                <div class="form-group col-12 col-md-9">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Pequena Discrição do Produto"
                                    />
                                </div>
                                <div class="form-group col-12 col-md-3">
                                    <select class="form-control">
                                        <option value=""> - Venda - </option>
                                        <option value="PC">Peça</option>
                                        <option value="CX">Caixa</option>
                                        <option value="M">Metragem</option>
                                    </select>
                                </div>

                                <div class="form-group col-6 col-md-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Marca do Produto"
                                    />
                                </div>
                                <div class="form-group col-6 col-md-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Estoque"
                                    />
                                </div>

                                <div class="form-group col-6 col-md-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Preço"
                                    />
                                </div>
                                <div class="form-group col-6 col-md-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Preço Promocional"
                                    />
                                </div>

                                <div class="form-group col-4">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Marca do Produto"
                                    />
                                </div>
                                <div class="form-group col-8">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Estoque"
                                    />
                                </div>

                                <div class="form-group col-6 col-md-2">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Largura"
                                    />
                                </div>
                                <div class="form-group col-6 col-md-2">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Altura"
                                    />
                                </div>
                                <div class="form-group col-6 col-md-2">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Diametro"
                                    />
                                </div>
                                <div class="form-group col-6 col-md-2">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Peso"
                                    />
                                </div>
                                <div class="form-group col-12 col-md-2">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                        />
                                        <label class="form-check-label">
                                            Frete Gratis?
                                        </label>
                                    </div>
                                </div>

                                <div class="box-categorie">
                                    
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
                                Registrar Produto
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
            codigo: "",
            Product_name: "",
            short_description: "",
            category: "",
            type_sale: "",
            price: "",
            promotional_price: "",
            brand: "",
            width: "",
            height: "",
            diameter: "",
            free_shipping: "",
            stock: "",
            product_image: "",
            description: "",
            outputCategories: {},
            disabled: 0
        };
    },
    created() {
        this.getResultCategories();
    },
    methods: {
        getResultCategories(outputCategorie = null) {
            this.categorie = outputCategorie !== null ? outputCategorie : "";
            const categorie_id =
                outputCategorie !== null
                    ? "categorieIndex/" + outputCategorie.id
                    : "categorieIndex";

            axios.get(categorie_id).then(response => {
                this.outputCategories = response.data.categories;

                $(function() {
                    $('[data-tooltip="tooltip"]').tooltip();
                });
            });
        }
    },
    filters: {}
};
</script>
