<?php
namespace App\Utils;

class Node
{
    public $key, $pseudo, $level, $first_name, $last_name, $pays, $parent, $icon, $url;
    
    public function __construct($key, $pseudo, $level, $first_name, $last_name, $pays, $parent)
    {
        $this->key = $key;
        $this->parent = $parent;
        $this->pseudo = $pseudo;
        $this->level = $level;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->pays = $pays;
        $this->icon = url('/').'/back_assets/go/level_icones/'.$this->setIcon($this->level).'.jpeg';
        $this->url = url('/'). '/espace-membres/reseau/genealogie/'.encrypt($key);
    }

    public function setIcon($level)
    {
        if ($level=='Niveau 0') {
            return 'step_0';
        }        
        if ($level=='Niveau 1') {
            return 'step_1';
        }        
        if ($level=='Niveau 2') {
            return 'step_2';
        }        
        if ($level=='Niveau 3') {
            return 'step_3';
        }        
        if ($level=='Niveau 4') {
            return 'step_4';
        }        
        if ($level=='Niveau 5') {
            return 'step_5';
        }
        if ($level == 'Niveau 6') {
            return 'step_6';
        }
        if ($level == 'Niveau 7') {
            return 'step_7';
        }        
    }
}