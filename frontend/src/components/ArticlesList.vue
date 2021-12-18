<template>
  <div class="list row">
    <div class="col-md-8">
      <div class="input-group mb-3">
        <input
            type="text"
            class="form-control"
            placeholder="Search by title"
            v-model="searchTitle"
        />
        <div class="input-group-append">
          <button
              class="btn btn-outline-secondary"
              type="button"
              @click="page = 1; retrieveTutorials();"
          >
            Search
          </button>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="mb-5">
        Categories:
        <select class="form-select form-select-lg" v-model="category" @change="handleCategoryChange($event)">
          <option v-for="(category, index) in categories" :key="category" :value="index">
            {{ category }}
          </option>
        </select>
      </div>
    </div>

    <div class="col-md-12">
      <div class="mb-5">
        Items per Page:
        <select class="form-select form-select-lg" v-model="perPage" @change="handlePageSizeChange($event)">
          <option v-for="size in pageSizes" :key="size" :value="size">
            {{ size }}
          </option>
        </select>
      </div>

      <b-pagination
          v-model="page"
          :total-rows="count"
          :per-page="perPage"
          prev-text="Prev"
          next-text="Next"
          @change="handlePageChange"
      ></b-pagination>
    </div>

    <div class="col-md-6">
      <h4>Articles List</h4>
      <ul class="list-group" id="tutorials-list">
        <li
            class="list-group-item"
            :class="{ active: index === currentIndex }"
            v-for="(article, index) in articles"
            :key="index"
            @click="setActiveArticle(article, index)"
        >
          <span v-if="article.media" class="badge badge-success">{{ article.media.type }}</span>
          <span v-html="article.title"></span>
        </li>
      </ul>
    </div>

    <div class="col-md-6">
      <div v-if="currentArticle">
        <div v-if="currentArticle.media">
          <span class="badge badge-success">{{ currentArticle.media.type }}</span>
        </div>
        <div>
          <p>Title:<span v-html="currentArticle.title"></span></p>
        </div>
        <div v-if="currentArticle.media">
          <img :src="currentArticle.media.url" class="img-thumbnail"/>
        </div>
        <div>
          <label><strong>Categories:</strong></label>
          {{ currentArticle.categories.join(', ') }}
        </div>
        <div>
          <p><span v-html="currentArticle.content"></span></p>
        </div>
      </div>
      <div v-else>
        <br/>
        <p>There are no articles</p>
      </div>
    </div>
  </div>
</template>

<script>
import ArticleDataService from "../services/ArticleDataService"
import CategoryDataService from "../services/CategoryDataService";

export default {
  name: "tutorials-list",
  data() {
    return {
      articles: [],
      currentArticle: null,
      currentIndex: -1,
      searchTitle: "",

      page: 1,
      count: 0,
      perPage: 5,

      pageSizes: [5, 10],

      category: '',
      categories: [],
    };
  },
  methods: {
    retrieveTutorials() {
      ArticleDataService.all(
          this.searchTitle,
          this.page,
          this.perPage,
          this.category,
      ).then((response) => {
        const {articles, total} = response.data
        this.articles = articles
        this.count = total

        console.log(response.data)
      })
          .catch((e) => {
            console.log(e)
          })
    },
    retrieveCategories() {
      CategoryDataService.all().then((response) => {
        const {categories} = response.data
        this.categories = categories;
      })
    },
    handlePageChange(value) {
      this.page = value
      this.retrieveTutorials()
    },

    handlePageSizeChange(event) {
      this.perPage = event.target.value
      this.page = 1
      this.retrieveTutorials()
    },

    handleCategoryChange(event) {
      this.category = event.target.value
      this.page = 1
      this.retrieveTutorials()
    },

    setActiveArticle(article, index) {
      this.currentArticle = article;
      this.currentIndex = index;
    },
  },
  mounted() {
    this.retrieveTutorials();
    this.retrieveCategories();
  },
}
</script>

<style>
.list {
  text-align: left;
  max-width: 750px;
  margin: auto;
}
</style>
