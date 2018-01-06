<?php
// Heading
$_['heading_title']                  = 'Realex Redirect';

// Text
$_['text_payment']                   = 'Paiement';
$_['text_success']                   = 'Succès: Vous avez modifié les détails de paiement par Realex !';
$_['text_edit']                      = 'Modifier le paiement par Realex Redirect';
$_['text_live']                      = 'Live';
$_['text_demo']                      = 'Démo';
$_['text_card_type']                 = 'Type de carte';
$_['text_enabled']                   = 'Activé';
$_['text_use_default']               = 'Utiliser le paramètrage par défaut';
$_['text_merchant_id']               = 'ID Marchand';
$_['text_subaccount']                = 'Sous-compte';
$_['text_secret']                    = 'Secret partagé';
$_['text_card_visa']                 = 'Visa';
$_['text_card_master']               = 'Mastercard';
$_['text_card_amex']                 = 'American Express';
$_['text_card_switch']               = 'Switch/Maestro';
$_['text_card_laser']                = 'Laser';
$_['text_card_diners']               = 'Diners';
$_['text_capture_ok']                = 'Succès de la collecte';
$_['text_capture_ok_order']          = 'Succès de la collecte, état de commande mis à jour sur “succès - règlée”';
$_['text_rebate_ok']                 = 'Votre paiement a été remboursé avec succès !';
$_['text_rebate_ok_order']           = 'Succès du remboursement, état de commande mis à jour sur “remboursée”';
$_['text_void_ok']                   = 'Succès de l\'annulation, état de commande mis à jour sur “annulée”';
$_['text_settle_auto']               = 'Auto';
$_['text_settle_delayed']            = 'Différé';
$_['text_settle_multi']              = 'Multi';
$_['text_url_message']               = 'Vous devez fournir l\'URL de la boutique à votre gestionnaire de compte Realex avant de pouvoir aller en ligne';
$_['text_payment_info']              = 'Informations de paiement';
$_['text_capture_status']            = 'Paiement collecté';
$_['text_void_status']               = 'Paiement annulé';
$_['text_rebate_status']             = 'Paiement remboursé';
$_['text_order_ref']                 = 'Réf. commande';
$_['text_order_total']               = 'Total autorisé';
$_['text_total_captured']            = 'Total collecté';
$_['text_transactions']              = 'Transactions';
$_['text_column_amount']             = 'Montant';
$_['text_column_type']               = 'Type';
$_['text_column_date_added']         = 'Créé le';
$_['text_confirm_void']              = 'Êtes-vous sûr(e) de vouloir annuler le paiement ?';
$_['text_confirm_capture']           = 'Êtes-vous sûr(e) de vouloir collecter le paiement ?';
$_['text_confirm_rebate']            = 'Êtes-vous sûr(e) de vouloir rembourser le paiement ?';
$_['text_realex']                    = '<a target="_blank" href="http://www.realexpayments.co.uk/partner-refer?id=opencart"><img src="view/image/payment/realex.png" alt="Realex" title="Realex" style="border: 1px solid #EEEEEE;" /></a>';

// Entry
$_['entry_merchant_id']              = 'ID Marchand';
$_['entry_secret']                   = 'Secret partagé';
$_['entry_rebate_password']          = 'Mot de passe de ristourne';
$_['entry_total']                    = 'Total';
$_['entry_sort_order']               = 'Classement';
$_['entry_geo_zone']                 = 'Zone géographique';
$_['entry_status']                   = 'Statut';
$_['entry_debug']                    = 'Journalisation de débuggage';
$_['entry_live_demo']                = 'Live / Démo';
$_['entry_auto_settle']              = 'Type de règlement';
$_['entry_card_select']              = 'Choix d\'une carte';
$_['entry_tss_check']                = 'Contrôles TSS';
$_['entry_live_url']                 = 'URL de connexion Live';
$_['entry_demo_url']                 = 'URL de connexion Démo';
$_['entry_status_success_settled']   = 'Succès - règlée';
$_['entry_status_success_unsettled'] = 'Succès - non règlée';
$_['entry_status_decline']           = 'Refusée';
$_['entry_status_decline_pending']   = 'Refusée - Authentification hors-ligne';
$_['entry_status_decline_stolen']    = 'Refusée - Carte perdue ou volée';
$_['entry_status_decline_bank']      = 'Refusée - Erreur de la banque';
$_['entry_status_void']              = 'Annulée';
$_['entry_status_rebate']            = 'Ristournée';
$_['entry_notification_url']         = 'URL de notification';

// Help
$_['help_total']                     = 'Le total à l\'encaissement que la commande doit atteindre avant que ce mode de paiement devienne actif.';
$_['help_card_select']               = 'Demande à l\'utilisateur de choisir son type de carte avant d\'être redirigé';
$_['help_notification']              = 'Vous devez fournir cette URL à Realex pour bénéficier des notifications de paiement';
$_['help_debug']                     = 'Activer le débuggage va écrire des données sensibles dans un fichier journal. Vous devriez toujours le désactiver sauf instructions contraires';
$_['help_dcc_settle']                = 'Si votre sous-compte a DCC d\'activé, vous devez utiliser le règlement automatique (Autosettle)';

// Tab
$_['tab_api']                        = 'Détails API';
$_['tab_account']                    = 'Comptes';
$_['tab_order_status']               = 'États de commande';
$_['tab_payment']                    = 'Paramètres de paiement';
$_['tab_advanced']                   = 'Avancé';

// Button
$_['button_capture']                 = 'Collecter';
$_['button_rebate']                  = 'Ristourner / Rembourser';
$_['button_void']                    = 'Annuler';

// Error
$_['error_merchant_id']              = 'ID Marchand requis !';
$_['error_secret']                   = 'Secret partagé requis !';
$_['error_live_url']                 = 'URL Live requise !';
$_['error_demo_url']                 = 'URL Démo requise !';
$_['error_data_missing']             = 'Des données requises sont manquantes !';
$_['error_use_select_card']          = 'Vous devez avoir activé “Choix d\'une carte” pour que le routage de sous-compte par type de carte fonctionne';
?>