<template>
  <div class="flex justify-between mb-5">
    <h1>Список товаров</h1>
    <v-button v-if="!isOpenForm" @click="isOpenForm = true">+ Добавить продукт</v-button>
  </div>
  <Transition>
    <div v-if="isOpenForm">
      <product-form 
        :products="productList" 
        @closeForm="isOpenForm = false" 
        @addProduct="addProduct" 
        class="my-10"
      />
    </div>
  </Transition>
  <main class="pt-5 border-t border-cyan-500">
    <products-table 
      :products="productList" 
      @deleteProduct="deleteProduct"
    />
  </main>
</template>

<script>
import Layout from "../Layouts/Layout";
import ProductsTable from "../Components/ProductsTable";
import VButton from "../Components/VButton";
import ProductForm from "../Components/ProductForm";
import axios from "axios";

export default {
  layout: Layout,
  components: {
    ProductsTable,
    VButton,
    ProductForm
  },
  props: {
    products: Array
  },
  data() {
    return {
      isOpenForm: false,
      productList: this.products,
    };
  },
  methods: {
    addProduct(data) {
      this.productList.push(data);
      this.isOpenForm = false;
    },
    async deleteProduct(id) {
      
      try {
        const {data} = await axios.delete("/api/products/" + id);
        this.productList = data;
      } catch (e) {
        this.$snackbar.add({
          type: 'error',
          text: e.response.data.message
        })

      }
    }
  }
};
</script>
