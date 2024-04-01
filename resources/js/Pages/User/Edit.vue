<script setup>
import { Head, Link, useForm, router } from "@inertiajs/vue3";
import MainLayout from "../../Layouts/MainLayout.vue";
import SectionHeader from "../../Components/sections/SectionHeader.vue";
import { getSrcAvatar } from "../../Utils";

const props = defineProps({
    user: {
        type: Object,
    },
    errors: {
        type: Object,
    },
    flash: {
        type: Object,
    },
});

const data = useForm({
    id: props?.user?.id,
    name: props?.user?.name,
    email: props?.user?.email,
    phone: props?.user?.phone,
    is_active: props?.user?.is_active,
    role: props?.user?.role,
    profile_pict: "",
});

function saveChanges() {
    // penulisan route harus url, tidak dapat berfungsi jika menggunakan route('routename')
    router.post(
        `/users/${data.id}`,
        {
            _method: "patch",
            ...data,
        },
        {
            preserveState: true,
            onSuccess: (res) => {
                iziToast.info({
                    title: "Success!!!",
                    message: res.props.flash.message,
                    position: "topRight",
                });
            },
            onError: (errors) => {
                let msg = Object.values(errors)[0];
                iziToast.error({
                    title: "Failed!!!",
                    message: msg,
                    position: "topRight",
                });
            },
        }
    );
}
</script>

<template>
    <Head title="Edit User" />
    <MainLayout>
        <div class="main-content">
            <section class="section">
                <SectionHeader title="Edit User" />
                <div class="section-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-12 col-md-4">
                            <div class="card profile-widget">
                                <div class="profile-widget-header">
                                    <img
                                        alt="image"
                                        :src="getSrcAvatar(user?.profile_pict)"
                                        class="rounded-circle profile-widget-picture"
                                    />
                                    <div class="profile-widget-items">
                                        <div
                                            class="profile-widget-item text-left ml-4"
                                        >
                                            <div
                                                class="profile-widget-item-value mb-1"
                                            >
                                                {{ user?.name }}
                                            </div>
                                            <div
                                                class="profile-widget-item-label"
                                            >
                                                {{ user?.role }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-widget-description pb-0">
                                    <div class="profile-widget-name">
                                        {{ user?.email }}
                                    </div>
                                    <div class="profile-widget-name">
                                        {{ user?.phone }}
                                    </div>
                                    <div class="mb-4">
                                        <div
                                            class="badge badge-success"
                                            v-if="user?.is_active === 1"
                                        >
                                            Active
                                        </div>
                                        <div class="badge badge-danger" v-else>
                                            Not Active
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="card">
                                <form @submit.prevent="saveChanges">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="role">Role</label>
                                            <select
                                                class="form-control"
                                                id="role"
                                                v-model="data.role"
                                            >
                                                <option value="admin">
                                                    admin
                                                </option>
                                                <option value="user">
                                                    user
                                                </option>
                                                <option value="doctor">
                                                    doctor
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Full name</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="data.name"
                                                :class="{
                                                    'is-invalid': errors?.name,
                                                }"
                                                tabindex="1"
                                                required
                                                autofocus
                                            />
                                            <div
                                                v-if="errors?.name"
                                                class="invalid-feedback"
                                            >
                                                {{ errors?.name }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input
                                                type="email"
                                                class="form-control"
                                                v-model="data.email"
                                                :class="{
                                                    'is-invalid': errors?.email,
                                                }"
                                                tabindex="1"
                                                required
                                            />
                                            <div
                                                v-if="errors?.email"
                                                class="invalid-feedback"
                                            >
                                                {{ errors?.email }}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input
                                                type="number"
                                                class="form-control"
                                                v-model="data.phone"
                                                :class="{
                                                    'is-invalid': errors?.phone,
                                                }"
                                                tabindex="1"
                                                required
                                            />
                                            <div
                                                v-if="errors?.phone"
                                                class="invalid-feedback"
                                            >
                                                {{ errors?.phone }}
                                            </div>
                                        </div>
                                        <label for="is_active"
                                            >Statuse <em>(active)</em>
                                        </label>
                                        <div class="form-group">
                                            <div
                                                class="form-check form-check-inline"
                                            >
                                                <input
                                                    class="form-check-input"
                                                    type="radio"
                                                    v-model="data.is_active"
                                                    value="1"
                                                    id="yes"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="yes"
                                                    >Yes</label
                                                >
                                            </div>
                                            <div
                                                class="form-check form-check-inline"
                                            >
                                                <input
                                                    class="form-check-input"
                                                    type="radio"
                                                    v-model="data.is_active"
                                                    value="0"
                                                    id="no"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="no"
                                                    >No</label
                                                >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="profile_pict"
                                                >Profile Picture</label
                                            >
                                            <input
                                                type="file"
                                                @input="
                                                    data.profile_pict =
                                                        $event.target.files[0]
                                                "
                                                class="form-control"
                                                :class="{
                                                    'is-invalid':
                                                        errors?.profile_pict,
                                                }"
                                            />
                                            <div
                                                v-if="errors?.profile_pict"
                                                class="invalid-feedback"
                                            >
                                                {{ errors?.profile_pict }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <Link
                                            :href="route('users.index')"
                                            class="btn btn-secondary mr-2"
                                        >
                                            Discard
                                        </Link>
                                        <button
                                            type="submit"
                                            class="btn btn-primary"
                                        >
                                            Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </MainLayout>
</template>
