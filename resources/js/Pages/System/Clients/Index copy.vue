<template>
  <q-layout>
    <q-page-container>
      <q-page>
        <q-row>
          <q-col cols="12" lg="8" class="mb-3">
            <q-card>
              <q-card-section class="q-pa-0">
                <q-row>
                  <q-col cols="12">
                    <div class="chart-data-selector ready q-pl-3 q-pr-4 q-pt-4">
                      <div class="chart-data-selector-items">
                        <chart-line v-if="loaded" :data="dataChartLine"></chart-line>
                      </div>
                    </div>
                  </q-col>
                </q-row>

                <q-row class="q-px-4 q-mt-2 q-pb-3">
                  <q-col cols="2" class="font-weight-bold text-primary">
                    {{ year }}
                  </q-col>
                  <q-col cols="10" class="font-weight-semibold text-right">
                    Totales generados por mes
                  </q-col>
                </q-row>
              </q-card-section>
            </q-card>
          </q-col>

          <q-col cols="12" lg="4">
            <q-row class="mb-3">
              <q-col cols="12" md="6">
                <q-card class="card-horizontal" flat>
                  <q-card-section class="bg-success">
                    <q-icon name="fas fa-users" class="text-white"></q-icon>
                  </q-card-section>
                  <q-card-section class="q-p-4 text-center">
                    <p class="font-weight-semibold mb-0">Total Clientes</p>
                    <h2 class="font-weight-semibold mt-0">
                      {{ clients_active }} / {{ clients_all }}
                    </h2>
                    <q-footer class="text-muted text-uppercase">
                      <q-item-label>Ver todos</q-item-label>
                    </q-footer>
                  </q-card-section>
                </q-card>
              </q-col>

              <q-col cols="12" md="6">
                <q-card class="card-horizontal" flat>
                  <q-card-section class="bg-info">
                    <q-icon name="fas fa-file-alt" class="text-white"></q-icon>
                  </q-card-section>
                  <q-card-section class="q-p-4 text-center">
                    <p class="font-weight-semibold mb-0 mt-3">Total Facturado</p>
                    <h2 class="font-weight-semibold mt-0 mb-3">
                      {{ total_payments.toFixed(2) }}
                    </h2>
                  </q-card-section>
                </q-card>
              </q-col>
            </q-row>

            <q-card id="client-list">
              <q-card-section class="bg-info">Listado de Clientes</q-card-section>
              <q-card-section>
                <!-- Your client list content goes here -->
              </q-card-section>
            </q-card>
          </q-col>
        </q-row>
      </q-page>
    </q-page-container>
  </q-layout>
</template>
<style>
#client-list .card-header {
  font-size: 1rem;
}
</style>
<script>
import CompaniesForm from "./Form.vue";
import { deletable } from "@/js/utilities/mixins/deletable";
import { changeable } from "@/js/utilities/mixins/changeable";
import SystemClientsResetPasswordMassive from "./ResetPassword.vue";
import ChartLine from "./Charts/Line.vue";
import queryString from "query-string";

export default {
  mixins: [deletable, changeable],
  components: { CompaniesForm, ChartLine, SystemClientsResetPasswordMassive },
  data() {
    return {
      showDialog: false,
      showDialogResetPasswordMassive: false,
      resource: "clients",
      recordId: null,
      records: [],
      loaded: false,
      year: 2019,
      total_documents: 0,
      total_payments: 0,
      dataChartLine: {
        labels: null,
        datasets: [
          {
            label: "Total",
            backgroundColor: "#28a745",
            borderColor: "#28a745",
            fill: true,
            data: null
          }
        ]
      },
      filter: {
        active: 0
      },
      array_options: [
        {
          id: 0,
          value: "Todos"
        },
        {
          id: 1,
          value: "Activo"
        },
        {
          id: 2,
          value: "Inactivo"
        }
      ],
      clients_active: 0,
      clients_all: 0
    };
  },
  async mounted() {
    this.loaded = false;
    await this.$http.get(`/${this.resource}/charts`).then(response => {
      let line = response.data.line;
      this.dataChartLine.labels = line.labels;
      this.dataChartLine.datasets[0].data = line.data;
      this.total_documents = response.data.total_documents;
      this.total_payments = response.data.total_payments;
      this.year = response.data.year;
      // console.log(response.data)
      // this.records = response.data.data
    });
    this.loaded = true;
  },
  created() {
    this.$eventHub.on("reloadData", () => {
      this.getData();
    });
    this.getData();
  },
  methods: {
    getData() {
      this.$http.get(`/${this.resource}/tables`).then(response => {
        this.clients_active = response.data.clients_active;
        this.clients_all = response.data.clients_all;
      });
      this.$http
        .get(`/${this.resource}/records?${this.getQueryParameters()}`)
        .then(response => {
          this.records = response.data.data;
        });
    },
    clickResetPasswordMassive() {
      this.showDialogResetPasswordMassive = true;
    },
    clickCreate(recordId = null) {
      this.recordId = recordId;
      this.showDialog = true;
    },
    clickEdit(recordId = null) {
      this.recordId = recordId;
      this.showDialog = true;
    },
    clickPassword(id) {
      this.change(`/${this.resource}/password/${id}`);
    },
    clickDelete(id) {
      this.destroy(`/${this.resource}/${id}`).then(() =>
        this.$eventHub.$emit("reloadData")
      );
    },
    changeActive(id, value) {
      this.$http
        .post(`/${this.resource}/active`, { id: id, active: value })
        .then(response => {
          this.$message.success(response.data.message);
          this.getData();
        });
    },
    getQueryParameters() {
      return queryString.stringify({
        ...this.filter
      });
    }
  }
};
</script>
