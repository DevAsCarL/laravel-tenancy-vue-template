<template>
    <Head :title="title" />

    <h1 v-text="title" class="lg:tw-text-4xl tw-text-3xl ftw-ont-medium tw-text-slate-800 lg:tw-mb-8 tw-mb-4"></h1>

    <div class="tw-bg-white tw-rounded-2xl lg:tw-p-10 tw-p-6 tw-border tw-border-slate-200">
        <p v-if="userCan($page.props, 'create-posts')">User can create posts.</p>
        <p v-else>User can't create posts.</p>
    </div>
</template>

<script setup lang="ts">
import App from "@js/Layouts/Tenant/App.vue";
import { ref } from "vue";

defineOptions({
    layout: App,
});

const title = "Home";
</script>
