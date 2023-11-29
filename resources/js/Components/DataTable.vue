<template>
    <div class="q-pa-md">
        <q-table flat bordered :title="title" :rows="props.rows" :columns="props.columns" color="primary" row-key="name">
            <template v-slot:top-right>
                <q-btn color="primary" icon-right="add" label="Nuevo" no-caps @click="$emit('onCreate')" />
            </template>
        </q-table>
    </div>
</template>
<script setup lang="ts">
const props = defineProps(['title','columns','rows'])
</script>