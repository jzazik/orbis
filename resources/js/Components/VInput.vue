<template>
  <div>
    <label class="flex flex-col">
      {{ label }}
      <input
        :name="name"
        class="ml-2 p-2 h-10 bg-cyan-900 rounded"
        :class="{ 'validation-input': isError, 'bg-gray-700': disabled }"
        :type="type"
        :value="modelValue"
        @input="updateValue"
        autocomplete="on"
        :disabled="disabled"
      />
    </label>
  </div>
</template>
<script>
export default {
  props: {
    label: String,
    name: String,
    type: { type: String, default: "text" },
    modelValue: String,
    isError: { type: Boolean, default: false },
    disabled: Boolean
  },
  methods: {
    updateValue(event) {
      this.$emit("update:modelValue", event.target.value);
    },
  },
};
</script>
