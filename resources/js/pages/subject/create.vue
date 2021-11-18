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
            <h5>Create Subject</h5>
            <router-link :to="{ name: 'subject-all' }" class="btn btn-primary"
              >Subject List</router-link
            >

          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-md-6 offset-3">
                <form @submit.prevent="createSubject">
                  <div class="form-group">
                    <label for="">Subject Name</label>

                    <input
                      type="text"
                      v-model="subjectForm.name"
                      name="name"
                      class="form-control"
                      placeholder="Name"
                    />
                    <div
                      v-if="subjectForm.errors.has('name')"
                      v-html="subjectForm.errors.get('name')"
                    />
                  </div>
                  <div class="form-group">
                    <label for="">Select Class</label>

                      <select 
                        v-model="subjectForm.class_id"
                        class="form-control">
  
                        <option value="">Select Class</option>
                        <option 
                          v-for="option in classes" 
                          v-bind:value="option.id">
                            {{ option.name }}
                        </option>
                      </select>

                    <div
                      v-if="subjectForm.errors.has('class_id')"
                      v-html="subjectForm.errors.get('class_id')"
                    />
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-success">
                      Create Subject
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

      classes: [],
      subjectForm: new Form({
        name: "",
        class_id: "",
      }),
    };
  },

    
  mounted(){
      this.getClasses()
  },
  methods: {
    
    getClasses() {
      axios.get("/api/class").then((response) => {
        this.classes = response.data;
      });

    },
    createSubject() {
      console.log(this.subjectForm);
      this.subjectForm.post("/api/subject").then(({ data }) => {
        this.subjectForm.name = "";
        this.subjectForm.class_id = "";

        this.$toast.success({
          title: "Success!",
          message: "Subject Created Successfully",
        });
      });
    },
  }
};
</script>

<style>
</style>
