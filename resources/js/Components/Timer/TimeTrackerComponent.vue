<template>
  <div class="flex flex-row gap-2 my-2">
    <div class="taskInfo flex">
      <input type="name" :class="globalClass.inputTextForm" />
      <select
        id="taskSelected"
        v-model="task.id"
        :class="globalClass.inputTextForm"
      >
        <option value="0">--</option>
        <option v-for="task in tasks" :key="task.id" :value="task.id">
          {{ task.name }}
        </option>
      </select>

      <div v-for="task in tasks" :key="task.id" :value="task.id">
        <div :set="(projectName = task.project.name)"></div>
        {{ task.name }}
      </div>

    </div>

    <div class="flex items-center justify-center buttons ml-auto">
      <ch-timer :time="prettyTime"></ch-timer>
      <div class="w-6"></div>
      <button
        @click="start()"
        :class="
          'bg-green-200 text-black text-xl font-bold hover:bg-white ' + globalClass.buttonForm
        "
        v-if="!this.isRunning"
      >
        Start
      </button>
      <button
        @click="pause()"
        :class="
          'bg-red-200 text-black text-xl font-bold hover:bg-white ' + globalClass.buttonForm
        "
        v-if="this.isRunning"
      >
        Stop
      </button>
      <!-- <button @click="reset()" :class="globalClass.buttonForm">Reset</button> -->
    </div>
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
        name: "test",
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

  props: ["projects", "categories", "tasks", "globalClass"],
};
</script>

<style>
</style>