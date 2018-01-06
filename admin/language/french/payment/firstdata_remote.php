<?php
// Heading
$_['heading_title']                  = 'First Data EMEA Web Service API';

// Text
$_['text_firstdata_remote']          = '<img src="view/image/payment/firstdata.png" alt="First Data" title="First Data" style="border: 1px solid #EEEEEE;" />';
$_['text_payment']                   = 'Paiement';
$_['text_success']                   = 'Succès: Vous avez modifié les détails de paiement par First Data !';
$_['text_edit']                      = 'Modifier le paiement par First Data EMEA Web Service API';
$_['text_card_type']                 = 'Type de carte';
$_['text_enabled']                   = 'Activé';
$_['text_merchant_id']               = 'ID Boutique';
$_['text_subaccount']                = 'Sous-compte';
$_['text_user_id']                   = 'ID Utilisateur';
$_['text_capture_ok']                = 'Succès de la collecte';
$_['text_capture_ok_order']          = 'Succès de la collecte, état de commande mis à jour sur “succès - règlée”';
$_['text_refund_ok']                 = 'Succès du remboursement';
$_['text_refund_ok_order']           = 'Succès du remboursement, état de commande mis à jour sur “remboursée”';
$_['text_void_ok']                   = 'Succès de l\'annulation, état de commande mis à jour sur “annulée”';
$_['text_settle_auto']               = 'Solde';
$_['text_settle_delayed']            = 'Pré-authentification';
$_['text_mastercard']                = 'Mastercard';
$_['text_visa']                      = 'Visa';
$_['text_diners']                    = 'Diners';
$_['text_amex']                      = 'American Express';
$_['text_maestro']                   = 'Maestro';
$_['text_payment_info']              = 'Informations de paiement';
$_['text_capture_status']            = 'Paiement collecté';
$_['text_void_status']               = 'Paiement annulé';
$_['text_refund_status']             = 'Paiement remboursé';
$_['text_order_ref']                 = 'Réf. commande';
$_['text_order_total']               = 'Total autorisé';
$_['text_total_captured']            = 'Total collecté';
$_['text_transactions']              = 'Transactions';
$_['text_column_amount']             = 'Montant';
$_['text_column_type']               = 'Type';
$_['text_column_date_added']         = 'Créé le';
$_['text_confirm_void']              = 'Êtes-vous sûr(e) de vouloir annuler le paiement ?';
$_['text_confirm_capture']           = 'Êtes-vous sûr(e) de vouloir collecter le paiement ?';
$_['text_confirm_refund']            = 'Êtes-vous sûr(e) de vouloir rembourser le paiement ?';

// Entry
$_['entry_certificate_path']         = 'Chemin vers le certificat';
$_['entry_certificate_key_path']     = 'Chemin vers la clé privée';
$_['entry_certificate_key_pw']       = 'Mot de passe clé privée';
$_['entry_certificate_ca_path']      = 'Chemin CA (Certificate Authority)';
$_['entry_merchant_id']              = 'ID de boutique';
$_['entry_user_id']                  = 'ID Utilisateur';
$_['entry_password']                 = 'Mot de passe';
$_['entry_total']                    = 'Total';
$_['entry_sort_order']               = 'Classement';
$_['entry_geo_zone']                 = 'Zone géographique';
$_['entry_status']                   = 'Statut';
$_['entry_debug']                    = 'Journalisation de débuggage';
$_['entry_auto_settle']              = 'Type de règlement';
$_['entry_status_success_settled']   = 'Succès - règlée';
$_['entry_status_success_unsettled'] = 'Succès - non règlée';
$_['entry_status_decline']           = 'Refusée';
$_['entry_status_void']              = 'Annulée';
$_['entry_status_refund']            = 'Remboursée';
$_['entry_enable_card_store']        = 'Activer le stockage des jetons de carte';
$_['entry_cards_accepted']           = 'Cartes acceptées';

// Help
$_['help_total']                     = 'Le total à l\'encaissement que la commande doit atteindre avant que ce mode de paiement devienne actif.';
$_['help_certificate']               = 'Les certificats et clés privéees devraient être stockés en dehors de vos dossiers web publiques';
$_['help_card_select']               = 'Demande à l\'utilisateur de choisir son type de carte avant d\'être redirigé';
$_['help_notification']              = 'Vous devez fournir cette URL à First Data pour bénéficier des notifications de paiement';
$_['help_debug']                     = 'Activer le débuggage va écrire des données sensibles dans un fichier journal. Vous devriez toujours le désactiver sauf instructions contraires';
$_['help_settle']                    = 'Si vous utilisez la pré-authentification, vous devez terminer une action de post-authentification dans les 3-5 jours sinon votre transaction sera abandonnée';

// Tab
$_['tab_account']                    = 'Infos API';
$_['tab_order_status']               = 'États de commande';
$_['tab_payment']                    = 'Paramètres de paiement';

// Button
$_['button_capture']                 = 'Collecter';
$_['button_refund']                  = 'Rembourser';
$_['button_void']                    = 'Annuler';

// Error
$_['error_merchant_id']              = 'ID de boutique requis !';
$_['error_user_id']                  = 'ID d\'utilisateur requis !';
$_['error_password']                 = 'Mot de passe requis !';
$_['error_certificate']              = 'Chemin du certificat requis !';
$_['error_key']                      = 'Clé du certificat requise !';
$_['error_key_pw']                   = 'Mot de passe clé du certificat requis !';
$_['error_ca']                       = 'Certificate Authority (CA) requis !';
?>