<script setup>
import { Link } from "@inertiajs/vue3";
import BlankLayout from "../../Layouts/BlankLayout.vue";
</script>
<template>
    <BlankLayout>
        <div class="card card-primary">
            <div class="card-header">
                <h4>Forgot Password</h4>
            </div>

            <div class="card-body pt-0">
                <p class="text-muted">
                    We will send a link to reset your password
                </p>
                <form
                    method="POST"
                    action="#"
                    class="needs-validation"
                    novalidate=""
                >
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input
                            id="email"
                            type="email"
                            class="form-control"
                            name="email"
                            tabindex="1"
                            required
                            autofocus
                        />
                        <div class="invalid-feedback">
                            Please fill in your email
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <button
                            type="submit"
                            class="btn btn-primary btn-lg btn-block"
                            tabindex="4"
                        >
                            Generate Link
                        </button>
                    </div>
                </form>
                <div class="text-muted text-center">
                    <Link :href="route('login')">I want to login</Link>
                </div>
            </div>
        </div>
    </BlankLayout>
</template>
