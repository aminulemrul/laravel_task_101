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
                <h3 class="card-title">Edit Department</h3>
              </div>

              <form role="form" @submit.prevent="editDepartment">
                <div class="card-body">
                  <div class="form-group">
                    <label for="category_name">Department Name</label>
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
                      ? user.role.permission.permission.departments.includes(
                          'edit'
                        )
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
  name: "DepartmentEdit",
  data() {
    return {
      form: {
        name: "",
      },
      errors: {},
    };
  },
  methods: {
    department() {
      axios
        .get("/admin/edit-department/" + this.$route.params.slug)
        .then((result) => {
          this.form = result.data.department;
        })
        .catch((err) => {});
    },
    editDepartment() {
      axios
        .post("/admin/update-department", this.form)
        .then((result) => {
          Toast.fire({
            icon: "success",
            title: "Department Update successfully",
          });
          this.$router.push({ name: "DepartmentList" });
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
    this.department();
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

