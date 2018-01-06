<?php
// Heading
$_['heading_title']                  = 'Globalpay Remote';

// Text
$_['text_payment']                   = 'Paiement';
$_['text_success']                   = 'Succès: Vous avez modifié les détails de paiement par Globalpay Remote !';
$_['text_edit']                      = 'Modifier le paiement par Globalpay Remote';
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
$_['text_ip_message']                = 'Vous devez fournir l\'adresse IP de votre serveur à votre gestionnaire de compte Globalpay avant de pouvoir aller en ligne';
$_['text_payment_info']              = 'Informations de paiement';
$_['text_capture_status']            = 'Paiement collecté';
$_['text_void_status']               = 'Paiement annulé';
$_['text_rebate_status']             = 'Paiement remboursé';
$_['text_order_ref']                 = 'Réf. commande';
$_['text_order_total']               = 'Total autorisé';
$_['text_total_captured']            = 'Total collecté';
$_['text_transactions']              = 'Transactions';
$_['text_confirm_void']              = 'Êtes-vous sûr(e) de vouloir annuler le paiement ?';
$_['text_confirm_capture']           = 'Êtes-vous sûr(e) de vouloir collecter le paiement ?';
$_['text_confirm_rebate']            = 'Êtes-vous sûr(e) de vouloir rembourser le paiement ?';
$_['text_globalpay_remote']          = '<a target="_blank" href="https://resourcecentre.globaliris.com/getting-started.php?id=OpenCart"><img src="view/image/payment/globalpay.png" alt="Globalpay" title="Globalpay" style="border: 1px solid #EEEEEE;" /></a>';

// Column
$_['text_column_amount']             = 'Montant';
$_['text_column_type']               = 'Type';
$_['text_column_date_added']         = 'Créé le';

// Entry
$_['entry_merchant_id']              = 'ID Marchand';
$_['entry_secret']                   = 'Secret partagé';
$_['entry_rebate_password']          = 'Mot de passe de ristourne';
$_['entry_total']                    = 'Total';
$_['entry_sort_order']               = 'Classement';
$_['entry_geo_zone']                 = 'Zone géographique';
$_['entry_status']                   = 'Statut';
$_['entry_debug']                    = 'Journalisation de débuggage';
$_['entry_auto_settle']              = 'Type de règlement';
$_['entry_tss_check']                = 'Contrôles TSS';
$_['entry_card_data_status']         = 'Journalisation des infos de carte';
$_['entry_3d']                       = 'Activer 3D secure';
$_['entry_liability_shift']          = 'Accepter les scénarios rejetant la non-responsabilité';
$_['entry_status_success_settled']   = 'Succès - règlée';
$_['entry_status_success_unsettled'] = 'Succès - non règlée';
$_['entry_status_decline']           = 'Refusée';
$_['entry_status_decline_pending']   = 'Refusée - Authentification hors-ligne';
$_['entry_status_decline_stolen']    = 'Refusée - Carte perdue ou volée';
$_['entry_status_decline_bank']      = 'Refusée - Erreur de la banque';
$_['entry_status_void']              = 'Annulée';
$_['entry_status_rebate']            = 'Ristournée';

// Help
$_['help_total']                     = 'Le total à l\'encaissement que la commande doit atteindre avant que ce mode de paiement devienne actif.';
$_['help_card_select']               = 'Demande à l\'utilisateur de choisir son type de carte avant d\'être redirigé';
$_['help_notification']              = 'Vous devez fournir cette URL à Realex pour bénéficier des notifications de paiement';
$_['help_debug']                     = 'Activer le débuggage va écrire des données sensibles dans un fichier journal. Vous devriez toujours le désactiver sauf instructions contraires';
$_['help_liability']                 = 'Accepter la responsabilité veut dire que vous accepterez encore les paiements lorsqu\'un utilisateur échoue à 3D secure.';
$_['help_card_data_status']          = 'Enregistre dans un journal les 4 derniers chiffres de carte, la date d\'expiration, le nom, le type et la banque émettrice';

// Tab
$_['tab_api']                        = 'Détails API';
$_['tab_account']                    = 'Comptes';
$_['tab_order_status']               = 'États de commande';
$_['tab_payment']                    = 'Paramètres de paiement';

// Button
$_['button_capture']                 = 'Collecter';
$_['button_rebate']                  = 'Ristourner / Rembourser';
$_['button_void']                    = 'Annuler';

// Error
$_['error_merchant_id']              = 'ID Marchand requis !';
$_['error_secret']                   = 'Secret partagé requis !';
?>