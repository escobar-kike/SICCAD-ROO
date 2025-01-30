<?php

namespace App\Livewire;

use App\Models\Cuerpos;
use App\Models\dictamenes;
use App\Models\imagenes;
use Livewire\Component;
use App\Models\categoria_fotos;
use Livewire\WithFileUploads;
use App\Models\tipos_de_hechos;

class Vista extends Component
{
    
    use WithFileUploads;

    public $imgprincipal;
   
    public $cuerpo;
    public $categoriaft;
    public $dictamenes;
    public $dataimages;
    public $datarchivo;
    public $archipdf = [];
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
        return view('livewire.vista');
    }

    public function getTiposHechosProperty()
    {
        return tipos_de_hechos::all();
    }
}
