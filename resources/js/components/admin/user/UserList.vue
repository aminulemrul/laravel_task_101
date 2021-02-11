<template>
  <div class="content-wrapper" style="min-height: 1202.48px">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"></a></li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="cart-title">Users</h3>
                <div
                  v-if="
                    auth_user.role
                      ? auth_user.role.permission.permission.users.includes(
                          'add'
                        )
                      : false
                  "
                  class="card-tools"
                  style="position: absolute; top: 1rem; right: 1.5rem"
                >
                  <router-link
                    :to="{ name: 'UserAdd' }"
                    class="btn btn-warning"
                  >
                    Add <i class="fas fa-plus"></i>
                  </router-link>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th width="5%">SL</th>
                      <th width="10%">Name</th>
                      <th width="10%">Email</th>
                      <th width="10%">Phone</th>
                      <th width="10%">Status</th>
                      <th width="25%">Department(Role)</th>

                      <th
                        v-if="
                          auth_user.role
                            ? auth_user.role.permission.permission.users.includes(
                                'edit'
                              )
                            : false
                        "
                        width="35%"
                      >
                        Action
                      </th>
                    </tr>
                  </thead>
                  <tbody v-if="users.data">
                    <tr v-for="(user, index) in users.data" :key="user.id">
                      <td>{{ index + 1 }}</td>
                      <td>{{ user.name }}</td>
                      <td>{{ user.email }}</td>
                      <td>{{ user.phone }}</td>
                      <td v-if="user.status == 1">
                        <span class="badge bg-success">active</span>
                      </td>
                      <td v-else>
                        <span class="badge bg-danger">inactive</span>
                      </td>
                      <td v-if="user.department">
                        {{ user.department.name }}({{ user.role.name }})
                      </td>
                      <td v-else>({{ user.role.name }})</td>

                      <td
                        v-if="
                          auth_user.role
                            ? auth_user.role.permission.permission.users.includes(
                                'edit'
                              )
                            : false
                        "
                      >
                        <router-link
                          :to="{
                            name: 'UserEdit',
                            params: { slug: user.slug },
                          }"
                          class="btn btn-sm btn-success"
                          >Edit</router-link
                        >
                        <button
                          class="btn btn-sm btn-danger"
                          @click.prevent="deleteUser(user.slug)"
                        >
                          Delete
                        </button>
                        <button
                          @click.prevent="userInactive(user.id)"
                          v-if="user.status == 1"
                          class="btn btn-sm btn-warning"
                        >
                          Inactive
                        </button>
                        <button
                          @click.prevent="userActive(user.id)"
                          v-else
                          class="btn btn-sm btn-info"
                        >
                          Active
                        </button>
                      </td>
                    </tr>
                  </tbody>
                  <tbody v-else>
                    <tr>
                      <td colspan="9" class="text-center">
                        <i class="far fa-folder-open"></i> No Data has been
                        Found
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <template v-if="users.last_page > 1">
                <pagination-component
                  :pagination="pagination"
                  :offset="3"
                  @paginate="userList()"
                ></pagination-component>
              </template>

              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
</template>

<script>
import PaginationComponent from "../inc/PaginationComponent";
export default {
  name: "UserList",
  data() {
    return {
      pagination: {
        current_page: 1,
      },
    };
  },
  components: {
    PaginationComponent,
  },

  methods: {
    userList() {
      this.$store.dispatch("user/userList", this.pagination.current_page);
    },
    deleteUser(slug) {
      axios
        .get("/admin/delete-user/" + slug)
        .then((result) => {
          this.userList();
          Toast.fire({
            icon: "success",
            title: "User Delete successfully",
          });
        })
        .catch((err) => {});
    },
    userInactive(id) {
      let r = confirm("Are you sure to inactive this user!");
      if (r == true) {
        axios
          .get("/admin/inactive-user/" + id)
          .then((result) => {
            this.userList();
            Toast.fire({
              icon: "success",
              title: "User Inactive successfully",
            });
          })
          .catch((err) => {});
      }
    },
    userActive(id) {
      let r = confirm("Are you sure to active this user!");
      if (r == true) {
        axios
          .get("/admin/active-user/" + id)
          .then((result) => {
            this.userList();
            Toast.fire({
              icon: "success",
              title: "User active successfully",
            });
          })
          .catch((err) => {});
      }
    },
    getUser() {
      this.$store.dispatch("user/getUser");
    },
  },
  created() {
    this.userList();
    this.getUser();
  },
  computed: {
    users() {
      return this.$store.getters["user/userList"];
    },
    auth_user() {
      return this.$store.getters["user/getUser"];
    },
    meta() {
      return {
        current_page: this.users.current_page,
        last_page: this.users.last_page,
        from: this.users.from,
        to: this.users.to,
        per_page: this.users.per_page,
        total: this.users.total,
        path: this.users.path,
      };
    },
    set() {
      return (this.pagination = this.meta);
    },
  },
};
</script>

<style lang="scss" scoped>
</style>
