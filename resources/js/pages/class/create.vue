<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div
            class="
              card-header
              d-flex
              justify-content-between
              align-content-center
            "
          >
            <h5>Create Class</h5>
            <router-link :to="{ name: 'class-list' }" class="btn btn-primary"
              >Class List</router-link
            >

          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-md-6 offset-3">
                <form @submit.prevent="createClass">
                  <div class="form-group">
                    <label for="">Class Name</label>

                    <input
                      type="text"
                      v-model="classForm.name"
                      name="name"
                      class="form-control"
                      placeholder="Name"
                    />
                    <div
                      v-if="classForm.errors.has('name')"
                      v-html="classForm.errors.get('name')"
                    />
                  </div>
                  <div class="form-group">
                    <label for="">Select Version</label>

                      <select 
                        v-model="classForm.version_id"
                        class="form-control">
  
                        <option value="">Select Version</option>
                        <option 
                          v-for="option in versions" 
                          v-bind:value="option.id">
                            {{ option.name }}
                        </option>
                      </select>

                    <div
                      v-if="classForm.errors.has('version_id')"
                      v-html="classForm.errors.get('version_id')"
                    />
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-success">
                      Create Class
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Form } from "vform";

export default {
  data() {
    return {

      versions: [],
      classForm: new Form({
        name: "",
        version_id: "",
      }),
    };
  },

    
    mounted(){
        this.getVersions()
    },
  methods: {
    
    getVersions() {
      console.log('versions calling')
      axios.get("/api/version").then((response) => {
        this.versions = response.data;
      });

    },
    createClass() {
      console.log(this.classForm);
      this.classForm.post("/api/class").then(({ data }) => {
        this.classForm.name = "";
        this.classForm.version_id = "";

        this.$toast.success({
          title: "Success!",
          message: "Class Created Successfully",
        });
      });
    },
  }
};
</script>

<style>
</style>
