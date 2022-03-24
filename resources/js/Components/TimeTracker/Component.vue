<template>
  <div class="ng-star-inserted">
    <div class=" page-wrapper  px-0  px-lg-2  pt-0">
      <div class=" tracker-wrapper ng-star-inserted">
        <div class=" container-fluid  px-0  px-lg-2">
          <div class=" tracker-entries-wrapper ng-star-inserted">

            <ts-time-tracker-component
              :projects="projects"
              :categories="categories"
              :tasks="tasks"
              :globalClass="globalClass"
            />

            <ts-tasks :tasks="tasks" />

            <ts-entry-group />

          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import TsTasks from "../Tasks/Component.vue";
import TsTimeTrackerComponent from "../Timer/TimeTrackerComponent.vue";
import TsEntryGroup from "./EntryGroup.vue";

export default {
  components: {
    TsTasks,
    TsTimeTrackerComponent,
    TsEntryGroup,
  },

  data() {},

  props: ["projects", "categories", "tasks","globalClass"],

  mounted() {},

  methods: {},
};
</script>

<style>
</style>

