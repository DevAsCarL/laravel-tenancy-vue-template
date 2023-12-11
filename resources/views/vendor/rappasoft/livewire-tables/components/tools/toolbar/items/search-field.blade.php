@aware(['component', 'tableName'])

<div x-cloak x-show="!currentlyReorderingStatus"
    @class([
        'mb-3 mb-md-0 input-group' => $component->isBootstrap(),
        'tw-flex tw-rounded-md tw-shadow-sm' => $component->isTailwind(),
    ])>
        <input
            wire:model{{ $component->getSearchOptions() }}="search"
            placeholder="{{ $component->getSearchPlaceholder() }}"
            type="text"
            {{ 
                $attributes->merge($component->getSearchFieldAttributes())
                ->class([
                    'tw-block tw-w-full tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-transition tw-duration-150 tw-ease-in-out sm:tw-text-sm sm:tw-leading-5 dark:tw-bg-gray-700 dark:tw-text-white dark:tw-border-gray-600 tw-rounded-none tw-rounded-l-md focus:tw-ring-0 focus:tw-border-gray-300' => $component->isTailwind() && $component->hasSearch() && $component->getSearchFieldAttributes()['default'] ?? true,
                    'tw-block tw-w-full tw-border-gray-300 tw-rounded-md tw-shadow-sm tw-transition tw-duration-150 tw-ease-in-out sm:tw-text-sm sm:tw-leading-5 dark:bg-gray-700 dark:text-white dark:border-gray-600 tw-rounded-md focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50' => $component->isTailwind() && !$component->hasSearch() && $component->getSearchFieldAttributes()['default'] ?? true,
                    'form-control' => $component->isBootstrap() && $component->getSearchFieldAttributes()['default'] ?? true,
                ])
                ->except('default') 
            }}

        />

        @if ($component->hasSearch())
        <div @class([
                    'd-inline-flex h-100 align-items-center ' => $component->isBootstrap(),
                ])>
                <div
                    wire:click="clearSearch"
                    @class([
                            'btn btn-outline-secondary d-inline-flex h-100 align-items-center' => $component->isBootstrap(),
                            'tw-inline-flex tw-h-full tw-items-center tw-px-3 tw-text-gray-500 tw-bg-gray-50 tw-rounded-r-md tw-border tw-border-l-0 tw-border-gray-300 tw-cursor-pointer sm:tw-text-sm dark:tw-bg-gray-700 dark:tw-text-white dark:tw-border-gray-600 dark:hover:tw-bg-gray-600' => $component->isTailwind(),
                        ])
                >
                @if($component->isTailwind())
                <x-heroicon-m-x-mark class='tw-w-4 tw-h-4' />
                @else
                <x-heroicon-m-x-mark style='width:1em; height:1em;'  />
                @endif
                    </div>
            </div>
        @endif


</div>
