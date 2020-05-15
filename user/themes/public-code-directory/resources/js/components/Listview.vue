<script>
import { mapGetters } from "vuex";
export default {
  name: "Listview",
  data() {
    return {
      loading: true,
      list: null
    };
  },
  computed: {
    ...mapGetters({
      products: "allProducts",
      countries: "countries",
      categories: "categories",
      licences: "licences",
      sectors: "sectors",
      filteredProducts: "filteredProducts"
    })
  },
  mounted() {
    setTimeout(() => {
      this.loading = false;
    }, 200);
    this.$on("showHide", (name, value) => {
      this.$store.commit("showHideMore", { name, value });
    });
  },
  methods: {}
};
</script>
