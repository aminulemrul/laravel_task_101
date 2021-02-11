<template>
  <div id="admin_master">
    <div class="wrapper">
      <template v-if="$route.name !== 'AdminLogin'">
        <!-- Navbar -->
        <admin-header></admin-header>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <admin-sidebar></admin-sidebar>
      </template>

      <!-- Content Wrapper. Contains page content -->
      <router-view></router-view>
      <!-- /.content-wrapper -->
      <!-- <admin-footer v-if="$route.name !== 'AdminLogin'"></admin-footer> -->
    </div>
  </div>
</template>

<script>
import AdminHeader from "./inc/AdminHeader";
import AdminFooter from "./inc/AdminFooter";
import AdminSidebar from "./inc/AdminSidebar";
export default {
  name: "AdminMaster",
  components: {
    AdminHeader,
    AdminFooter,
    AdminSidebar,
  },
};
</script>

<style lang="scss" scoped>
</style>
