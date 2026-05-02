<?php

use App\Ai\Agents\PokemonAgent;
use Laravel\Ai\Streaming\Events\TextDelta;
use Livewire\Component;

new class extends Component {
    public string $question = '';
    public array $messages = [];

    public function ask(): void
    {
        if (trim($this->question) === '') {
            return;
        }

        $this->messages[] = ['role' => 'user', 'content' => $this->question];
        $question = $this->question;
        $this->question = '';

        $stream = PokemonAgent::make()->stream($question);
        $fullResponse = '';

        foreach ($stream as $event) {
            // dd($event);
            if ($event instanceof TextDelta) {
                $fullResponse .= $event->delta;
                $this->stream(to: 'streamedResponse', content: $event->delta);
            }
        }

        $this->messages[] = ['role' => 'assistant', 'content' => $fullResponse];
        //dd($this->messages);
    }
}

?>

<div class="max-w-2xl mx-auto p-6" x-data="{ pendingQuestion: '' }">
    <h1 class="text-2xl font-bold mb-6">SPA Assistant</h1>

    <div class="space-y-4 mb-6">
        @foreach($messages as $message)
            <div>
                <strong>
                    {{ $message['role'] === 'user' ? 'You' : 'SPA Assistant' }}:
                </strong>
                <p>{!! Str::markdown($message['content']) !!}</p>
            </div>
        @endforeach

        <div wire:loading wire:target="ask">
            <div>
                <strong>You:</strong>
                <p x-text="pendingQuestion"></p>
            </div>
            <div>
                <strong>SPA Assistant:</strong>
                <p>
                    <span wire:stream="streamedResponse"></span>
                    <span class="thinking">Thinking...</span>
                </p>
            </div>
        </div>
    </div>

    <form wire:submit="ask"
          >
        <input x-ref="q"
               type="text"
               wire:model="question"
               placeholder="Ask about the agreement..."
               wire:loading.attr="disabled"
               wire:target="ask"
               class="w-full border rounded-lg px-4 py-2 mb-2">
        <button type="submit"
                wire:loading.attr="disabled"
                wire:target="ask"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg">
            Ask
        </button>
    </form>
</div>

