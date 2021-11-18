<template>
  <div class="container">
    <div class="row justify-content-center">
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
            <h5 class="mb-0">Quiz</h5>
            <router-link
              :to="{ name: 'create-quiz' }"
              class="btn btn-primary"
              >Create Quiz</router-link
            >
          </div>

          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th style="width: 100px">Id</th>
                  <th>Title</th>
                  <th>Version</th>
                  <th>Class</th>
                  <th>Subject</th>
                  <th>Start Date</th>
                  <th>Start Time</th>
                  <th>End Date</th>
                  <th>End Time</th>
                  <th>Pass Percentage</th>
                  <th style="width: 150px">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="quiz in quizes" :key="quiz.id">
                  <td style="width: 100px">{{ quiz.id }}</td>
                  <td>{{ quiz.name }}</td>
                  <td>{{ quiz.version }}</td>
                  <td>{{ quiz.class }}</td>
                  <td>{{ quiz.subject }}</td>
                  <td>{{ quiz.start_date }}</td>
                  <td>{{ quiz.start_time }}</td>
                  <td>{{ quiz.end_date }}</td>
                  <td>{{ quiz.end_time }}</td>
                  <td>{{ quiz.pass_percentage }}</td>
                  <td style="width: 150px">
                    <router-link
                      class="btn btn-primary btn-sm"
                      :to="{ name: 'edit-class', params: { id: quiz.id } }"
                      >Edit</router-link
                    >
                    <a
                      @click.prevent="deleteQuiz(clas)"
                      href="#"
                      class="btn btn-danger btn-sm"
                      >delete</a
                    >
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      quizes: [],
    };
  },
  methods: {
    loadQuiz() {
      axios.get("/api/quiz").then((response) => {
        this.quizes = response.data;
      });
    },

    deleteQuiz(quiz) {
      axios.delete(`/api/quiz/${quiz.id}`).then(() => {
        this.$toast.success({
          title: "Success!",
          message: "Quiz deleted successfully.",
        });
      });

      let index = this.classes.indexOf(clas);
      this.classes.splice(index, 1);
    },
  },
  mounted() {
    this.loadQuiz();
  },
};
</script>
