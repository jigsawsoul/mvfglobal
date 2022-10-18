const axios = require('axios').default
window.axios = axios

import Vue from 'vue'
import debounce from 'v-debounce'

Vue.use(debounce)
Vue.component('github-search', require('./components/github-search.vue').default)

const app = new Vue({
    el: '#app'
});
