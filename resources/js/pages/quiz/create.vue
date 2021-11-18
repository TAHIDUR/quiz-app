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
            <h5>Create Quiz</h5>
            <router-link :to="{ name: 'quiz-list' }" class="btn btn-primary"
              >Quiz List</router-link
            >

          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-md-6 offset-3">
                <form @submit.prevent="createQuiz">
                  <div class="form-group">
                    <label for="">Quiz Name</label>

                    <input
                      type="text"
                      v-model="quizForm.name"
                      name="name"
                      class="form-control"
                      placeholder="Name"
                    />
                    <div
                      v-if="quizForm.errors.has('name')"
                      v-html="quizForm.errors.get('name')"
                    />
                  </div>
                  <div class="form-group">
                    <label for="">Select Version</label>

                      <select 
                        v-model="quizForm.version_id"
                        class="form-control">
  
                        <option value="">Select Version</option>
                        <option 
                          v-for="option in versions" 
                          v-bind:value="option.id">
                            {{ option.name }}
                        </option>
                      </select>

                    <div
                      v-if="quizForm.errors.has('version_id')"
                      v-html="quizForm.errors.get('version_id')"
                    />
                  </div>
                  <div class="form-group">
                    <label for="">Select Class</label>

                      <select 
                        v-model="quizForm.class_id"
                        class="form-control">
  
                        <option value="">Select Class</option>
                        <option 
                          v-for="option in classes" 
                          v-bind:value="option.id">
                            {{ option.name }}
                        </option>
                      </select>

                    <div
                      v-if="quizForm.errors.has('class_id')"
                      v-html="quizForm.errors.get('class_id')"
                    />
                  </div>
                  <div class="form-group">
                    <label for="">Select Subject</label>

                      <select 
                        v-model="quizForm.subject_id"
                        class="form-control">
  
                        <option value="">Select Class</option>
                        <option 
                          v-for="option in subjects" 
                          v-bind:value="option.id">
                            {{ option.name }}
                        </option>
                      </select>

                    <div
                      v-if="quizForm.errors.has('subject_id')"
                      v-html="quizForm.errors.get('subject_id')"
                    />
                  </div>

                  <div class="form-group">
                    <label for="">Start Date</label>

                    <input
                      type="date"
                      v-model="quizForm.start_date"
                      name="start_date"
                      class="form-control"
                      placeholder="Start Date"
                    />
                    <div
                      v-if="quizForm.errors.has('start_date')"
                      v-html="quizForm.errors.get('start_date')"
                    />
                  </div>
                  <div class="form-group">
                    <label for="">Start Time</label>

                    <input
                      type="time"
                      v-model="quizForm.start_time"
                      name="start_time"
                      class="form-control"
                      placeholder="Start Time"
                    />
                    <div
                      v-if="quizForm.errors.has('start_time')"
                      v-html="quizForm.errors.get('start_time')"
                    />
                  </div>
                  <div class="form-group">
                    <label for="">End Date</label>

                    <input
                      type="date"
                      v-model="quizForm.end_date"
                      name="end_date"
                      class="form-control"
                      placeholder="End Date"
                    />
                    <div
                      v-if="quizForm.errors.has('end_date')"
                      v-html="quizForm.errors.get('end_date')"
                    />
                  </div>
                  <div class="form-group">
                    <label for="">End Time</label>

                    <input
                      type="time"
                      v-model="quizForm.end_time"
                      name="end_time"
                      class="form-control"
                      placeholder="Name"
                    />
                    <div
                      v-if="quizForm.errors.has('end_time')"
                      v-html="quizForm.errors.get('end_time')"
                    />
                  </div>
                  <div class="form-group">
                    <label for="">Pass Percentage</label>

                    <input
                      type="number"
                      v-model="quizForm.pass_percentage"
                      name="pass_percentage"
                      class="form-control"
                      placeholder="Pass Percentage"
                    />
                    <div
                      v-if="quizForm.errors.has('pass_percentage')"
                      v-html="quizForm.errors.get('pass_percentage')"
                    />
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-success">
                      Create Quiz
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
      classes: [],
      subjects: [],

      quizForm: new Form({
        name: "",
        version_id: "",
        class_id: "",
        subject_id: "",
        start_date: "",
        start_time: "",
        end_date: "",
        end_time: "",
        pass_percentage: "",
      }),
    };
  },

    
    mounted(){
        this.getVersions(),
        this.getClasses(),
        this.getSubject();


    },
  methods: {
    
    getVersions() {
      axios.get("/api/version").then((response) => {
        this.versions = response.data;
      });

    },

    getClasses() {
      axios.get("/api/class").then((response) => {
        this.classes = response.data;
      });

    },

    getSubject() {
      axios.get("/api/subject").then((response) => {
        this.subjects = response.data;
      });
    },
    
    createQuiz() {
      this.quizForm.post("/api/quiz").then(({ data }) => {
        this.quizForm.name = "";
        this.quizForm.version_id = "";
        this.quizForm.class_id = "";
        this.quizForm.subject_id = "";
        this.quizForm.start_date = "";
        this.quizForm.start_time = "";
        this.quizForm.end_date = "";
        this.quizForm.end_time = "";
        this.quizForm.pass_percentage = "";

        this.$toast.success({
          title: "Success!",
          message: "Quiz Created Successfully",
        });
      });
    },
  }
};
</script>

<style>
</style>
