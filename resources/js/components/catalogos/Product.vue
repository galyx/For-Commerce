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
                    v-on:click="(type_save = 'SALVAR'), saveProduct()"
                >
                    <i class="fa fa-plus"></i> Novo Produto
                </button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header"></div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Imagem</th>
                                            <th>Produto</th>
                                            <th>Data</th>
                                            <th>Categoria</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="product in products"
                                            :key="product.id"
                                        >
                                            <td>{{ product.codigo }}</td>
                                            <td>
                                                <img
                                                    :src="
                                                        product.images[0].path
                                                            | rota
                                                    "
                                                    class="img-product"
                                                />
                                            </td>
                                            <td>{{ product.product_name }}</td>
                                            <td>
                                                {{
                                                    product.created_at
                                                        | formatDate
                                                }}
                                            </td>
                                            <td>
                                                {{ product.categories[0].name }}
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
                                                        title="Editar Produto"
                                                        data-toggle="modal"
                                                        data-target="#modalProducts"
                                                        v-on:click="
                                                            (type_save =
                                                                'ATUALIZAR'),
                                                                saveProduct(
                                                                    product
                                                                )
                                                        "
                                                    >
                                                        <i
                                                            class="fa fa-user-edit"
                                                        ></i>
                                                    </button>

                                                    <button
                                                        type="button"
                                                        class="btn btn-danger"
                                                        v-on:click="
                                                            destroy(product)
                                                        "
                                                        data-tooltip="tooltip"
                                                        data-placement="top"
                                                        title="Deletar Produto"
                                                    >
                                                        <i
                                                            class="fa fa-trash"
                                                        ></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <pagination
                                :data="pages"
                                @pagination-change-page="getProducts"
                            ></pagination>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
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

                    <form @submit="addProduct" method="post">
                        <div class="modal-body">

                            <div class="form-row">
                                <div class="form-group col-4">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Codigo do Produto"
                                        @input="codigo = formatNumber(codigo)"
                                        maxlength="8"
                                        v-model="codigo"
                                        v-bind:class="{
                                            'is-invalid': errors.codigo
                                        }"
                                    />
                                </div>
                                <div class="form-group col-8">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Nome do Produto"
                                        v-model="product_name"
                                        v-bind:class="{
                                            'is-invalid': errors.product_name
                                        }"
                                    />
                                </div>

                                <div class="form-group col-12 col-md-9">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Pequena Discrição do Produto"
                                        v-model="short_description"
                                        v-bind:class="{
                                            'is-invalid':
                                                errors.short_description
                                        }"
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
                                            v-bind:class="{
                                                'border-danger text-danger':
                                                    errors.type_sale
                                            }"
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
                                    <div class="dropdown">
                                        <button
                                            type="button"
                                            id="drop_brand"
                                            class="btn btn-default dropdown-toggle"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                            style="width: 100%;"
                                            v-bind:class="{
                                                'border-danger text-danger':
                                                    errors.brand
                                            }"
                                        >
                                            -
                                            <span v-if="brand">{{
                                                brand.name
                                            }}</span>
                                            <span v-else
                                                >Marcas do Produto</span
                                            >
                                            -
                                        </button>

                                        <div
                                            class="dropdown-menu"
                                            aria-labelledby="drop_brand"
                                        >
                                            <button
                                                class="dropdown-item select-custom"
                                                type="button"
                                                v-for="brandId in brands"
                                                :key="brandId.id"
                                                v-on:click="brand = brandId"
                                            >
                                                {{ brandId.name }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-6 col-md-3">
                                    <div class="dropdown">
                                        <button
                                            type="button"
                                            id="drop_family"
                                            class="btn btn-default dropdown-toggle"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                            style="width: 100%;"
                                            v-bind:class="{
                                                'border-danger text-danger':
                                                    errors.family
                                            }"
                                        >
                                            -
                                            <span v-if="family">{{
                                                family.name
                                            }}</span>
                                            <span v-else
                                                >Família do Produto</span
                                            >
                                            -
                                        </button>

                                        <div
                                            class="dropdown-menu"
                                            aria-labelledby="drop_family"
                                        >
                                            <button
                                                class="dropdown-item select-custom"
                                                type="button"
                                                v-for="familyId in families"
                                                :key="familyId.id"
                                                v-on:click="family = familyId"
                                            >
                                                {{ familyId.name }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="form-group col-6 col-md-3">
                                    <div class="dropdown">
                                        <button
                                            type="button"
                                            id="drop_colors"
                                            class="btn btn-default dropdown-toggle"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                            style="width: 100%;"
                                        >
                                            -
                                            <span v-if="colors">{{
                                                colors.name
                                            }}</span>
                                            <span v-else
                                                >Catalogo de Cores</span
                                            >
                                            -
                                        </button>

                                        <div
                                            class="dropdown-menu"
                                            aria-labelledby="drop_colors"
                                        >
                                            <button
                                                class="dropdown-item select-custom"
                                                type="button"
                                                v-for="colorId in catalogs" :key="colorId.id"
                                                v-on:click="colors = colorId"
                                            >
                                                {{colorId.name}}
                                            </button>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="form-group col-6 col-md-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Preço"
                                        @input="price = formatReal(price)"
                                        v-model="price"
                                        v-bind:class="{
                                            'is-invalid': errors.price
                                        }"
                                    />
                                </div>

                                <div class="form-group col-6 col-md-2">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Largura"
                                        @input="width = formatNumber(width)"
                                        maxlength="3"
                                        v-model="width"
                                        v-bind:class="{
                                            'is-invalid': errors.width
                                        }"
                                    />
                                </div>
                                <div class="form-group col-6 col-md-2">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Altura"
                                        @input="height = formatNumber(height)"
                                        maxlength="3"
                                        v-model="height"
                                        v-bind:class="{
                                            'is-invalid': errors.height
                                        }"
                                    />
                                </div>
                                <div class="form-group col-6 col-md-2">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Diametro"
                                        @input="
                                            diameter = formatNumber(diameter)
                                        "
                                        maxlength="3"
                                        v-model="diameter"
                                        v-bind:class="{
                                            'is-invalid': errors.diameter
                                        }"
                                    />
                                </div>
                                <div class="form-group col-6 col-md-2">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Peso"
                                        @input="weight = formatNumber(weight)"
                                        v-model="weight"
                                        v-bind:class="{
                                            'is-invalid': errors.weight
                                        }"
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
                                    <div
                                        class="categorie-box"
                                        v-bind:class="{
                                            'border border-danger':
                                                errors.mainCategories
                                        }"
                                    >
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
                                                        {{ image.wxh[1] }}</span
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
                                    <div
                                        class="image-box"
                                        v-bind:class="{
                                            'border border-danger':
                                                errors.mainCategories
                                        }"
                                    >
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
                                                        removeImage(mainImage)
                                                    "
                                                >
                                                    Remover
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Descrição do Produto -->
                            <div class="form-row">
                                <div class="form-group col-12 mt-2">
                                    <h4>Descrição Completa</h4>
                                    <vue-editor
                                        v-model="description"
                                    ></vue-editor>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button
                                    class="btn btn-primary"
                                    :disabled="disabled == 1"
                                >
                                    <span class="fa fa-save"></span>
                                    <span v-if="type_save == 'SALVAR'">Registrar Produto</span>
                                    <span v-if="type_save == 'ATUALIZAR'">Atualizar Produto</span>
                                </button>
                            </div>
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
            id_product: "",
            codigo: "",
            product_name: "",
            short_description: "",
            colors: null,
            family: "",
            type_sale: "",
            price: "",
            brand: "",
            width: "",
            height: "",
            diameter: "",
            weight: "",
            free_shipping: 0,
            description: "",
            status: false,
            mainCategories: [],
            mainImages: [],
            categories: {},
            images: {},
            brands: {},
            families: {},
            catalogs: {},
            errors: {},
            disabled: 0,
            products: [],
            pages: {},
            type_save: ""
        };
    },
    created() {
        this.getResultCategories();
        this.getImages();
        this.getBrands();
        this.getFamilies();
        // this.getCatalogs();
        this.getProducts();
    },
    methods: {
        formatReal(value) {
            var v = value + "";
            v = v.replace(/\D/g, "");
            v = v.replace(/(\d{2})$/g, ",$1");
            return v;
        },
        formatNumber(value) {
            var v = value + "";
            v = v.replace(/\D/g, "");
            return v;
        },
        getProducts(page) {
            if (typeof page === "undefined") {
                page = 1;
            }
            this.$http
                .get("productIndex?page=" + page)
                .then(response => {
                    return response.json();
                })
                .then(data => {
                    // Paginas do admin
                    this.pages = data;
                    // Separado por pagina
                    this.products = data.data;
                    // Total para buscar por filtro

                    $(function() {
                        $('[data-tooltip="tooltip"]').tooltip();
                    });
                });
        },
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
            this.images.splice(this.images.indexOf(image), 1);
            this.mainImages.push(image);
        },
        removeImage(mainImage) {
            this.mainImages.splice(this.mainImages.indexOf(mainImage), 1);
            this.images.push(mainImage);
        },
        getBrands() {
            axios.get("./tags/brandIndex").then(res => {
                this.brands = res.data.brandTotal;
            });
        },
        getFamilies() {
            axios.get("./tags/familyIndex").then(res => {
                this.families = res.data.familyTotal;
            });
        },
        // getCatalogs(){
        //     axios.get('./tags/colorIndex').then(res => {
        //         this.catalogs = res.data.colorTotal;
        //     });
        // },

        //cadastrando produto
        addProduct(e) {
            e.preventDefault();
            this.disabled = 1;

            // Sweet para carregamento
            this.$swal({
                title: "Salvando Dados!",
                onBeforeOpen: () => {
                    this.$swal.showLoading();
                }
            });
            if(this.type_save == 'SALVAR'){
                var url_save = "productStore";
            }
            if(this.type_save == 'ATUALIZAR'){
                var url_save = "productUpdate";
            }
            // Conexão
            axios
                .post(url_save, {
                    id_product: this.id_product,
                    codigo: this.codigo,
                    product_name: this.product_name,
                    short_description: this.short_description,
                    colors: this.colors,
                    family: this.family,
                    type_sale: this.type_sale,
                    price: this.price,
                    brand: this.brand,
                    width: this.width,
                    height: this.height,
                    diameter: this.diameter,
                    weight: this.weight,
                    free_shipping: this.free_shipping,
                    description: this.description,
                    status: this.status,
                    mainCategories: this.mainCategories,
                    mainImages: this.mainImages
                })
                .then(response => {
                    this.$swal({
                        title: "Produto registrado com successo!",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });

                    // Limpeza dos campos para novos cadastros
                    this.codigo = "";
                    this.product_name = "";
                    this.short_description = "";
                    this.colors = "";
                    this.family = "";
                    this.type_sale = "";
                    this.price = "";
                    this.brand = "";
                    this.width = "";
                    this.height = "";
                    this.diameter = "";
                    this.weight = "";
                    this.free_shipping = "";
                    this.description = "";
                    this.status = false;
                    this.mainCategories = [];
                    this.mainImages = [];

                    this.getResultCategories();
                    this.getImages();
                    this.getBrands();
                    this.getFamilies();
                    this.getProducts();

                    this.disabled = 0;
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
        destroy(e) {
            this.$swal({
                title: "Você tem Certeza?",
                html:
                    "Você irá deletar o <strong>" +
                    e.product_name +
                    "</strong> permanentemente!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sim, Delete isso!",
                cancelButtonText: "Não, Mantê-la"
            }).then(result => {
                if (result.value) {
                    axios.get("productDestroy/" + e.id).then(response => {
                        this.getProducts();
                        this.$swal({
                            title: "Deletado!",
                            html:
                                "<strong>" +
                                e.product_name +
                                "</strong> Deletado com sucesso.",
                            icon: "success"
                        });
                    });
                }
            });
        },
        saveProduct(e) {
            this.getResultCategories();
            this.getBrands();
            this.getFamilies();
            // this.getCatalogs();

            if (this.type_save == "ATUALIZAR") {
                this.id_product = e.id;
                this.codigo = e.codigo;
                this.product_name = e.product_name;
                this.short_description = e.short_description;
                // this.colors             = this.catalogs.find(item => item.id > e.colors);
                this.family = this.families.find(item => item.id == e.family);
                this.type_sale = e.type_sale;
                this.price = e.price.replace(".", ",");
                this.brand = this.brands.find(item => item.id == e.brand);
                this.width = e.width;
                this.height = e.height;
                this.diameter = e.diameter;
                this.weight = e.weight;
                this.free_shipping = e.free_shipping == 0 ? 0 : 1;
                this.description = e.description;
                this.mainCategories = e.categories;

                // Fazemos ua noca leitura das imagens e depois filtramos elas
                axios
                    .get("../imageIndex")
                    .then(result => {
                        this.images = result.data;
                        this.mainImages = [];
                    })
                    .then(result => {
                        e.images.forEach(value => {
                            this.mainImages.push(
                                this.images.find(item => item.id == value.id)
                            );
                            this.images.splice(
                                this.images.indexOf(
                                    this.images.find(
                                        item => item.id == value.id
                                    )
                                ),
                                1
                            );
                        });
                    });

                // Criar uma variavel em branco para categorias
                var getCategorie = "";
                // Lendo as categorias e por bug salvar o ultimo
                e.categories.forEach(value => {
                    getCategorie = value;
                });
                // Pegando o resultado sistema
                this.getResultCategories(getCategorie);
            }

            if(this.type_save == "SALVAR"){
                this.getImages();

                this.id_product = "";
                this.codigo = "";
                this.product_name = "";
                this.short_description = "";
                // this.colors             = null;
                this.family = "";
                this.type_sale = "";
                this.price = "";
                this.brand = "";
                this.width = "";
                this.height = "";
                this.diameter = "";
                this.weight = ""
                this.free_shipping = 0;
                this.description = "";
                this.mainCategories = [];
                this.mainImages = [];
            }
        }
    },
    filters: {
        rota(url) {
            // return "http://localhost:8000/" + url;
            return "http://localhost/For-Commerce/public/" + url;
        }
    }
};
</script>

<style scoped>
.img-product {
    width: 75px;
    height: 75px;
    max-width: 100%;
}
</style>
