<?php

use Livewire\Component;

use Livewire\Attributes\Layout;

new #[Layout('layouts.web')] class extends Component {
    
};
?>

<div>
    <flux:input wire:ref="content" />

    Characters: <span wire:ref="count">0</span>

    @script
        <script>
            this.$refs.content.addEventListener('input', (e) => {
                this.$refs.count.textContent = e.target.value.length
            })
        </script>
    @endscript

</div>
