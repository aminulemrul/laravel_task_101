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
                <h3 class="card-title">Add User Work</h3>
              </div>

              <form role="form" @submit.prevent="addUserWork">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="category_name"
                          >Work <span style="color: red">*</span></label
                        >

                        <select
                          @change="workSet"
                          id="selectWork"
                          class="form-control"
                          v-model="form.work_id"
                        >
                          <option disabled value="">Select Work</option>
                          <option value="new_work">Add New Work</option>
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

                    <div
                      class="col-md-12"
                      id="newWorkform"
                      style="display: none"
                    >
                      <div class="form-group">
                        <label for="category_name"
                          >New Work <span style="color: red">*</span></label
                        >

                        <input class="form-control" v-model="form.name" />
                        <small style="color: red" v-if="errors['name']">{{
                          errors["name"][0]
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
                          @change="getUser"
                        >
                          <option value="" disabled>Select Department</option>
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
                          <option disabled value="">Select User</option>
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
                          'add'
                        )
                      : false
                  "
                >
                  <button type="submit" class="btn btn-primary">Submit</button>
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
      form: {
        work_id: "",
        department_id: "",
        user_id: "",
      },
      users: [],
      errors: {},
    };
  },

  methods: {
    workSet() {
      let value = this.form.work_id;
      if (value == "new_work") {
        $("#newWorkform").show();
      } else {
        $("#newWorkform").hide();
      }
    },
    getUser() {
      axios
        .get("/admin/get-department-user/" + this.form.department_id)
        .then((result) => {
          this.users = result.data.users;
        })
        .catch((err) => {});
    },
    departmentList() {
      this.$store.dispatch("department/allDepartment");
    },
    allWork() {
      this.$store.dispatch("work/allWork");
    },
    addUserWork() {
      axios
        .post("/admin/add-user-work", this.form)
        .then((result) => {
          if (result.data == "error") {
            Toast.fire({
              icon: "error",
              title: "Already assigned this work for this user",
            });
          } else {
            Toast.fire({
              icon: "success",
              title: "User Work Add successfully",
            });
            this.$router.push({ name: "UserWorkList" });
          }
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
        });
    },
    getAuthUser() {
      this.$store.dispatch("user/getUser");
    },
  },
  created() {
    this.departmentList();
    this.allWork();
    this.getAuthUser();
  },
  computed: {
    departments() {
      return this.$store.getters["department/departmentList"];
    },
    works() {
      return this.$store.getters["work/workList"];
    },
    user() {
      return this.$store.getters["user/getUser"];
    },
  },
};
</script>

<style lang="scss" scoped>
</style>
