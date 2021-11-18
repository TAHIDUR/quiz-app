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
            <h5>Create Version</h5>
            <router-link :to="{ name: 'version-list' }" class="btn btn-primary"
              >Version List</router-link
            >

          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-md-6 offset-3">
                <form @submit.prevent="createVersion">
                  <div class="form-group">
                    <label for="">Version Name</label>

                    <input
                      type="text"
                      v-model="versionForm.name"
                      name="name"
                      class="form-control"
                      placeholder="Name"
                    />
                    <div
                      v-if="versionForm.errors.has('name')"
                      v-html="versionForm.errors.get('name')"
                    />
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-success">
                      Create Version
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
      versionForm: new Form({
        name: "",
      }),
    };
  },
  methods: {
    createVersion() {
      this.versionForm.post("/api/version").then(({ data }) => {
        this.versionForm.name = "";

        this.$toast.success({
          title: "Success!",
          message: "Version Created Successfully",
        });
      });
    },
  },
};
</script>

<style>
</style>
