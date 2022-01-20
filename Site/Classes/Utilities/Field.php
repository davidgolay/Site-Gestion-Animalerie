<?php
require_once ('HTML.php');
require_once ('Mark.php');
require_once ('label.php');

abstract class Field extends Mark {
 
    private string $name; 
    
    private string $type; 
    
    private string $value;

    private Label $label;

    public function __Construct(string $name, string $type, string $value){
        $this->name  = $name;
        $this->type  = $type;
        $this->value = $value;
    }

    public function __ToString():string
    {
        return $this->GenerateField();
    }

    public abstract function GenerateField();

    public function GenerateAttributes():string
    {
        $class = '';
        $type  = '';
        $name  = '';
        $value = '';

        if(!empty($this->getClass())) {
            $class  = HTML::Attribute("class", $this->getClass());
        }
        if(!empty($this->type)) {
            $type  = HTML::Attribute("type", $this->type); 
        }
        if(!empty($this->value)) {
            $value  = HTML::Attribute("value", $this->value); 
        }
        if(!empty($this->name)) {
            $name  = HTML::Attribute("name", $this->name); 
        }

        $attributes  = $class . $type . $name . $value;
        return $attributes;
    }

    public function GenerateLabel():string{
        $label = '';
        if(!empty($this->label)){
            $label = $this->label->__ToString();
        }
        return $label;
    }

    public function AddLabel(Label $label){
        $this->label = $label;
    }

    public function setValue(string $val){
        $this->value = $val;
    }

    public function getName():string{
        return $this->name;
    }

    public function getValue():string{
        return $this->value;
    }



}
?>