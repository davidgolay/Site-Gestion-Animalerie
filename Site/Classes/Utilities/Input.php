<?php
declare (strict_types=1);
require_once ('HTML.php');
require_once ('Field.php');

class Input extends Field {

    public function GenerateField()
    {
        $label = $this->GenerateLabel();
        $field = HTML::SurroundAutoClosing('input', $this->GenerateAttributes() );
        $finalOutput = $label . ' ' . $field;
        $finalOutput = HTML::Surround('div', HTML::Attribute('class', 'input-container'), $finalOutput);
        return $finalOutput;
    }




}
?>