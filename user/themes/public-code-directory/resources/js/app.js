import 'babel-polyfill'
import store from './store'
import Buefy from 'buefy'
import './vee-validate'
import NavBar from './components/NavBar.vue'
import Listview from './components/Listview.vue'
import Tableview from './components/Tableview.vue'
import Totalproducts from './components/Totalproducts.vue'
import Worldmap from './components/Worldmap.vue'
import SidebarFilters from './components/Sidebar.vue'
import Progressteps from './components/Progressteps.vue'

window.Vue = require('vue')

Vue.filter('capitalize', function(value) {
  if (!value) return ''
  value = value.toString()
  return value.charAt(0).toUpperCase() + value.slice(1)
})
Vue.filter('truncate', function(text, stop, clamp) {
  return text.slice(0, stop) + (stop < text.length ? clamp || '...' : '')
})

Vue.use(Buefy, {
  defaultIconPack: 'fas',
})

Vue.config.productionTip = false

new Vue({
  el: '#app',
  store,
  components: {
    Worldmap,
    Listview,
    Progressteps,
    Totalproducts,
    Tableview,
    NavBar,
    SidebarFilters,
  },
  delimiters: ['${', '}'],
})
