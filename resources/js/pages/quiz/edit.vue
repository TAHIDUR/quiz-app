<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-content-center">
                        <h5>Edit Subject - {{ subjectForm.name }}</h5>
                        <router-link :to="{name: 'subject-list'}" class="btn btn-primary">Subject List</router-link>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 offset-3">
                                <form @submit.prevent="updateSubject">
                                    <div class="form-group">
                                        <label for="">Subject Name</label>

                                        <input type="text"  v-model="subjectForm.name" name="name" class="form-control" placeholder="name" />
                                         <div v-if="subjectForm.errors.has('name')" v-html="subjectForm.errors.get('name')" />
                                    </div>


                                    <div class="form-group">
                                        <label for="">Select Subject</label>

                                        <select 
                                            v-model="subjectForm.version_id"
                                            class="form-control">
                    
                                            <option value="">Select Subject</option>
                                            <option 
                                                v-for="option in classes" 
                                                v-bind:value="option.id"
                                                :selected="option.id == '{{ subjectForm.version_id }}'">
                                                    {{ option.name }}
                                            </option>
                                        </select>

                                        <div
                                        v-if="subjectForm.errors.has('version_id')"
                                        v-html="subjectForm.errors.get('version_id')"
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

            classes: [],
            subjectForm: new Form({
                name: '',
                version_id: '',
                }),
        }
    },
    methods: {
        updateSubject(){
            let id = this.$route.params.id;
            this.subjectForm.put(`/api/subject/${id}`).then(() => {
             this.$toast.success({
                    title:'Success!',
                    message:'Subject update successfully.'
                });
            })

        },
        loadSubject(){
            let id = this.$route.params.id;

            axios.get(`/api/subject/${id}/edit`).then(response => {
                this.subjectForm.name = response.data.name;
                this.subjectForm.version_id = response.data.version_id;
            });
        },    
        
        loadClasses() {
            axios.get("/api/class").then((response) => {
                this.classes = response.data;
            });
        },

    },
    mounted(){
        this.loadSubject();
        this.loadClasses();
    }


}
</script>

<style>

</style>
