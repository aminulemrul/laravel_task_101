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
                <h3 class="cart-title">Roles</h3>
                <div
                  v-if="
                    user.role
                      ? user.role.permission.permission.roles.includes('add')
                      : false
                  "
                  class="card-tools"
                  style="position: absolute; top: 1rem; right: 1.5rem"
                >
                  <router-link
                    :to="{ name: 'RoleAdd' }"
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
                      <th>Name</th>
                      <th
                        v-if="
                          user.role
                            ? user.role.permission.permission.roles.includes(
                                'edit'
                              )
                            : false
                        "
                      >
                        Action
                      </th>
                    </tr>
                  </thead>
                  <tbody v-if="roles.data">
                    <tr v-for="(role, index) in roles.data" :key="role.id">
                      <td>{{ index + 1 }}</td>
                      <td>{{ role.name }}</td>

                      <td
                        v-if="
                          user.role
                            ? user.role.permission.permission.roles.includes(
                                'edit'
                              )
                            : false
                        "
                      >
                        <router-link
                          :to="{
                            name: 'RoleEdit',
                            params: { slug: role.slug },
                          }"
                          class="btn btn-sm btn-success"
                          >Edit</router-link
                        >
                      </td>
                    </tr>
                  </tbody>
                  <tbody v-else>
                    <tr>
                      <td colspan="3" class="text-center">
                        <i class="far fa-folder-open"></i> No Data has been
                        Found
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <template v-if="roles.last_page > 1">
                <pagination-component
                  :pagination="pagination"
                  :offset="3"
                  @paginate="roleList()"
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
  name: "RoleList",
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
    roleList() {
      this.$store.dispatch("role/roleList", this.pagination.current_page);
    },

    getUser() {
      this.$store.dispatch("user/getUser");
    },
  },
  created() {
    this.roleList();
    this.getUser();
  },
  computed: {
    roles() {
      return this.$store.getters["role/roleList"];
    },
    user() {
      return this.$store.getters["user/getUser"];
    },
    meta() {
      return {
        current_page: this.roles.current_page,
        last_page: this.roles.last_page,
        from: this.roles.from,
        to: this.roles.to,
        per_page: this.roles.per_page,
        total: this.roles.total,
        path: this.roles.path,
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
