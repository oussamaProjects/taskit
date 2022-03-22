<template>
  <div tabrow="" class="flex tracker-entry">
    <div class="flex flex-col description-col flex-grow-0">
      <span class="flex align-items-center mr-2">
        <div class="fake-input-wrapper cut-text w-full">
          <input
            type="text"
             
            autocomplete="off"
            spellcheck="true"
            class="
              form-control
              input-description
              ng-untouched ng-pristine ng-valid
            "
            placeholder="Add description"
            title="Salat alasr"
          />
          <div class="form-control fake-input">Salat alasr</div>
        </div></span
      >
    </div>
    <div class="flex flex-col project-col">
      <div   class="dropdown dropdown-large flex w-full">
        <div class="cut-text w-full">
          <ts-project-picker-label />
        </div>
        <span    ></span>
      </div>
    </div>
    <div class="flex flex-col tag-col">
      <div
         
        class="dropdown flex w-full cut-text-wrapper justify-content-end"
      >
        <ts-tag-names />
      </div>
    </div>
    <div class="col-fixed">
      <div class="timetracker-list-actions flex justify-content-between w-full">
        <ts-billable-icon />
        <ts-single-date-picker />
        <div
          class="
            component-divided-left
            d-md-inline-flex
            input-time-wrapper
            entry-duration
            m-abs
            remove-divider-mob
          "
        >
          <ts-input-duration />
        </div>
        <div
           
          class="component-divided-left icon-play pointer non-selectable px-1"
          title="Continue timer for this activity"
        >
          <img
            src="https://app.clockify.me/assets/images/ui-icons/play.svg"
            class="px-1 pr-lg-2"
          />
        </div>
        <div
           
           
          class="dropdown tree-dots flex ng-star-inserted"
        >
          <div
            dropdownkeybutton=""
             
            class="
              pointer
              non-selectable
              component-divided-left
              d-flex
              dropdown-toggle
              no-arrow
            "
          >
            <img
              src="https://app.clockify.me/assets/images/ui-icons/menu-dots-vertical.svg"
              class="px-2"
            />
          </div>
          <span    ></span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import TsProjectPickerLabel from "./ProjectPickerLabel.vue";
import TsTagNames from "./TagNames.vue";
import TsBillableIcon from "./BillableIcon.vue";
import TsInputDuration from "./InputDuration.vue";
import TsSingleDatePicker from "./SingleDatePicker.vue";

export default {
  components: {
    TsProjectPickerLabel,
    TsTagNames,
    TsBillableIcon,
    TsInputDuration,
    TsSingleDatePicker,
  },
};
</script>

<style>
</style>