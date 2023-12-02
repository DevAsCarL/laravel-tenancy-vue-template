<template>
    <q-dialog v-model="props.showDialog" @hide="close" @show="create">
        <q-card style="width: 600px; max-width: 80vw;">
            <q-card-section class="q-pt-none">
                <q-form @submit.prevent="submit" class="row py-4 q-pa-md q-gutter-sm justify-center">
                    <q-input class="col-12 col-md-5" v-if="props.recordId === null" v-model="form.number" :maxlength="11"
                        label="RUC" mask="###########" :class="{ 'q-error': errors.number }"
                        :rules="[val => !!val || 'este campo es requerido']">
                        <template v-slot:append>
                            <q-btn color="primary">
                                <div class="ellipsis">
                                    SUNAT
                                    <q-icon name="search" slot="after" class="cursor-pointer" @click="searchSunat" />
                                </div>
                            </q-btn>
                        </template>
                    </q-input>
                    <q-input v-else class="col-12 col-md-5" v-model="form.number" :maxlength="11" label="RUC"
                        :class="{ 'q-error': errors.number }" :rules="[val => !!val || 'este campo es requerido']"
                        readonly />
                    <q-input class="col-12 col-md-5" v-model="form.name" label="Nombre de la Empresa"
                        :class="{ 'q-error': errors.name }" :rules="[val => !!val || 'este campo es requerido']" />
                    <q-input v-if="props.recordId == null" class="col-12 col-md-5" v-model="form.subdomain"
                        label="Nombre de Subdominio" :class="{ 'q-error': errors.subdomain }"
                        :rules="[val => !!val || 'este campo es requerido']">
                        <template v-slot:append>
                            <p style="font-size: 0.8rem;display: flex; align-items: end; height: 100%;">{{ url_base }}</p>
                        </template>
                    </q-input>
                    <q-input v-else class="col-12 col-md-5" v-model="form.hostname" label="Nombre de la Empresa"
                        :class="{ 'q-error': errors.hostname }" :rules="[val => !!val || 'este campo es requerido']" />
                    <q-input v-else class="col-12 col-md-5" v-model="form.email" :maxlength="11"
                        label="Nombre de la Empresa" :class="{ 'q-error': errors.email }" />
                    <q-input class="col-12 col-md-5" v-model="form.password" filled :type="isPwd ? 'password' : 'text'">
                        <template v-slot:append>
                            <q-icon :name="isPwd ? 'visibility_off' : 'visibility'" class="cursor-pointer"
                                @click="isPwd = !isPwd" />
                        </template>
                    </q-input>
                    <q-select class="col-12 col-md-5" v-model="form.plan_id" :options="plans" label="Plan" />

                    <q-input class="col-12 col-md-5" filled v-model="form.plan_start_date" mask="date">
                        <template v-slot:append>
                            <q-icon name="event" class="cursor-pointer">
                                <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                                    <q-date v-model="form.plan_start_date">
                                        <div class="row items-center justify-end">
                                            <q-btn v-close-popup label="Close" color="primary" flat />
                                        </div>
                                    </q-date>
                                </q-popup-proxy>
                            </q-icon>
                        </template>
                    </q-input>

                    <q-input class="col-12 col-md-5" v-model="form.amount" :precision="2" :step="0.1" :min="0.00"
                        label="Monto" mask="#.##" input-class="text-right" :class="{ 'q-error': errors.amount }" />

                    <q-card-actions class="col-12" align="right">
                        <q-btn label="Cancelar" color="primary" @click="close" />
                        <q-btn label="Guardar" color="primary" type="submit" :loading="loading_submit"
                            :disable="loading_submit" />
                    </q-card-actions>
                </q-form>
            </q-card-section>
        </q-card>
    </q-dialog>
</template>

<script setup lang="ts">
import { functions, exchangeRate, serviceNumber } from "@/js/utilities/mixins/functions";

import axios from "axios";
import { $eventHub } from "@/js/utilities/events.js";
import { onMounted, reactive, ref, toRefs } from "vue";
import { useQuasar } from "quasar";

const props = defineProps(["showDialog", "recordId"]);
const emit = defineEmits(['onCreate', 'update:showDialog'])
const $message = useQuasar();
const loading_submit = ref<boolean>(false);
const loading_search = ref<boolean>(false);
const show = ref<boolean>(props.showDialog);
const titleDialog = ref<string | null>(null);
const resource = "clients";
let errors = ref({});
let form = reactive({
    id: null,
    name: "",
    hostname: "",
    email: "consulta@disoft.pe",
    subdomain: "",
    identity_document_type_id: "6",
    number: "",
    password: "dsjoe280811$",
    plan_id: 1,
    plan_start_date: new Date().toISOString().slice(0, 10),
    amount: 0.00,
});
let url_base = ref<string | null>(null);
let plans = ref<any[]>([]);
const isPwd = ref<boolean>(true);
onMounted(() => {
    initForm();
    axios.get(`/${resource}/tables`).then((response) => {
        url_base.value = response.data.url_base;
        plans.value = response.data.plans;
    });
});

const initForm = () => {
    errors.value = {};
    Object.assign(form, {
        id: null,
        name: "",
        hostname: "",
        email: "consulta@disoft.pe",
        subdomain: "",
        identity_document_type_id: "6",
        number: "",
        password: "dsjoe280811$",
        plan_id: 1,
        plan_start_date: new Date().toISOString().slice(0, 10),
        amount: 0.00,
    });
};

const create = async () => {
    titleDialog.value = props.recordId ? "Editar Cliente" : "Nuevo Cliente";
    if (props.recordId) {
        let response = await axios.get(`/${resource}/record/${props.recordId}`);
        form = response.data.data;
        form.subdomain = form.hostname;
    }
};

const submit = () => {
    loading_submit.value = true;
    axios
        .post(`/${resource}`, form)
        .then((response) => {
            if (response.data.success) {
                $message.notify({
                    type: 'positive',
                    position: 'top',
                    message: response.data.message
                });
                $eventHub.emit("reloadData");
                close();
            } else {
                $message.notify({
                    type: 'negative',
                    position: 'top',
                    message: response.data.message
                });
            }
        })
        .catch((error) => {
            if (error.response.status === 422) {
                error.value = error.response.data;
            } else {
                console.log(error.response);
            }
        })
        .then(() => {
            loading_submit.value = false;
        });
};

const close = () => {
    emit("update:showDialog", false);
    initForm();
};

const searchSunat = () => {
    searchServiceNumber();
};

const searchServiceNumber = async () => {
    if (form.number === '') {
        // Puedes lanzar una excepción o manejar el error según sea necesario
        console.error('Ingresar el número a buscar');
        return;
    }

    loading_search.value = true;

    try {
        const response = await axios.get(`/services/ruc/${form.number}`);
        const responseData = response.data;

        if (responseData.success) {
            const data = responseData.data;
            form.name = data.name;
        } else {
            console.error(responseData.message);
        }
    } catch (error) {
        console.error(error.response);
    } finally {
        loading_search.value = false;
    }
};
</script>

