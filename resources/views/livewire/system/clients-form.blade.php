<div x-data="{ open: false }">
    <button class="tw-rounded-md tw-border-2 tw-py-1 tw-px-2 hover:tw-text-gray-500" @click="open = ! open">
        Nuevo +
    </button>
    <!-- component -->
    <div x-show="open"
        class="fixed top-0 left-0 bottom-0 w-full h-full tw-flex tw-items-center  tw-bg-opacity-25"
        style="z-index: 999">
        <div
            class="tw-bg-white dark:tw-bg-gray-800  tw-shadow-md tw-rounded tw-px-8 tw-pt-6 tw-pb-8 tw-mb-4 tw-flex tw-flex-col tw-w-[90%] md:tw-w-[50%] tw-mx-auto">
            <div class="tw-w-100 tw-flex tw-justify-end">
                <button class="tw-rounded-md tw-border-2 tw-py-1 tw-px-2 hover:tw-text-gray-500" @click="open = ! open">
                    x
                </button>
            </div>
            <div class="tw--mx-3 tw-grid tw-grid-cols-2 tw-grid-flow-rows tw-gap-3 ">
                <div class="">
                    <label
                        class="tw-block tw-uppercase tw-tracking-wide tw-text-grey-darker tw-text-xs tw-font-bold tw-mb-2"
                        for="ruc">
                        RUC
                    </label>
                    <input wire:model="form.number"
                        class="tw-bg-white tw-appearance-none tw-block tw-w-full tw-bg-grey-lighter tw-text-grey-darker tw-border tw-border-red tw-rounded tw-py-3 tw-px-4 tw-mb-3"
                        id="ruc" type="text">
                </div>
                <div class="">
                    <label
                        class="tw-block tw-uppercase tw-tracking-wide tw-text-grey-darker tw-text-xs tw-font-bold tw-mb-2"
                        for="name">
                        Empresa
                    </label>
                    <input
                        class="tw-appearance-none tw-block tw-w-full tw-bg-grey-lighter tw-text-grey-darker tw-border tw-border-grey-lighter tw-rounded tw-py-3 tw-px-4"
                        id="form.name" type="text">
                </div>
                <div class="">
                    <label
                        class="tw-block tw-uppercase tw-tracking-wide tw-text-grey-darker tw-text-xs tw-font-bold tw-mb-2"
                        for="subdomain">
                        Nombre Subdominio
                    </label>
                    <input wire:model="form.subdomain"
                        class="tw-appearance-none tw-block tw-w-full tw-bg-grey-lighter tw-text-grey-darker tw-border tw-border-red tw-rounded tw-py-3 tw-px-4 tw-mb-3"
                        id="subdomain" type="text">
                </div>
                <div class="">
                    <label
                        class="tw-block tw-uppercase tw-tracking-wide tw-text-grey-darker tw-text-xs tw-font-bold tw-mb-2"
                        for="password">
                        Contraseña
                    </label>
                    <input wire:model="form.password"
                        class="tw-appearance-none tw-block tw-w-full tw-bg-grey-lighter tw-text-grey-darker tw-border tw-border-grey-lighter tw-rounded tw-py-3 tw-px-4 tw-mb-3"
                        id="password" type="password">
                </div>
                <div class="">
                    <label
                        class="tw-block tw-uppercase tw-tracking-wide tw-text-grey-darker tw-text-xs tw-font-bold tw-mb-2"
                        for="plan">
                        Plan
                    </label>
                    <div class="tw-relative">
                        <select wire:model="form.plan_id"
                            class="tw-block tw-appearance-none tw-w-full tw-bg-grey-lighter tw-border tw-border-grey-lighter tw-text-grey-darker tw-py-3 tw-px-4 tw-pr-8 tw-rounded"
                            id="plan">
                            @foreach ($form->plans as $key => $name)
                                <option value="{{ $key }}"> {{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="">
                    <label
                        class="tw-block tw-uppercase tw-tracking-wide tw-text-grey-darker tw-text-xs tw-font-bold tw-mb-2"
                        for="plan_start_date">
                        Fecha
                    </label>
                    <div class="tw-relative">
                        <input wire:model="form.plan_start_date"
                            class="tw-appearance-none tw-block tw-w-full tw-bg-grey-lighter tw-text-grey-darker tw-border tw-border-grey-lighter tw-rounded tw-py-3 tw-px-4 tw-mb-3"
                            id="plan_start_date" type="date">
                    </div>
                </div>
                <div class="">
                    <label
                        class="tw-block tw-uppercase tw-tracking-wide tw-text-grey-darker tw-text-xs tw-font-bold tw-mb-2"
                        for="amount">
                        Monto
                    </label>
                    <div class="tw-relative">
                        <input wire:model="form.amount"
                            class="tw-appearance-none tw-block tw-w-full tw-bg-grey-lighter tw-text-grey-darker tw-border tw-border-grey-lighter tw-rounded tw-py-3 tw-px-4 tw-mb-3"
                            id="amount" type="number" step="0.01" min="0.00">
                    </div>
                </div>

            </div>
            <div class="tw-w-100 tw-flex tw-gap-2 tw-justify-end">
                <button
                    class="tw-bg-yellow-500 tw-text-gray-50 tw-px-4 tw-py-1 tw-rounded-md tw-border-2 hover:tw-bg-yellow-400"
                    @click="open = ! open">
                    Cancelar
                </button>
                <button
                    class="tw-bg-blue-700 tw-text-gray-50 tw-px-4 tw-py-1 tw-rounded-md tw-border-2 hover:tw-bg-blue-500"
                    @click="open = ! open">
                    Aceptar
                </button>
            </div>
        </div>
    </div>
</div>
