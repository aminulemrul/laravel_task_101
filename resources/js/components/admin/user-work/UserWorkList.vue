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
                <template v-if="user.role ? user.role_id == 1 : false">
                  <h3 class="cart-title">User Works</h3>
                </template>
                <template v-else-if="user.role ? user.role_id == 2 : false">
                  <h3 class="cart-title">Department Works</h3>
                </template>
                <template v-else>
                  <h3 class="cart-title">My Works</h3>
                </template>

                <div
                  v-if="
                    user.role
                      ? user.role.permission.permission.assign_works.includes(
                          'add'
                        )
                      : false
                  "
                  class="card-tools"
                  style="position: absolute; top: 1rem; right: 1.5rem"
                >
                  <router-link
                    :to="{ name: 'UserWorkAdd' }"
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
                      <th>SL</th>
                      <th>Work Name</th>
                      <th>User Name</th>
                      <th>Department</th>
                      <th
                        v-if="
                          user.role
                            ? user.role.permission.permission.assign_works.includes(
                                'edit'
                              ) ||
                              user.role.permission.permission.assign_works.includes(
                                'delete'
                              )
                            : false
                        "
                      >
                        Action
                      </th>
                    </tr>
                  </thead>
                  <tbody v-if="user_works">
                    <tr
                      v-for="(user_work, index) in user_works"
                      :key="user_work.id"
                    >
                      <td>{{ index + 1 }}</td>
                      <td v-if="user_work.work">{{ user_work.work.name }}</td>
                      <td v-if="user_work.user">{{ user_work.user.name }}</td>
                      <td v-if="user_work.department">
                        {{ user_work.department.name }}
                      </td>

                      <td
                        v-if="
                          user.role
                            ? user.role.permission.permission.assign_works.includes(
                                'edit'
                              ) ||
                              user.role.permission.permission.assign_works.includes(
                                'delete'
                              )
                            : false
                        "
                      >
                        <template
                          v-if="
                            user.role
                              ? user.role.permission.permission.assign_works.includes(
                                  'edit'
                                )
                              : false
                          "
                        >
                          <router-link
                            :to="{
                              name: 'UserWorkEdit',
                              params: { id: user_work.id },
                            }"
                            class="btn btn-sm btn-success"
                            >Edit</router-link
                          >
                        </template>
                        <template
                          v-if="
                            user.role
                              ? user.role.permission.permission.assign_works.includes(
                                  'delete'
                                )
                              : false
                          "
                        >
                          <button
                            class="btn btn-sm btn-danger"
                            @click.prevent="deleteUserWork(user_work.id)"
                          >
                            Delete
                          </button>
                        </template>
                      </td>
                    </tr>
                  </tbody>
                  <tbody v-else>
                    <tr>
                      <td colspan="5" class="text-center">
                        <i class="far fa-folder-open"></i> No Data has been
                        Found
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

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
export default {
  name: "UserWorkList",
  data() {
    return {};
  },

  methods: {
    userWorkList() {
      this.$store.dispatch("work/userWorkList");
    },
    getUser() {
      this.$store.dispatch("user/getUser");
    },
    deleteUserWork(id) {
      axios
        .get("/admin/delete-user-work/" + id)
        .then((result) => {
          this.userWorkList();
          Toast.fire({
            icon: "success",
            title: "User Work Delete successfully",
          });
        })
        .catch((err) => {});
    },
  },
  created() {
    this.userWorkList();
    this.getUser();
  },
  computed: {
    user_works() {
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
