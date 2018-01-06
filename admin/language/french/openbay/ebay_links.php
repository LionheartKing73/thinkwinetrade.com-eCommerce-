<?php
// Heading
$_['heading_title']           = 'Liens d\'Objet';
$_['text_openbay']            = 'OpenBay Pro';
$_['text_ebay']               = 'eBay';

// Buttons
$_['button_resync']           = 'Re-synchronisation';
$_['button_check_unlinked']   = 'Vérifier les objets non-liés';
$_['button_remove_link']      = 'Enlever le lien';

// Errors
$_['error_ajax_load']         = 'Désolé, impossible d\'obtenir une réponse. Essayez plus tard.';
$_['error_validation']        = 'Vous devez vous inscrire pour avoir votre jeton d\'accès à l\'API et activer le module.';
$_['error_no_listings']       = 'Aucun objet lié trouvé.';
$_['error_link_value']        = 'Le lien de produit est sans valeur';
$_['error_link_no_stock']     = 'Un lien ne peut être créé pour un objet sans stock. Terminez l\'objet manuellement sur eBay.';
$_['error_subtract_setting']  = 'Ce produit est marqué à ne pas soustraire du stock dans OpenCart.';

// Text
$_['text_linked_items']       = 'Objets liés';
$_['text_unlinked_items']     = 'Objets non-liés';
$_['text_alert_stock_local']  = 'Votre annonce eBay sera mise à jour avec vos niveaux de stock local !';
$_['text_link_desc1']         = 'Lier vos objets permettra le contrôle du stock sur vos annonces eBay.';
$_['text_link_desc2']         = 'Pour chaque objet modifié, le stock local (le stock disponible dans votre boutique OpenCart) mettra à jour votre annonce eBay';
$_['text_link_desc3']         = 'Votre stock local est le stock qui est disponible à la vente. Vos niveaux de stock eBay doivent correspondre à cela.';
$_['text_link_desc4']         = 'Votre stock attribué est constitué des objets qui sont vendus mais pas encore payés. Ces objets doivent être comptabilisés à part dans vos niveaux de stock disponible.';
$_['text_text_linked_desc']   = 'Les objets liés sont les objets OpenCart qui ont un lien vers une annonce eBay.';
$_['text_text_unlinked_desc'] = 'Les objets non-liés sont les annonces sur votre compte eBay qui n\'ont aucun lien vers un quelconque de vos produits OpenCart.';
$_['text_text_unlinked_info'] = 'Cliquez sur le bouton de vérification des objets non-liés pour rechercher vos annonces eBay actives pour des objets non-liés. Cela peut durer un moment si vous avez beaucoup d\'annonces eBay.';
$_['text_text_loading_items'] = 'Chargement des objets en cours';
$_['text_failed']             = 'Échec du chargement';
$_['text_limit_reached']      = 'Le nombre maximum de vérifications par requête a été atteint, cliquez sur le bouton pour continuer la recherche';
$_['text_stock_error']        = 'Erreur de stock';
$_['text_listing_ended']      = 'Annonce terminée';
$_['text_filter']             = 'Filtrer les résultats';
$_['text_filter_title']       = 'Intitulé';
$_['text_filter_range']       = 'Intervalle de stock';
$_['text_filter_range_from']  = 'Min';
$_['text_filter_range_to']    = 'Max';
$_['text_filter_var']         = 'Inclure les écarts';

// Tables
$_['column_action']           = 'Action';
$_['column_status']           = 'Status';
$_['column_variants']         = 'Écarts';
$_['column_item_id']          = 'N° d\'objet eBay';
$_['column_product']          = 'Produit';
$_['column_product_auto']     = 'Nom du produit (Complétion automatique)';
$_['column_listing_title']    = 'Intitulé d\'annonce eBay';
$_['column_allocated']        = 'Stock attribué (vendu mais pas payé)';
$_['column_ebay_stock']       = 'Stock eBay (sur l\'annonce)';
$_['column_stock_available']  = 'Stock en boutique';
$_['column_stock_reserve']    = 'Niveau de réserve';
?>