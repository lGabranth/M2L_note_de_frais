<?php 

class type {
    use Genos;
    public $id;
    public $type_note_de_frais;

    function __construct(){
        $this->id                   = 0;
        $this->type_note_de_frais   = '';
    }
}