
##Instructions du TP3
>Utiliser une branche "dev/tp3_home" créée à partir de "deploy/prod"
- Le rendu doit être accompagné d’un fichier README_TP3.md expliquant comment installer et voir votre travail.
- Vous pouvez également y argumenter vos choix.
- Donnez dedans un lien vers un dump et les files (sur votre onedrive) et enlevez les éventuels dump.sql files.zip de votre branche.
rendu à 17h max le vendredi


>Pour ce projet TP3 mise en place de la page d'accueil, veuillez trouver :

    spec fil rouge TP3.pdf
    Les instructions sont présentes précédemment
    Lien pour le fichier files.zip :
    Lien pour le fichier dump.sql :

##Pour ouvrir et etudier le projet :

- décompresser le fichier files.zip que vous pouvez trouver à :
>https://adimeo-my.sharepoint.com/:u:/p/cpommier/ESZ-46RMRIpOlm8aoQ0VaRABa09EQUeZxT6nW_C9LFkY5Q?e=rtg21e
- copier les fichiers dans le dossier web/sites/default/files/
- insérez tous les fichiers dans ce dossier
- pour la base de donnée, le fichier dump.sql se trouve à la racine du projet à l'adresse suivante
>https://adimeo-my.sharepoint.com/:u:/p/cpommier/Eb3BG0lmrY9Ji-xwBkfYGeIBD67zgqnIn0XZRJMJs-wVgA?e=y0gjQw

>vous pouvez restaurer la base de donnée avec Drush en effectuant les commandes suivantes :
- drush sql:drop drush sql:cli mysql> source /chemin_dump/dump.sql
- (si erreur "Failed to open file dump.sql', error: 2" => mettre chemin absolu de la DB) exit drush cr
vous pouvez restaurer en utilisant Docker en effectuant les commandes suivantes
docker exec -i cp22_saulnier_db sh -c 'exec mysql -uroot -proot cp22_saulnier' < $PWD/dump.sql


##Structure Gateway et Manager :

J'ai essayé de bien travailler la structure de mon code de manière à factoriser au maximum les éléments.Ainsi toute la query sera filtrée selon les besoins.
Puis dans chaque module news, news_list, edito, partners, socials il n'y a plus qu'un manager qui régit la logique et fait appel au manager de global.

> Une gateway taxonomy est présente dans le menu global accompagnée de son interface.

BasicListOfTaxonomyTermGateway

Cette gateway permet de récupérer les termes de taxonomie de partners et social

> Un manager taxonomy est présent dans le global.

BasicListOfTaxonomyTermManager

Cette classe est abstraite et permet rapidement de récupérer tous les éléments pour charger la taxonomie

> Une gateway Nodes est présente dans le menu global accompagnée de son interface.

BasicListOfNodesGateway

Cette classe ultra factorisée permet de récupérer tous les nodes que je charge dans le site.
J'ai créé un systeme de tableau pour charger les query en fonctions de plusieurs condition.
Allez la voir, ca vaut le détour

> Un manager nodes est présent dans le global avec son interface

BasicListOfNodesManager

Dans ce manager, 3 méthodes sont présentes et chargent tous les nodes nécessaires sur le site.
Il y a une méthode pour le loadmultiple, une methode pour le view multiple et une methode pour charger les ids des nodes


>Chaque module possède son propre manager pour répartir dans les modules ou les blocks...


## Integration de la page d'accueil
>Le breadcrumb enlevé de la page d'accueil

>Pour l'image du cover, ce n'est pas indiqué dans les specifications mais Gregory m'a conseillé d'ajouter un champ image pour gérer cette information.

Cette technique permet d'avoir une meilleur expérience UX coté contributeur pour changer directement l'image dans la modification de la page d'accueil

J'ai recuperer cette image sur la maquette puis je l'ai compressé pour qu'elle ne prenne pas trop d'espace mémoire.

>Organisation du menu contrib :

J'ai organisé le menu contrib pour qu'il respecte les demandes dans les spécs.
J'ai essayé de maximiser l'expérience UX avec la création d'une vue de filtrage des actualités promus en page d'accueuil.
Et créer des boutons structure et structure de contenu qui recense les informations principales

Pour les éléments promus en page d'accueil, j'ai initialisé l'ouverture de page sur les actualités.
Dans les specs il est indiqué "projets éditoriaux à changer" seulement ces éléments sont modifiables directement dans la construction de la page d'accueil.
Ainsi pour une meilleur expérience utilisateur j'ai fais ce choix la.

>Ou se trouve les codes des menus links

Taxonomie :
- thematique dans le module global
- Réseaux sociaux et Partenaires dans leur module socials et partners

Structure de contenu :
- Actualités dans le module news
- Edito dans le module edito
--> j'ai ajouté la possibilité de voir le contenu non publié

Structure :
- Menu principal et menu footer dans le global

Accueil : dans le module home
- Modification de la page d'accueil
- Promu en page d'accueil


##Back Office et code
Mise en cache des partners qui seront modifiés rarement et donc plus rapide à charger...Pas extrêmement utile mais bon

SiteMap effectué pour toutes les entitées de contenu avec un changement periodique (toutes les semaines) et un index plus important pour la page d'accueil.
De plus j'ai choisi d'indexer les photos car elles sont très importantes sur ce type de projet de manière à faire remonter les éléments en haut de page.
Et les actualités avec index de 0.7 (entre la page d'accueil et edito) car les news sont assez importantes.
Les menus sont indexés.
Les elements de taxonomie partenaire et reseau social sont eux indexés.
les thematiques  indéxés fortement.

##Le LAYOUT
J'ai commencé en desktop first
Pour l'image en background je n'ai pas réussi a effectuer le bon placement.


>Le contenu principal

- Dans les projets edito, les boutons en bas de page n'ont pas la même marge. Ainsi la marge à créer n'est qu'une estimation.
- Les editos sont à une marge très grande de la cover sur la maquette, j'ai conservé ce qui était mentionné même si le rendu est très bizarre
- Pour les news, j'ai tronqué les soustitres de chaque élément de manière à ce que l'équilibre de la page soit bien respecté
- Si il n'y a pas de news j'ai appliqué un display flex row pour l'edito comme indiqué dans les spécs.
- J'ai conservé les mêmes marges avec 14rem à gauche et 14rem à droite.
- Aucune information est mentionné dans les spéc concernant le rmeplacement du temps écoulé pour les news : dixit "Contrairement à la maquette, la période de publication n’est pas
  affichée".N'ayant pas d'informations dans les spécs correspondant au remplacement de la hauteur du temps écoulé conernant la dernière actualité,
  j'ai donc adapté en ajoutant un margin de manière à voir le theme ressortir au dessus de la ligne de haut d'image.

> Si pas d'actualités et une seule page édito référencée
>
Comme indiqué dans les spécs j'ai adapté le layout mais il n'est précisé aucune information concernant le rendu, j'ai ainsi adapté selon les possibilités.

>BreakPoints

Pour le breakpoint format mobile, j'effectue la cassure à 1120 px.
Pour le deuxieme breakpoint format mobile j'effectue une modification à 750 px sur la div des news.

>Footer

Dans le menu des partenaires j'ai mis le slider en loop pour que les icones reviennent à chaque tour.


