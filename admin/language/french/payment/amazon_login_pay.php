<?php
//Headings
$_['heading_title']                = 'Connexion et Paiement avec Amazon';

//Text
$_['text_success']                 = 'Succès: Vous avez actualisé le module “Connexion et Paiement avec Amazon” !';
$_['text_ipn_url']                 = 'URL de tâche de fond';
$_['text_ipn_token']               = 'Jeton secret';
$_['text_us']                      = 'US';
$_['text_germany']                 = 'Allemagne';
$_['text_uk']                      = 'Royaume Uni';
$_['text_live']                    = 'Live';
$_['text_sandbox']                 = 'Sandbox';
$_['text_auth']                    = 'Autorisation';
$_['text_payment']                 = 'Paiement';
$_['text_no_capture']              = '--- Aucune collecte automatique ---';
$_['text_all_geo_zones']           = 'Toutes zones géographiques';
$_['text_button_settings']         = 'Paramètres du bouton d\'encaissement';
$_['text_colour']                  = 'Couleur';
$_['text_orange']                  = 'Orange';
$_['text_tan']                     = 'Bronzé';
$_['text_white']                   = 'Blanc';
$_['text_light']                   = 'Lumineux';
$_['text_dark']                    = 'Sombre';
$_['text_medium']                  = 'Moyen';
$_['text_large']                   = 'Grand';
$_['text_x_large']                 = 'Extra grand';
$_['text_background']              = 'Arrière-plan';
$_['text_amazon_login_pay']        = '<a href="http://go.amazonservices.com/opencart.html" target="_blank" title="Inscription à “Connexion et Paiement avec Amazon”"><img src="view/image/payment/amazon.png" alt="Connexion et Paiement avec Amazon" title="Connexion et Paiement avec Amazon" style="border: 1px solid #EEEEEE;" /></a>';
$_['text_amazon_join']             = '<a href="http://go.amazonservices.com/opencart.html" target="_blank" title="Inscription à “Connexion et Paiement avec Amazon”"><u>Inscription à “Connexion et Paiement avec Amazon”</u></a>';
$_['entry_login_pay_test']         = 'Mode test';
$_['entry_login_pay_mode']         = 'Mode paiement';
$_['text_payment_info']            = 'Informations de paiement';
$_['text_capture_ok']              = 'Succès de la collecte';
$_['text_capture_ok_order']        = 'Succès de la collecte, autorisation collectée avec succès';
$_['text_refund_ok']               = 'Succès du remboursement';
$_['text_refund_ok_order']         = 'Succès du remboursement, état de commande mis à jour sur “remboursée”';
$_['text_cancel_ok']               = 'Succès de l\'annulation, état de commande mis à jour sur “annulée”';
$_['text_capture_status']          = 'Paiement collecté';
$_['text_cancel_status']           = 'Paiement annulé';
$_['text_refund_status']           = 'Paiement remboursé';
$_['text_order_ref']               = 'Réf. commande';
$_['text_order_total']             = 'Total autorisé';
$_['text_total_captured']          = 'Total collecté';
$_['text_transactions']            = 'Transactions';
$_['text_column_authorization_id'] = 'ID d\'autorisation Amazon';
$_['text_column_capture_id']       = 'ID de collecte Amazon';
$_['text_column_refund_id']        = 'ID de remboursement Amazon';
$_['text_column_amount']           = 'Montant';
$_['text_column_type']             = 'Type';
$_['text_column_status']           = 'Statut';
$_['text_column_date_added']       = 'Créé le';
$_['text_confirm_cancel']          = 'Êtes-vous sûr(e) de vouloir annuler le paiement ?';
$_['text_confirm_capture']         = 'Êtes-vous sûr(e) de vouloir collecter le paiement ?';
$_['text_confirm_refund']          = 'Êtes-vous sûr(e) de vouloir rembourser le paiement ?';
$_['text_minimum_total']           = 'Total minimum de commande';
$_['text_geo_zone']                = 'Zone géographique';
$_['text_status']                  = 'Statut';
$_['text_declined_codes']          = 'Tester les codes de refus';
$_['text_sort_order']              = 'Classement';
$_['text_amazon_invalid']          = 'Méthode de paiement invalide';
$_['text_amazon_rejected']         = 'Refusée par Amazon';
$_['text_amazon_timeout']          = 'La transaction a expiré';
$_['text_amazon_no_declined']      = '--- Aucune autorisation refusée automatiquement ---';

// Columns
$_['column_status']                = 'Statut';

//entry
$_['entry_merchant_id']            = 'ID Marchand';
$_['entry_access_key']             = 'Clé d\'accès';
$_['entry_access_secret']          = 'Clé secrète';
$_['entry_client_id']              = 'ID Client';
$_['entry_client_secret']          = 'Secret client';
$_['entry_marketplace']            = 'Place de marché';
$_['entry_capture_status']         = 'État “collecte automatique”';
$_['entry_pending_status']         = 'État “en attente”';
$_['entry_ipn_url']                = 'URL IPN';
$_['entry_ipn_token']              = 'Jeton secret';
$_['entry_debug']                  = 'Journalisation de débuggage';


// Help
$_['help_pay_mode']                = 'Le paiement est disponible uniquement pour les places de marché US';
$_['help_capture_status']          = 'Choisissez l\'état de commande qui va déclancher la collecte automatique d\'un paiement autorisé';
$_['help_ipn_url']                 = 'Définissez cela comme votre URL marchand dans Amazon Seller Central';
$_['help_ipn_token']               = 'Rendez le long et dur à deviner';
$_['help_debug']                   = 'Activer le débuggage va écrire des données sensibles dans un fichier journal. Vous devriez toujours le désactiver sauf instructions contraires';
$_['help_declined_codes']          = 'Uniquement afin de tester';

// Order Info
$_['tab_order_adjustment']         = 'Rectification de commande';

// Errors
$_['error_permission']             = 'Attention: Vous n\'avez pas les droits nécessaires pour modifier ce module !';
$_['error_merchant_id']            = 'ID Marchand requis !';
$_['error_access_key']             = 'La clé d\'accès est requise !';
$_['error_access_secret']          = 'La clé secrète est requise !';
$_['error_client_id']              = 'ID Client requis !';
$_['error_client_secret']          = 'Clé Client requise !';
$_['error_pay_mode']               = 'Le paiement est disponible uniquement pour les places de marché US';
$_['error_curreny']                = 'Votre boutique doit avoir la devise %s installée et activée';
$_['error_upload']                 = 'Échec de l\'upload';
$_['error_data_missing']           = 'Des données requises sont manquantes !';

// Buttons
$_['button_capture']               = 'Collecter';
$_['button_refund']                = 'Rembourser';
$_['button_cancel']                = 'Annuler';
?>