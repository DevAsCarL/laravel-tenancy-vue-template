<template>
    <Head>
        <title></title>
    </Head>

    <div class="tw-min-h-full">
        <Header :menu="menu" />

        <main>
            <div class="tw-mx-auto tw-max-w-7xl tw-px-4 tw-sm:px-6 tw-lg:px-8">
                <slot />
            </div>
        </main>
    </div>

    <Notice />
</template>

<script>
import { router } from "@inertiajs/core";

import Header from "@js/Components/Header.vue";
import Notice from "@js/Components/Notice.vue";

export default {
    name: "App Layout",

    components: {
        Header,
        Notice,
    },

    data() {
        return {
            menu: [
                {
                    label: "Home",
                    route: route("clients"),
                    condition: true,
                    components: ['System/Clients/Index'],
                },
                {
                    label: "Account",
                    route: route("account.edit"),
                    condition: true,
                    components: ['Account/Edit'],
                },
                {
                    label: "Organisation",
                    route: route("organisation.edit"),
                    condition: this.userCan(this.$page.props, 'edit-organisation'),
                    components: ['Organisation/Edit'],
                },
                {
                    label: "Logout",
                    route: route("logout"),
                    condition: true,
                    components: [],
                },
            ],

            mobileMenuOpen: false,
        };
    },

    mounted() {
        router.on("success", () => {
            this.mobileMenuOpen = false;
        });
    },
};
</script>
