<template>
    <Line :data="data" :options="options" class="w-[500px]"/>
</template>

<script>

import { Line } from 'vue-chartjs'
import { lineChartOptions } from "./config";
import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend,
    Filler
} from 'chart.js'

ChartJS.register(CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend,
    Filler)
export default {
    components: { Line },
    props: ["data"],
    data() {
        return {
            options: lineChartOptions,
        };
    },
};
</script>
