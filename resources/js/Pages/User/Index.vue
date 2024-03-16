<script setup>
import { Link, Head, router } from "@inertiajs/vue3";
import MainLayout from "../../Layouts/MainLayout.vue";
import SectionHeader from "../../Components/sections/SectionHeader.vue";
import Create from "./Create.vue";
defineProps({
    data: {
        type: Object,
    },
    errors: {
        type: Object,
    },
});

function deleteRow(id) {
    router.delete(route("users.destroy", id), {
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

function getSrcAvatar(path) {
    let src = import.meta.env.VITE_APP_URL;
    if (path !== null) return src + "/storage/" + path;
    else return src + "/assets/img/avatar/avatar-1.png";
}
</script>
<template>
    <Head title="Manage User" />

    <MainLayout>
        <div class="main-content">
            <section class="section">
                <SectionHeader title="Manage User"> </SectionHeader>
                <div class="section-body">
                    <button
                        class="btn btn-primary ml-4 mb-2"
                        data-toggle="modal"
                        data-target="#exampleModal"
                    >
                        New user
                    </button>

                    <p class="section-lead ml-4">
                        You can manage all users, such as adding a new user,
                        editing, deleting etc.
                    </p>

                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body px-3 pt-3">
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
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th class="text-center">
                                                    Action
                                                </th>
                                            </tr>

                                            <tr
                                                v-for="(dt, index) in data.data"
                                            >
                                                <td>
                                                    <!-- <div
                                                        class="custom-checkbox custom-control"
                                                    >
                                                        <input
                                                            type="checkbox"
                                                            data-checkboxes="mygroup"
                                                            :value="dt.id"
                                                            class="custom-control-input"
                                                            :id="`checkbox-${index}`"
                                                        />
                                                        <label
                                                            :for="`checkbox-${index}`"
                                                            class="custom-control-label"
                                                            >&nbsp;</label
                                                        >
                                                    </div> -->
                                                    <figure
                                                        class="avatar avatar-sm mr-2"
                                                    >
                                                        <img
                                                            :src="
                                                                getSrcAvatar(
                                                                    dt?.profile_pict
                                                                )
                                                            "
                                                            alt="..."
                                                        />
                                                    </figure>
                                                </td>
                                                <td>{{ dt.name }}</td>
                                                <td>{{ dt.email }}</td>
                                                <td>{{ dt.role }}</td>
                                                <td>
                                                    <div
                                                        class="badge badge-success"
                                                        v-if="
                                                            dt.is_active === 1
                                                        "
                                                    >
                                                        Active
                                                    </div>
                                                    <div
                                                        class="badge badge-danger"
                                                        v-else
                                                    >
                                                        Not Active
                                                    </div>
                                                </td>
                                                <td
                                                    class="text-lg-center text-right gap-1"
                                                >
                                                    <Link
                                                        :href="
                                                            route(
                                                                'users.edit',
                                                                dt.id
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
    <Create :errors="errors" />
</template>
