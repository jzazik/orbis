<template>
  <main class="container m-auto p-5">
    <slot/>
  </main>
  <teleport to="body">
    <vue3-snackbar bottom :duration="4000"></vue3-snackbar>
  </teleport>
</template>

<script>
import HeaderLink from "../Components/HeaderLink";
import {Vue3Snackbar} from "vue3-snackbar";

export default {
  components: {HeaderLink, Vue3Snackbar},
  props: {},
  data() {
    return {};
  },
  computed: {},
  methods: {}

};
</script>
<style>

</style>