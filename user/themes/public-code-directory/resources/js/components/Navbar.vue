<script>
export default {
  name: "NavBar",
  data() {
    return {
      navIsActive: false
    };
  },
  methods: {
    toggleNav() {
      !this.navIsActive
        ? (this.navIsActive = true)
        : (this.navIsActive = false);
    }
  },
  beforeCreate() {
    this.$store.dispatch("fetchLinks");
  }
};
</script>
<style lang="sass">
.mr-2
  margin-right: 0.75rem
</style>
