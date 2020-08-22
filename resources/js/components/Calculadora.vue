<template>
    <div class="container mx-auto my-5">
        <form @submit.prevent="calcular">
            <div class="form-group">
                <label for="exampleInputEmail1">Largura</label>
                <input
                    type="text"
                    class="form-control"
                    id="largura"
                    v-model="largura"
                />
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Profundidade</label>
                <input
                    type="text"
                    class="form-control"
                    id="profundidade"
                    v-model="profundidade"
                />
            </div>
            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            largura: "",
            profundidade: ""
        };
    },
    methods: {
    
      calcular(){
           let valor = 5; 
            alert(this.largura + this.profundidade * valor);
             
      }
    
  }
};
</script>
