<template>
  <div class="timer text-2xl font-bold">{{ prettify }}</div>
</template>

<script>
export default {
  data() {
    return {
      time: this.time,
    };
  },
  computed: {
    prettify() {
      let days = "0";
      let hours = "0";
      let minutes = "0";
      let secondes = "0";

      let data = this.time.split(":");
      days = data[0] ?? 0;
      hours = data[1] ?? 0;
      minutes = data[2] ?? 0;
      secondes = data[3] ?? 0;

      if (days < 10) days = "0" + days;

      if (hours < 10) hours = "0" + hours;
      if (hours == 0) hours = "00";

      if (minutes < 10) minutes = "0" + minutes;
      if (minutes == 0) minutes = "00";

      if (secondes < 10) secondes = "0" + secondes;
      if (secondes == 0) secondes = "00";

      return hours + ":" + minutes + ":" + secondes;
    },
  },
  props: ["time"],
};
</script>

<style>
</style>