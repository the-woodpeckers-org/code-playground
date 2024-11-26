<template>
    <form @submit.prevent>
      <input 
        id="search-input" 
        type="search" 
        v-model="searchQuery" 
        placeholder="Search… Job name, location, company name" 
        autocomplete="off" 
        spellcheck="true" 
        aria-autocomplete="list" 
        aria-controls="search-listbox" 
        @input="updateSuggestions" 
        class="input h-12 w-full rounded-full pl-4 pr-12 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm"
      />
    </form>

    <ul 
      id="search-listbox" 
      role="listbox" 
      v-if="filteredSuggestions.length" 
      class="bg-white shadow-md mt-2 rounded-lg overflow-hidden max-h-64 overflow-y-auto"
    >
      <li 
        class="hover:bg-indigo-50 px-4 py-2 text-gray-800 cursor-pointer flex justify-between items-center" 
        v-for="(suggestion, index) in filteredSuggestions" 
        :key="index" 
        role="option" 
        @click="selectSuggestion(suggestion)"
      >
        <span>{{ suggestion.title }}</span>
        <span class="text-gray-500">{{ suggestion.company.name }}</span>
      </li>
      <li v-if="seemore" class="bg-indigo-50 text-indigo-600 font-semibold px-4 py-2 text-center cursor-pointer hover:bg-indigo-100">
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
  props: {
    allItems: [],
  },
  emits: ['selected'],
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
      this.searchQuery = suggestion.name;
      this.filteredSuggestions = [];
      this.$emit('selected', suggestion);
    },
  },
  async mounted() {
 
  },
};
</script>

<style>
form {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

input {
  padding: 8px;
  font-size: 1rem;
  border: 1px solid #ccc;
  border-radius: 4px;
}

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