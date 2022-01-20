<?php
    declare (strict_types = 1);
    require_once ('Utilities/HTML.php');
    /**
     * Cette classe grpahique permet de représenter une liste d'animaux en contenu Html
     */
    class VueAnimal{

        /**
         * Liste d'animaux qui servira à remplir le tableau d'animaux
         */
        private array $animaux;

        private int $nbColumns = 7;

        /**
         * représente le fait que le tableau devra ou non afficher ses boutons
         */
        private bool $editable = true;

        public function __construct(array $animaux)
        {
            if(!empty($animaux) ){
                $this->animaux = $animaux;
            }     
        }

        /** Cette méthode permet de renvoyer le string qui générere le tableau d'affichage des animaux 
         * @return string tableau au format HMTL concatèné en string représentant le tableau de la liste des animaux
        */
        public function AnimalsTable(){

            $tableContent = $this->GenerateTableHeader().$this->GenerateTableRows();
            $idAttributte = HTML::Attribute('id', 'animals');
            $animalTable = HTML::Surround('table', $idAttributte, $tableContent);

            //$containerAttribute =  HTML::Attribute('class', 'container-table');
            // $animalTable = HTML::Surround('div', $containerAttribute, $animalTable);
            echo $animalTable;
        }
        
        /**
         * Cette méthode permet de générer le contenu du table des animaux
         * @return String chaine concatenée permettant de représenter graphiquement les cellules du tableau
         */
        public function GenerateTableRows():string
        {
            $res = '';       
            if (!empty($this->animaux))
            {
                foreach($this->animaux as $value)
                {  
                    //static <td> cells
                    $res .= HTML::Surround('td', '', $value->nom() );
                    $res .= HTML::Surround('td', '', $value->espece() );
                    $res .= HTML::Surround('td', '', $value->cri() );
                    $res .= HTML::Surround('td', '', $value->proprietaire() );
                    $res .= HTML::Surround('td', '', strval($value->age()) );

                    if($this->editable){
                        //Modify button part
                        $urlModify = 'modify.php?id='.$value->id();
                        $classFakeButton = HTML::Attribute('class', 'button-link');
                        $idFakeButton = HTML::Attribute('id', 'a-fake');
                        $modifyFakeButton = HTML::FakeLinkButton('Modifier', $urlModify);
                        $res .= HTML::Surround('td', $idFakeButton, $modifyFakeButton );

                        //Supression button part
                        $urlRemove = 'remove.php?ids='.$value->id();
                        $removeFakeButton = HTML::FakeLinkButton('Supprimer', $urlRemove);
                        $res .= HTML::Surround('td', '', $removeFakeButton );
                    }

                    //final <tr> row
                    $res = HTML::Surround('tr', '', $res);
                }
            }else
            {
                $emptyMessage = "Aucun animal dans votre liste";
                $colspanAttribute = HTML::Attribute('colspan', strval($this->nbColumns));
                $res = HTML::Surround('td', $colspanAttribute, $emptyMessage);
                $res = HTML::Surround('tr', '', $res);
            }
            return $res;
        }

        /**
         * Cette methode permet de générer la ligne d'entete du table
         * @return String chaine concatené permettant de représenter graphiquement la ligne d'en tete
         */
        public function GenerateTableHeader():string{
            $res = '';          
            $res .= HTML::Surround('th', '', 'Nom');
            $res .= HTML::Surround('th', '', 'Espece');
            $res .= HTML::Surround('th', '', 'Cri');
            $res .= HTML::Surround('th', '', 'Propriétaire');
            $res .= HTML::Surround('th', '', 'Age');
            if($this->editable){
                $res .= HTML::Surround('th', '', 'Modification');
                $res .= HTML::Surround('th', '', 'Suppression');
            }

            return $res;
        }

        public function setEditable(bool $isEditable){
            $this->editable = $isEditable;
        }
    }

?>