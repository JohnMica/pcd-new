<script>
import { ValidationObserver, ValidationProvider, validate } from "vee-validate";
import axios from "axios";
const qs = require("qs");
const transformRequest = (jsonData = {}) =>
  Object.entries(jsonData)
    .map(x => `${encodeURIComponent(x[0])}=${encodeURIComponent(x[1])}`)
    .join("&");
export default {
  name: "Progressteps",
  delimiters: ["${", "}"],
  components: {
    ValidationObserver,
    ValidationProvider
  },
  data() {
    return {
      currentStep: 5,
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
        name: "name",
        emailAddress: "email@test.com",
        organisation: "organisation",
        projectName: "project name",
        projectWebsite: "http://test.com",
        projectUrl: "http://test.com",
        projectCountry: "country",
        projectLanguages: "en, it, de",
        projectType: "project type",
        projectLicence: "licnce",
        projectCategory: "categ",
        projectSector: "sector",
        projectDescription:
          "descirpieornainawin ainaoidnioandi oansiodn oiasd idi na",
        projectDevelopers: [
          {
            name: "dev name",
            website: "http://test.com",
            logoUrl: "http://test.com",
            category: "dev catego"
          }
        ],
        projectMaintainers: [
          {
            name: "mant name",
            website: "http://test.com",
            logoUrl: "http://test.com",
            category: "maint catego"
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
  computed: {
    randomNonce() {
      return (Math.random() * 1e32).toString(24);
    },
    randomId() {
      return (Math.random() * 1e32).toString(20);
    }
  },
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
        const ajaxForm = $("#formbuilder");
        axios
          .post("forms/formbuilder", ajaxForm.serialize(), {
            headers: {
              "content-type": "application/x-www-form-urlencoded",
              Accept: "application/json",
              "X-Requested-With": "XMLHttpRequest"
            }
          })
          .then(res => {
            setTimeout(() => {
              console.log("response", res);

              // this is just to reset the form, set the loading to false and display the thank you message
              that.submitSuccess = true;
              that.sendingForm = false;
              that.currentStep = 6;
              requestAnimationFrame(() => {
                that.$refs.formbuilder.reset();
              });
            }, 500);
          })
          .catch(error => {
            if (error.response) {
              // The request was made and the server responded with a status code
              // that falls out of the range of 2xx
              console.error("error.response", error.response);
              that.sendingForm = false;
            } else if (error.request) {
              // The request was made but no response was received
              // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
              // http.ClientRequest in node.js
              console.error("error.request", error.request);
              that.sendingForm = false;
            } else {
              // Something happened in setting up the request that triggered an Error
              console.error("Error", error.message);
              that.sendingForm = false;
            }
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
.field {
  padding-top: 0.5rem;
  padding-bottom: 1rem;
  .label {
    display: inline-flex;
    align-items: center;
  }
}
</style>
