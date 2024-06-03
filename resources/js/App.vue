<template>
    <div>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <router-link class="navbar-brand text-white" to="/">User Data</router-link>

            </div>
        </nav>

        <!-- Main Content -->

        <div class="container my-4">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
export default {
    // Your script content
}
</script>

<style>
/* Optionally add custom styles here */
</style>
