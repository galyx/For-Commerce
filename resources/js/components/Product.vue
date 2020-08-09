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
                <div class="modal-content bg-secondary">
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
                                        v-model="codigo"
                                    />
                                </div>
                                <div class="form-group col-8">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Nome do Produto"
                                        v-model="Product_name"
                                    />
                                </div>

                                <div class="form-group col-12 col-md-9">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Pequena Discrição do Produto"
                                        v-model="short_description"
                                    />
                                </div>
                                <div class="form-group col-12 col-md-3">
                                    <div class="dropdown">
                                        <button
                                            type="button"
                                            id="drop_venda"
                                            class="btn btn-default dropdown-toggle"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                            style="width: 100%;"
                                        >
                                            -
                                            <span v-if="type_sale == 'PC'"
                                                >Peça</span
                                            >
                                            <span v-else-if="type_sale == 'CX'"
                                                >Caixa</span
                                            >
                                            <span v-else-if="type_sale == 'MT'"
                                                >Metragem</span
                                            >
                                            <span v-else>Venda</span> -
                                        </button>

                                        <div
                                            class="dropdown-menu"
                                            aria-labelledby="drop_venda"
                                        >
                                            <button
                                                class="dropdown-item select-custom"
                                                type="button"
                                                v-on:click="type_sale = 'PC'"
                                            >
                                                Peça
                                            </button>
                                            <button
                                                class="dropdown-item select-custom"
                                                type="button"
                                                v-on:click="type_sale = 'CX'"
                                            >
                                                Caixa
                                            </button>
                                            <button
                                                class="dropdown-item select-custom"
                                                type="button"
                                                v-on:click="type_sale = 'MT'"
                                            >
                                                Metragem
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-6 col-md-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Marca do Produto"
                                        v-model="brand"
                                    />
                                </div>
                                <div class="form-group col-6 col-md-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Familia do Produto"
                                        v-model="group"
                                    />
                                </div>
                                <div class="form-group col-6 col-md-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Preço"
                                        v-model="price"
                                    />
                                </div>

                                <div class="form-group col-6 col-md-2">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Largura"
                                        v-model="width"
                                    />
                                </div>
                                <div class="form-group col-6 col-md-2">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Altura"
                                        v-model="height"
                                    />
                                </div>
                                <div class="form-group col-6 col-md-2">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Diametro"
                                        v-model="diameter"
                                    />
                                </div>
                                <div class="form-group col-6 col-md-2">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Peso"
                                        v-model="weight"
                                    />
                                </div>
                                <div class="form-group col-12 col-md-4">
                                    <div class="form-check-toggle d-flex">
                                        <div class="toggle">
                                            <input
                                                type="checkbox"
                                                id="free_shipping"
                                                v-model="free_shipping"
                                            />
                                            <label for="free_shipping"></label>
                                        </div>
                                        <label class="form-check-label">
                                            Frete Gratis?
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Categorias -->
                            <div class="form-row">
                                <div class="form-group col-12 col-lg-6">
                                    <h4>Categorias</h4>
                                    <div class="categorie-box">
                                        <div
                                            class="categorie-label d-flex justify-content-between"
                                            v-for="categorie in categories"
                                            :key="categorie.id"
                                        >
                                            <span class="my-auto">{{
                                                categorie.name
                                            }}</span>
                                            <div class="view">
                                                {{
                                                    categorie
                                                        .children_categories
                                                        .length
                                                }}
                                            </div>
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-primary"
                                                v-on:click="
                                                    addCategorie(categorie)
                                                "
                                            >
                                                Adicionar
                                                <i
                                                    class="fa fa-chevron-right"
                                                ></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12 col-lg-6">
                                    <h4>Categorias Adicionadas</h4>
                                    <div class="categorie-box">
                                        <div
                                            class="categorie-label d-flex justify-content-between"
                                            v-for="mainCategorie in mainCategories"
                                            :key="mainCategorie.id"
                                        >
                                            <span class="my-auto">{{
                                                mainCategorie.name
                                            }}</span
                                            ><button
                                                type="button"
                                                class="btn btn-sm btn-danger"
                                                v-on:click="
                                                    removeCategorie(
                                                        mainCategorie
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

                            <!-- Imagens -->
                            <div class="form-row">
                                <div class="form-group col-12 col-lg-6">
                                    <h4>Imagens</h4>
                                    <div class="image-box">
                                        <div
                                            class="image-label d-flex justify-content-between"
                                            v-for="image in images"
                                            :key="image.id"
                                        >
                                            <div
                                                class="preview-card-image text-center"
                                            >
                                                <div
                                                    class="preview-card-body-image"
                                                >
                                                    <img
                                                        :src="image.path"
                                                        alt="Imagem"
                                                    />
                                                </div>
                                            </div>

                                            <div class="my-auto">
                                                <div
                                                    class="text-center preview-card-titulo text-truncate"
                                                >
                                                    <a
                                                        target="_blank"
                                                        :href="image.path"
                                                        ><i
                                                            class="fa fa-eye"
                                                        ></i
                                                    ></a>
                                                    {{ image.image_name }}
                                                </div>

                                                <div
                                                    class="d-flex justify-content-between preview-card-titulo"
                                                >
                                                    <span>{{
                                                        image.extension
                                                    }}</span>
                                                    <span>{{
                                                        image.size
                                                    }}</span>
                                                    <span
                                                        >{{ image.wxh[0] }}
                                                        x
                                                        {{
                                                            image.wxh[1]
                                                        }}</span
                                                    >
                                                </div>
                                            </div>

                                            <div class="my-auto">
                                                <button
                                                    type="button"
                                                    class="btn btn-sm btn-primary m-2"
                                                    v-on:click="addImage(image)"
                                                >
                                                    Adicionar
                                                    <i
                                                        class="fa fa-chevron-right"
                                                    ></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12 col-lg-6">
                                    <h4>Imagens Adicionadas</h4>
                                    <div class="image-box">
                                        <div
                                            class="image-label d-flex justify-content-between"
                                            v-for="mainImage in mainImages"
                                            :key="mainImage.id"
                                        >
                                            <div
                                                class="preview-card-image text-center"
                                            >
                                                <div
                                                    class="preview-card-body-image"
                                                >
                                                    <img
                                                        :src="mainImage.path"
                                                        alt="Imagem"
                                                    />
                                                </div>
                                            </div>

                                            <div class="my-auto">
                                                <div
                                                    class="text-center preview-card-titulo text-truncate"
                                                >
                                                    <a
                                                        target="_blank"
                                                        :href="mainImage.path"
                                                        ><i
                                                            class="fa fa-eye"
                                                        ></i
                                                    ></a>
                                                    {{ mainImage.image_name }}
                                                </div>

                                                <div
                                                    class="d-flex justify-content-between preview-card-titulo"
                                                >
                                                    <span>{{
                                                        mainImage.extension
                                                    }}</span>
                                                    <span>{{
                                                        mainImage.size
                                                    }}</span>
                                                    <span
                                                        >{{ mainImage.wxh[0] }}
                                                        x
                                                        {{
                                                            mainImage.wxh[1]
                                                        }}</span
                                                    >
                                                </div>
                                            </div>

                                            <div class="my-auto">
                                                <button
                                                    type="button"
                                                    class="btn btn-sm btn-danger m-2"
                                                    v-on:click="
                                                    removeImage(
                                                        mainImage
                                                    )
                                                "
                                                >
                                                    Remover
                                                    <i
                                                        class="fa fa-times"
                                                    ></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Descrição do Produto -->
                            <vue-editor v-model="description"></vue-editor>
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
            group: "",
            type_sale: "",
            price: "",
            brand: "",
            width: "",
            height: "",
            diameter: "",
            weight: "",
            free_shipping: false,
            description: "",
            status: false,
            mainCategories: [],
            mainImages: [],
            categories: {},
            images: {},
            disabled: 0
        };
    },
    created() {
        this.getResultCategories();
        this.getImages();
    },
    methods: {
        getResultCategories(categorie = null) {
            const categorie_id =
                categorie !== null
                    ? "categorieIndex/" + categorie.id
                    : "categorieIndex";

            axios.get(categorie_id).then(response => {
                this.categories = response.data.categories;
            });
        },
        addCategorie(categorie) {
            this.categories = {};
            this.mainCategories.push(categorie);
            this.getResultCategories(categorie);
        },
        removeCategorie(categorie) {
            this.mainCategories.splice(this.mainCategories.indexOf(categorie));
            const categorie_id =
                categorie.categorie_id !== null
                    ? "categorieIndex/" + categorie.categorie_id
                    : "categorieIndex";

            axios.get(categorie_id).then(response => {
                this.categories = response.data.categories;
            });
        },
        getImages() {
            axios.get("../imageIndex").then(result => {
                this.images = result.data;
            });
        },
        addImage(image) {
            this.images.splice(this.images.indexOf(image),1);
            this.mainImages.push(image);
        },
        removeImage(mainImage) {
            this.mainImages.splice(this.mainImages.indexOf(mainImage),1);
            this.images.push(mainImage);
        }
    },
    filters: {}
};
</script>
