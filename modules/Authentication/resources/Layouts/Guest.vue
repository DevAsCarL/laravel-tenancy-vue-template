<template>
    <Head>
        <title></title>
    </Head>

    <div class="tw-min-h-full">
        <!-- <Header :menu="menu" /> -->

        <main>
            <div class="tw-mx-auto tw-max-w-2xl  tw-px-4 sm:tw-px-6 lg:tw-px-8">
                <slot />
            </div>
        </main>
    </div>

    <Notice />
</template>

<script>
    import Header from "@js/Components/Header.vue";
    import Notice from "@js/Components/Notice.vue";

    export default {
        name: "Guest Layout",

        components: {
            Header,
            Notice,
        },

        data() {
            return {
                menu: [
                    {
                        label: "Login",
                        route: route("login"),
                        condition: true,
                        components: ['Login/Show'],
                    },
                    {
                        label: "Register",
                        route: route("register"),
                        condition: true,
                        components: ['Register/Show'],
                    },
                ],
            };
        },
    };
</script>
