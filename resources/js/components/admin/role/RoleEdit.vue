<template>
  <div class="content-wrapper" style="min-height: 1203.6px">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"></a></li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Role</h3>
              </div>

              <form role="form" @submit.prevent="editRole">
                <div class="card-body">
                  <div class="form-group">
                    <label for="category_name">Roll Name</label>
                    <input
                      type="text"
                      class="form-control"
                      id="category_name"
                      v-model="form.name"
                    />
                    <small style="color: red" v-if="errors['name']">{{
                      errors["name"][0]
                    }}</small>
                  </div>
                </div>
                <!-- /.card-body -->

                <div
                  class="card-footer"
                  v-if="
                    user.role
                      ? user.role.permission.permission.roles.includes('edit')
                      : false
                  "
                >
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-md-3"></div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</template>

<script>
export default {
  name: "RoleEdit",
  data() {
    return {
      form: {
        name: "",
      },
      errors: {},
    };
  },
  methods: {
    role() {
      axios
        .get("/admin/edit-role/" + this.$route.params.slug)
        .then((result) => {
          this.form = result.data.role;
        })
        .catch((err) => {});
    },
    editRole() {
      axios
        .post("/admin/update-role", this.form)
        .then((result) => {
          Toast.fire({
            icon: "success",
            title: "Role Update successfully",
          });
          this.$router.push({ name: "RoleList" });
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
        });
    },
    getUser() {
      this.$store.dispatch("user/getUser");
    },
  },
  created() {
    this.role();
    this.getUser();
  },
  computed: {
    user() {
      return this.$store.getters["user/getUser"];
    },
  },
};
</script>

<style lang="scss" scoped>
</style>

