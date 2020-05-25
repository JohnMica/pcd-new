<script>
export default {
  name: "MobileFilters",
  delimiters: ["${", "}"],
  data() {
    return {
      isComponentModalActive: false
    };
  },
  components: {
    SidebarFilters: () => import("./Sidebar")
  },
  computed: {},
  methods: {
    saveFilters() {
      this.$emit("saveFilters", filters);
    }
  },
  mounted() {}
};
</script>
