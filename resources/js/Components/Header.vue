<template>
    <header class="tw-bg-white tw-border-b tw-border-slate-200">
        <nav>
            <div class="tw-mx-auto tw-max-w-7xl tw-px-4 sm:tw-px-6 lg:tw-px-8">
                <div class="tw-flex tw-h-16 tw-items-center tw-justify-between">
                    <div class="tw-flex tw-items-center">
                        <div class="tw-flex-shrink-0">
                            <SparklesIcon class="tw-h-8 tw-w-8" />
                        </div>
                    </div>
                    <div class="tw-hidden md:tw-block">
                        <div class="tw-hidden md:tw-block">
                            <div class="tw-ml-10 tw-flex tw-items-baseline tw-space-x-4">
                                <template v-for="link in props.menu" :key="link.label">
                                    <Link v-if="link.condition" :href="link.route" :method="link?.method"
                                        :as="link?.method == 'post' ? 'button' : 'a'" v-text="link.label"
                                        class="tw-rounded-xl tw-px-3 tw-py-2 tw-text-sm tw-font-medium" :class="{
                                            'tw-bg-slate-100': link.components.includes($page.component),
                                            'tw-text-slate-500 tw-hover:text-slate-900': !link.components.includes($page.component),
                                        }" />
                                </template>
                            </div>
                        </div>
                    </div>

                    <div class="tw--mr-2 tw-flex md:tw-hidden">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" type="button"
                            class="tw-relative tw-inline-flex tw-items-center tw-justify-center tw-rounded-md tw-bg-slate-100 tw-p-2 tw-text-slate-900 tw-hover:bg-slate-900 tw-hover:text-white">
                            <span class="tw-sr-only">Open main menu</span>
                            <XMarkIcon v-if="mobileMenuOpen" class="tw-block h-6 w-6" />
                            <Bars3Icon v-else class="tw-block tw-h-6 tw-w-6" />
                        </button>
                    </div>
                </div>
            </div>

            <div v-show="mobileMenuOpen" class="tw-md:hidden">
                <div class="tw-space-y-1 tw-px-2 tw-pb-3 tw-pt-2 tw-sm:px-3">
                    <template v-for="link in props.menu" :key="link.label">
                        <Link v-if="link.condition" :href="link.route" v-text="link.label"
                            class="tw-rounded-xl tw-px-3 tw-py-2 tw-text-base tw-font-medium tw-block" :class="{
                                'tw-bg-slate-100': link.components.includes($page.component),
                                'tw-text-slate-500 tw-hover:text-slate-900': !link.components.includes($page.component),
                            }" aria-current="page" />
                    </template>
                </div>
            </div>
        </nav>
    </header>
</template>

<script setup lang="ts">
import { ref } from 'vue';
interface MenuItem {
    label: string;
    condition: boolean;
    route: string;
    method?: string;
    as?: string;
    components: string[];
}
const props = defineProps({
    menu: {
        type: Array as () => MenuItem[],
        required: true,
    },
})
const mobileMenuOpen = ref<boolean>(false);
</script>
