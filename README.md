# Item Sniffer
Item Sniffer est une **librairie PHP** permettant de récupérer toutes les informations essentielles à la création d'un item sans avoir à créer ses stats et ses lignes.
Il est exclusivement compatible avec la **version 1.29 de Dofus**.

## Fonctionnalités
- Description
- Nom
- Level
- Gfxid
- Type
- Effets
- Effets encodés.

*Attention*, tous les effets ne sont pas gérés mais les principaux sont gérés.(Cf. Effects.md)

## Utilisation
Se réferer au fichier `index.php` sinon :
- Dans un premier temps, récupérer l'URL de l'item que vous souhaiter sur le fansite [DofusBook](http://www.dofusbook.net/fr/encyclopedie/fiche/equipements.html), par exemple voici l'URL de la Cape du Bretteur Céleste : `http://www.dofusbook.net/fr/encyclopedie/objet/3522.html`, son ID est donc **3522**.
- N'oubliez pas d'inclure le fichier de la librairie `include('libary.php');`.
- Créer un objet en utilisant le code `$object = new Object(3522);`.
- La librarie est prête, exemple d'utilisation `$object->desc();` pour récupérer la description de l'objet.

## Screenshots
![image](http://image.noelshack.com/fichiers/2015/41/1444582326-screen.jpg)
