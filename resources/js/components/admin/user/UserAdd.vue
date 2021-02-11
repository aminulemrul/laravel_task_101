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
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add User</h3>
              </div>

              <form role="form" @submit.prevent="addUser">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="category_name"
                          >Full Name <span style="color: red">*</span></label
                        >
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Enter Full Name"
                          v-model="form.name"
                        />
                        <small style="color: red" v-if="errors['name']">{{
                          errors["name"][0]
                        }}</small>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="category_name"
                          >Email <span style="color: red">*</span></label
                        >
                        <input
                          type="email"
                          class="form-control"
                          placeholder="Enter Email"
                          v-model="form.email"
                        />
                        <small style="color: red" v-if="errors['email']">{{
                          errors["email"][0]
                        }}</small>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="category_name"
                          >Phone <span style="color: red">*</span></label
                        >
                        <input
                          type="number"
                          class="form-control"
                          placeholder="Enter Phone"
                          v-model="form.phone"
                        />
                        <small style="color: red" v-if="errors['phone']">{{
                          errors["phone"][0]
                        }}</small>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="category_name">Address</label>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Enter Address"
                          v-model="form.address"
                        />
                        <small style="color: red" v-if="errors['address']">{{
                          errors["address"][0]
                        }}</small>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="category_name"
                          >Password <span style="color: red">*</span></label
                        >
                        <input
                          type="password"
                          class="form-control"
                          placeholder="Enter Password"
                          v-model="form.password"
                        />
                        <small style="color: red" v-if="errors['password']">{{
                          errors["password"][0]
                        }}</small>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="category_name"
                          >Confirm Password
                          <span style="color: red">*</span></label
                        >
                        <input
                          type="password"
                          class="form-control"
                          placeholder="Confirm Password"
                          v-model="form.password_confirmation"
                        />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="category_name"
                          >Role <span style="color: red">*</span></label
                        >

                        <select class="form-control" v-model="form.role_id">
                          <option disabled value="">Select Role</option>
                          <option
                            v-for="role in roles"
                            :key="role.id"
                            :value="role.id"
                          >
                            {{ role.name }}
                          </option>
                        </select>
                        <small style="color: red" v-if="errors['role_id']">{{
                          errors["role_id"][0]
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
                          <option disabled value="">Select Department</option>
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
                  </div>
                </div>
                <!-- /.card-body -->

                <div
                  class="card-footer"
                  v-if="
                    user.role
                      ? user.role.permission.permission.users.includes('add')
                      : false
                  "
                >
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>

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
  name: "UserAdd",
  data() {
    return {
      form: {
        role_id: "",
        department_id: "",
      },
      errors: {},
    };
  },

  methods: {
    addUser() {
      axios
        .post("/admin/add-user", this.form)
        .then((result) => {
          Toast.fire({
            icon: "success",
            title: "User Add successfully",
          });
          this.$router.push({ name: "UserList" });
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
        });
    },
    getUser() {
      this.$store.dispatch("user/getUser");
    },
    departmentList() {
      this.$store.dispatch("department/allDepartment");
    },
    allRole() {
      this.$store.dispatch("role/allRole");
    },
  },
  created() {
    this.departmentList();
    this.allRole();
    this.getUser();
  },
  computed: {
    departments() {
      return this.$store.getters["department/departmentList"];
    },
    roles() {
      return this.$store.getters["role/roleList"];
    },
    user() {
      return this.$store.getters["user/getUser"];
    },
  },
};
</script>

<style lang="scss" scoped>
</style>
