<script>
import { mapGetters } from "vuex";
export default {
  name: "SidebarFilters",
  delimiters: ["${", "}"],
  data() {
    return {
      name: "",
      country: "",
      checkedSectors: [],
      checkedCategories: [],
      checkedLicences: [],
      checkedUsers: [],
      checkedLang: [],
      selected: null
    };
  },
  computed: {
    filteredDataArray() {
      return this.countries.filter(option => {
        return (
          option
            .toString()
            .toLowerCase()
            .indexOf(this.country.toLowerCase()) >= 0
        );
      });
    },
    productNames() {
      let arr = [];
      this.allProducts.map(el => {
        arr.push(el.name);
      });
      return arr;
    },
    filteredProductNames() {
      return this.productNames.filter(option => {
        return (
          option
            .toString()
            .toLowerCase()
            .indexOf(this.name.toLowerCase()) >= 0
        );
      });
    },
    dataToSend() {
      return {
        name: this.name,
        countries: this.country,
        sectors: this.checkedSectors,
        categories: this.checkedCategories,
        licences: this.checkedLicences,
        users: this.checkedUsers,
        languages: this.checkedLang,
        selectedProd: this.selected
      };
    },
    filtersApplied() {
      return (
        this.checkedSectors.length > 0 ||
        this.checkedCategories.length > 0 ||
        this.checkedLicences.length > 0 ||
        this.checkedUsers.length > 0 ||
        this.checkedLang.length > 0 ||
        this.name.length > 0 ||
        this.country.length > 0
      );
    },
    ...mapGetters({
      countries: "countries",
      sectors: "sectors",
      allProducts: "allProducts",
      categories: "categories",
      licences: "licences",
      users: "users",
      languages: "languages"
    })
  },
  methods: {
    toggleCategs() {
      if (this.checkedCategories.length < this.categories.length) {
        this.checkedCategories = this.categories;
      } else {
        this.checkedCategories = [];
      }
      this.updateFilteredItems();
    },
    toggleSectors() {
      if (this.checkedSectors.length < this.sectors.length) {
        this.checkedSectors = this.sectors;
      } else {
        this.checkedSectors = [];
      }
      this.updateFilteredItems();
    },
    toggleLicences() {
      if (this.checkedLicences.length < this.licences.length) {
        this.checkedLicences = this.licences;
      } else {
        this.checkedLicences = [];
      }
      this.updateFilteredItems();
    },
    toggleUsers() {
      if (this.checkedUsers.length < this.users.length) {
        this.checkedUsers = this.users;
      } else {
        this.checkedUsers = [];
      }
      this.updateFilteredItems();
    },
    toggleLangs() {
      if (this.checkedLang.length < this.languages.length) {
        this.checkedLang = this.languages;
      } else {
        this.checkedLang = [];
      }
      this.updateFilteredItems();
    },
    clearAllFilters() {
      this.name = "";
      this.country = "";
      this.checkedSectors = [];
      this.checkedCategories = [];
      this.checkedLicences = [];
      this.checkedUsers = [];
      this.checkedLang = [];
      this.selected = null;
      this.resetItems();
    },
    updateFilteredItems() {
      this.$store.commit("updateFilteredProducts", this.dataToSend);
    },
    resetItems() {
      this.$store.commit("resetProducts");
    }
  },
  mounted() {}
};
</script>
