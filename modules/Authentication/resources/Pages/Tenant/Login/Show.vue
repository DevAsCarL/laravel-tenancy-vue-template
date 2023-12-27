<template>
    <Head :title="title" />

    <h1
        v-text="title"
        class="lg:tw-text-4xl tw-text-3xl tw-font-medium tw-text-slate-800 tw-text-center lg:tw-mb-8 tw-mb-4"
    ></h1>

    <div class="tw-bg-white tw-rounded-2xl lg:tw-p-10 tw-p-6 tw-border tw-border-slate-200">
        <form @submit.prevent="submitLoginForm">
            <div class="tw-grid tw-grid-cols-1 tw-gap-5 sm:tw-gap-7 sm:tw-grid-cols-6">
                <div class="tw-col-span-full">
                    <label
                        class="tw-pb-2 tw-block tw-text-base tw-font-medium tw-leading-6 tw-text-slate-800"
                        for="email"
                    >
                        Email
                    </label>
                    <input
                        id="email"
                        type="email"
                        required
                        class="tw-block tw-w-full tw-rounded-md tw-border-slate-300 tw-shadow-sm focus:tw-border-slate-300 focus:tw-ring focus:tw-ring-slate-200 focus:tw-ring-opacity-50"
                        v-model="loginForm.email"
                    />
                </div>

                <div class="tw-col-span-full">
                    <label
                        class="tw-pb-2 tw-block tw-text-base tw-font-medium tw-leading-6 tw-text-slate-800"
                        for="password"
                    >
                        Password
                    </label>
                    <input
                        id="password"
                        type="password"
                        class="tw-block tw-w-full tw-rounded-md tw-border-slate-300 tw-shadow-sm focus:tw-border-slate-300 focus:tw-ring focus:tw-ring-slate-200 focus:tw-ring-opacity-50"
                        required
                        v-model="loginForm.password"
                    />
                </div>

                <div class="tw-col-span-full">
                    <div class="tw-flex tw-items-center gap-x-2">
                        <input
                            id="remember"
                            type="checkbox"
                            class="tw-h-5 tw-w-5 tw-rounded tw-text-slate-800 tw-border-slate-300 focus:tw-border-slate-300 focus:tw-ring focus:tw-ring-slate-200 focus:tw-ring-opacity-50"
                            v-model="loginForm.remember"
                        />
                        <label
                            for="remember"
                            class="tw-block tw-text-sm tw-font-medium tw-leading-6 tw-text-slate-800"
                        >
                            Remember
                        </label>
                    </div>
                </div>

                <div class="tw-col-span-full">
                    <Button
                        text="Log In"
                        styles="full"
                        :disabled="loginForm.processing"
                    />
                </div>
            </div>
        </form>

        <div class="tw-mt-5 sm:tw-mt-7">
            <p class="tw-text-center tw-text-slate-800">
                <Link
                    class="tw-underline hover:tw-no-underline"
                    :href="route('register')"
                >
                Register
                </Link>
            </p>
        </div>
    </div>
</template>


<script setup lang="ts">
import Button from "@/js/Components/Button.vue";
import { useForm } from "@inertiajs/vue3";
import App from "@js/Layouts/Tenant/App.vue";
import { ref } from "vue";

defineOptions({
    layout: App,
  });

const props = defineProps<{
  email: string;
  password: string;
  remember: boolean;
  redirect: string;
  appName: string;
}>();

const title = ref(props.appName);
const loginForm = useForm({
  email: props.email,
  password: props.password,
  remember: props.remember,
  redirect: props.redirect,
});

const submitLoginForm = () => {
  loginForm.post(route("login.store"));
};
</script>
