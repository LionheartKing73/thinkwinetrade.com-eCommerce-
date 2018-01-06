<?php
// Heading
$_['heading_title']              = 'Importation d\'Objet';
$_['text_openbay']               = 'OpenBay Pro';
$_['text_ebay']                  = 'eBay';

// Text
$_['text_sync_import_line1']     = '<strong>Attention !</strong> Ceci va importer tous vos produits eBay et construire une structure catégorie dans votre boutique. Il est conseillé que vous supprimiez toutes les catégories et produits avant de lancer cette option.<br />La structure catégorie provient des catégories normales eBay, et non des catégories de votre boutique (si vous avez une boutique eBay). Vous pouvez renommer, enlever et éditer les catégories importées sans affecter vos produits eBay.';
$_['text_sync_import_line3']     = 'Vous devez vous assurer que votre serveur accepte et soit en mesure de traiter de grandes quantitées de données POST. 1000 objets eBay correspondant approximativement à 40Mo, vous devrez calculer vos besoins. Si votre requête échoue, alors votre paramètrage est probablement trop petit. Votre paramètre “memory_limit” de php.ini doit être d\'environ 128Mo.';
$_['text_sync_server_size']      = 'Actuellement, votre serveur accepte: ';
$_['text_sync_memory_size']      = 'Votre “memory_limit” de PHP: ';
$_['text_import_confirm']        = 'Cela va importer tous vos objets eBay comme de nouveaux produits, êtes-vous sûr(e) ? IMPOSSIBLE de revenir en arrière ! ASSUREZ-VOUS d\'abord d\'avoir une sauvegarde !';
$_['text_import_notify']         = 'Votre demande d\'importation a été envoyée pour traitement. Une importation prend environ 1 heure pour 1000 objets.';
$_['text_import_images_msg1']    = 'Des images sont en attente d\'importation/copie depuis eBay. Rafraîchissez cette page, si le nombre ne décroit pas';
$_['text_import_images_msg2']    = 'cliquez ici';
$_['text_import_images_msg3']    = 'et patientez. Des informations détaillées sur ce qui se passe peuvent être trouvées <a href="http://shop.openbaypro.com/index.php?route=information/faq&topic=8_45" target="_blank">ici</a>';

// Entry
$_['entry_import_item_advanced'] = 'Obtenir les données avancées';
$_['entry_import_categories']    = 'Importer les catégories';
$_['entry_import_description']   = 'Importer les descriptions d\'objets';
$_['entry_import']               = 'Importer les objets eBay';

// Buttons
$_['button_import']              = 'Importer';
$_['button_complete']            = 'Terminer';

// Help
$_['help_import_item_advanced']  = 'Durera 10 fois plus longtemps pour importer les objets. Importe les poids, tailles, ISBN et plus si disponible';
$_['help_import_categories']     = 'Construit une structure catégorie dans votre boutique à partir des catégories eBay';
$_['help_import_description']    = 'Cela va tout importer, y compris le HTML, les compteurs de visites, etc...';

// Error
$_['error_import']               = 'Échec du chargement';
$_['error_maintenance']          = 'Votre boutique est en mode maintenance. Une importation échouera !';
$_['error_ajax_load']            = 'Désolé, la connexion au serveur a échoué';
$_['error_validation']           = 'Vous devez vous inscrire pour avoir votre jeton d\'accès à l\'API et activer le module.';
?>