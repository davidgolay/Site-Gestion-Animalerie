<?php

require_once ('Input.php');
require_once ('Button.php');
require_once ('Field.php');

class Form {

    private $fields = array(); //tableau permettant de stocker des objets de type Champ.
    private string $action; //: chaîne de caractère représentant la chaîne action du formulaire, c’està-dire la page de destination.

    private string $title;

    private string $subtitle;

    public function __Construct(string $action)
    {
        $this->action = $action;
    }

    public function __ToString():string
    {
        $content = $this->GenerateTitle() . $this->GenerateSubtitle();
        foreach($this->fields as $field) {   
            $content = $content . $field->__ToString();
        }

        $method  = HTML::Attribute("method", "post");
        $class   = HTML::Attribute("class", "form");
        $action  = HTML::Attribute("action", $this->action);
        $form    = HTML::Surround('form', $class . $method . $action, $content);

        return $form;
    }

    /**
     * Ajoute un Champ au Form
     */
    public function Add(Field $field)
    {
        $this->fields[] = $field;
    }

    /**
     * cette fonction permet de reinjecter des valeurs dans le formulaire
     */
    public function Hydrate(array $donnees)
    {
        $cursor = 0;
        foreach($donnees as $d)
        {
            $this->fields[$cursor]->setValue($d);
            $cursor ++;
        }
    }

    public function __toStringResultat():string
    {
        $res = '';
        foreach($this->fields as $c)
        {
            $res = $res . $c->getName().' => '.$c->getValue().'</br>';
        }
        return $res;
    }

    public function GenerateTitle():string{
        $titleText = '';
        if(!empty($this->title)) { 
            $titleText = HTML::Surround('div', HTML::Attribute('class', 'title'), $this->title);
        }
        return $titleText;
    }

    public function GenerateSubtitle():string{
        $subtitleText = '';
        if(!empty($this->subtitle)) { 
            $subtitleText = HTML::Surround('div', HTML::Attribute('class', 'subtitle'), $this->subtitle);
        }
        return $subtitleText;
    }

    public function setTitle(string $title){
        $this->title = $title;
    }

    public function setSubtitle(string $subtitle){
        $this->subtitle = $subtitle;
    }
}
?>