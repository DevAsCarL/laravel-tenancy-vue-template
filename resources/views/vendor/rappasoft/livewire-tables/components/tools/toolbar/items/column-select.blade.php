@aware(['component', 'tableName'])
@if ($component->isTailwind())
<div class="@if ($component->getColumnSelectIsHiddenOnMobile()) tw-hidden sm:tw-block @elseif ($component->getColumnSelectIsHiddenOnTablet()) tw-hidden md:tw-block @endif tw-mb-4 tw-w-full md:tw-w-auto md:tw-mb-0 md:tw-ml-2">
    <div
        x-data="{ open: false, childElementOpen: false }"
        @keydown.window.escape="if (!childElementOpen) { open = false }"
        x-on:click.away="if (!childElementOpen) { open = false }"
        class="tw-inline-block tw-text-left tw-relative tw-w-auto"
        wire:key="{{ $tableName }}-column-select-button"
    >
        <div>
            <span class="rounded-md shadow-sm">
                <button
                    x-on:click="open = !open"
                    type="button"
                    class="tw-inline-flex tw-justify-center tw-px-4 tw-py-2 tw-w-full tw-text-sm tw-font-medium tw-rounded-md tw-border tw-shadow-sm focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600"
                    aria-haspopup="true"
                    x-bind:aria-expanded="open"
                    aria-expanded="true"
                >
                    @lang('Columns')

                    <x-heroicon-m-chevron-down class="tw--mr-1 tw-ml-2 tw-h-5 tw-w-5" />
                </button>
            </span>
        </div>

        <div
            x-cloak x-show="open"
            x-transition:enter="tw-transition tw-ease-out tw-duration-100"
            x-transition:enter-start="tw-transform tw-opacity-0 tw-scale-95"
            x-transition:enter-end="tw-transform tw-opacity-100 tw-scale-100"
            x-transition:leave="tw-transition tw-ease-in tw-duration-75"
            x-transition:leave-start="tw-transform tw-opacity-100 tw-scale-100"
            x-transition:leave-end="tw-transform tw-opacity-0 tw-scale-95"
            class="tw-absolute tw-right-0 tw-z-50 tw-mt-2 tw-w-full tw-rounded-md tw-divide-y tw-divide-gray-100 tw-ring-1 tw-ring-black tw-ring-opacity-5 tw-shadow-lg tw-origin-top-right md:tw-w-48 focus:tw-outline-none"
        >
            <div class="tw-bg-white tw-rounded-md tw-shadow-xs dark:bg-gray-700 ">
                <div class="tw-p-2" role="menu" aria-orientation="vertical"
                        aria-labelledby="column-select-menu"
                >
                    <div wire:key="{{ $tableName }}-columnSelect-selectAll-{{ rand(0,1000) }}">
                        <label
                            wire:loading.attr="disabled"
                            class="tw-inline-flex tw-items-center tw-px-2 tw-py-1 disabled:tw-opacity-50 disabled:tw-cursor-wait"
                        >
                            <input
                                class="tw-text-indigo-600 tw-transition duration-150 ease-in-out border-gray-300 rounded shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600 disabled:opacity-50 disabled:cursor-wait"
                                wire:loading.attr="disabled" 
                                type="checkbox"
                                @checked($component->getSelectableSelectedColumns()->count() == $component->getSelectableColumns()->count())
                                @if($component->getSelectableSelectedColumns()->count() == $component->getSelectableColumns()->count())  wire:click="deselectAllColumns" @else wire:click="selectAllColumns" @endif
                            >
                            <span class="tw-ml-2">{{ __('All Columns') }}</span>
                        </label>
                    </div>

                    @foreach ($component->getColumnsForColumnSelect() as $columnSlug => $columnTitle)
                        <div
                            wire:key="{{ $tableName }}-columnSelect-{{ $loop->index }}"
                        >
                            <label
                                wire:loading.attr="disabled"
                                wire:target="selectedColumns"
                                class="inline-flex items-center px-2 py-1 disabled:opacity-50 disabled:cursor-wait"
                            >
                                <input
                                    class="text-indigo-600 rounded border-gray-300 shadow-sm transition duration-150 ease-in-out focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600 disabled:opacity-50 disabled:cursor-wait"
                                    wire:model.live="selectedColumns" wire:target="selectedColumns"
                                    wire:loading.attr="disabled" type="checkbox"
                                    value="{{ $columnSlug }}" />
                                <span class="ml-2">{{ $columnTitle }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@elseif ($component->isBootstrap())
<div
    @class([
        'd-none d-sm mb-3 mb-md-0 pl-0 pl-md-2' => $component->getColumnSelectIsHiddenOnMobile() && $component->isBootstrap4(),
        'd-none d-md-block mb-3 mb-md-0 pl-0 pl-md-2' => $component->getColumnSelectIsHiddenOnTablet() && $component->isBootstrap4(),
        'd-none d-sm-block mb-3 mb-md-0 md-0 ms-md-2' => $component->getColumnSelectIsHiddenOnMobile() && $component->isBootstrap5(),
        'd-none d-md-block mb-3 mb-md-0 md-0 ms-md-2' => $component->getColumnSelectIsHiddenOnTablet() && $component->isBootstrap5(),
    ])
>
    <div
        x-data="{ open: false, childElementOpen: false }"
        x-on:keydown.escape.stop="if (!childElementOpen) { open = false }"
        x-on:mousedown.away="if (!childElementOpen) { open = false }"
        @class([
            'dropdown d-block d-md-inline' => $component->isBootstrap(),
        ])
        wire:key="{{ $tableName }}-column-select-button"
    >
        <button
            x-on:click="open = !open"
            @class([
                'btn dropdown-toggle d-block w-100 d-md-inline' => $component->isBootstrap(),
            ])
            type="button" id="{{ $tableName }}-columnSelect" aria-haspopup="true"
            x-bind:aria-expanded="open"
        >
            @lang('Columns')
        </button>

        <div
            x-bind:class="{ 'show': open }"
            @class([
                'dropdown-menu dropdown-menu-right w-100 mt-0 mt-md-3' => $component->isBootstrap4(),
                'dropdown-menu dropdown-menu-end w-100' => $component->isBootstrap5(),
            ])
            aria-labelledby="columnSelect-{{ $tableName }}"
        >
            @if($component->isBootstrap4())
                <div wire:key="{{ $tableName }}-columnSelect-selectAll-{{ rand(0,1000) }}">
                    <label wire:loading.attr="disabled" class="px-2 mb-1">
                        <input
                            wire:loading.attr="disabled"
                            type="checkbox"
                            @if($component->getSelectableSelectedColumns()->count() == $component->getSelectableColumns()->count()) checked wire:click="deselectAllColumns" @else unchecked wire:click="selectAllColumns" @endif
                        />

                        <span class="ml-2">{{ __('All Columns') }}</span>
                    </label>
                </div>
            @elseif($component->isBootstrap5())
                <div class="form-check ms-2" wire:key="{{ $tableName }}-columnSelect-selectAll-{{ rand(0,1000) }}">
                    <input
                        wire:loading.attr="disabled"
                        type="checkbox"
                        class="form-check-input"
                        @if($component->getSelectableSelectedColumns()->count() == $component->getSelectableColumns()->count()) checked wire:click="deselectAllColumns" @else unchecked wire:click="selectAllColumns" @endif
                    />

                    <label wire:loading.attr="disabled" class="form-check-label">
                        {{ __('All Columns') }}
                    </label>
                </div>
            @endif

            @foreach ($component->getColumnsForColumnSelect() as $columnSlug => $columnTitle)
                <div
                    wire:key="{{ $tableName }}-columnSelect-{{ $loop->index }}"
                    @class([
                        'form-check ms-2' => $component->isBootstrap5(),
                    ])
                >
                    @if ($component->isBootstrap4())
                        <label
                            wire:loading.attr="disabled"
                            wire:target="selectedColumns"
                            class="px-2 {{ $loop->last ? 'mb-0' : 'mb-1' }}"
                        >
                            <input
                                wire:model.live="selectedColumns"
                                wire:target="selectedColumns"
                                wire:loading.attr="disabled" type="checkbox"
                                value="{{ $columnSlug }}"
                            />
                            <span class="ml-2">
                                {{ $columnTitle }}
                            </span>
                        </label>
                    @elseif($component->isBootstrap5())
                        <input
                            wire:model.live="selectedColumns"
                            wire:target="selectedColumns"
                            wire:loading.attr="disabled"
                            type="checkbox"
                            class="form-check-input"
                            value="{{ $columnSlug }}"
                        />
                        <label
                            wire:loading.attr="disabled"
                            wire:target="selectedColumns"
                            class="{{ $loop->last ? 'mb-0' : 'mb-1' }} form-check-label"
                        >
                            {{ $columnTitle }}
                        </label>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>

@endif
