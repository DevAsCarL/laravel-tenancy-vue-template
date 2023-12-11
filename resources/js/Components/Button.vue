<template>
    <button class="tw-rounded-md tw-w-full tw-bg-slate-800 tw-px-6 tw-py-3 tw-text-sm tw-font-semibold tw-text-white tw-shadow-sm hover:tw-bg-slate-500">
        <span v-text="text"></span>
    </button>
</template>

<script>
    export default {
        props: {
            text: {
                type: String,
                default: "Submit",
            },
            styles: String | Array,
        },

        computed: {
            classes() {
                let classes = ["btn"];

                if (this.styles) {
                    if (this.styles.constructor.name === "String") {
                        classes.push(`btn--${this.styles}`);
                    } else if (this.styles.constructor.name === "Array") {
                        this.styles.forEach((style) => {
                            classes.push(`btn--${style}`);
                        });
                    }
                }

                return classes.join(" ");
            },
        },
    };
</script>
