<?php

use Livewire\Component;
use Livewire\Attributes\On;
// use App\Models\Todo as ModelsTodo;
use App\Models\Todo;

new class extends Component
{
    public $task;
    public $todos;

    // Usamos Atributos
    // protected $listeners = ['addTodo', 'setOrden', 'update'];

    protected $rules = [
        'task' => 'required|min:2|max:255'
    ];

    public function mount()
    {
        $this->todos = Todo::orderBy('position')->where('user_id', auth()->id())->get()->toArray();
    }

    function save()
    {
        $this->validate();

        $todo = Todo::create(
            [
                'name' => $this->task,
                'user_id' => auth()->id(),
                'position' => Todo::where('user_id', auth()->id())->count(),
            ]
        );

        $this->dispatch('addTodo', $todo);
    }

    #[On('setPosition')]
    function setPosition($pks)
    {
        foreach ($pks as $position => $t) {
            Todo::
                where('user_id', auth()->id())
                ->where('id', $t)
                ->update(['position' => $position]);
        }
    }

    #[On('delete')]
    function delete(?int $id = null)
    {
        if ($id) {
            // elimina todo del usuario
            Todo::where('user_id', auth()->id())
                ->where('id', $id)->delete();
        } else {
            // elimina todo los TODO del usuario
            Todo::where('user_id', auth()->id())->delete();
        }

    }

    #[On('update')]
    function update($todo = null)
    {
        if ($todo == null) {
            return;
        }
        // *** actualizar todo del usuario
        Todo::where('user_id', auth()->id())
            ->where('id', $todo['id'])->update([
                    'name' => $todo['name'],
                    'status' => $todo['status'],
                ]);
    }
};
?>

<div x-data="data()" x-init="order()" class="max-w-xl mx-auto py-8">
    <flux:card>
        <flux:heading level="1" class="mb-6">Todo List</flux:heading>

        <div class="space-y-4">
            <flux:input 
                type="text" 
                x-model="search" 
                placeholder="Buscar tareas..."
                icon="magnifying-glass"
            />

            <form wire:submit.prevent="save()" class="flex gap-2">
                <flux:input 
                    type="text" 
                    wire:model="task" 
                    placeholder="Nueva tarea..."
                    class="flex-1"
                />
                <flux:button type="submit" variant="primary" icon="plus">
                    Añadir
                </flux:button>
            </form>
            @error('task')
                <flux:error name="task" />
            @enderror
        </div>

        <div class="mt-6">
            <ul x-ref="items" class="space-y-2" wire:ignore>
                <template x-for="t in filterTodo()" :key="t.id">
                    <li :id="t.id" class="flex items-center gap-3 p-3 bg-zinc-50 dark:bg-zinc-800 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-700 transition-colors">
                        <input 
                            type="checkbox" 
                            x-model="t.status" 
                            @change="$wire.dispatch('update', { todo: t })"
                            class="w-5 h-5 rounded border-zinc-300 text-purple-600 focus:ring-purple-500"
                        >
                        <div class="flex-1">
                            <template x-if="completed(t)">
                                <span class="text-green-600 text-sm font-medium">Completado</span>
                            </template>
                            <template x-if="!completed(t)">
                                <span class="text-orange-600 text-sm font-medium">Pendiente</span>
                            </template>
                            <span x-text="t.name" @click="t.editMode=true" x-show="!t.editMode" class="block mt-1"></span>
                            <flux:input 
                                type="text" 
                                @keyup.enter="t.editMode=false; $wire.dispatch('update', { todo: t })"
                                x-model="t.name" 
                                x-show="t.editMode" 
                                class="mt-1"
                            />
                        </div>
                        <flux:button variant="danger" size="sm" @click="remove(t)" icon="trash">
                        </flux:button>
                    </li>
                </template>
            </ul>

            @if (count($wire.get('todos') ?? []) > 0)
                <div class="mt-6 flex justify-end">
                    <flux:button variant="danger" @click="removeAll" icon="trash">
                        Eliminar todas
                    </flux:button>
                </div>
            @else
                <flux:text class="text-center text-zinc-500 py-8">
                    No hay tareas. ¡Añade una!
                </flux:text>
            @endif
        </div>
    </flux:card>
</div>

@script
    <script>
        
        console.log($wire)
        Alpine.data('data', () => {
            //  function data() {
            return {
                // todos: $wire.entangle('todos'),
                todos: $wire.get('todos'),
                // todos: Alpine.$persist([]),

                search: '',
                task: '',
                count: Alpine.$persist(10),
                order() {

                    $wire.on('addTodo', (arrgs) => {
                        this.todos.push(arrgs[0])
                    })

                    Sortable.create(this.$refs.items, {
                        onEnd: (event) => {
                            // var todosAux = []
                            var todosPKs = []

                            //document.querySelectorAll('.list-group li').forEach((todoHTML => {

                            $refs.items.querySelectorAll('li').forEach((todoHTML => {
                                todosPKs.push(todoHTML.id)
                                // this.todos.forEach(todo => {
                                //     if(todo.id == todoHTML.id){
                                //         todosAux.push(todo)
                                //     }
                                // })
                            }))
                             // console.log(todosPKs)
                            // this.todos = todosAux
                            Livewire.dispatch('setPosition', {
                                pks: todosPKs
                            })
                        }
                    })
                },
                completed(todo) {
                    return todo.status == 1
                },
                totalTodos() {
                    return this.todos.length
                },
                filterTodo() {
                    return this.todos.filter((t) => t.name.toLowerCase().includes(this.search.toLowerCase()))
                },
                remove(todo) {
                    this.todos = this.todos.filter((t) => t != todo)
                    Livewire.dispatch('delete', {
                        id: todo.id
                    })
                },
                removeAll() {
                    this.todos = []
                    Livewire.dispatch('delete')
                },
            }
            //  }
        })
    </script>
@endscript
