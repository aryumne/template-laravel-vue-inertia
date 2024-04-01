<script setup>
import { Link } from "@inertiajs/vue3";
import { getSrcAvatar } from "../../Utils";
const updateSidebarNiceScroll = () => {
    const interval = setInterval(() => {
        if (window.sidebar_nicescroll !== null) {
            window.sidebar_nicescroll.resize();
        }
    }, 10);

    setTimeout(() => {
        clearInterval(interval);
    }, 600);
};

const toggleSidebarMini = (mini) => {
    const body = document.body;

    if (!mini) {
        body.classList.remove("sidebar-mini");
        document.querySelector(".main-sidebar").style.overflow = "hidden";
        setTimeout(() => {
            document
                .querySelector(".main-sidebar")
                .niceScroll(window.sidebar_nicescroll_opts);
            window.sidebar_nicescroll = document
                .querySelector(".main-sidebar")
                .getNiceScroll();
        }, 500);
        document
            .querySelectorAll(
                ".main-sidebar .sidebar-menu > li > ul .dropdown-title"
            )
            .forEach((element) => {
                element.remove();
            });
        document
            .querySelectorAll(".main-sidebar .sidebar-menu > li > a")
            .forEach((element) => {
                element.removeAttribute("data-toggle");
                element.removeAttribute("data-original-title");
                element.removeAttribute("title");
            });
    } else {
        body.classList.add("sidebar-mini");
        body.classList.remove("sidebar-show");
        if (window.sidebar_nicescroll) {
            window.sidebar_nicescroll.remove();
            window.sidebar_nicescroll = null;
        }
        document
            .querySelectorAll(".main-sidebar .sidebar-menu > li")
            .forEach((element) => {
                if (element.querySelector(".dropdown-menu")) {
                    element.querySelector(".dropdown-menu").style.display =
                        "none";
                    const dropdownTitle = document.createElement("li");
                    dropdownTitle.classList.add("dropdown-title", "pt-3");
                    dropdownTitle.textContent =
                        element.querySelector("a").textContent;
                    element
                        .querySelector(".dropdown-menu")
                        .prepend(dropdownTitle);
                } else {
                    element
                        .querySelector("a")
                        .setAttribute("data-toggle", "tooltip");
                    element
                        .querySelector("a")
                        .setAttribute(
                            "data-original-title",
                            element.querySelector("a").textContent
                        );
                    $('[data-toggle="tooltip"]').tooltip({
                        placement: "right",
                    });
                }
            });
    }
};

const toggleSidebar = () => {
    const body = document.querySelector("body");
    const w = window.outerWidth;

    if (w <= 1024) {
        body.classList.remove("search-show", "search-gone");
        if (body.classList.contains("sidebar-gone")) {
            body.classList.remove("sidebar-gone");
            body.classList.add("sidebar-show");
        } else {
            body.classList.add("sidebar-gone");
            body.classList.remove("sidebar-show");
        }

        updateSidebarNiceScroll();
    } else {
        body.classList.remove("search-show", "search-gone");
        if (body.classList.contains("sidebar-mini")) {
            toggleSidebarMini(false);
        } else {
            toggleSidebarMini(true);
        }
    }
};
</script>
<template>
    <div class="navbar-bg"></div>
    <nav class="navbar navbar-expand-lg main-navbar">
        <div class="mr-auto">
            <ul class="navbar-nav mr-3">
                <li>
                    <a
                        href="#"
                        @click="toggleSidebar"
                        class="nav-link nav-link-lg"
                    >
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>
        </div>
        <ul class="navbar-nav navbar-right">
            <li class="dropdown">
                <a
                    href="#"
                    data-toggle="dropdown"
                    class="nav-link dropdown-toggle nav-link-lg nav-link-user"
                >
                    <figure class="avatar avatar-sm mr-1">
                        <img
                            :src="getSrcAvatar($page.props.user.profile_pict)"
                            alt="foto-profile"
                        />
                    </figure>
                    <div class="d-sm-none d-lg-inline-block">
                        Hi, {{ $page.props.user.name }}
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-title">Logged in 5 min ago</div>
                    <a
                        href="features-profile.html"
                        class="dropdown-item has-icon"
                    >
                        <i class="far fa-user"></i> Profile
                    </a>
                    <!-- <a
                        href="features-settings.html"
                        class="dropdown-item has-icon"
                    >
                        <i class="fas fa-cog"></i> Settings
                    </a> -->
                    <div class="dropdown-divider"></div>
                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        class="dropdown-item has-icon text-danger"
                    >
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </Link>
                </div>
            </li>
        </ul>
    </nav>
</template>

<style>
button.dropdown-item {
    padding: 10px 20px !important;
    font-weight: 500;
    line-height: 1.2;
}

.dropdown-menu button {
    font-size: 13px;
}
</style>
