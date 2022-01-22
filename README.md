# Protosite de gestion d'animalerie

Ce projet a été réalisé dans le cadre d'un TP de 2ème d'IUT informatique en une vingtaine d'heures.

# ☑️ Le TP en quelques points 

## 📜 Classes et scripts PHP
•	Classe utilitaire pour générer du contenu HTML, attributs, identifiant </br>
•	Classe IHM pour regénérer facilement le tableau des animaux
•	Formulaires dynamiques (décorés différemment selon les cas)

## 🔍 Recherche par filtre et suppression des animaux
•	Possibilité de trouver plusieurs animaux qui correspondent aux critères de recherche </br>
•	Recherche par filtres cumulés (les champs de recherche ne sont pas obligatoires, il permette d’affiner la recherche). </br>
•	Recherche flexible qui permet d’afficher les animaux dont le nom, l’espèce etc. commence par le contenu entré dans le formulaire </br>
•	Recherche stricte de l’âge (seuls les âges équivalent sont trouvables) </br>
•	Possibilité de supprimer tous les animaux (filtrés) d’un coup. </br>

## 🛡️ Sécurité et confort
•	Gestion des caractère spéciaux pour éviter les injection SQL </br>
•	Redirection vers l’index </br> 
•	Gestion des exceptions de PDO </br>
•	Vérification des champs qui doivent être non vide </br>
•	Page intermédiaire de suppression des animaux </br>
