<template>
  <!-- <app-layout title="Dashboard"> -->
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        TimeTracker
      </h2>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="flex flex-col bg-white overflow-hidden shadow-lg sm:rounded"
        >
          <ch-time-tracker-component
          :projects="projects"
          :categories="categories"
          :tasks="tasks"
           />
        </div>
      </div>
    </div>
  <!-- </app-layout> -->
</template>

<script>
// import { defineComponent } from "vue";
// import AppLayout from "@/Layouts/AppLayout.vue";
import ChTimeTrackerComponent from "../Components/TimeTracker/Component.vue";

export default ({
  components: {
    // AppLayout,
    ChTimeTrackerComponent,
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

  props: ["projects","categories","tasks"],
});
</script>
