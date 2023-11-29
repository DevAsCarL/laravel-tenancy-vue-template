<template>
    <q-layout view="hHh Lpr fFf">
        <q-page-container>
            <q-page class="flex flex-center column">

                <Head :title="title" />
                <h1 v-text="title" class="lg:text-3xl text-2xl font-medium text-slate-800 text-center lg:mb-4 mb-2">
                </h1>
                <q-card class="q-pa-lg shadow-2 my_card" bordered>
                    <q-card-section class="text-center">
                        <div class="text-grey-9 text-h5 text-weight-bold">Sign in</div>
                    </q-card-section>
                    <q-form @submit.prevent="submitLoginForm">
                        <q-card-section>
                            <q-input dense outlined v-model="loginForm.email" label="Email Address"></q-input>
                            <q-input dense outlined class="q-mt-md" v-model="loginForm.password" type="password"
                                label="Password"></q-input>
                        </q-card-section>
                        <q-card-section>
                            <q-btn style="
  border-radius: 8px;" color="dark" rounded size="md" label="Sign in" no-caps class="full-width" type="submit"></q-btn>
                        </q-card-section>
                    </q-form>
                </q-card>
            </q-page>
        </q-page-container>
    </q-layout>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
const props = defineProps({
    email: String,
    password: String,
    remember: Boolean,
    redirect: String,
    appName: String,
})
const title = ref(props.appName);
const loginForm = useForm({
    email: props.email,
    password: props.password,
    remember: props.remember,
    redirect: props.redirect,
});

const submitLoginForm = () => {
    loginForm.post(route('login.store'));
};
</script>

