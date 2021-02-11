<template>
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"
          ><i class="fas fa-bars"></i
        ></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <router-link :to="{ name: 'AdminDashboard' }" class="nav-link"
          >Home</router-link
        >
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
        </a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <img
            src="/admin/images/default_avatar.png"
            style="height: 30px; width: 32px; margin-right: 6px; opacity: 0.8"
            alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3"
          />{{ user.name }}
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Account Setting</span>
          <div class="dropdown-divider"></div>
          <a href="javascript:void()" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> View Profile
          </a>

          <div class="dropdown-divider"></div>
          <router-link
            :to="{ name: 'AdminLogout' }"
            style="cursor: pointer"
            class="dropdown-item"
          >
            <i class="fas fa-lock mr-2"></i> Logout
          </router-link>
        </div>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  name: "AdminHeader",
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
