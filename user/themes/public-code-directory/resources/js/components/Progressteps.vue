<script>
import { ValidationObserver, ValidationProvider, validate } from "vee-validate";
import axios from "axios";
export default {
  name: "Progressteps",
  delimiters: ["${", "}"],
  components: {
    ValidationObserver,
    ValidationProvider
  },
  data() {
    return {
      currentStep: 4,
      submitSuccess: false,
      projectDevelopersModalActive: false,
      projectMaintainersModalActive: false,
      projectUsersModalActive: false,
      sendingForm: false,
      formSubmitted: false,
      counterDev: 0,
      counterMaint: 0,
      sameAsDevs: false,
      form: {
        yourName: "",
        emailAddress: "",
        organisation: "",
        projectName: "",
        projectWebsite: "",
        projectUrl: "",
        projectCountry: "",
        prjectLanguages: [],
        projectType: "",
        projectLicence: "",
        projectCategory: "",
        projectSector: "",
        projectDescription: "",
        projectDevelopers: [
          {
            name: "",
            website: "",
            logoUrl: "",
            category: ""
          }
        ],
        projectMaintainers: [
          {
            name: "",
            website: "",
            logoUrl: "",
            category: ""
          }
        ],
        projectUsers: [
          {
            name: "name",
            website: "https://google.com",
            logoUrl: "https://google.com",
            category: "categoru",
            location: {
              longitude: "54.23223",
              latitude: "-1.23232"
            }
          }
        ]
      },
      tempFormData: {
        name: "name",
        website: "https://google.com",
        logoUrl: "https://google.com",
        category: "categoru",
        location: {
          longitude: "54.23223",
          latitude: "-1.23232"
        }
      },
      formSubmissionResult: null
    };
  },
  computed: {},
  methods: {
    backToStep() {
      if (this.currentStep === 1) {
        return;
      }
      this.currentStep--;
    },
    addDevelopers() {
      this.showDevs = true;
      this.counterDev++;
      this.projectDevelopersModalActive = true;
    },
    addMaintainers() {
      this.showDevs = true;
      this.counterMaint++;
      this.projectMaintainersModalActive = true;
    },
    addUsers() {
      this.showUsers = true;
      this.counterUsers++;
      this.projectUsersModalActive = true;
    },
    closeModal() {
      this.projectDevelopersModalActive = false;
      this.projectMaintainersModalActive = false;
      this.projectUsersModalActive = false;
    },
    saveDeveloper() {
      this.projectDevelopersModalActive = false;
      this.form.projectDevelopers.push(this.tempFormData);
      this.tempFormData = {
        name: "",
        website: "",
        logoUrl: "",
        category: "",
        longitude: "",
        latitude: ""
      };
    },
    saveUser() {
      this.projectUsersModalActive = false;
      this.form.projectUsers.push(this.tempFormData);
      this.tempFormData = {
        name: "",
        website: "",
        logoUrl: "",
        category: "",
        longitude: "",
        latitude: ""
      };
    },
    saveMaintainer() {
      this.projectMaintainersModalActive = false;
      this.form.projectMaintainers.push(this.tempFormData);
      this.tempFormData = {
        name: "",
        website: "",
        logoUrl: "",
        category: "",
        longitude: "",
        latitude: ""
      };
    },
    removeDeveloper(index) {
      this.form.projectDevelopers.splice(index, 1);
      this.tempFormData = {
        name: "",
        website: "",
        logoUrl: "",
        category: "",
        longitude: "",
        latitude: ""
      };
    },
    removeMaintainer(index) {
      this.form.projectMaintainers.splice(index, 1);
      this.tempFormData = {
        name: "",
        website: "",
        logoUrl: "",
        category: "",
        longitude: "",
        latitude: ""
      };
    },
    removeUser(index) {
      this.form.projectUsers.splice(index, 1);
      this.tempFormData = {
        name: "",
        website: "",
        logoUrl: "",
        category: "",
        longitude: "",
        latitude: ""
      };
    },
    onSubmit() {
      let that = this;
      if (that.currentStep === 5) {
        this.sendingForm = true;
        axios
          .post("join-us", {
            headers: {},
            method: "POST",
            body: JSON.stringify(that.form)
          })
          .then(res => {
            setTimeout(() => {
              // this is just to reset the form, set the loading to false and display the thank you message
              that.submitSuccess = true;
              that.sendingForm = false;
              that.currentStep = 6;
              requestAnimationFrame(() => {
                that.$refs.join.reset();
              });
            }, 500);
          })
          .catch(error => {
            console.log(error);
          });

        return;
      }
      this.currentStep++;
    }
  }
};
</script>
<style lang="scss">
.field.is-between {
  justify-content: space-between;
}
</style>
