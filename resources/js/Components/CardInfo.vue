<template>
    <q-card class="column tw-m-2 tw-w-[300px] tw-mx-auto">
        <q-card-section horizontal class="tw-h-[120px]">
            <q-card-section class="col-5" :class="bgcolor">
                <q-icon size="5rem" :name="props.icon" class="tw-text-white tw-fit"/>
            </q-card-section>
            <q-separator vertical />
            <q-card-section class="col-7 tw-flex tw-justify-center col">
                <h6>{{ props.title }}</h6>
                <p>{{ props.data }}</p>
            </q-card-section>
        </q-card-section>
    </q-card>
</template>

<script setup lang="ts">
 const props = defineProps(['title', 'data', 'icon', 'bgcolor'])
</script>
