<template>
  <div class="flex flex-row gap-2 my-2">
    <ch-timer :time="prettyTime"></ch-timer>
    <button @click="start()" class="text-custom_green uppercase">Start</button>
    <button @click="pause()" class="text-custom_green uppercase">Pause</button>
    <button @click="reset()" class="text-custom_green uppercase">Reset</button>
    <select id="taskSelected" v-model="task.id">
      <option value="0">--</option>
      <option v-for="task in tasks" :key="task.id" :value="task.id">
        {{ task.name }}
      </option>
    </select>
  </div>
</template>

<script>
import chTimer from "./Timer.vue";
import chTimerSetup from "./TimerSetup.vue";

export default {
  components: {
    chTimer,
    chTimerSetup,
  },

  data() {
    return {
      task: {
        id: 1,
        name: 'test',
      },
      isRunning: false,
      hours: 0,
      minutes: 0,
      secondes: 0,
      time: 0,
      timer: null,
      sound: new Audio("https://lasonotheque.org/UPLOAD/mp3/2254.mp3"),
    };
  },

  computed: {
    prettyTime() {
      let seconds = Number(this.time);
      let d = Math.floor(seconds / (3600 * 24));
      let h = Math.floor((seconds % (3600 * 24)) / 3600);
      let m = Math.floor((seconds % 3600) / 60);
      let s = Math.floor(seconds % 60);

      let day = d > 0 ? d : "";
      let hours = h > 0 ? h : "";
      let minutes = m > 0 ? m : "";
      let secondes = s > 0 ? s : "";

      return day + ":" + hours + ":" + minutes + ":" + secondes;
    },
  },

  methods: {
    start() {
      this.isRunning = true;
      if (!this.timer) {
        this.sound.play();
        this.timer = setInterval(() => {
          this.time++;
        }, 1000);
      }

      this.$inertia.post("/task/start", this.task.id);
    },
    pause() {
      this.isRunning = false;
      this.sound.play();
      clearInterval(this.timer);
      this.timer = null;
    },
    reset() {
      this.$inertia.post("/task/end", this.task.id);

      this.pause();
      this.time = 0;
      this.secondes = 0;
      this.minutes = 0;
      this.hours = 0;
    },
  },

  props: ["projects", "categories", "tasks"],
};
</script>

<style>
</style>