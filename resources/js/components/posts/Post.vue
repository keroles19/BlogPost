<template>
  <div class="">
  <div class="media simple-post" v-for="post in posts" :key="post.id">
    <img class="mr-3" :src="'/uploads/post_images/'+post.image" :alt="post.title">
    <div class="media-body">
      <h4 class="mt-0">
        <router-link  :to="'/post/'+post.slug">{{ post.title }}</router-link>
      </h4>
       {{ post.body.substr(0,150) }}
      <ul class="list-inline list-unstyled d-flex post-info">
        <li><span><i class="fa fa-user"></i> posted by : <strong class="text-primary">{{post.user.name}}</strong> </span></li>
        <li>|</li>
        <li><span><i class="fa fa-calendar"></i> {{ post.created_at }} </span></li>
        <li>|</li>
        <span><i class="fa fa-comment"></i> {{post.comments.length}} comments</span>

      </ul>
    </div>
  </div>
  </div>
</template>

<script>
export default {
  data(){
    return {
     posts : []
    }
  },
  mounted() {
    this.getPost();
  },
  methods :{
    getPost(){
      axios.get('/api/post').then(res => {
        this.posts = res.data
      })
      .catch(error => console.log(error));
    }
  }
}
</script>
