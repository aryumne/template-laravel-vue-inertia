<script setup>
import Header from "./main_parts/Header.vue";
import Sidebar from "./main_parts/Sidebar.vue";
import Footer from "./main_parts/Footer.vue";
</script>
<template>
    <div class="main-wrapper">
        <!-- Header -->
        <Header />

        <!-- Sidebar -->
        <Sidebar />

        <!-- Content -->
        <slot />

        <!-- Footer -->
        <Footer />
    </div>
</template>
