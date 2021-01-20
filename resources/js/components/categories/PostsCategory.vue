<template>
  <div class="row">
    <!-- Blog Entries Column -->
    <div class="col-md-8">
      <vcl-facebook v-if="isLoading" :width="300" :height="500"></vcl-facebook>
      <div v-else class="media simple-post" v-for="post in posts" :key="post.id">
        <img class="mr-3" :src="'/uploads/post_images/'+post.image" :alt="post.title">
        <div class="media-body">
          <h4 class="mt-0">
            <router-link :to="'/post/'+post.slug">{{ post.title }}</router-link>
          </h4>
          {{ post.body.substr(0, 150) }}
          <ul class="list-inline list-unstyled d-flex post-info">
            <li><span><i class="fa fa-user"></i> posted by : <strong
                class="text-primary">{{ post.user.name }}</strong> </span></li>
            <li>|</li>
            <li><span><i class="fa fa-calendar"></i> {{ post.created_at }} </span></li>
            <li>|</li>
            <span><i class="fa fa-comment"></i> {{ post.comments.length }} comments</span>

          </ul>
        </div>
      </div>
    </div>
    <!-- Sidebar Widgets Column -->
    <div class="col-md-4">

      <!-- Search Widget -->
      <div class="card my-4">
        <h5 class="card-header">Search</h5>
        <div class="card-body">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
          </div>
        </div>
      </div>

      <Category></Category>

    </div>

  </div>
</template>

<script>

import  VclFacebook  from 'vue-content-loading';
import Category from "./Category";
export default {
  components: {VclFacebook, Category},
  data() {
    return {
      posts: [],
      isLoading : true

    }
  },
  mounted() {
    this.getPost();
  },
  methods: {
    getPost() {
      axios.get('/api/category/' + this.$route.params.slug + '/posts').then(res => {
        this.posts = res.data;
        this.isLoading = false;
      }).catch(error => console.log(error));
    }
  }
}
</script>
