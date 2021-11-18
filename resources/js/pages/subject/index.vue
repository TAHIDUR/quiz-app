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
            <h5 class="mb-0">Subject</h5>
            <router-link
              :to="{ name: 'create-subject' }"
              class="btn btn-primary"
              >Create Subject</router-link
            >
          </div>

          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th style="width: 100px">Id</th>
                  <th>Name</th>
                  <th>Class</th>
                  <th style="width: 150px">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(subject, index) in subjects" :key="subject.id">
                  <td style="width: 100px">{{ index+1 }}</td>
                  <td>{{ subject.name }}</td>
                  <td>{{ subject.class }}</td>
                  <td style="width: 150px">
                    <router-link
                      class="btn btn-primary btn-sm"
                      :to="{ name: 'edit-subject', params: { id: subject.id } }"
                      >Edit</router-link
                    >
                    <a
                      @click.prevent="deleteSubject(subject)"
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
      subjects: [],
    };
  },
  methods: {
    loadSubject() {
      axios.get("/api/subject").then((response) => {
        this.subjects = response.data;
      });
    },

    deleteSubject(subject) {
      axios.delete(`/api/subject/${subject.id}`).then(() => {
        this.$toast.success({
          title: "Success!",
          message: "Subject deleted successfully.",
        });
      });

      let index = this.subjects.indexOf(subject);
      this.subjects.splice(index, 1);
    },
  },
  mounted() {
    this.loadSubject();
  },
};
</script>
