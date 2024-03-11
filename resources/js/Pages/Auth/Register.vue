<script setup>
import { Link } from "@inertiajs/vue3";
import BlankLayout from "../../Layouts/BlankLayout.vue";
</script>
<template>
    <BlankLayout>
        <div class="card card-primary">
            <div class="card-header">
                <h4>Register</h4>
            </div>

            <div class="card-body">
                <form
                    method="POST"
                    action="#"
                    class="needs-validation"
                    novalidate=""
                >
                    <div class="row">
                        <div class="form-group col-12 col-md-6">
                            <label for="name">Full Name</label>
                            <input
                                id="name"
                                type="text"
                                class="form-control"
                                name="name"
                                autofocus
                            />
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="email">Email</label>
                            <input
                                id="email"
                                type="email"
                                class="form-control"
                                name="email"
                            />
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12 col-md-6">
                            <label for="password" class="d-block"
                                >Password</label
                            >
                            <input
                                id="password"
                                type="password"
                                class="form-control pwstrength"
                                data-indicator="pwindicator"
                                name="password"
                            />
                            <div id="pwindicator" class="pwindicator">
                                <div class="bar"></div>
                                <div class="label"></div>
                            </div>
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="password2" class="d-block"
                                >Password Confirmation</label
                            >
                            <input
                                id="password2"
                                type="password"
                                class="form-control"
                                name="password-confirm"
                            />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12 col-md-6">
                            <label for="phone">Phone</label>
                            <input
                                type="number"
                                class="form-control"
                                name="address"
                            />
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="address">Address</label>
                            <input
                                type="text"
                                class="form-control"
                                name="address"
                            />
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <button
                            type="submit"
                            class="btn btn-primary btn-lg btn-block"
                            tabindex="4"
                        >
                            Register
                        </button>
                    </div>
                </form>
                <div class="text-muted text-center">
                    already have an account?
                    <Link :href="route('login')">Sign in</Link>
                </div>
            </div>
        </div>
    </BlankLayout>
</template>
