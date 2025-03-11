<?php

namespace App\Livewire\Tables;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;

class UserTable extends DataTableComponent
{
    //protected $model = User::class;
    public $title = "Eliminar Usuario";
    public $content = "¿Quieres eliminar al usuario?";
    public $item_id = 0;
    public $openModal = false;
    
    
    public function builder ():Builder {
        return User::where('email', '!=', 'root@gmail.com');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()->hideIf(true),
            Column::make("Nombre", "name")
                ->sortable()->searchable(),
            Column::make("Correo Electrónico", "email")
                ->sortable()->searchable(),
            Column::make("Eliminar")
                ->label(fn($row, Column $column) => view('livewire.delete')->with(["id" => $row->id, "description" => $row->name])),
        ];
    }

    public function confirmDestroy ($id, $descripcion)
    {
        $this->content = " ¿Estas seguro de eliminar al usuario: ".$descripcion."?";
        $this->item_id = $id;
        $this->openModal= true;
    }

    public function doDelete () {
        User::find($this->item_id)->delete();
        //$this->reset();
        $this->openModal= false;
    }
    
    public function customView(){
        return 'components.destroy';
    }
}
