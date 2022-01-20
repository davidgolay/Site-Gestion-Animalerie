<?php 
    class Mark {
        
        private string $class;

        public function setClass(string $className){
            $this->class = $className;
        }

        public function getClass():string{
            return $this->class;
        }
    }
?>