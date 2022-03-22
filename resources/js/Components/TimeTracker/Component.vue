<template>
  <div>
    <div class="w-full relative p-4 border-b border-tertiary">
      <div class="uppercase font-medium text-custom_blue my-4">Counter</div>
      <!-- <ch-timer-component></ch-timer-component> -->
      <ch-time-tracker-component
        :projects="projects"
        :categories="categories"
        :tasks="tasks"
      ></ch-time-tracker-component>
    </div>
  </div>
</template>

<script>
import ChTimerComponent from "../Timer/TimerComponent.vue";
import ChTimeTrackerComponent from "../Timer/TimeTrackerComponent.vue";

export default {
  components: {
    ChTimerComponent,
    ChTimeTrackerComponent,
  },

  data() {},

  props: ["projects", "categories", "tasks"],

  mounted() {},

  methods: {},
};
</script>

<style>
</style>

