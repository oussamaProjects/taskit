<template>
  <div>
    <ch-timer-setup @set-time="setTime"></ch-timer-setup>
    <br />
    <ch-timer :time="prettyTime"></ch-timer>
    <br />
    <button @click="start()">Start</button>
    <br />
    <button @click="pause()">pause</button>
    <br />
    <button @click="reset()">reset</button>
    <br />
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
      isRunning: false,
      minutes: 0,
      secondes: 0,
      time: 0,
      timer: null,
      sound: new Audio(
        "http://s1download-universal-soundbank.com/wav/nudge.wav"
      ),
    };
  },

  computed: {
    prettyTime() {
      let time = this.time / 60;
      let minutes = parseInt(time);
      let secondes = Math.round((time - minutes) * 60);
      return minutes + ":" + secondes;
    },
  },
  methods: {
    start() {
      console.log(  !this.timer);

      this.isRunning = true;
      if (!this.timer) {
        this.timer = setInterval(() => {
          if (this.time > 0) {
            this.time--;
          } else {
            clearInterval(this.timer);
            this.sound.play();
            this.reset();
          }
        }, 1000);
      }

      
      alert('rtrtr');
    },
    pause() {
      this.isRunning = false;
      clearInterval(this.timer);
      this.timer = null;
    },
    reset() {
      this.pause();
      this.time = 0;
      this.secondes = 0;
      this.minutes = 0;
    },
    setTime(payload) {
      this.time = payload.minutes * 60 + payload.secondes;
    },
  },
};
</script>

<style>
</style>