<template>


  <!-- Categories Widget -->
  <div class="card my-4">
    <h5 class="card-header">Categories</h5>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-6">
          <ul class="list-unstyled mb-0" v-if="categories.length > 1">
            <li v-for="(category,index) in categories" :key="index">
               <router-link :to="'/category/'+category.slug+'/posts'">{{category.name}}</router-link>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
export default {
name: "Category",
  data(){
  return {
    categories : []
  }
  },
  mounted() {
   this.getCategory();
  },
  methods : {
    getCategory(){
      axios.get('api/category')
      .then(res => {
        this.categories = res.data
      }).catch(error =>{
        console.log(error)
      })
    }
  }
}
</script>

<style scoped>

</style>