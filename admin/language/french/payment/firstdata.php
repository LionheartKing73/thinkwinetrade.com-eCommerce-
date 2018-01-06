<?php
// Heading
$_['heading_title']					         = 'First Data EMEA Connect (3DSecure activé)';

// Text
$_['text_payment']                   = 'Paiement';
$_['text_success']                   = 'Succès: Vous avez modifié les détails de paiement par First Data !';
$_['text_edit']                      = 'Modifier le paiement par First Data EMEA Connect (3DSecure activé)';
$_['text_notification_url']          = 'URL de notification';
$_['text_live']                      = 'Live';
$_['text_demo']                      = 'Démo';
$_['text_enabled']                   = 'Activé';
$_['text_merchant_id']               = 'ID Boutique';
$_['text_secret']                    = 'Secret partagé';
$_['text_capture_ok']                = 'Succès de la collecte';
$_['text_capture_ok_order']          = 'Succès de la collecte, état de commande mis à jour sur “succès - règlée”';
$_['text_void_ok']                   = 'Succès de l\'annulation, état de commande mis à jour sur “annulée”';
$_['text_settle_auto']               = 'Solde';
$_['text_settle_delayed']            = 'Pré-authentification';
$_['text_success_void']              = 'La transaction a été annulée';
$_['text_success_capture']           = 'La transaction a été collectée';
$_['text_firstdata']                 = '<img src="view/image/payment/firstdata.png" alt="First Data" title="First Data" style="border: 1px solid #EEEEEE;" />';
$_['text_payment_info']              = 'Informations de paiement';
$_['text_capture_status']            = 'Paiement collecté';
$_['text_void_status']               = 'Paiement annulé';
$_['text_order_ref']                 = 'Réf. commande';
$_['text_order_total']               = 'Total autorisé';
$_['text_total_captured']            = 'Total collecté';
$_['text_transactions']              = 'Transactions';
$_['text_column_amount']             = 'Montant';
$_['text_column_type']               = 'Type';
$_['text_column_date_added']         = 'Créé le';
$_['text_confirm_void']              = 'Êtes-vous sûr(e) de vouloir annuler le paiement ?';
$_['text_confirm_capture']           = 'Êtes-vous sûr(e) de vouloir collecter le paiement ?';

// Entry
$_['entry_merchant_id']              = 'ID de boutique';
$_['entry_secret']                   = 'Secret partagé';
$_['entry_total']                    = 'Total';
$_['entry_sort_order']               = 'Classement';
$_['entry_geo_zone']                 = 'Zone géographique';
$_['entry_status']                   = 'Statut';
$_['entry_debug']                    = 'Journalisation de débuggage';
$_['entry_live_demo']                = 'Live / Démo';
$_['entry_auto_settle']              = 'Type de règlement';
$_['entry_card_select']              = 'Choisir une carte';
$_['entry_tss_check']                = 'Contrôles TSS';
$_['entry_live_url']                 = 'URL de connexion Live';
$_['entry_demo_url']                 = 'URL de connexion Démo';
$_['entry_status_success_settled']   = 'Succès - règlée';
$_['entry_status_success_unsettled'] = 'Succès - non règlée';
$_['entry_status_decline']           = 'Refusée';
$_['entry_status_void']              = 'Annulée';
$_['entry_enable_card_store']        = 'Activer le stockage des jetons de carte';

// Help
$_['help_total']                     = 'Le total à l\'encaissement que la commande doit atteindre avant que ce mode de paiement devienne actif.';
$_['help_notification']              = 'Vous devez fournir cette URL à First Data pour bénéficier des notifications de paiement';
$_['help_debug']                     = 'Activer le débuggage va écrire des données sensibles dans un fichier journal. Vous devriez toujours le désactiver sauf instructions contraires';
$_['help_settle']                    = 'Si vous utilisez la pré-authentification, vous devez terminer une action de post-authentification dans les 3-5 jours sinon votre transaction sera abandonnée';

// Tab
$_['tab_account']                    = 'Infos API';
$_['tab_order_status']               = 'États de commande';
$_['tab_payment']                    = 'Paramètres de paiement';
$_['tab_advanced']                   = 'Avancé';

// Button
$_['button_capture']                 = 'Collecter';
$_['button_void']                    = 'Annuler';

// Error
$_['error_merchant_id']              = 'ID de boutique requis !';
$_['error_secret']                   = 'Secret partagé requis !';
$_['error_live_url']                 = 'URL Live requise !';
$_['error_demo_url']                 = 'URL Démo requise !';
$_['error_data_missing']             = 'Des données requises sont manquantes !';
$_['error_void_error']               = 'Impossible d\'annuler la transaction !';
$_['error_capture_error']            = 'Imposible de collecter la transaction !';
?>