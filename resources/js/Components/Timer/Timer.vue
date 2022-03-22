<template>
  <div class="timer text-custom_green font-bold">{{ prettify  }}</div>
</template>

<script>
export default {
    data(){
        return {
            time:this.time
        }
    },
  computed: {
    prettify( ) { 
        console.log(this.time);
        let data = this.time.split(":");
        let days = data[0];
        let hours = data[1];
        let minutes = data[2];
        let secondes = data[3];

        if (days < 10) {
          days = "0" + days;
        }
        if (hours < 10) {
          hours = "0" + hours;
        }
        if (minutes < 10) {
          minutes = "0" + minutes;
        }
        if (secondes < 10) {
          secondes = "0" + secondes;
        }
        return days + ":" + hours + ":" + minutes + ":" + secondes;
    },
  },
  props: ["time"],
};
</script>

<style>
</style>