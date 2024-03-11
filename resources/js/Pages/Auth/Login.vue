<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import BlankLayout from "../../Layouts/BlankLayout.vue";
const loginForm = useForm({
    email: null,
    password: null,
});

defineProps({
    errors: {
        type: Object,
    },
});
</script>
<template>
    <BlankLayout>
        <div class="card card-primary">
            <div class="card-header">
                <h4>Login</h4>
            </div>

            <div class="card-body">
                <form @submit.prevent="loginForm.post(route('login'))">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input
                            v-model="loginForm.email"
                            type="email"
                            class="form-control"
                            :class="{ 'is-invalid': errors.email }"
                            tabindex="1"
                            required
                            autofocus
                        />
                        <div v-if="errors.email" class="invalid-feedback">
                            {{ errors.email }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="d-block">
                            <label for="password" class="control-label"
                                >Password</label
                            >
                            <div class="float-right">
                                <Link
                                    :href="route('password.reset')"
                                    class="text-small"
                                >
                                    Forgot Password?
                                </Link>
                            </div>
                        </div>
                        <input
                            v-model="loginForm.password"
                            type="password"
                            class="form-control"
                            tabindex="2"
                            required
                        />
                        <div class="invalid-feedback">
                            please fill in your password
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <button
                            type="submit"
                            class="btn btn-primary btn-lg btn-block"
                            tabindex="4"
                        >
                            Login
                        </button>
                    </div>
                </form>
                <div class="text-muted text-center">
                    Don't have an account?
                    <Link :href="route('register')">Sign up</Link>
                </div>
            </div>
        </div>
    </BlankLayout>
</template>
