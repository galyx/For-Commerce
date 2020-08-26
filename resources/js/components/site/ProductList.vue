<template>
    <div class="row mt-5">
        <div class="col-12 col-lg-6 my-auto">
            <div class="row">
                <div class="col-12">
                    <img class="img-fluid" src="http://itagrill.servidorweb7.com.br/img/logo3.png" alt="Logo de produtos" />
                </div>

                <div
                    v-for="product1 in products2"
                    :key="product1.id"
                    class="col-6 d-flex flex-column produto-info-1"
                >
                    <div class="img-product-1">
                        <img
                            class="img-fluid"
                            :src="product1.images[0].path | rota"
                            alt="Produto"
                        />
                    </div>
                    <div class="text-center my-2">
                        <span class="texto"
                            >{{ product1.product_name }} -
                            {{ product1.short_description }}</span
                        >
                    </div>
                    <div class="text-center">
                        <span class="preco">R$ {{ product1.price | formatPrice }}</span>
                    </div>
                    <div class="text-center my-2">
                        <span class="texto"
                            >R$ {{ product1.price | formatPrice }} a vista ou 10x de R$ 270,00</span
                        >
                    </div>
                    <div class="mt-auto detalhe">
                        <a class="btn btn-block btn-default mb-3" href=""
                            >VER PRODUTO</a
                        >
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="row">
                <div
                    v-for="product in products"
                    :key="product.id"
                    class="col-4 d-flex flex-column produto-info-2"
                >
                    <div class="img-product">
                        <img
                            class="img-fluid"
                            :src="product.images[0].path"
                            alt="Produto"
                        />
                    </div>
                    <div class="text-center">
                        <span class="texto"
                            >{{ product.product_name }} -
                            {{ product.short_description }}</span
                        >
                    </div>
                    <div class="text-center">
                        <span class="preco"
                            >R$ {{ product.price | formatPrice }}</span
                        >
                    </div>
                    <div class="text-center">
                        <span class="texto"
                            >R$  {{ product.price | formatPrice }} a vista ou 10x de R$ 270,00</span
                        >
                    </div>
                    <div class="mt-auto detalhe">
                        <a class="btn btn-block btn-default mb-3" href=""
                            >VER PRODUTO</a
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            products: [],
            products2: []
        };
    },
    created() {
        this.getProducts();
        this.getProducts2();
    },

    methods: {
        getProducts() {
            axios.get("products/list").then(result => {
                this.products = result.data;
            });
        },
        getProducts2() {
            axios.get("products/list/2").then(result => {
                this.products2 = result.data;
            });
        }
    },
    filters: {
        rota(url) {
            return "http://localhost:8000/" + url;
        },
        formatPrice(value) {
            let val = (value / 1).toFixed(2).replace(".", ",");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    }
};
</script>

<style scoped>
.img-product {
    width: auto;
    height: auto;
}
.img-product img {
    width: 150px;
    height: 150px;
    object-fit: cover;
}

.img-product-1 {
    width: auto;
    height: auto;
}
.img-product-1 img {
    width: 250px;
    height: 225px;
    object-fit: cover;
}
</style>
