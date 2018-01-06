<?php
// Heading
$_['heading_title']					  = 'SagePay Server';

// Text
$_['text_payment']            = 'Paiement';
$_['text_success']            = 'Succès: Vous avez modifié les détails de paiement par SagePay !';
$_['text_edit']               = 'Modifier le paiement par SagePay Server';
$_['text_sagepay_server']     = '<a href="https://support.sagepay.com/apply/default.aspx?PartnerID=E511AF91-E4A0-42DE-80B0-09C981A3FB61" target="_blank"><img src="view/image/payment/sagepay.png" alt="SagePay" title="SagePay" style="border: 1px solid #EEEEEE;" /></a>';
$_['text_sim']                = 'Simulateur';
$_['text_test']               = 'Test';
$_['text_live']               = 'Live';
$_['text_defered']            = 'Différé';
$_['text_authenticate']       = 'Authentification';
$_['text_release_ok']         = 'Votre paiement a été émis avec succès !';
$_['text_release_ok_order']   = 'Succès de l\'émission, état de commande mis à jour sur “succès - règlé”';
$_['text_rebate_ok']          = 'Votre paiement a été remboursé avec succès !';
$_['text_rebate_ok_order']    = 'Succès du remboursement, état de commande mis à jour sur “remboursée”';
$_['text_void_ok']            = 'Succès de l\'annulation, état de commande mis à jour sur “annulée”';
$_['text_payment_info']       = 'Informations de paiement';
$_['text_release_status']     = 'Paiement émis';
$_['text_void_status']        = 'Paiement annulé';
$_['text_rebate_status']      = 'Paiement remboursé';
$_['text_order_ref']          = 'Réf. commande';
$_['text_order_total']        = 'Total autorisé';
$_['text_total_released']     = 'Total émis';
$_['text_transactions']       = 'Transactions';
$_['text_column_amount']      = 'Montant';
$_['text_column_type']        = 'Type';
$_['text_column_date_added']  = 'Créé le';
$_['text_confirm_void']       = 'Êtes-vous sûr(e) de vouloir annuler le paiement ?';
$_['text_confirm_release']    = 'Êtes-vous sûr(e) de vouloir émettre le paiement ?';
$_['text_confirm_rebate']     = 'Êtes-vous sûr(e) de vouloir rembourser le paiement ?';

// Entry
$_['entry_vendor']            = 'Vendeur';
$_['entry_test']              = 'Mode test';
$_['entry_transaction']       = 'Méthode de transaction';
$_['entry_total']             = 'Total';
$_['entry_order_status']      = 'État de commande';
$_['entry_geo_zone']          = 'Zone géographique';
$_['entry_status']            = 'Statut';
$_['entry_sort_order']        = 'Classement';
$_['entry_debug']             = 'Journalisation de débuggage';
$_['entry_card']              = 'Cartes de boutique';
$_['entry_cron_job_token']    = 'Jeton secret';
$_['entry_cron_job_url']      = 'URL de tâche de fond';
$_['entry_last_cron_job_run'] = 'Dernière exécution de la tâche de fond';

// Help
$_['help_total']              = 'Le total à l\'encaissement que la commande doit atteindre avant que ce mode de paiement devienne actif.';
$_['help_debug']              = 'Activer le débuggage va écrire des données sensibles dans un fichier journal. Vous devriez toujours le désactiver sauf instructions contraires';
$_['help_transaction']        = 'La méthode de transaction DOIT être positionnée sur Paiement pour permettre les paiements d\'inscription';
$_['help_cron_job_token']     = 'Rendez le long et dur à deviner';
$_['help_cron_job_url']       = 'Définissez une tâche de fond pour appeler cette URL';

// Button
$_['btn_release']             = 'Émettre';
$_['btn_rebate']              = 'Ristourner / Rembourser';
$_['btn_void']                = 'Annuler';

// Error
$_['error_permission']        = 'Attention: Vous n\'avez pas les droits nécessaires pour modifier le paiement par SagePay!';
$_['error_vendor']            = 'ID Vendeur requis !';
?>