<template>
  <div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
       aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Register</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="login-form">
            <form method="post" @submit.prevent="submit">
              <h2 class="text-center">Create New Account</h2>
              <div class="form-group">
                <input type="text" name="name" :class="{ 'is-invalid': $v.name.$error}" class="form-control"
                       v-model.trim="$v.name.$model" placeholder="name"
                       required="required">
                <span class="error text-danger" v-if="$v.name.$dirty && !$v.name.required">user name is required</span>
              </div>
              <div class="form-group ">
                <input type="email" name="email" :class="{ 'is-invalid': $v.email.$error }" class="form-control "
                       v-model.trim="$v.email.$model" placeholder="email"
                       required="required">
                <span class="error text-danger" v-if="$v.email.$dirty && !$v.email.required">email is required</span>
                <span class="error text-danger" v-if="$v.email.$dirty && !$v.email.email">email is not correct</span>
              </div>

              <div class="form-group">
                <input type="password" name="password" :class="{ 'is-invalid': $v.password.$error }"
                       class="form-control" v-model.trim="$v.password.$model" placeholder="Password"
                       required="required">
                <span class="error text-danger"
                      v-if="$v.password.$dirty && !$v.password.required">password is required</span>
                <span class="error text-danger"
                      v-if="$v.password.$dirty && !$v.password.minLength">password must be
                  {{ $v.password.$params.minLength.min }} character at least </span>
              </div>

              <div class="form-group">
                <input type="password" :class="{ 'is-invalid': $v.password_confirmation.$error }"
                       name="password_confirmation" class="form-control" v-model.trim="$v.password_confirmation.$model"
                       placeholder="Password repeated"
                       required="required">
                <span class="text-danger" v-if="$v.password_confirmation.$dirty && !$v.password_confirmation.required">password is required</span>
                <span class="text-danger"
                      v-if="$v.password_confirmation.$dirty && !$v.password_confirmation.sameAsPassword">
                password confirmation not same as  password</span>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" :disabled="$v.$invalid">Create Account</button>
              </div>
              <div class="clearfix">
                <a href="#" class="pull-right">Forgot Password?</a>
              </div>
            </form>
            <p class="text-center">having account ?
              <strong class="switch-tologin-modal"><a href="#">Login</a></strong>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {email, minLength, required, sameAs} from 'vuelidate/lib/validators'

export default {
  name: "register",
  data() {
    return {
      name: '',
      email: '',
      password: '',
      password_confirmation: ''
    }

  },
  mounted() {
  },
  validations: {
    name: {
      required,
    },
    email: {
      required, email
    },
    password: {
      required,
      minLength: minLength(6)
    },
    password_confirmation: {
      required,
      sameAsPassword: sameAs('password')
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
          this.$store.dispatch('registerUser', {name, email, password}).then(res =>{
            if(this.$store.getters.getToken){
              window.location.reload()
            }
          });
        }, 500)
      }
    }
  }
}
</script>

<style scoped>

</style>