<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class=" d-flex justify-content-between card-header ">
                    <h4>User Data</h4>
                    <router-link :to="{ name: 'Create' }">
                        <button type="button" class="btn btn-secondary btn-lg">Add Data</button>
                    </router-link>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Skills</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody v-if="users.length > 0">
                                <tr v-for="(user, key) in users" :key="key">
                                    <td>{{ user.name }}</td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <div class="pills" v-for="(skill, index) in user.skills" :key="index">
                                                {{ skill }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <router-link :to="{ name: 'Edit', params: { id: user.id } }"
                                            class="btn btn-sm btn-outline-primary me-2"><i
                                                class="bi bi-pencil-square me-1"></i>
                                            Edit</router-link>
                                        <button type="button" @click="deleteData(user.id)"
                                            class="btn btn-sm btn-outline-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" align="center">No User Data Found.</td>
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
export default {
    name: "users",
    data() {
        return {
            users: [],

        }
    },
    mounted() {
        this.getUsersData()
    },
    methods: {
        async getUsersData() {
            try {
                const response = await axios.get('/users');
                this.users = response.data;
            } catch (error) {
                console.error(error);
                this.users = [];
            }
        },
        deleteData(id) {
            if (confirm("Are you sure to delete this category ?")) {
                axios.delete(`/users/${id}`).then(response => {
                    this.getUsersData()
                }).catch(error => {
                    console.log(error)
                })
            }
        }
    }
}
</script>
<style scoped>
.pills {
    background-color: #f6c5c5;
    border: none;
    border-radius: 25px;
    color: #000;
    cursor: pointer;
    font: inherit;
    outline: inherit;
    padding: 5px 10px;
}
</style>
