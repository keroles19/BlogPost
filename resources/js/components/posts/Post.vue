<template>
  <div class="row">
    <!-- Blog Entries Column -->
    <div class="col-md-8">
      <vcl-facebook v-if="isLoading" ></vcl-facebook>
      <div v-else-if="noExists" class="media simple-post">
        <div class="media-body">
          <p>No Exists Item</p>
        </div>
      </div>
      <div v-else class="media simple-post" v-for="post in posts.data" :key="post.id">
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
      <pagination :data="posts" @pagination-change-page="getPost"></pagination>
    </div>
    <!-- Sidebar Widgets Column -->
    <div class="col-md-4">
      <!-- Search Widget -->
      <div class="card my-4">
        <h5 class="card-header">Search</h5>
        <div class="card-body">
          <div class="input-group">
            <input type="text" class="form-control" v-model="search" placeholder="Search for...">
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
import Category from "../categories/Category";
import  VclFacebook  from 'vue-content-loading';

export default {
  components: {Category,VclFacebook},
  data() {
    return {
      posts: {},
      isLoading : true,
      noExists : false,
      search : ''
    }
  },
  created() {
    this.getPost();
  },
  watch :{
    search(query){
      if(query.trim().length > 0) {
        this.isLoading = true;
        axios.get('api/search/'+this.search.trim()+'?page=1').then(res =>{
          if(res.data.data.length > 0){
            this.posts = res.data
            this.noExists = false
          }else{
            this.noExists = true
          }
          this.isLoading = false;
        })
      }
      else{
         this.posts = JSON.parse(localStorage.getItem('posts'));
         this.isLoading = false;
      }
    }
  },
  methods: {
    getPost(page) {
      console.log(this.$store.state.token);
      axios.get('/api/post?page='+ page).then(res => {
        this.posts = res.data
        localStorage.setItem('posts',JSON.stringify(this.posts));
        this.isLoading = false;
      }).catch(error => console.log(error));
    }
  }
}
</script>
