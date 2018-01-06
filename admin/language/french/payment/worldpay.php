<?php
// Heading
$_['heading_title']                      = 'WorldPay';

// Text
$_['text_payment']                       = 'Paiement';
$_['text_success']                       = 'Succès: Vous avez modifié les détails de compte WorldPay !';
$_['text_worldpay']                      = '<a href="https://support.worldpay.com/apply/default.aspx?PartnerID=E511AF91-E4A0-42DE-80B0-09C981A3FB61" target="_blank"><img src="view/image/payment/worldpay.png" alt="Worldpay" title="Worldpay" style="border: 1px solid #EEEEEE;" /></a>';
$_['text_test']                          = 'Test';
$_['text_live']                          = 'Live';
$_['text_authenticate']                  = 'Authentifier';
$_['text_release_ok']                    = 'Votre paiement a été émis avec succès !';
$_['text_release_ok_order']              = 'Succès du paiement, état de commande mis à jour sur “succès - règlé”';
$_['text_refund_ok']                     = 'Votre paiement a été remboursé avec succès !';
$_['text_refund_ok_order']               = 'Succès du remboursement, état de commande mis à jour sur “remboursée”';
$_['text_void_ok']                       = 'Succès de l\'annulation, état de commande mis à jour sur “annulée”';

// Entry
$_['entry_service_key']                  = 'Clé Service';
$_['entry_client_key']                   = 'Clé Client';
$_['entry_total']                        = 'Total';
$_['entry_order_status']                 = 'État de commande';
$_['entry_geo_zone']                     = 'Zone géographique';
$_['entry_status']                       = 'Statut';
$_['entry_sort_order']                   = 'Classement';
$_['entry_debug']                        = 'Journalisation de débuggage';
$_['entry_card']                         = 'Cartes de boutique';
$_['entry_secret_token']                 = 'Jeton secret';
$_['entry_webhook_url']                  = 'URL Webhook';
$_['entry_cron_job_url']                 = 'URL de tâche de fond';
$_['entry_last_cron_job_run']            = 'Dernière exécution de la tâche de fond';
$_['entry_success_status']               = 'État “succès”';
$_['entry_failed_status']                = 'État “échoué”';
$_['entry_settled_status']               = 'État “règlé”';
$_['entry_refunded_status']              = 'État “remboursé”';
$_['entry_partially_refunded_status']    = 'État “partiellement remboursé”';
$_['entry_charged_back_status']          = 'État “rétrofacturé”';
$_['entry_information_requested_status'] = 'État “information demandée”';
$_['entry_information_supplied_status']  = 'État “information fournie”';
$_['entry_chargeback_reversed_status']   = 'État “rétrofacturation reversée”';


$_['entry_reversed_status']              = 'État “reversé”';
$_['entry_voided_status']                = 'État “annulé”';

// Help
$_['help_total']                         = 'Le total à l\'encaissement que la commande doit atteindre avant que ce mode de paiement devienne actif.';
$_['help_debug']                         = 'Activer le débuggage va écrire des données sensibles dans un fichier journal. Vous devriez toujours le désactiver sauf instructions contraires';
$_['help_secret_token']                  = 'Rendez le long et dur à deviner';
$_['help_webhook_url']                   = 'Définissez les webhooks Worldpay pour appeler cette URL';
$_['help_cron_job_url']                  = 'Définissez une tâche de fond pour appeler cette URL';

// Tab
$_['tab_settings']                       = 'Paramètres';
$_['tab_order_status']                   = 'États de commande';

// Error
$_['error_permission']                   = 'Attention: Vous n\'avez pas les droits nécessaires pour modifier le paiement par Worldpay !';
$_['error_service_key']                  = 'Clé service requise !';
$_['error_client_key']                   = 'Clé client requise !';

// Order page - payment tab
$_['text_payment_info']                  = 'Informations de paiement';
$_['text_refund_status']                 = 'Paiement remboursé';
$_['text_order_ref']                     = 'Réf. commande';
$_['text_order_total']                   = 'Total autorisé';
$_['text_total_released']                = 'Total émis';
$_['text_transactions']                  = 'Transactions';
$_['text_column_amount']                 = 'Montant';
$_['text_column_type']                   = 'Type';
$_['text_column_date_added']             = 'Créé le';

$_['text_confirm_refund']                = 'Êtes-vous sûr(e) de vouloir rembourser le paiement ?';

$_['btn_refund']                         = 'Ristourner / Rembourser';
?>