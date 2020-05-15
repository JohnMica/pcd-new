<script>
export default {
  name: "Totalproducts",
  computed: {
    totalUsers() {
      return this.$store.state.users.length;
    },
    totalProducts() {
      return this.$store.state.products.length;
    }
  }
};
</script>
