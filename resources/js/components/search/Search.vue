<template>
  <label class="input input-bordered flex items-center gap-2">
    <input id="search-input" type="search" v-model="searchQuery" placeholder="Search… Job name, location, company name"
      autocomplete="off" spellcheck="true" aria-autocomplete="list" aria-controls="search-listbox"
      @input="updateSuggestions" class="grow text-gray-700 placeholder-gray-400" />
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="h-4 w-4 opacity-70"
      @click="searchClick">
      <path fill-rule="evenodd"
        d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
        clip-rule="evenodd" />
    </svg>
  </label>
  <ul id="search-listbox" role="listbox" v-if="filteredSuggestions.length"
    class="bg-white shadow-md mt-2 rounded-lg overflow-hidden max-h-64 overflow-y-auto">
    <li class="hover:bg-indigo-50 px-4 py-2 text-gray-800 cursor-pointer flex justify-between items-center"
      v-for="(suggestion, index) in filteredSuggestions" :key="index" role="option"
      @click="selectSuggestion(suggestion)">
      <span>{{ suggestion.title }}</span>
      <span class="text-gray-500">{{ suggestion.company.name }}</span>
    </li>
    <li v-if="seemore" @click="jobITAll"
      class="bg-indigo-50 text-indigo-600 font-semibold px-4 py-2 text-center cursor-pointer hover:bg-indigo-100">
      See more →
    </li>
  </ul>
</template>

<script>
import { HTTP } from '@/http-common.js';
export default {
  data() {
    return {
      searchQuery: "",
      filteredSuggestions: [],
      seemore: false,
    };
  },
  emits: ['selected'],
  props: {
    allItems: [],
  },
  name: 'Search',
  methods: {
    updateSuggestions() {
      this.seemore = false;
      if (!this.searchQuery) {
        this.filteredSuggestions = [];
        return;
      }
      const query = this.searchQuery.toLowerCase();
      this.filteredSuggestions = this.allItems.filter((item) =>
        item.title.toLowerCase().includes(query)
        || item.location.toLowerCase().includes(query)
        || item.salary.toString().includes(query)
        || JSON.parse(item.skill.replace(/'/g, '"')).some((skill) => skill.toLowerCase().includes(query))
      );
      this.filteredSuggestions = this.filteredSuggestions.slice(0, 5);
      if (this.filteredSuggestions.length >= 5) {
        this.seemore = true;
      }
    },
    clearSearch() {
      this.searchQuery = "";
      this.filteredSuggestions = [];
      this.seemore = false;
    },
    selectSuggestion(suggestion) {
        const encodedKeyword = encodeURIComponent( suggestion.title);
        this.$router.push({ name: 'job-it', params: { keyword:  suggestion.title } });
        this.searchQuery = "";
        this.filteredSuggestions = [];
    },
    searchClick() {
      if (this.searchQuery) {
        const encodedKeyword = encodeURIComponent(this.searchQuery );
        this.$router.push({ name: 'job-it', params: { keyword: this.searchQuery } });
      } else {
        this.$router.push({ name: 'job-it-all' });
      }
      this.searchQuery = "";
      this.filteredSuggestions = [];
    },
    jobITAll() {
      this.$router.push({ name: 'job-it-all' });
    },
  },
};
</script>

<style>
ul {
  margin: 0;
  padding: 0;
  list-style: none;
  border: 1px solid #ccc;
  border-radius: 4px;
  max-height: 150px;
  overflow-y: auto;
}

li {
  padding: 8px;
  cursor: pointer;
}

li:hover {
  background-color: #f0f0f0;
}
</style>