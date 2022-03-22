<template>
  <div class="task w-full p-2 shadow-sm rounded-sm my-1" :id="task.id">
    <div class="flex flex-row">{{ task.name }}</div>
  </div>
</template>

<script>
export default {
  components: {
    // AppLayout,
  },

  data() {
    return {
      globalClass: {
        inputTextForm:
          "appearance-none border border-gray-400 hover:border-gray-300 rounded-sm w-full p-2 text-gray-700 leading-tight focus:outline-none shadow bg-white hover:bg-main text-xs transition-all duration-300 transform",
        buttonForm:
          "appearance-none border border-main hover:border-main rounded-sm w-full p-2 text-custom_blue leading-tight focus:outline-none shadow bg-white hover:bg-main text-xs transition-all duration-300 transform",
        link: "text-xs text-custom_blue hover:text-custom_blue transition-all duration-300 transform cursor-pointer",
        textError: "text-error text-xs bg-error p-1 rounded-xs mt-1",
        textSucces: "text-custom_blue text-xs bg-success p-1 rounded-xs mt-1",
      },
    };
  },

  mounted() {},

  props: ["task"],
};
</script>

<style>
</style>