<template>
  <div id="admin_login" class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="javascript:void()"> <b>Admin</b> </a>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Sign in to acount to see dashboard</p>

          <form @submit.prevent="adminLogin">
            <div class="input-group mb-3">
              <input
                type="email"
                class="form-control"
                v-model="form.email"
                placeholder="Email"
              />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <small style="color: red" v-if="errors['email']">{{
              errors["email"][0]
            }}</small>
            <div class="input-group mb-3">
              <input
                type="password"
                class="form-control"
                placeholder="Password"
                v-model="form.password"
              />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <small style="color: red" v-if="errors['password']">{{
              errors["password"][0]
            }}</small>
            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <!-- <input type="checkbox" id="remember" />
                  <label for="remember">Remember Me</label>-->
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">
                  Sign In
                </button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <!-- <div class="social-auth-links text-center mb-3">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-primary">
              <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
            </a>
            <a href="#" class="btn btn-block btn-danger">
              <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
            </a>
          </div>-->
          <!-- /.social-auth-links -->

          <!-- <p class="mb-1">
            <a href="forgot-password.html">I forgot my password</a>
          </p>
          <p class="mb-0">
            <a href="register.html" class="text-center">Register a new membership</a>
          </p>-->
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "AdminLogin",
  data() {
    return {
      form: {
        email: "",
        password: "",
      },
      errors: {},
    };
  },
  methods: {
    adminLogin() {
      axios
        .post("/api/auth/login", this.form)
        .then((result) => {
          if (result.data == "error") {
            Toast.fire({
              icon: "error",
              title: "Email or Password Not Valid",
            });
          } else if (result.data == "inactive") {
            Toast.fire({
              icon: "error",
              title: "Your account is deactive, Please contact with admin",
            });
          } else {
            localStorage.setItem(
              "admin_access_token",
              result.data.admin_access_token
            );
            localStorage.setItem(
              "admin_data",
              JSON.stringify(result.data.admin_data)
            );
            Toast.fire({
              icon: "success",
              title: "Logged In successfully",
            });
            this.$router.push({ name: "AdminDashboard" });
          }
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
        });
    },
  },
};
</script>

<style lang="scss" scoped>
</style>
