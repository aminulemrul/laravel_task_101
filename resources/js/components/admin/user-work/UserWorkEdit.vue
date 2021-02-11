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
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit User Work</h3>
              </div>

              <form role="form" @submit.prevent="editUserWork">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="category_name"
                          >Work <span style="color: red">*</span></label
                        >

                        <select
                          id="selectWork"
                          class="form-control"
                          v-model="form.work_id"
                        >
                          <option
                            v-for="work in works"
                            :key="work.id"
                            :value="work.id"
                          >
                            {{ work.name }}
                          </option>
                        </select>
                        <small style="color: red" v-if="errors['work_id']">{{
                          errors["work_id"][0]
                        }}</small>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="category_name"
                          >Department <span style="color: red">*</span></label
                        >
                        <select
                          class="form-control"
                          v-model="form.department_id"
                        >
                          <option
                            v-for="department in departments"
                            :key="department.id"
                            :value="department.id"
                          >
                            {{ department.name }}
                          </option>
                        </select>
                        <small
                          style="color: red"
                          v-if="errors['department_id']"
                          >{{ errors["department_id"][0] }}</small
                        >
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="category_name"
                          >Assign To <span style="color: red">*</span></label
                        >
                        <select class="form-control" v-model="form.user_id">
                          <option
                            v-for="user in users"
                            :key="user.id"
                            :value="user.id"
                          >
                            {{ user.name }}
                          </option>
                        </select>

                        <small style="color: red" v-if="errors['user_id']">{{
                          errors["user_id"][0]
                        }}</small>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div
                  class="card-footer"
                  v-if="
                    user.role
                      ? user.role.permission.permission.assign_works.includes(
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
          <div class="col-md-2"></div>

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
  name: "UserWorkAdd",
  data() {
    return {
      form: {},
      errors: {},
    };
  },

  methods: {
    departmentList() {
      this.$store.dispatch("department/allDepartment");
    },
    allWork() {
      this.$store.dispatch("work/allWork");
    },
    allUser() {
      this.$store.dispatch("user/allUser");
    },

    user_work() {
      axios
        .get("/admin/edit-user-work/" + this.$route.params.id)
        .then((result) => {
          this.form = result.data.user_work;
        })
        .catch((err) => {});
    },
    editUserWork() {
      axios
        .post("/admin/update-user-work", this.form)
        .then((result) => {
          Toast.fire({
            icon: "success",
            title: "User Work Update successfully",
          });
          this.$router.push({ name: "UserWorkList" });
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
    this.departmentList();
    this.allWork();
    this.allUser();
    this.user_work();
    this.getUser();
  },
  computed: {
    departments() {
      return this.$store.getters["department/departmentList"];
    },
    works() {
      return this.$store.getters["work/workList"];
    },
    users() {
      return this.$store.getters["user/userList"];
    },
    user() {
      return this.$store.getters["user/getUser"];
    },
  },
};
</script>

<style lang="scss" scoped>
</style>
