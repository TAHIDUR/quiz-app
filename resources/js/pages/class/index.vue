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
            <h5 class="mb-0">Class</h5>
            <router-link
              :to="{ name: 'create-class' }"
              class="btn btn-primary"
              >Create Class</router-link
            >
          </div>

          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th style="width: 100px">Id</th>
                  <th>Name</th>
                  <th>Version</th>
                  <th style="width: 150px">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="clas in classes" :key="clas.id">
                  <td style="width: 100px">{{ clas.id }}</td>
                  <td>{{ clas.name }}</td>
                  <td>{{ clas.version }}</td>
                  <td style="width: 150px">
                    <router-link
                      class="btn btn-primary btn-sm"
                      :to="{ name: 'edit-class', params: { id: clas.id } }"
                      >Edit</router-link
                    >
                    <a
                      @click.prevent="deleteClass(clas)"
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
      classes: [],
    };
  },
  methods: {
    loadClasses() {
      axios.get("/api/class").then((response) => {
        this.classes = response.data;
      });
    },

    deleteClass(clas) {
      axios.delete(`/api/class/${clas.id}`).then(() => {
        this.$toast.success({
          title: "Success!",
          message: "Class deleted successfully.",
        });
      });

      let index = this.classes.indexOf(clas);
      this.classes.splice(index, 1);
    },
  },
  mounted() {
    this.loadClasses();
  },
};
</script>
