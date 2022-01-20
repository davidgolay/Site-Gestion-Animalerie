<?php
    declare (strict_types = 1);
    class Animal{
        
        private int $_id;
        private string $_nom;
        private string $_espece;
        private string $_cri;
        private string $_proprietaire;
        private int $_age;

        //Assesseurs
        public function id():int { return $this->_id; }
        public function nom():string { return $this->_nom; }
        public function espece():string { return $this->_espece; }
        public function cri():string { return $this->_cri; }
        public function proprietaire():string { return $this->_proprietaire; }
        public function age():int { return $this->_age; }

        //Modificateurs
        public function setId($id) {
            $id = (int) $id;
            if ($id > 0) 
            $this->_id = $id;
        }

        public function setNom($nom) {
            $nom = htmlspecialchars($nom);
            $this->_nom = $nom;
        }

        public function setEspece($espece) {
            $espece = htmlspecialchars($espece);
            $this->_espece = $espece;
        }

        public function setCri($cri) {
            $cri = htmlspecialchars($cri);
            $this->_cri = $cri;
        }

        public function setProprietaire($proprietaire) {
            $proprietaire = htmlspecialchars($proprietaire);
            $this->_proprietaire = $proprietaire;
        }

        public function setAge($age) {
            $age = (int) $age;
            if ($age > 0) 
            $this->_age = $age;
        }

        public function __construct($donnees)
        {
            $this->Hydrate($donnees);
        }


        //Methodes
        /**
         * Hydrate l'instance animal à partir des données passées en paramètre
         */
        public function Hydrate($donnees){
            foreach ($donnees as $key => $value)
            {
                $method = 'set'.ucfirst($key);
                if (method_exists($this, $method))
                {
                    $this->$method($value);
                }
            }
        }

        /**
         * Permet de récupérer les attributs de l'instance
         */
        public function getAnimalVars():array{
            return get_object_vars($this);
        }
        
        //Overrides
        public function __toString()
        {
            $nom          = 'Nom: '        .$this->_nom.'</br>';
            $espece       = 'Espece: '     .$this->_espece.'</br>';
            $age          = 'Age: '        .$this->_age.'</br>';
            $cri          = 'Cri: '        .$this->_cri.'</br>';
            $proprietaire = 'Propriétaire: '.$this->_proprietaire.'</br>';
            $toString     = $nom . $espece . $age . $cri . $proprietaire;
            return $toString;
        }
       
    }
?>