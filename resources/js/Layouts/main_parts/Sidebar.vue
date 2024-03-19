<script setup>
import { Link } from "@inertiajs/vue3";
</script>
<template>
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand pt-2 mb-4" style="line-height: 2rem">
                <Link :href="route('dashboard')">
                    Clinic <br />
                    Management System
                </Link>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <Link :href="route('dashboard')">CMS</Link>
            </div>
            <ul class="sidebar-menu">
                <li :class="{ active: route().current('dashboard') }">
                    <Link class="nav-link" :href="route('dashboard')"
                        ><i class="fas fa-fire"></i>
                        <span>Dashboard</span></Link
                    >
                </li>
                <li :class="{ active: route().current('users.*') }">
                    <Link class="nav-link" :href="route('users.index')"
                        ><i class="fas fa-users"></i>
                        <span>Manage User</span></Link
                    >
                </li>
                <li :class="{ active: route().current('doctors.*') }">
                    <Link class="nav-link" :href="route('doctors.index')"
                        ><i class="fas fa-users"></i>
                        <span>Manage Doctors</span></Link
                    >
                </li>
            </ul>

            <div class="hide-sidebar-mini mt-4 mb-4 p-3">
                <a
                    href="https://getstisla.com/docs"
                    class="btn btn-primary btn-lg btn-block btn-icon-split"
                >
                    <i class="fas fa-rocket"></i> Documentation
                </a>
            </div>
        </aside>
    </div>
</template>
