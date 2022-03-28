<template>
  <v-table :th-arr="['id', 'Название', 'Цена', 'Список продуктов', 'Actions']">
    <tr v-for="product in products" :key="product.id" class="hover:bg-sky-800">
      <td class="py-2 px-2 text-xs italic">
        {{ product.id }}
      </td>
      <td
        class="py-2 pr-2 font-mono font-bold text-xs leading-6 text-sky-500 whitespace-nowrap dark:text-sky-400"
      >
        {{ product.name }}
      </td>
      <td class="py-2 px-2 text-xs italic">
        {{ product.price }}
      </td>
      <td class="py-2 px-2 text-xs italic">
        <ul>
          <li v-for="item in product.set_products">
            id {{ item.id }} - {{ item.name }}
          </li>
        </ul>
      </td>
      <td class="py-2 px-2 text-xs italic">
        <v-button @click="$emit('deleteProduct', product.id)">Удалить</v-button>
      </td>
    </tr>
  </v-table>
  <div v-if="!products.length" class="w-full mt-14">
    <div class="text-center font-semibold mx-auto text-l">
      Товаров пока нет 
    </div>
  </div>
</template>

<script>
import VTable from "./VTable";
import VButton from "./VButton";

export default {
  components: {
    VTable,
    VButton
  },
  props: {
    products: Array
  },
  data() {
    return {};
  },
  computed: {
    
  },
  methods: {
    
  },
};
</script>
<style></style>
