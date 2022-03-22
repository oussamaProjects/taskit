<template>
  <div class="flex">
    <div class="text-right">
      <input
        autocomplete="off"
        type="text"
        class="form-control input-time-picker ng-untouched ng-pristine ng-valid"
      />
    </div>
    <span class="h-line-divider"></span>
    <div>
      <input
        autocomplete="off"
        type="text"
        class="form-control input-time-picker ng-untouched ng-pristine ng-valid"
      />
    </div>
  </div>

  <div class="ml-3">
    <input-single-date>
      <span class="pointer non-selectable ng-star-inserted">
        <img
          src="https://app.clockify.me/assets/images/ui-icons/calendar.svg"
        />
      </span>
    </input-single-date>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>