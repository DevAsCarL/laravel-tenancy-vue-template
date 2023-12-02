<template>
  <q-layout class="tw-mt-24">
    <q-page-container class="row flex justify-center items-center gap-6">
      <div class="row col-12 col-md-6">
        <ChartLine :data="dataChartLine"></ChartLine>
      </div>
      <div class="row col-12 col-md-4">
        <div class="col-12 col-sm-6 col-md-12">
          <CardInfo title="Total Clientes" :data="clientCount" icon="person" bgcolor="bg-green" />
        </div>
        <div class="col-12 col-sm-6 col-md-12">
          <CardInfo title="Total Facturado" :data="totalPaid" icon="description" bgcolor="bg-amber" />
        </div>
      </div>
      <DataTable title="Listado de Clientes" :columns="columns" :rows="records" @onCreate="clickCreate" />
    </q-page-container>
  </q-layout>
  <CompaniesForm v-model:showDialog="showDialog" :recordId="recordId" />
</template>
<style>
#client-list .card-header {
  font-size: 1rem;
}
</style>

<script setup lang="ts">
import { ref, onMounted, onBeforeMount, onUnmounted } from 'vue';
import axios from 'axios';
import { $eventHub } from "@/js/utilities/events.js";
import { deletable } from '@/js/utilities/mixins/deletable';
import { changeable } from '@/js/utilities/mixins/changeable';
import CompaniesForm from './Form.vue';
import CardInfo from '@/js/Components/CardInfo.vue';
import DataTable from '@/js/Components/DataTable.vue';
import SystemClientsResetPasswordMassive from './ResetPassword.vue';
import ChartLine from './Charts/Line.vue';
import queryString from 'query-string';
import { computed } from '@vue/reactivity';

const showDialog = ref(false);
const showDialogResetPasswordMassive = ref(false);
const resource = 'clients';
const recordId = ref(null);
const records = ref([]);
const loaded = ref(false);
const year = ref(2019);
const total_documents = ref(0);
const total_payments = ref(0);
const columns = [
  {
    name: 'id',
    label: '#',
    field: 'id'
  },
  { name: 'hostname', align: 'center', label: 'Hostname', field: 'hostname', sortable: true },
  { name: 'name', align: 'center', label: 'Nombre', field: 'name', sortable: true },
  { name: 'number', align: 'center', label: 'RUC', field: 'number', sortable: true },
  { name: 'plan', align: 'center', label: 'Plan', field: 'plan', sortable: true },
  { name: 'plan_start_date', align: 'center', label: 'F. Inicio de Plan', field: 'plan_start_date', sortable: true },
  { name: 'amount', align: 'center', label: 'Monto', field: 'amount', sortable: true },
  { name: 'email', align: 'center', label: 'Correo', field: 'email', sortable: true },
  { name: 'count_doc', align: 'center', label: 'Comprobantes', field: 'count_doc', sortable: true },
  { name: 'created_at', align: 'center', label: 'F.Creación', field: 'created_at', sortable: true },
  { name: 'Acciones', align: 'center', label: 'Acciones', field: 'hostname', sortable: true },
]


const dataChartLine = ref({
  labels: null,
  datasets: [
    {
      label: 'Total',
      backgroundColor: '#28a745',
      borderColor: '#28a745',
      fill: true,
      data: null,
    },
  ],
});
const filter = ref({
  active: 0,
});
const array_options = [
  {
    id: 0,
    value: 'Todos',
  },
  {
    id: 1,
    value: 'Activo',
  },
  {
    id: 2,
    value: 'Inactivo',
  },
];
const clients_active = ref(0);
const clients_all = ref(0);
const clientCount = computed(() => `${clients_active.value}/${clients_all.value}`);
const totalPaid = computed(() => total_payments.value.toFixed(2));
const getQueryParameters = () => {
  return queryString.stringify({
    ...filter.value,
  });
};

const getData = () => {
  loaded.value = false;
  axios.get(`/${resource}/charts`).then((response: { data: { line: any; total_documents: number; total_payments: number; year: number; }; }) => {
    let line = response.data.line;
    dataChartLine.value.labels = line.labels;
    dataChartLine.value.datasets[0].data = line.data;
    total_documents.value = response.data.total_documents;
    total_payments.value = response.data.total_payments;
    year.value = response.data.year;
  });
  axios.get(`/${resource}/tables`).then((response: { data: { clients_active: number; clients_all: number; }; }) => {
    clients_active.value = response.data.clients_active;
    clients_all.value = response.data.clients_all;
  });
  axios.get(`/${resource}/records?${getQueryParameters()}`).then((response: { data: never[]; }) => {
    records.value = response.data;
    loaded.value = true;
  });
};

onMounted(() => {
  getData();
});

onBeforeMount(() => {
  // Escucha el evento y recarga los datos
  const reloadDataHandler = () => {
    getData();
  };
  $eventHub.on('reloadData', reloadDataHandler);

  // Limpia el evento cuando el componente se destruye
  onUnmounted(() => {
    $eventHub.off('reloadData', reloadDataHandler);
  });
});

const clickResetPasswordMassive = () => {
  showDialogResetPasswordMassive.value = true;
};

const clickCreate = (id = null) => {
  recordId.value = id;
  showDialog.value = true;
};

const clickEdit = (id = null) => {
  recordId.value = id;
  showDialog.value = true;
};

const clickPassword = (id: any) => {
  change(`/${resource}/password/${id}`);
};

const clickDelete = (id: any) => {
  destroy(`/${resource}/${id}`).then(() => {
    $eventHub.emit('reloadData');
  });
};

const changeActive = (id: any, value: any) => {
  axios.post(`/${resource}/active`, { id: id, active: value }).then((response: { data: { message: any; }; }) => {
    $message.success(response.data.message);
    getData();
  });
};
</script>
