@aware(['component', 'tableName'])
@props(['filterGenericData'])

@if ($component->hasConfigurableAreaFor('before-toolbar'))
    @include($component->getConfigurableAreaFor('before-toolbar'), $component->getParametersForConfigurableArea('before-toolbar'))
@endif

<div @class([
        'd-md-flex justify-content-between mb-3' => $component->isBootstrap(),
        'md:tw-flex md:tw-justify-between tw-mb-4 tw-px-4 md:tw-p-0 ' => $component->isTailwind(),
    ])
>
    <div @class([
            'd-md-flex' => $component->isBootstrap(),
            'tw-w-full tw-mb-4 md:tw-mb-0 md:tw-w-2/4 md:tw-flex tw-space-y-4 md:tw-space-y-0 md:tw-space-x-2' => $component->isTailwind(),
        ])
    >
        <div x-cloak x-show="!currentlyReorderingStatus">
            @if ($component->hasConfigurableAreaFor('toolbar-left-start'))
                @include($component->getConfigurableAreaFor('toolbar-left-start'), $component->getParametersForConfigurableArea('toolbar-left-start'))
            @endif
        </div>
        
        @if ($component->reorderIsEnabled())
            <x-livewire-tables::tools.toolbar.items.reorder-buttons />
        @endif
        
        @if ($component->searchIsEnabled() && $component->searchVisibilityIsEnabled())
            {{-- <x-livewire-tables::tools.toolbar.items.search-field /> --}}
            @include('vendor\rappasoft\livewire-tables\components\tools\toolbar\items\search-field')
        @endif

        @if ($component->filtersAreEnabled() && $component->filtersVisibilityIsEnabled() && $component->hasVisibleFilters())
            <x-livewire-tables::tools.toolbar.items.filter-button :$filterGenericData />
        @endif

        @if ($component->hasConfigurableAreaFor('toolbar-left-end'))
            <div x-cloak x-show="!currentlyReorderingStatus">
                @include($component->getConfigurableAreaFor('toolbar-left-end'), $component->getParametersForConfigurableArea('toolbar-left-end'))
            </div>
        @endif
    </div>

    <div x-cloak x-show="!currentlyReorderingStatus"         
        @class([
            'd-md-flex' => $component->isBootstrap(),
            'tw-flex gap-2 tw-items-center tw-space-y-0 tw-space-x-2' => $component->isTailwind(),
        ])
    >
        @if ($component->hasConfigurableAreaFor('toolbar-right-start'))
            @include($component->getConfigurableAreaFor('toolbar-right-start'), $component->getParametersForConfigurableArea('toolbar-right-start'))
        @endif

        @if ($component->showBulkActionsDropdownAlpine())
            <x-livewire-tables::tools.toolbar.items.bulk-actions />
        @endif
       
            <livewire:system.clients-form>
        @if ($component->columnSelectIsEnabled())
            {{-- <x-livewire-tables::tools.toolbar.items.column-select />  --}}
            @include('vendor\rappasoft\livewire-tables\components\tools\toolbar\items\column-select')
        @endif

        @if ($component->paginationIsEnabled() && $component->perPageVisibilityIsEnabled())
            {{-- <x-livewire-tables::tools.toolbar.items.pagination-dropdown />  --}}
            @include('vendor\rappasoft\livewire-tables\components\tools\toolbar\items\pagination-dropdown')
        @endif

        @if ($component->hasConfigurableAreaFor('toolbar-right-end'))
            @include($component->getConfigurableAreaFor('toolbar-right-end'), $component->getParametersForConfigurableArea('toolbar-right-end'))
        @endif
    </div>
</div>
@if (
    $component->filtersAreEnabled() &&
    $component->filtersVisibilityIsEnabled() &&
    $component->hasVisibleFilters() &&
    $component->isFilterLayoutSlideDown()
)
    <x-livewire-tables::tools.toolbar.items.filter-slidedown :$filterGenericData />
@endif


@if ($component->hasConfigurableAreaFor('after-toolbar'))
    <div x-cloak x-show="!currentlyReorderingStatus" >
        @include($component->getConfigurableAreaFor('after-toolbar'), $component->getParametersForConfigurableArea('after-toolbar'))
    </div>
@endif
<script>
    Livewire.on('openModal', modalName => {
        const modal = document.getElementById(modalName);
        if (modal) modal.style.display = 'block';
        
    });
</script>