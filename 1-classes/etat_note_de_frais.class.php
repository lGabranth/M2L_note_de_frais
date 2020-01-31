<?php

class etat_note_de_frais {
    use Genos;
    public $id;
    public $etat_note_de_frais;

    function __construct(){
        $this->id                   = 0;
        $this->etat_note_de_frais   = '';
    }
}