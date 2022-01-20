<?php
    require_once ('HTML.php');
    require_once ('Field.php');

    class Button extends Field {

        public function GetBaliseType():string{
            return 'input';
        }

        public function GenerateField()
        {
            $fieldText = HTML::Surround($this->GetBaliseType(), $this->GenerateAttributes(), "" );
            return $fieldText;
        }
    }
?>