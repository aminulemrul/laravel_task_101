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
                <h3 class="card-title">Add Permission</h3>
              </div>

              <form role="form" @submit.prevent="addPermission">
                <div class="card-body">
                  <div class="form-group">
                    <label for="category_name">Role</label>
                    <select v-model="form.role_id" class="form-control">
                      <option value="">Select Role</option>
                      <option
                        :value="role.id"
                        v-for="role in roles"
                        :key="role.id"
                      >
                        {{ role.name }}
                      </option>
                    </select>
                    <small style="color: red" v-if="errors['role_id']">{{
                      errors["role_id"][0]
                    }}</small>
                  </div>

                  <div class="form-group">
                    <table class="table table-responsive table-striped">
                      <thead>
                        <tr>
                          <th>Module</th>
                          <th>List</th>
                          <th>Add</th>
                          <th>Edit</th>
                          <th>View</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Roles</td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.roles"
                              value="list"
                            />
                          </td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.roles"
                              value="add"
                            />
                          </td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.roles"
                              value="edit"
                            />
                          </td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.roles"
                              value="view"
                            />
                          </td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.roles"
                              value="delete"
                            />
                          </td>
                        </tr>

                        <tr>
                          <td>Permissions</td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.permissions"
                              value="list"
                            />
                          </td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.permissions"
                              value="add"
                            />
                          </td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.permissions"
                              value="edit"
                            />
                          </td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.permissions"
                              value="view"
                            />
                          </td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.permissions"
                              value="delete"
                            />
                          </td>
                        </tr>

                        <tr>
                          <td>Departments</td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.departments"
                              value="list"
                            />
                          </td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.departments"
                              value="add"
                            />
                          </td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.departments"
                              value="edit"
                            />
                          </td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.departments"
                              value="view"
                            />
                          </td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.departments"
                              value="delete"
                            />
                          </td>
                        </tr>

                        <tr>
                          <td>Works</td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.works"
                              value="list"
                            />
                          </td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.works"
                              value="add"
                            />
                          </td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.works"
                              value="edit"
                            />
                          </td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.works"
                              value="view"
                            />
                          </td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.works"
                              value="delete"
                            />
                          </td>
                        </tr>

                        <tr>
                          <td>Users</td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.users"
                              value="list"
                            />
                          </td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.users"
                              value="add"
                            />
                          </td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.users"
                              value="edit"
                            />
                          </td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.users"
                              value="view"
                            />
                          </td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.users"
                              value="delete"
                            />
                          </td>
                        </tr>

                        <tr>
                          <td>Assign Works</td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.assign_works"
                              value="list"
                            />
                          </td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.assign_works"
                              value="add"
                            />
                          </td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.assign_works"
                              value="edit"
                            />
                          </td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.assign_works"
                              value="view"
                            />
                          </td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="form.permission.assign_works"
                              value="delete"
                            />
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- /.card-body -->

                <div
                  class="card-footer"
                  v-if="
                    user.role
                      ? user.role.permission.permission.permissions.includes(
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
  name: "PermissionAdd",
  data() {
    return {
      form: {
        role_id: "",
        permission: {
          roles: [],
          permissions: [],
          departments: [],
          works: [],
          users: [],
          assign_works: [],
        },
      },

      errors: {},
    };
  },

  methods: {
    allRole() {
      this.$store.dispatch("role/allRole");
    },
    addPermission() {
      axios
        .post("/admin/add-permission", this.form)
        .then((result) => {
          this.$router.push({ name: "PermissionList" });
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
    this.allRole();
    this.getUser();
  },
  computed: {
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
