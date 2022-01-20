<?php
    declare (strict_types=1);

    class Label {

        private string $content;

        public function __construct(string $content)
        {
            $this->content = $content;
        }

        public function __ToString():string
        {
            $label = HTML::Surround('label', '', $this->content);
            return $label;
        }
    }
    


?>