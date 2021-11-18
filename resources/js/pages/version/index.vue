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
            <h5 class="mb-0">Version</h5>
            <router-link
              :to="{ name: 'create-version' }"
              class="btn btn-primary"
              >Create Version</router-link
            >
          </div>

          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th style="width: 100px">Id</th>
                  <th>Name</th>
                  <th style="width: 150px">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(version, index) in versions" :key="version.id">
                  <td style="width: 100px">{{ index+1 }}</td>
                  <td>{{ version.name }}</td>
                  <td style="width: 150px">
                    <router-link
                      class="btn btn-primary btn-sm"
                      :to="{ name: 'edit-version', params: { id: version.id } }"
                      >Edit</router-link
                    >
                    <a
                      @click.prevent="deleteVersion(version)"
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
      versions: [],
    };
  },
  methods: {
    loadVersions() {
      axios.get("/api/version").then((response) => {
        this.versions = response.data;
      });
    },

    deleteVersion(version) {
      axios.delete(`/api/version/${version.id}`).then(() => {
        this.$toast.success({
          title: "Success!",
          message: "Version deleted successfully.",
        });
      });

      let index = this.versions.indexOf(version);
      this.versions.splice(index, 1);
    },
  },
  mounted() {
    this.loadVersions();
  },
};
</script>
