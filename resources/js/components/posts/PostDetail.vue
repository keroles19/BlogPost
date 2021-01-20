<template>
  <!-- Post Content Column -->
  <div class="row">
    <div class="col-lg-8">

      <!-- Title -->
      <h1 class="mt-4">{{ post.title  }}</h1>

      <!-- Author -->
      <p class=" alert alert-info" v-if="post.category" style="width: fit-content;
        padding: 5px;
        color: #142d31;" >{{ post.category.name }}
      </p>

      <hr>

      <!-- Date/Time -->
      <p>Posted  <strong class="badge badge-primary p-1"></strong> {{post.created_at}}
        <span class="float-right"><strong class="badge badge-info p-1" v-if="post.comments">{{ comments.length }}</strong> comments</span></p>

      <hr>

      <!-- Preview Image -->
      <img class="img-fluid rounded" :src="'/uploads/post_images/'+post.image" :alt="post.title" style="width:900px;max-height:300px">

      <hr>

      <!-- Post Content -->
     <p>
       {{post.body}}
     </p>
      <hr>

      <!-- Comments Form -->
      <div class="card my-4">
        <h5 class="card-header">Leave a Comment:</h5>
        <div class="card-body">
          <form>
            <div class="form-group">
              <textarea v-model="body" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>

      <!-- Single Comment -->
      <div class="media mb-4" v-for="(comment,index) in comments" :key="index">
        <img class="d-flex mr-3 rounded-circle" width="70px" :src="'/uploads/user_images/'+comment.user.profile_img" alt="">
        <div class="media-body">
          <h5 class="mt-0">{{comment.user.name}}</h5>
          {{comment.body}}
        </div>
      </div>

<!--      &lt;!&ndash; Comment with nested comments &ndash;&gt;-->
<!--      <div class="media mb-4">-->
<!--        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">-->
<!--        <div class="media-body">-->
<!--          <h5 class="mt-0">Commenter Name</h5>-->
<!--          Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.-->

<!--          <div class="media mt-4">-->
<!--            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">-->
<!--            <div class="media-body">-->
<!--              <h5 class="mt-0">Commenter Name</h5>-->
<!--              Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.-->
<!--            </div>-->
<!--          </div>-->

<!--          <div class="media mt-4">-->
<!--            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">-->
<!--            <div class="media-body">-->
<!--              <h5 class="mt-0">Commenter Name</h5>-->
<!--              Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.-->
<!--            </div>-->
<!--          </div>-->

<!--        </div>-->
<!--      </div>-->

    </div>

  </div>
</template>

<script>
export default {
  data(){
    return {
      post : '',
      body : '',
      post_id : '',
      comments : []
    }
  },
  created() {
    this.getPostDetails();
    this.updateToken();
  },
  methods :{
    getPostDetails(){
      axios.get('/api/post/'+this.$route.params.slug).then(res => {
        this.post = res.data;
        this.post_id = res.data.post_id;
        this.comments = res.data.comments;
      })
      .catch(error => console.log(error));
    },
    addComment(){
      axios.post('/api/add_comment',).then(res => {
        this.post = res.data;
        this.comments.unshift(res.data);
      })
          .catch(error => console.log(error));
    },
    updateToken(){
      let token = JSON.parse(localStorage.getItem('token'));
      this.$store.commit('setToken',token);
    }
  },
  computed:{
    isLogin(){
      return this.$store.getters.getToken;
    }
  }
}
</script>
