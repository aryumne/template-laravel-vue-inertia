<script setup>
import { useForm } from "@inertiajs/vue3";

const data = useForm({
    doctor_name: "",
    doctor_phone: null,
    doctor_email: "",
    doctor_address: "",
    specialist_id: null,
    sip: "",
    id_ihs: "",
    nik: "",
    doctor_profile_pict: null,
});

defineProps({
    errors: {
        type: Object,
    },
    specialists: {
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
            class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable"
            role="document"
        >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create new doctor</h5>
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
                        data.post(route('doctors.store'), configSubmit)
                    "
                >
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-12 col-md-6">
                                <label for="specialist_id"
                                    >Spesialist
                                    <span class="text-danger">*</span></label
                                >
                                <select
                                    class="form-control"
                                    id="specialist_id"
                                    v-model="data.specialist_id"
                                >
                                    <option
                                        v-for="opt in specialists"
                                        :value="opt.id"
                                    >
                                        {{ opt.specialist_name }}
                                    </option>
                                </select>
                                <div
                                    v-if="errors?.specialist_id"
                                    class="invalid-feedback"
                                >
                                    {{ errors?.specialist_id }}
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="doctor_name"
                                    >Doctor name
                                    <span class="text-danger">*</span></label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="data.doctor_name"
                                    :class="{
                                        'is-invalid': errors?.doctor_name,
                                    }"
                                    tabindex="1"
                                    required
                                />
                                <div
                                    v-if="errors?.doctor_name"
                                    class="invalid-feedback"
                                >
                                    {{ errors?.doctor_name }}
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="email"
                                    >Email
                                    <span class="text-danger">*</span></label
                                >
                                <input
                                    type="email"
                                    class="form-control"
                                    v-model="data.doctor_email"
                                    :class="{
                                        'is-invalid': errors?.doctor_email,
                                    }"
                                    tabindex="1"
                                    required
                                />
                                <div
                                    v-if="errors?.doctor_email"
                                    class="invalid-feedback"
                                >
                                    {{ errors?.doctor_email }}
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="doctor_phone"
                                    >Phone
                                    <span class="text-danger">*</span></label
                                >
                                <input
                                    type="number"
                                    class="form-control"
                                    v-model="data.doctor_phone"
                                    :class="{
                                        'is-invalid': errors?.doctor_phone,
                                    }"
                                    tabindex="1"
                                    required
                                />
                                <div
                                    v-if="errors?.doctor_phone"
                                    class="invalid-feedback"
                                >
                                    {{ errors?.doctor_phone }}
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="sip"
                                    >SIP
                                    <span class="text-danger">*</span></label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="data.sip"
                                    :class="{
                                        'is-invalid': errors?.sip,
                                    }"
                                    tabindex="1"
                                    required
                                />
                                <div
                                    v-if="errors?.sip"
                                    class="invalid-feedback"
                                >
                                    {{ errors?.sip }}
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="nik">NIK</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    v-model="data.nik"
                                    :class="{
                                        'is-invalid': errors?.nik,
                                    }"
                                    tabindex="1"
                                />
                                <div
                                    v-if="errors?.nik"
                                    class="invalid-feedback"
                                >
                                    {{ errors?.nik }}
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="id_ihs">ID IHS</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="data.id_ihs"
                                    :class="{
                                        'is-invalid': errors?.id_ihs,
                                    }"
                                    tabindex="1"
                                />
                                <div
                                    v-if="errors?.id_ihs"
                                    class="invalid-feedback"
                                >
                                    {{ errors?.id_ihs }}
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="profile_pict"
                                    >Doctor Profile Picture</label
                                >
                                <input
                                    type="file"
                                    @input="
                                        data.doctor_profile_pict =
                                            $event.target.files[0]
                                    "
                                    class="form-control"
                                    :class="{
                                        'is-invalid':
                                            errors?.doctor_profile_pict,
                                    }"
                                />
                                <div
                                    v-if="errors?.doctor_profile_pict"
                                    class="invalid-feedback"
                                >
                                    {{ errors?.doctor_profile_pict }}
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <label for="doctor_address"
                                    >Doctor Address</label
                                >
                                <textarea
                                    class="form-control"
                                    v-model="data.doctor_address"
                                    data-height="75"
                                ></textarea>
                                <div
                                    v-if="errors?.doctor_address"
                                    class="invalid-feedback"
                                >
                                    {{ errors?.doctor_address }}
                                </div>
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
