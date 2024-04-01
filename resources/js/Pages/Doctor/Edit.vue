<script setup>
import { Head, Link, useForm, router } from "@inertiajs/vue3";
import MainLayout from "../../Layouts/MainLayout.vue";
import SectionHeader from "../../Components/sections/SectionHeader.vue";
import { getSrcAvatar } from "../../Utils";

const props = defineProps({
    doctor: {
        type: Object,
    },
    specialists: {
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
    id: props?.doctor?.id,
    doctor_name: props?.doctor?.doctor_name,
    doctor_email: props?.doctor?.doctor_email,
    doctor_phone: props?.doctor?.doctor_phone,
    doctor_address: props?.doctor?.doctor_address,
    specialist_id: props?.doctor?.specialist_id,
    docter_specialist_name: props?.doctor?.specialist_name,
    sip: props?.doctor?.sip,
    id_ihs: props?.doctor?.id_ihs,
    nik: props?.doctor?.nik,
    doctor_profile_pict: "",
});

function saveChanges() {
    // penulisan route harus url, tidak dapat berfungsi jika menggunakan route('routename')
    router.post(
        `/doctors/${data.id}`,
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
    <Head title="Edit Doctor" />
    <MainLayout>
        <div class="main-content">
            <section class="section">
                <SectionHeader title="Edit Doctor" />
                <div class="section-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-12 col-md-4">
                            <div class="card profile-widget">
                                <div class="profile-widget-header">
                                    <img
                                        alt="image"
                                        :src="
                                            getSrcAvatar(
                                                doctor?.doctor_profile_pict
                                            )
                                        "
                                        height="100"
                                        width="150"
                                        class="rounded-circle profile-widget-picture"
                                    />
                                    <div class="profile-widget-items">
                                        <div
                                            class="profile-widget-item text-left ml-4"
                                        >
                                            <div
                                                class="profile-widget-item-value mb-1"
                                            >
                                                {{ doctor?.doctor_name }}
                                            </div>
                                            <div
                                                class="profile-widget-item-label"
                                            >
                                                {{
                                                    doctor?.doctor_specialist_name
                                                }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-widget-description pb-0">
                                    <div class="profile-widget-name">
                                        Email : {{ doctor?.doctor_email }}
                                    </div>
                                    <div class="profile-widget-name">
                                        Phone : {{ doctor?.doctor_phone }}
                                    </div>
                                    <div class="profile-widget-name">
                                        Address : {{ doctor?.doctor_address }}
                                    </div>
                                    <div class="profile-widget-name">
                                        SIP : {{ doctor?.sip }}
                                    </div>
                                    <div class="profile-widget-name">
                                        ID IHS : {{ doctor?.id_ihs }}
                                    </div>
                                    <div class="profile-widget-name">
                                        NIK : {{ doctor?.nik }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="card">
                                <form @submit.prevent="saveChanges">
                                    <div class="card-body">
                                        <div class="row">
                                            <div
                                                class="form-group col-12 col-md-6"
                                            >
                                                <label for="specialist_id"
                                                    >Spesialist
                                                    <span class="text-danger"
                                                        >*</span
                                                    ></label
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
                                                        {{
                                                            opt.specialist_name
                                                        }}
                                                    </option>
                                                </select>
                                                <div
                                                    v-if="errors?.specialist_id"
                                                    class="invalid-feedback"
                                                >
                                                    {{ errors?.specialist_id }}
                                                </div>
                                            </div>
                                            <div
                                                class="form-group col-12 col-md-6"
                                            >
                                                <label for="doctor_name"
                                                    >Doctor name
                                                    <span class="text-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="data.doctor_name"
                                                    :class="{
                                                        'is-invalid':
                                                            errors?.doctor_name,
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
                                            <div
                                                class="form-group col-12 col-md-6"
                                            >
                                                <label for="email"
                                                    >Email
                                                    <span class="text-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <input
                                                    type="email"
                                                    class="form-control"
                                                    v-model="data.doctor_email"
                                                    :class="{
                                                        'is-invalid':
                                                            errors?.doctor_email,
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
                                            <div
                                                class="form-group col-12 col-md-6"
                                            >
                                                <label for="doctor_phone"
                                                    >Phone
                                                    <span class="text-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <input
                                                    type="number"
                                                    class="form-control"
                                                    v-model="data.doctor_phone"
                                                    :class="{
                                                        'is-invalid':
                                                            errors?.doctor_phone,
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
                                            <div
                                                class="form-group col-12 col-md-6"
                                            >
                                                <label for="sip"
                                                    >SIP
                                                    <span class="text-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="data.sip"
                                                    :class="{
                                                        'is-invalid':
                                                            errors?.sip,
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
                                            <div
                                                class="form-group col-12 col-md-6"
                                            >
                                                <label for="nik">NIK</label>
                                                <input
                                                    type="number"
                                                    class="form-control"
                                                    v-model="data.nik"
                                                    :class="{
                                                        'is-invalid':
                                                            errors?.nik,
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
                                            <div
                                                class="form-group col-12 col-md-6"
                                            >
                                                <label for="id_ihs"
                                                    >ID IHS</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="data.id_ihs"
                                                    :class="{
                                                        'is-invalid':
                                                            errors?.id_ihs,
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
                                            <div
                                                class="form-group col-12 col-md-6"
                                            >
                                                <label for="profile_pict"
                                                    >Doctor Profile
                                                    Picture</label
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
                                                    v-if="
                                                        errors?.doctor_profile_pict
                                                    "
                                                    class="invalid-feedback"
                                                >
                                                    {{
                                                        errors?.doctor_profile_pict
                                                    }}
                                                </div>
                                            </div>

                                            <div class="form-group col-12">
                                                <label for="doctor_address"
                                                    >Doctor Address</label
                                                >
                                                <textarea
                                                    class="form-control"
                                                    v-model="
                                                        data.doctor_address
                                                    "
                                                    data-height="75"
                                                ></textarea>
                                                <div
                                                    v-if="
                                                        errors?.doctor_address
                                                    "
                                                    class="invalid-feedback"
                                                >
                                                    {{ errors?.doctor_address }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <Link
                                            :href="route('doctors.index')"
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
