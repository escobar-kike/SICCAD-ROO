<?php

namespace App\Livewire;

use App\Models\categoria_fotos;
use App\Models\Cuerpos;
use App\Models\cuerpos_dictamenes;
use App\Models\dictamenes;
use App\Models\tipos_de_hechos;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Actualizar extends Component
{
    use WithFileUploads;

    public $imgprincipal;
   
    public $cuerpo;
    public $categoriaft;
    public $dictamenes;
    public $dataimages;
    public $datarchivo;
    public $archipdf = [];
    public $new_imagenes = [];
    public $imagenes = [];

    public $edit = [
        'CI' => '',
        'identificado' => '',
        'nombre' => '',
        'apellidop' => '',
        'apellidom' => '',
        'edad' => '',
        'edad2' => '',
        'sexo' => '',
        'fecha' => '',
        'causa_muerte' => '',
        'ubicacion' => '',
        'tiposdehechos_id'=> '',
        'imgprincipal' =>''
    ];


   public function mount($id)
    {

        $this->cuerpo = Cuerpos::find($id);
        $this->edit['CI']=$this->cuerpo->CI;
        $this->edit['identificado']=$this->cuerpo->identificado;
        $this->edit['nombre']=$this->cuerpo->nombre;
        $this->edit['apellidop']=$this->cuerpo->apellidop;
        $this->edit['apellidom']=$this->cuerpo->apellidom;
        $this->edit['edad']=$this->cuerpo->edad;
        $this->edit['edad2']=$this->cuerpo->edad2;
        $this->edit['sexo']=$this->cuerpo->sexo;
        $this->edit['fecha']=$this->cuerpo->fecha;
        $this->edit['causa_muerte']=$this->cuerpo->causa_muerte;
        $this->edit['ubicacion']=$this->cuerpo->ubicacion;
        $this->edit['tiposdehechos_id']=$this->cuerpo->tiposdehechos_id;
        $this->edit['imgprincipal']=$this->cuerpo->imgprincipal;

        $this->categoriaft = categoria_fotos::all();
        
        $this->imagenes=$this->cuerpo->imagenes;

            foreach($this->imagenes as $image){
                $tmp["categoriasft_id"]=$image->categoriasft_id;
                $tmp["descripcion"]=$image->descripcion;
                $this->dataimages[]=$tmp;

            }
           //dd($this->dataimages);
        $this->dictamenes = dictamenes::all();

        $this->archipdf=$this->cuerpo->cuerpos_dictamenes;

            foreach($this->archipdf as $archi){
                $pdfs["dictamenes_id"]=$archi->dictamenes_id;
                $this->datarchivo[]=$pdfs;
            }

            //$cuerpo = Cuerpos::find($id);
           // dd($this->datarchivo);
    }
    public function render()
    {
        return view('livewire.actualizar');
    }

    public function update(){
        //dd($this->cuerpo);
        //$cuerpo = Cuerpos::find($this->posteditId);

        if ($this->imgprincipal != null)
        {
            $this->imgprincipal->store('public/imgprincipal');
            $this->edit['imgprincipal'] = $this->imgprincipal->hashName();
            Storage::delete('app/public/imgprincipal/' . $this->cuerpo->imgprincipal);
        }
        else {
            $this->edit['imgprincipal'] = $this->cuerpo->imgprincipal;
        }
        $this->cuerpo->update([

            'CI' => $this->edit['CI'],
            'identificado' => $this->edit['identificado'],
            'nombre' => $this->edit['nombre'],
            'apellidop' => $this->edit['apellidop'],
            'apellidom' => $this->edit['apellidom'],
            'edad' => $this->edit['edad'],
            'edad2' => $this->edit['edad2'],
            'sexo' => $this->edit['sexo'],
            'fecha' => $this->edit['fecha'],
            'causa_muerte' => $this->edit['causa_muerte'],
            'ubicacion' => $this->edit['ubicacion'],
            'tiposdehechos_id' => $this->edit['tiposdehechos_id'],
            'imgprincipal' => $this->edit['imgprincipal']
        ]);
        
        

        return redirect()->route('Cuerpos.index');
    }



    // 1 modificar la base de datos y agregar el nombre del pdf en el pivote
    //2 luego se debe de validar el registro del cuerpo nuevo a la hora de darle de alta 
    // 3 en editar checar que se pueda editar las fotos y dic.
    // por ultimo eliminar .
    
    

    public function getTiposHechosProperty()
    {
        return tipos_de_hechos::all();
    }

}
