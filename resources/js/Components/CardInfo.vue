<template>
    <q-card class="column m-2 w-[300px] mx-auto">
        <q-card-section horizontal class="h-[120px]">
            <q-card-section class="col-5" :class="bgcolor">
                <q-icon size="5rem" :name="props.icon" class="text-white fit"/>
            </q-card-section>
            <q-separator vertical />
            <q-card-section class="col-7 flex justify-center col">
                <h6>{{ props.title }}</h6>
                <p>{{ props.data }}</p>
            </q-card-section>
        </q-card-section>
    </q-card>
</template>

<script setup lang="ts">
 const props = defineProps(['title', 'data', 'icon', 'bgcolor'])
</script>
