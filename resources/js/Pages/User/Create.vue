<script setup>
import { useForm } from "@inertiajs/vue3";

const data = useForm({
    name: "",
    email: "",
    password: "",
    role: "",
    phone: "",
    profile_pict: "",
});

defineProps({
    errors: {
        type: Object,
    },
});

const configSubmit = {
    preserveScroll: true,
    onSuccess: (res) => {
        iziToast.info({
            title: "Success!!!",
            message: res.props.flash.message,
            position: "topRight",
        });
        data.reset();
        const closeButton = document.querySelector(".modal .close");
        if (closeButton) {
            closeButton.click(); // Trigger click event on close button
        }
    },
    onError: (errors) => {
        let msg = Object.values(errors)[0];
        iziToast.error({
            title: "Failed!!!",
            message: msg,
            position: "topRight",
        });
    },
};
</script>
<template>
    <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
        <div
            class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document"
        >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create new user</h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form
                    @submit.prevent="
                        data.post(route('users.store'), configSubmit)
                    "
                >
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select
                                class="form-control"
                                id="role"
                                v-model="data.role"
                            >
                                <option value="admin">admin</option>
                                <option value="user">user</option>
                                <option value="doctor">doctor</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Full name</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="data.name"
                                :class="{ 'is-invalid': errors?.name }"
                                tabindex="1"
                                required
                                autofocus
                            />
                            <div v-if="errors?.name" class="invalid-feedback">
                                {{ errors?.name }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input
                                type="email"
                                class="form-control"
                                v-model="data.email"
                                :class="{ 'is-invalid': errors?.email }"
                                tabindex="1"
                                required
                            />
                            <div v-if="errors?.email" class="invalid-feedback">
                                {{ errors?.email }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input
                                type="number"
                                class="form-control"
                                v-model="data.phone"
                                :class="{ 'is-invalid': errors?.phone }"
                                tabindex="1"
                                required
                            />
                            <div v-if="errors?.phone" class="invalid-feedback">
                                {{ errors?.phone }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="data.password"
                                    :class="{ 'is-invalid': errors?.password }"
                                    aria-label="Recipient's username"
                                    aria-describedby="button-addon2"
                                />
                                <div class="input-group-append">
                                    <button
                                        class="btn btn-warning"
                                        type="button"
                                        id="button-addon2"
                                    >
                                        Generate
                                    </button>
                                </div>
                            </div>
                            <div
                                v-if="errors?.password"
                                class="invalid-feedback"
                            >
                                {{ errors?.password }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="profile_pict">Profile Picture</label>
                            <input
                                type="file"
                                @input="
                                    data.profile_pict = $event.target.files[0]
                                "
                                class="form-control"
                                :class="{ 'is-invalid': errors?.profile_pict }"
                            />
                            <div
                                v-if="errors?.profile_pict"
                                class="invalid-feedback"
                            >
                                {{ errors?.profile_pict }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
