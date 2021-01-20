<template>
  <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
       aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Login</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="login-form">
            <form method="post" @submit.prevent="submit">
              <h2 class="text-center">Log in</h2>
              <div class="form-group">
                <input type="text" name="email" :class="{ 'is-invalid': $v.email.$error }"
                       v-model.trim="$v.email.$model" class="form-control"
                       placeholder="Username" required="required">
                <span class="error text-danger" v-if="$v.email.$dirty && !$v.email.required">email is required</span>
                <span class="error text-danger" v-if="$v.email.$dirty && !$v.email.email">email is not correct</span>
              </div>
              <div class="form-group">
                <input type="password" name="password" :class="{ 'is-invalid': $v.password.$error }"
                       v-model.trim="$v.password.$model" class="form-control"
                       placeholder="Password" required="required">
                <span class="error text-danger"
                      v-if="$v.password.$dirty && !$v.password.required">password is required</span>
                <span class="error text-danger"
                      v-if="$v.password.$dirty && !$v.password.minLength">password must be
                  {{ $v.password.$params.minLength.min }} character at least </span>
              </div>
              <div class="form-group">
                <span v-show="status!==null" class="text-danger"> {{status}} </span>
                <button type="submit" :disabled="$v.$invalid" class="btn btn-primary btn-block">Log in</button>
              </div>
              <div class="clearfix">
                <a href="#" class="pull-right">Forgot Password?</a>
              </div>
            </form>
            <p class="text-center"><a class="switch-toregister-modal" href="#">Create an Account</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {email, minLength, required} from 'vuelidate/lib/validators'

export default {
  name: "login",
  data() {
    return {
      email: '',
      password: '',
      status : null
    }
  },
  validations: {
    email: {
      required, email
    },
    password: {
      required, minLength: minLength(6)
    }
  },
  methods: {
    submit() {
      this.$v.$touch()
      if (this.$v.$invalid) {
        alert('please try again');
      } else {
        // do your submit logic here
        setTimeout(() => {
          let {name, email, password} = this;
          this.$store.dispatch('loginUser', {name, email, password}).then(res=>{
            if(this.$store.getters.getToken){
               window.location.reload()
            }
            else{
              this.status = 'Oops please try again :(';
            }
          }).catch(err=>{
            console.log('error' + err);
          });
        }, 500)
      }
    }
  }
}
</script>

<style scoped>

</style>