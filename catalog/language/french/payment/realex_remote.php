<?php
// Text
$_['text_title']                       = 'Carte de Crédit / Carte de Débit';
$_['text_credit_card']                 = 'Détails carte de crédit';
$_['text_wait']                        = 'Veuillez patienter !';
$_['text_result']                      = 'Résultat';
$_['text_message']                     = 'Message';
$_['text_cvn_result']                  = 'Résultat CVN';
$_['text_avs_postcode']                = 'Code postal AVS';
$_['text_avs_address']                 = 'Adresse AVS';
$_['text_eci']                         = 'Résultat ECI (3D secure)';
$_['text_tss']                         = 'Résultat TSS';
$_['text_card_bank']                   = 'Banque d\'émission de la carte';
$_['text_card_country']                = 'Pays de la carte';
$_['text_card_region']                 = 'Région / Département de la carte';
$_['text_last_digits']                 = 'Les 4 derniers chiffres (xxxx) de la carte: ';
$_['text_order_ref']                   = 'Référence de commande';
$_['text_timestamp']                   = 'Horodatage';
$_['text_card_visa']                   = 'Visa';
$_['text_card_mc']                     = 'Mastercard';
$_['text_card_amex']                   = 'American Express';
$_['text_card_switch']                 = 'Switch';
$_['text_card_laser']                  = 'Laser';
$_['text_card_diners']                 = 'Diners';
$_['text_auth_code']                   = 'Code d\'authentification';
$_['text_3d_s1']                       = 'Détenteur non inscrit, transfert de responsabilité';
$_['text_3d_s2']                       = 'Impossible de vérifier l\'inscription, pas de transfert de responsabilité';
$_['text_3d_s3']                       = 'Réponse invalide du serveur d\'inscriptions, pas de transfert de responsabilité';
$_['text_3d_s4']                       = 'Inscrit, mais réponse invalide d\'ACS (Access Control Server), pas de transfert de responsabilité';
$_['text_3d_s5']                       = 'Authentification réussie, transfert de responsabilité';
$_['text_3d_s6']                       = 'Tentative d\'authentification reconnue, transfert de responsabilité';
$_['text_3d_s7']                       = 'Mot de passe saisi incorrect, pas de transfert de responsabilité';
$_['text_3d_s8']                       = 'Authentification non-disponible, pas de transfert de responsabilité';
$_['text_3d_s9']                       = 'Réponse invalide d\'ACS, pas de transfert de responsabilité';
$_['text_3d_s10']                      = 'Erreur fatale RealMPI, pas de transfert de responsabilité';

// Entry
$_['entry_cc_type']                    = 'Type de carte';
$_['entry_cc_number']                  = 'Numéro de la carte';
$_['entry_cc_name']                    = 'Nom du titulaire de la carte';
$_['entry_cc_expire_date']             = 'Date d\'expiration de la carte';
$_['entry_cc_cvv2']                    = 'Code de sécurité de la carte (CVV2)';
$_['entry_cc_issue']                   = 'Numéro d\'émission de la carte';

// Help
$_['help_start_date']                  = '(si disponible)';
$_['help_issue']                       = '(uniquement pour les cartes Maestro et Solo)';

// Error
$_['error_card_number']                = 'Assurez-vous que votre n° de carte soit valide !';
$_['error_card_name']                  = 'Assurez-vous que le nom du titulaire de la carte soit valide !';
$_['error_card_cvv']                   = 'Assurez-vous que le CVV2 soit valide !';
$_['error_3d_unable']                  = 'Le marchand exige 3D secure mais impossible de vérifier avec votre banque, veuillez réessayer ultérieurement.';
$_['error_3d_500_response_no_payment'] = 'Une réponse invalide a été reçue en provenance du processeur de carte, aucun paiement n\'a été effectué';
$_['error_3d_unsuccessful']            = 'Échec de l\'autorisation 3D secure';
?>