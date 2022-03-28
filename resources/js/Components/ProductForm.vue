<template>
  <div>
    <form class="flex gap-5 items-center justify-center">
      <label class="flex flex-col">
        Тип продукта
        <select class="ml-2 p-2 h-10 bg-cyan-900 rounded" v-model="productType">
          <option value="product">Продукт</option>
          <option value="set">Набор</option>
        </select>
      </label>
      
      <v-input
        v-model="form.name"
        name="name"
        label="Название"
        :is-error="v$.form.name.$error"
      />
      <Transition>
        <label v-if="!showProduct" class="flex flex-col">
          Список продуктов
          <Multiselect
            style="min-width: 200px"
            mode="tags"
            v-model="form.productList"
            :options="productListForSelect"
          />
        </label>
      </Transition>
      
      <v-input
        v-model="form.price"
        name="price"
        label="Цена"
        type="number"
        :disabled="!showProduct"
        :is-error="v$.form.price.$error"
      />
      <v-button
        class="self-end"
        :class="{ 'animate-pulse': loading }"
        @click.prevent="save"
      >
        Сохранить
      </v-button>
      <v-button
        class="self-end"
        @click="$emit('closeForm')"
      >
        Отменить
      </v-button>


    </form>
    <div class="validation-text text-center" v-if="errorMessage">
      {{ errorMessage }}
    </div>
  </div>
</template>

<script>
import VInput from "./VInput";
import VButton from "./VButton";
import useVuelidate from "@vuelidate/core";
import {required, minLength, maxLength, requiredIf} from "@vuelidate/validators";
import axios from 'axios';
import Multiselect from '@vueform/multiselect'

export default {
  components: {VInput, VButton, Multiselect},
  setup() {
    return {
      v$: useVuelidate(),
    };
  },
  validations() {
    return {
      form: {
        name: {
          required,
          minLength: minLength(2),
          maxLength: maxLength(255),
        },
        price: { requiredIf: requiredIf(this.showProduct)}
      }
    };
  },
  props: ['products'],
  data() {
    return {
      form: {
        name: '',
        price: '',
        productType: 'product',
        productList: null,
      },
      loading: false,
      productType: 'product',
      errorMessage: '',
    };
  },
  computed: {
    showProduct() {
      return this.productType === 'product'
    },
    productListForSelect() {
      return this.products.map(product => {
        return { value: product.id, label: `id:${product.id} - ${product.name}`}
      })
    },
    productList() {
      return this.form.productList
    }
  },
  methods: {
    async save() {
      this.v$.$touch();

      if (this.v$.$invalid) {
        return;
      }
      this.loading = true;
      let result = null;
      try {
        const {data} = await axios.post("/api/products", this.form);
        this.$emit('addProduct', data)
      } catch (e) {
        // console.log(e.response.data);
        this.errorMessage = e.response.data.message;
      }
      this.loading = false;
      if (result) {
        this.errorMessage = "";
        for (let member in this.form) delete this.form[member];
      }
    }
  },
  watch: {
    productList(v) {
      this.form.price = this.products
        .filter(product => v.includes(product.id))
        .reduce((previousValue, currentValue) => Number(previousValue) + Number(currentValue.price), 0)
    }
  }

};
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
