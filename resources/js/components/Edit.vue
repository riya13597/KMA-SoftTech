<template>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="d-flex justify-content-between card-header bg-gradient-primary text-white">
                <h1 class="card-title text-center">Edit an Item</h1>
                <router-link to="/">
                    <button type="button" class="btn btn-secondary btn-lg">Go Back</button>
                </router-link>
            </div>
            <div class="card-body">
                <div v-if="successMessage" class="alert alert-success">
                    {{ successMessage }}
                </div>
                <form @submit.prevent="updateItem">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="itemName" class="form-label">Name:</label>
                            <input type="text" id="itemName" class="form-control" v-model="item.name"
                                placeholder="Enter name" @input="validateAlphabets" required>
                            <div v-if="nameError" class="text-danger mt-1">
                                {{ nameError }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="itemSkills" class="form-label">Skills:</label>
                            <input type="text" id="itemSkills" class="form-control" v-model="item.skill.name"
                                placeholder="Enter skills, separated by commas" required>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary px-4">Update Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted, reactive, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import axios from 'axios';

export default {
    setup() {
        const item = reactive({ id: '', name: '', skill: '' });
        const route = useRoute();
        const router = useRouter();
        const successMessage = ref('');
        const nameError = ref('');
        const skillsInput = ref('');

        const getItem = async () => {
            try {
                const uri = `/users/${route.params.id}/edit`;
                const response = await axios.get(uri);
                Object.assign(item, response.data);
            } catch (error) {
                console.error("Failed to fetch item:", error);
            }
        };

        const updateItem = async () => {
            item.skills = item.skill_id;
            const uri = `/users/${route.params.id}`;
            await axios.patch(uri, item);
            successMessage.value = 'Item Updated Successfully!';
            setTimeout(() => {
                successMessage.value = '';
                router.push({ name: 'Index' });
            }, 1000);
        };

        const validateAlphabets = (event) => {
            const value = event.target.value;
            if (/[^a-zA-Z]/.test(value)) {
                nameError.value = 'Only alphabets are allowed';
            } else {
                nameError.value = '';
            }
            item.name = value.replace(/[^a-zA-Z]/g, '');
        };

        onMounted(getItem);

        return {
            item,
            skillsInput,
            updateItem,
            successMessage,
            validateAlphabets,
            nameError
        };
    }
}
</script>

<style scoped>
.bg-gradient-primary {
    background: linear-gradient(45deg, #007bff, #6610f2);
}
</style>
