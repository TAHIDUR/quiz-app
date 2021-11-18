<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-content-center">
                        <h5>Edit Class - {{ classForm.name }}</h5>
                        <router-link :to="{name: 'class-list'}" class="btn btn-primary">Class List</router-link>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 offset-3">
                                <form @submit.prevent="updateClass">
                                    <div class="form-group">
                                        <label for="">Class Name</label>

                                        <input type="text"  v-model="classForm.name" name="name" class="form-control" placeholder="class name" />
                                         <div v-if="classForm.errors.has('name')" v-html="classForm.errors.get('name')" />
                                    </div>


                                    <div class="form-group">
                                        <label for="">Select Version</label>

                                        <select 
                                            v-model="classForm.version_id"
                                            class="form-control">
                    
                                            <option value="">Select Version</option>
                                            <option 
                                                v-for="option in versions" 
                                                v-bind:value="option.id"
                                                :selected="option.id == '{{ classForm.version_id }}'">
                                                    {{ option.name }}
                                            </option>
                                        </select>

                                        <div
                                        v-if="classForm.errors.has('version_id')"
                                        v-html="classForm.errors.get('version_id')"
                                        />
                                    </div>


                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Update Version</button>
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

import { Form } from 'vform'
import axios from 'axios'

export default {
    data(){
        return{

            versions: [],
            classForm: new Form({
                name: '',
                version_id: '',
                }),
        }
    },
    methods: {
        updateClass(){
            let id = this.$route.params.id;
            this.classForm.put(`/api/class/${id}`).then(() => {
             this.$toast.success({
                    title:'Success!',
                    message:'Class update successfully.'
                });
            })

        },
        loadClass(){
            let id = this.$route.params.id;

            axios.get(`/api/class/${id}/edit`).then(response => {
                this.classForm.name = response.data.name;
                this.classForm.version_id = response.data.version_id;
            });
        },    
        
        loadVersions() {
            axios.get("/api/version").then((response) => {
                this.versions = response.data;
            });
        },

    },
    mounted(){
        this.loadClass();
        this.loadVersions();
    }


}
</script>

<style>

</style>
