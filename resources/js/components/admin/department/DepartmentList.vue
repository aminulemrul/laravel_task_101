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
                <h3 class="cart-title">Departments</h3>
                <div
                  v-if="
                    user.role
                      ? user.role.permission.permission.departments.includes(
                          'add'
                        )
                      : false
                  "
                  class="card-tools"
                  style="position: absolute; top: 1rem; right: 1.5rem"
                >
                  <router-link
                    :to="{ name: 'DepartmentAdd' }"
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
                            ? user.role.permission.permission.departments.includes(
                                'add'
                              )
                            : false
                        "
                      >
                        Action
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="(department, index) in departments.data"
                      :key="department.id"
                    >
                      <td>{{ index + 1 }}</td>
                      <td>{{ department.name }}</td>

                      <td
                        v-if="
                          user.role
                            ? user.role.permission.permission.departments.includes(
                                'edit'
                              )
                            : false
                        "
                      >
                        <router-link
                          :to="{
                            name: 'DepartmentEdit',
                            params: { slug: department.slug },
                          }"
                          class="btn btn-sm btn-success"
                          >Edit</router-link
                        >
                        <button
                          class="btn btn-sm btn-danger"
                          @click.prevent="deleteDepartment(department.slug)"
                        >
                          Delete
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <template v-if="departments.last_page > 1">
                <pagination-component
                  :pagination="pagination"
                  :offset="3"
                  @paginate="departmentList()"
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
  name: "departmentList",
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
    departmentList() {
      this.$store.dispatch(
        "department/departmentList",
        this.pagination.current_page
      );
    },
    deleteDepartment(slug) {
      axios
        .get("/admin/delete-department/" + slug)
        .then((result) => {
          this.departmentList();
          Toast.fire({
            icon: "success",
            title: "Department Delete successfully",
          });
        })
        .catch((err) => {});
    },
    getUser() {
      this.$store.dispatch("user/getUser");
    },
  },
  created() {
    this.departmentList();
    this.getUser();
  },
  computed: {
    departments() {
      return this.$store.getters["department/departmentList"];
    },
    meta() {
      return {
        current_page: this.departments.current_page,
        last_page: this.departments.last_page,
        from: this.departments.from,
        to: this.departments.to,
        per_page: this.departments.per_page,
        total: this.departments.total,
        path: this.departments.path,
      };
    },
    set() {
      return (this.pagination = this.meta);
    },
    user() {
      return this.$store.getters["user/getUser"];
    },
  },
};
</script>

<style lang="scss" scoped>
</style>
