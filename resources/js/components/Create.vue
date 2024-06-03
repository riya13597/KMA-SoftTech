<template>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-gradient-primary text-white">
                <h1 class="card-title">Create An Item</h1>
            </div>
            <div class="card-body">
                <div v-if="successMessage" class="alert alert-success">
                    {{ successMessage }}
                </div>
                <form @submit.prevent="addItem">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" id="name" class="form-control" v-model="item.name" placeholder="Enter name"
                                @input="validateAlphabets" required>
                            <div v-if="nameError" class="text-danger mt-1">
                                {{ nameError }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="itemSkills" class="form-label">Skills:</label>
                            <input type="text" id="itemSkills" class="form-control" v-model="item.skillsInput"
                                placeholder="Enter skills, separated by commas" required>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary px-4">Add Item</button>
                    </div>
                </form>
                <div class="mt-4 d-flex justify-content-start">
                    <router-link :to="{ name: 'User' }" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left-circle"></i> Return to Items List
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';

export default {
    setup() {
        const item = reactive({ name: '', skillsInput: '' });
        const router = useRouter();
        const successMessage = ref('');
        const nameError = ref('');
        const addItem = async () => {
            const uri = '/users';
            try {
                await axios.post(uri, item);
                successMessage.value = 'Item added successfully!';
                setTimeout(() => {
                    successMessage.value = '';
                    router.push({ name: 'Index' });
                }, 1000);
            } catch (error) {
                console.error('Error adding item:', error);
            }
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

        return {
            item,
            addItem,
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
