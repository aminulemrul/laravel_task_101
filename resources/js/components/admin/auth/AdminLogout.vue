<template></template>

<script>
export default {
  name: "AdminLogout",
  created() {
    localStorage.removeItem("admin_access_token");
    localStorage.removeItem("admin_data");
    Toast.fire({
      icon: "success",
      title: "Logged Out successfully",
    });
    this.$router.push({ name: "AdminLogin" });
  },
};
</script>

<style lang="scss" scoped>
</style>
