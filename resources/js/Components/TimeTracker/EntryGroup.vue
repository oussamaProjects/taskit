<template>
  <div class="card my-2">
    <ts-entry-group-header />
    <ts-time-tracker-entry />
  </div>
</template>

<script>
import TsEntryGroupHeader from "./EntryGroupHeader.vue";
import TsTimeTrackerEntry from "./TimeTrackerEntry.vue";

export default {
  components: {
    TsEntryGroupHeader,
    TsTimeTrackerEntry,
  },
};
</script>

<style>
</style>