import Vue from 'vue'

export default {
  init() {
    // JavaScript to be fired on the home page
    new Vue({
      el: 'wp-vue-app',
    })
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
