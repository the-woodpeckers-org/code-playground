<template>
    <div>
      <form @submit.prevent>
        <input
          id="search-input"
          type="search"
          v-model="searchQuery"
          placeholder="Search…"
          autocomplete="off"
          spellcheck="true"
          aria-autocomplete="list"
          aria-controls="search-listbox"
          @input="updateSuggestions"
        />
      </form>
      <ul
        id="search-listbox"
        role="listbox"
        v-if="filteredSuggestions.length"
      >
        <li
          v-for="(suggestion, index) in filteredSuggestions"
          :key="index"
          role="option"
          @click="selectSuggestion(suggestion)"
        >
          {{ suggestion.name }}
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import { HTTP } from '@/http-common.js';
  export default {
    data() {
      return {
        searchQuery: "",
        allItems: [],
        filteredSuggestions: [],
      };
    },
    emits: ['selected'],
    name : 'SearchDynamic',
    methods: {
      updateSuggestions() {
        if (!this.searchQuery) {
          this.filteredSuggestions = [];
          return;
        }
        const query = this.searchQuery.toLowerCase();
        this.filteredSuggestions = this.allItems.filter((item) =>
          item.name.toLowerCase().includes(query)
        );
      },
      clearSearch() {
      this.searchQuery = "";
      this.filteredSuggestions = [];
    },
      selectSuggestion(suggestion) {
        this.searchQuery = suggestion.name;
        this.filteredSuggestions = [];
        this.$emit('selected', suggestion);
      },
     async loadItems() {
            await HTTP.get('/api/getCompaniesU')
                .then(response => {
                  console.log("cong ty: ",response.data);
                    this.allItems = response.data.data;
                })
                .catch(error => {
                    console.log(error);
                });
    },
    },
    async mounted() {
       await this.loadItems();
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
  