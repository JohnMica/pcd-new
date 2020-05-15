<script>
import { mapGetters } from "vuex";

export default {
  name: "Tableview",
  delimiters: ["${", "}"],
  components: {},
  data() {
    return {
      loading: true,
      isEmpty: false,
      isBordered: false,
      isStriped: true,
      isNarrowed: true,
      isHoverable: true,
      isFocusable: false,
      isLoading: false,
      hasMobileCards: true,
      isPaginated: true,
      isPaginationSimple: false,
      showDetailIcon: true,
      currentPage: 1,
      perPage: 10,
      sortField: "date",
      sortOrder: "desc",
      defaultSortDirection: "desc",
      selected: {}
    };
  },

  computed: {
    ...mapGetters({
      products: "allProducts",
      countries: "countries",
      categories: "categories",
      licences: "licences",
      sectors: "sectors"
    }),
    list() {
      return this.$store.state.filteredProducts;
    }
  },
  watch: {
    list(newValue, oldValue) {
      this.loading = true;
      setTimeout(() => {
        this.loading = false;
      }, 250);
    }
  },

  methods: {
    toggle(row) {
      this.$refs.table.toggleDetails(row);
    }
  }
};
</script>
