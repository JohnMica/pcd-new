<script>
import { mapGetters } from "vuex";
import L, { latLng } from "leaflet";
import { LMap, LTileLayer, LMarker, LPopup } from "vue2-leaflet";
import "leaflet/dist/leaflet.css";

// import { Icon } from "leaflet";

// delete Icon.Default.prototype._getIconUrl;
// Icon.Default.mergeOptions({
//   iconRetinaUrl:
//     "/pcd/user/themes/public-code-directory/dist/images/vendor/leaflet/dist/marker-icon-2x.png",
//   iconUrl:
//     "/pcd/user/themes/public-code-directory/dist/images/vendor/leaflet/dist/marker-icon.png",
//   shadowUrl:
//     "/pcd/user/themes/public-code-directory/dist/images/vendor/leaflet/dist/marker-shadow.png"
// });

export default {
  name: "Worldmap",
  data() {
    return {
      zoom: 1,
      center: [51.5285582, -0.2416811],
      url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
      locations: [],
      minZoom: 1,
      maxZoom: 13,
      showObjectMap: false,
      selectedMapObj: {},
      showMore: false,
    };
  },
  computed: {
    ...mapGetters({
      products: "allProducts",
      countries: "countries",
      categories: "categories",
      sectors: "sectors",
      users: "users",
      languages: "languages",
    }),

    list() {
      return this.$store.state.filteredProducts;
    },
  },
  components: {
    LMap,
    LTileLayer,
    LMarker,
    LPopup,
  },
  watch: {
    list(newValue, oldValue) {
      let loadingComponent = this.$buefy.loading.open({
        container: this.$refs.mapWrapper.$el,
      });
      setTimeout(() => {
        loadingComponent.close();
        this.makeLocations();
        this.$refs.map.mapObject._onResize();
      }, 300);
    },
  },
  methods: {
    makeLocations() {
      this.locations = [];
      for (let index = 0; index < this.list.length; index++) {
        this.list[index].users.forEach((user) => {
          if (user.user_name !== "") {
            this.locations.push({
              id: index,
              position: latLng(
                user.user_geolocation.lat,
                user.user_geolocation.long
              ),
              url: user.user_url,
              logo: user.user_logo_url ? user.user_logo_url : "",
              name: user.user_name,
              attribution: `<div class='is-flex is-column has-text-centered'><img src='${user.user_logo_url}' class='small-logo'/>  ${user.user_name}</div>  `,
            });
          }
        });
      }
    },
    udpateSelectedMapObj(marker) {
      this.showObjectMap = false;
      Object.assign(
        this.selectedMapObj,
        this.list.filter((el) =>
          el.users.some((item) => item.user_name === marker.name)
        )[0]
      );
      this.showObjectMap = true;
    },
    removeSelection(marker) {
      this.showObjectMap = false;
      if (this.selectedMapObj.user_name === marker.name) {
        this.selectedMapObj = null;
      } else {
        return;
      }
    },
  },
  mounted() {
    this.$nextTick(() => {
      let loadingComponent = this.$buefy.loading.open({
        container: this.$refs.mapWrapper.$el,
      });
      setTimeout(() => {
        loadingComponent.close();
        this.makeLocations();
        this.$refs.map.mapObject._onResize();
      }, 500);
    });
  },
};
</script>
