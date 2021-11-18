<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-content-center">
                        <h5>Edit Version - {{ versionForm.name }}</h5>
                        <router-link :to="{name: 'version-list'}" class="btn btn-primary">Version List</router-link>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 offset-3">
                                <form @submit.prevent="updateVersion">
                                    <div class="form-group">
                                        <label for="">Version Name</label>

                                        <input type="text"  v-model="versionForm.name" name="name" class="form-control" placeholder="version name" />
                                         <div v-if="versionForm.errors.has('name')" v-html="versionForm.errors.get('name')" />
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
            versionForm: new Form({
                name: '',
                }),
        }
    },
    methods: {
        updateVersion(){
            let id = this.$route.params.id;
            this.versionForm.put(`/api/version/${id}`).then(() => {
             this.$toast.success({
                    title:'Success!',
                    message:'Version update successfully.'
                });
            })

        },
        loadVersion(){
            let id = this.$route.params.id;

            axios.get(`/api/version/${id}/edit`).then(response => {
                this.versionForm.name = response.data.name;
            });
        }

    },
    mounted(){
        this.loadVersion();
    }


}
</script>

<style>

</style>
