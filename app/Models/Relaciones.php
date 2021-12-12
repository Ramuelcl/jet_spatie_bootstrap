<?php // belongsTo -> Pertenece a

// modelo padre llama al modelo hijo que tiene los registros
$reg = Modelo_Padre::first();
$reg->belongsToRelation(Model Modelo_Hijo, $columna_padre,$columna_hijo);
//----------------------------
// Modelo_Padre
use Modelo_Hijo::class;
public function belongsToRelation()
{
    return $this->belongsTo(Modelo_Hijo::class, $columna_padre, $columna_hijo);
}
