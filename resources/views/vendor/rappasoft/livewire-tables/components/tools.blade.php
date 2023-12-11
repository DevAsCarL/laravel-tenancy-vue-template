@aware(['component'])

<div @class([
    'tw-flex-col' => $component->isTailwind(),
    'd-flex flex-column ' => ($component->isBootstrap()),
])>
    {{ $slot }}
</div>
