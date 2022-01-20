<?php
declare (strict_types=1);
/**
 * Cette classe permet de générer de l'HTML, 
 * elle est utile pour placer facilement du contenu entre des balises,
 * créer des balises possèdant des attributs etc...
 * @Author David Golay
 */
class HTML {

    /**
     * Englobe un contenu (string) par une balise rensignée en paramètre,
     * avec la possiblité d'y ajouter des attributs
     */
    public static function Surround(string $balise, string $attributes, string $content):string
    {
        $surrounded = HTML::Open($balise, $attributes);
        $surrounded = $surrounded.$content;
        $surrounded = $surrounded.HTML::Close($balise);   
        return $surrounded;
    }

    /**
     * Genere une balise auto-fermante,
     * avec la possiblité d'y ajouter des attributs
     */
    public static function SurroundAutoClosing(string $balise, string $attributes):string
    {
        $surrounded = HTML::Open($balise, $attributes);
        $surrounded = $surrounded.HTML::Close($balise);   
        return $surrounded;
    }

    /**
     * Genere un attribut sous forme de texte
     */
    public static function Attribute(string $attribute, string $value):string
    {
        $output = $attribute.'="'.$value.'" ';
        return $output;
    }

    /**
     * Contenu textuel pour ouvrir une balise renseignée en paramètre
     */
    public static function Open(string $balise, string $attributes):string
    {
        $openedMarkUp= '<'.$balise.' '.$attributes.'>';
        return $openedMarkUp;
    }

    /**
     * Contenu textuel pour fermer une balise renseignée en paramètre
     */
    public static function Close(string $balise):string
    {
        $closedMarkUp= '</'.$balise.'>';
        return $closedMarkUp;
    }

    /**
     * Permet de générer un faux bouton (balise a) avec la destination vers laquelle ce lien nous emmène
     */
    public static function FakeLinkButton(string $buttonName, string $destination):string{
        $href = HTML::Attribute('href', $destination);
        $link = HTML::Surround('a', $href, $buttonName);
        return $link;
    }

}
?>