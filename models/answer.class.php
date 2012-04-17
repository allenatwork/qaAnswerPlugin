<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Answer{
    var $id;
    var $body;
    
    public function __construct($id,$body) {
        $this->id=$id;
        $this->body=$body;
    }
    
    public function display(){
        echo $this->body;
    }
}
?>
