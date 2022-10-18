<template>
  <div class="m-5 w-[520px]">

    <div class="rounded-2xl bg-white shadow-xl">

      <form autocomplete="off">
        <div class="relative">
          <icon-search></icon-search>
          <input id="username" type="text" value="" v-model.lazy="username" v-debounce="delay" v-on:keydown="loading()" placeholder="Search" class="rounded-2xl w-full text-xl h-16 pl-14 pr-20 placeholder-[#828A95] text-[#181D29] outline-none">
          <icon-loader v-if="!loaded"></icon-loader>
        </div>
      </form>

      <div :class="{ 'border-t-2 border-[#F2F2F2] py-2' : this.results.length }">
        <transition-group tag="ul" name="list">
          <li v-for="item in results" :key="item.id" class="flex py-3 mx-6 border-b last:border-b-0 border-[#F2F2F2]">
            <div class="w-10 h-10 mr-3">
              <img :src="item.avatar_url" class="object-cover rounded" />
            </div>
            <div class="self-center flex-1">
              <a :href="item.html_url" class="text-[#181D29] text-sm font-semibold">
                {{ item.name ?? 'Unknown' }}
              </a>
              <div class="text-xs text-[#828A95]" :class="{ ' font-bold' : item.language }">
                {{ item.language ?? "doesn't have any public repositories" }}
              </div>
            </div>
            <div class="self-center flex space-x-3">
              <a v-if="item.html_url" :href="item.html_url">
                <icon-github></icon-github>
              </a>
              <a v-if="item.twitter_username" :href="'https://twitter.com/' + item.twitter_username">
                <icon-twitter></icon-twitter>
              </a>
              <a v-if="item.email" :href="'mailto:' + item.email">
                <icon-email></icon-email>
            </a>
            </div>
          </li>
        </transition-group>
      </div>

    </div>

    <div class="mt-4 text-center text-xs flex justify-between items-center mx-4 flex-col md:flex-row">
      <p class="mb-3 md:mb-0"><strong class="opacity-20">WP CLI: </strong> <code class="opacity-20 bg-gray-300 border border-gray-500 py-1 rounded-full px-2">wp github &lt;username&gt;</code></p>
      <p class="opacity-20">MVF Gobal - Created by <a href="mailto:richardclivehowse">Richard Howse</a></p>
    </div>

    <div v-if="error" class="fixed bottom-5 left-5 right-5 p-2 px-4 rounded-lg bg-red-500 text-white text-sm">
      <strong>Error:</strong> {{ error.data }}
    </div>

  </div>
</template>

<script>

import IconEmail from './icons/email.vue';
import IconGithub from './icons/github.vue';
import IconLoader from './icons/loader.vue';
import IconSearch from './icons/search.vue';
import IconTwitter from './icons/twitter.vue';

export default {

  components: {
    IconEmail,
    IconGithub,
    IconLoader,
    IconSearch,
    IconTwitter
  },

  data() {
    return {
      delay: 500,
      username: '',
      error: false,
      loaded: true,
      results: [],
    }
  },

  mounted: function () {
    console.log('mounted')
  },

  watch: {
    username() {
      this.search()
    }
  },

  methods: {
    loading() {
      this.error = false
      this.loaded = false
    },

    search() {
      if (!this.username) {
        this.error = false
        this.loaded = true
        return 
      }

      axios
      .get('/wp-json/v1/github/' + this.username)
      .then(response => {

        if (response.data.status !== 200) {
          this.error = response.data
        } else {
          this.results.unshift(response.data.data)
        }

        this.loaded = true

      })
      .catch(error => {
        this.loaded = true
        console.log(error)
      })
    }
  }
}
</script>
