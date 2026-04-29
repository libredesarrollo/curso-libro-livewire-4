<?php

namespace App\Ai\Agents;

use App\Ai\Middleware\RetrieveContext;
use Illuminate\Support\Collection;
use Laravel\Ai\Attributes\MaxTokens;
use Laravel\Ai\Attributes\Temperature;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\HasMiddleware;
use Laravel\Ai\Promptable;

#[Temperature(0.0)]
#[MaxTokens(1024)]
class SpaAssistant implements Agent, HasMiddleware
{
    use Promptable;

    protected Collection $chunks;

    public function __construct()
    {
        $this->chunks = collect();
    }

    public function withChunks(Collection $chunks): void
    {
        $this->chunks = $chunks;
    }

    public function middleware(): array
    {
        return [new RetrieveContext(minSimilarity: 0.3, limit: 10)];
    }

    public function instructions(): string
    {
        return view('prompts.spa-rag', ['chunks' => $this->chunks])->render();
    }
}