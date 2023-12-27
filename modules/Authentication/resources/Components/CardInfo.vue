<template>
    <q-card class="column tw-m-2 tw-w-[300px] tw-mx-auto">
        <q-card-section horizontal class="tw-h-[120px]">
            <q-card-section class="col-5" :class="bgcolor">
                <q-icon size="5rem" :name="props.icon" class="tw-text-white fit"/>
            </q-card-section>
            <q-separator vertical />
            <q-card-section class="tw-flex tw-justify-center tw-flex-col tw-items-center tw-gap-2">
                <h6>{{ props.title }}</h6>
                <p class="tw-text-xl">{{ props.data }}</p>
            </q-card-section>
        </q-card-section>
    </q-card>
</template>

<script setup lang="ts">
 const props = defineProps(['title', 'data', 'icon', 'bgcolor'])
</script>
