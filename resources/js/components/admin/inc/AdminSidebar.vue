<template>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <router-link :to="{ name: 'AdminDashboard' }" class="brand-link">
      <img
        src="dist/img/AdminLTELogo.png"
        alt="AdminLTE Logo"
        class="brand-image img-circle elevation-3"
        style="opacity: 0.8"
      />
      <span class="brand-text font-weight-light" v-if="user.role">{{
        user.role.name
      }}</span>
    </router-link>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img
            src="/admin/images/default_avatar.png"
            class="img-circle elevation-2"
            alt="User Image"
          />
        </div>
        <div class="info">
          <a href="javascript:void()" class="d-block">{{ user.name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <router-link :to="{ name: 'AdminDashboard' }" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </router-link>
          </li>

          <li
            class="nav-item has-treeview"
            v-if="
              user.role
                ? user.role.permission.permission.roles.includes('list')
                : false
            "
          >
            <router-link :to="{ name: 'RoleList' }" class="nav-link">
              <i class="nav-icon fa fa-tasks"></i>
              <p>Role</p>
            </router-link>
          </li>

          <li
            class="nav-item has-treeview"
            v-if="
              user.role
                ? user.role.permission.permission.permissions.includes('list')
                : false
            "
          >
            <router-link :to="{ name: 'PermissionList' }" class="nav-link">
              <i class="nav-icon fab fa-empire"></i>
              <p>Permission</p>
            </router-link>
          </li>
          <li
            class="nav-item has-treeview"
            v-if="
              user.role
                ? user.role.permission.permission.departments.includes('list')
                : false
            "
          >
            <router-link :to="{ name: 'DepartmentList' }" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>Department</p>
            </router-link>
          </li>

          <li
            class="nav-item has-treeview"
            v-if="
              user.role
                ? user.role.permission.permission.users.includes('list')
                : false
            "
          >
            <router-link :to="{ name: 'UserList' }" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>Users</p>
            </router-link>
          </li>
          <li
            class="nav-item has-treeview"
            v-if="
              user.role
                ? user.role.permission.permission.works.includes('list')
                : false
            "
          >
            <router-link :to="{ name: 'WorkList' }" class="nav-link">
              <i class="nav-icon fas fa-business-time"></i>
              <p>Work</p>
            </router-link>
          </li>
          <li
            class="nav-item has-treeview"
            v-if="
              user.role
                ? user.role.permission.permission.assign_works.includes('list')
                : false
            "
          >
            <router-link :to="{ name: 'UserWorkList' }" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <template v-if="user.role ? user.role_id == 1 : false">
                <p>Assign Work</p>
              </template>
              <template v-else-if="user.role ? user.role_id == 2 : false">
                <p>Department Work</p>
              </template>
              <template v-else>
                <p>My Work</p>
              </template>
            </router-link>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</template>

<script>
export default {
  name: "AdminSidebar",
  data() {
    return {};
  },

  methods: {
    getUser() {
      this.$store.dispatch("user/getUser");
    },
  },
  created() {
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
