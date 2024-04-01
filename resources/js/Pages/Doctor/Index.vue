<script setup>
import { Link, Head, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import MainLayout from "../../Layouts/MainLayout.vue";
import SectionHeader from "../../Components/sections/SectionHeader.vue";
import Create from "./Create.vue";
import { getSrcAvatar } from "../../Utils";
const props = defineProps({
    data: {
        type: Object,
    },
    specialists: {
        type: Object,
    },
    filters: {
        type: Object,
    },
    errors: {
        type: Object,
    },
});

const search = ref(props.filters.search);
const entires = ref(props.data.per_page);

watch(search, (val) => {
    router.get(
        route("doctors.index"),
        { search: val },
        { preserveState: true }
    );
});

watch(entires, (val) => {
    console.log(val);
    let currentParams = route().params;
    currentParams.entires = val;
    currentParams.page = 1;
    router.get(route("doctors.index"), currentParams, { preserveState: true });
});

function deleteRow(id) {
    router.delete(route("doctors.destroy", id), {
        preserveScroll: true,
        onBefore: () => confirm("Are you sure?"),
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
    });
}
</script>
<template>
    <Head title="Manage Doctor" />

    <MainLayout>
        <div class="main-content">
            <section class="section">
                <SectionHeader title="Manage Doctor"> </SectionHeader>
                <div class="section-body">
                    <button
                        class="btn btn-primary ml-4 mb-2"
                        data-toggle="modal"
                        data-target="#exampleModal"
                    >
                        New Doctor
                    </button>

                    <p class="section-lead ml-4">
                        You can manage all doctors, such as adding a new doctor,
                        editing, deleting etc.
                    </p>

                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body px-3 pt-3">
                                    <div class="float-left">
                                        <select
                                            class="form-control py-0"
                                            v-model="entires"
                                        >
                                            <option>5</option>
                                            <option>10</option>
                                            <option>25</option>
                                            <option>50</option>
                                            <option>100</option>
                                        </select>
                                    </div>
                                    <div class="float-right">
                                        <div class="input-group">
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="Search"
                                                v-model="search"
                                            />
                                            <div class="input-group-append">
                                                <button class="btn btn-primary">
                                                    <i
                                                        class="fas fa-search"
                                                    ></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clearfix mb-3"></div>
                                    <div class="table-responsive">
                                        <table
                                            class="table-striped table-md table"
                                        >
                                            <tr>
                                                <th>
                                                    <div
                                                        class="custom-checkbox custom-control"
                                                    >
                                                        <input
                                                            type="checkbox"
                                                            data-checkboxes="mygroup"
                                                            data-checkbox-role="dad"
                                                            class="custom-control-input"
                                                            id="checkbox-all"
                                                        />
                                                        <label
                                                            for="checkbox-all"
                                                            class="custom-control-label"
                                                            >&nbsp;</label
                                                        >
                                                    </div>
                                                </th>
                                                <th>Name</th>
                                                <th>Contact</th>
                                                <th>SIP</th>
                                                <th>Spesialis</th>
                                                <th>ID IHS</th>
                                                <th class="text-center">
                                                    Action
                                                </th>
                                            </tr>

                                            <tr
                                                v-for="(dt, index) in data.data"
                                            >
                                                <td>
                                                    <figure
                                                        class="avatar avatar-sm mr-2"
                                                    >
                                                        <img
                                                            :src="
                                                                getSrcAvatar(
                                                                    dt?.doctor_profile_pict
                                                                )
                                                            "
                                                            alt="..."
                                                        />
                                                    </figure>
                                                </td>
                                                <td>{{ dt.doctor_name }}</td>
                                                <td>
                                                    <div>
                                                        <p class="p-0 m-0">
                                                            {{
                                                                dt.doctor_email
                                                            }}
                                                        </p>
                                                        <em class="p-0 m-0">
                                                            {{
                                                                dt.doctor_phone
                                                            }}
                                                        </em>
                                                    </div>
                                                </td>
                                                <td>{{ dt.sip }}</td>
                                                <td>
                                                    {{
                                                        dt.doctor_specialist_name
                                                    }}
                                                </td>
                                                <td>{{ dt.id_ihs }}</td>
                                                <td
                                                    class="text-lg-center text-right gap-1"
                                                >
                                                    <Link
                                                        :href="
                                                            route(
                                                                'doctors.edit',
                                                                dt
                                                            )
                                                        "
                                                        class="btn btn-info mr-0 mr-lg-1 mb-1 mb-lg-0 btn-sm"
                                                        >Edit</Link
                                                    >
                                                    <button
                                                        class="btn btn-danger btn-sm"
                                                        @click="
                                                            deleteRow(dt.id)
                                                        "
                                                    >
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div
                                    class="card-footer text-right overflow-auto"
                                >
                                    <nav class="d-inline-block">
                                        <ul class="pagination mb-0">
                                            <template
                                                v-for="(link, i) in data.links"
                                            >
                                                <li
                                                    class="page-item"
                                                    v-if="link.url === null"
                                                >
                                                    <Link
                                                        class="page-link"
                                                        href="#"
                                                        v-html="link.label"
                                                        as="button"
                                                    />
                                                </li>
                                                <li
                                                    class="page-item"
                                                    :class="{
                                                        active: link.active,
                                                    }"
                                                    v-else
                                                >
                                                    <Link
                                                        class="page-link"
                                                        :href="link.url"
                                                        v-html="link.label"
                                                        as="button"
                                                    />
                                                </li>
                                            </template>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </MainLayout>
    <Create :errors="errors" :specialists="specialists" />
</template>
