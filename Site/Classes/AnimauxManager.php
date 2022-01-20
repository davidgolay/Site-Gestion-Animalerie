<?php
/**
 * Cette classe permet de gérer la liaison entre le site et la base de donnée
 */
class AnimauxManager
{

    /**
     * @var PDO
     */
    private $_db;

    /**
     * @param $db PDO
     */
    public function __construct($db)
    {
        $this->setDb($db);
    }

    /**
     * Permet de créer la table Animal si elle n'existe pas
     */
    public function createNotExistingAnimalTable(): void
    {
        try{
            $q = $this->_db->prepare('CREATE TABLE IF NOT EXISTS AnimalerieGOLAY.ANIMAL
            (
                ID INT PRIMARY KEY AUTO_INCREMENT,
                NOM VARCHAR(50) NOT NULL,
                ESPECE VARCHAR(50) NOT NULL,
                CRI VARCHAR(50) NOT NULL,
                PROPRIETAIRE VARCHAR(50) NOT NULL,
                AGE INT NOT NULL
            );');                
            $q->execute();

        } catch (PDOException $Exception){
            echo  $Exception->getMessage();
            echo (int)$Exception->getCode();
        }
    }

    /**
     * Permet d'ajouter un animal
     * @param \Animal $animal
     */
    public function add(Animal $animal): void
    {
        try{
            $q = $this->_db->prepare('INSERT INTO AnimalerieGOLAY.animal(nom, espece, cri, proprietaire, age) VALUES (:nom, :espece, :cri, :proprietaire, :age);');        
            $q->bindValue(':nom', $animal->nom(), PDO::PARAM_STR);
            $q->bindValue(':espece', $animal->espece(), PDO::PARAM_STR);
            $q->bindValue(':cri', $animal->cri(), PDO::PARAM_STR);
            $q->bindValue(':proprietaire', $animal->proprietaire(), PDO::PARAM_STR);
            $q->bindValue(':age', $animal->age(), PDO::PARAM_INT);         
            $q->execute();

        } catch (PDOException $Exception){
            echo  $Exception->getMessage();
            echo (int)$Exception->getCode();
        }
    }

    /**
     * Permet de supprimer un animal
     * @param \Animal $animal
     */
    public function delete(Animal $animal): void
    {
        try{
            $q = $this->_db->prepare('DELETE FROM AnimalerieGOLAY.animal WHERE id = :id;');
            $q->bindValue(':id', $animal->id(), PDO::PARAM_INT);
            $q->execute();
        }catch (PDOException $Exception){
            echo  $Exception->getMessage();
            echo (int)$Exception->getCode();
        }
    }

    /**
     * Permet de récupérer un animal
     * @param $id
     * @return \Animal|null
     */
    public function get($id): ?Animal
    {
        $animal = null;
        $id = (int) $id;
        try{
            $q = $this->_db->prepare('SELECT * FROM AnimalerieGOLAY.animal WHERE id = :id;');
            $q->bindValue(':id', $id, PDO::PARAM_INT);           
            $q->execute();
            $donnees = $q->fetch(PDO::FETCH_ASSOC);
            $animal = new Animal($donnees);
            $animal->Hydrate($donnees);
        }
        catch (PDOException $Exception) {
            echo  $Exception->getMessage();
            echo (int)$Exception->getCode();
        }
        return $animal;
    }

    /**
     * Permet de récupérer tous les animaux
     * @return Animal[]
     */
    public function getList(): array
    {
        $animaux = array();
        try{
            $q = $this->_db->query('SELECT * FROM AnimalerieGOLAY.animal ORDER BY ESPECE;');
            while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
                $animaux[] = new Animal($donnees);
            }        
        }
        catch (PDOException $Exception) {
            echo  $Exception->getMessage();
            echo (int)$Exception->getCode();
        }

        return $animaux;
    }

    /**
     * Permet de récupérer tous les animaux qui corresponde aux critères de recherche passés en paramètre
     * @return Animal[]
     */
    public function getByFilters(array $filters): array
    {
        $whereConditions = array(); //tableau qui stockera les différents WHERE [attributes] = value;

        $customQuery = 'SELECT * FROM AnimalerieGOLAY.animal'; //requete sous forme initial (sans aucun filtre) qui sera personnalisée selon les cas

        //ajout des différentes conditions en fonction de l'existence ou non des filtres postés
        if(!empty($filters['nom']))            $whereConditions[] = 'NOM LIKE "'.$filters['nom'].'%"';              
        if(!empty($filters['espece']))         $whereConditions[] = 'ESPECE LIKE "'.$filters['espece'].'%"';           
        if(!empty($filters['cri']))            $whereConditions[] = 'CRI LIKE "'.$filters['cri'].'%"';
        if(!empty($filters['proprietaire']))   $whereConditions[] = 'PROPRIETAIRE LIKE "'.$filters['proprietaire'].'%"';
        if(!empty($filters['age']))            $whereConditions[] = 'AGE = "'.$filters['age'].'"';

        $index = 0;
        // Pour chaque condition receuilli dans le tableau
        foreach($whereConditions as $condition)
        {
            if($index <= 0){ $customQuery .= ' WHERE '; } 
            else {$customQuery .= ' AND ';}
            $customQuery .= $condition;
            $index++;
        }

        $customQuery .= ' ORDER BY ESPECE;';

        $animaux = array();

        try{
            $q = $this->_db->prepare($customQuery);
            $q->execute();

            while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
                $animaux[] = new Animal($donnees);
            }        
        }
        catch (PDOException $Exception) {
            echo  $Exception->getMessage();
            echo (int)$Exception->getCode();
        }

        return $animaux;
    }

    /**
     * Permet de modifier un animal
     * @param \Animal $animal
     */
    public function update(Animal $animal): void
    {
        $q = $this->_db->prepare('UPDATE AnimalerieGOLAY.animal SET nom = :nom, espece = :espece, cri = :cri, proprietaire = :proprietaire, age = :age WHERE id = :id;');
        $q->bindValue(':nom', $animal->nom(), PDO::PARAM_STR);
        $q->bindValue(':espece', $animal->espece(), PDO::PARAM_STR);
        $q->bindValue(':cri', $animal->cri(), PDO::PARAM_STR);
        $q->bindValue(':proprietaire', $animal->proprietaire(), PDO::PARAM_STR);
        $q->bindValue(':age', $animal->age(), PDO::PARAM_INT);
        $q->bindValue(':id', $animal->id(), PDO::PARAM_INT); 
        $q->execute();
    }

    /**
     * Permet de redéfinir la valeur de la propriété $_db
     * @param PDO $db
     */
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }

}