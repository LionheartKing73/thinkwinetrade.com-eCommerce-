<?php
// Text
$_['text_title']              = 'Carte de Crédit / Carte de Débit';
$_['text_credit_card']        = 'Détails carte de crédit';
$_['text_wait']               = 'Veuillez patienter !';

// Entry
$_['entry_cc_number']         = 'Numéro de la carte';
$_['entry_cc_name']           = 'Nom du détenteur de la carte';
$_['entry_cc_expire_date']    = 'Date d\'expiration de la carte';
$_['entry_cc_cvv2']           = 'Code de sécurité de la carte (CVV2)';

// Help
$_['help_start_date']         = '(si disponible)';
$_['help_issue']              = '(uniquement pour les cartes Maestro et Solo)';

// Text
$_['text_result']             = 'Résultat: ';
$_['text_approval_code']      = 'Code d\'approbation: ';
$_['text_reference_number']   = 'Référence: ';
$_['text_card_number_ref']    = 'Les 4 derniers chiffres (xxxx) de la carte: ';
$_['text_card_brand']         = 'Marque de la carte: ';
$_['text_response_code']      = 'Code de réponse: ';
$_['text_fault']              = 'Message de défaut: ';
$_['text_error']              = 'Message d\'erreur: ';
$_['text_avs']                = 'Vérification de l\'adresse: ';
$_['text_address_ppx']        = 'Aucune donnée d\'adresse fournie ou adresse non-vérifiée par l\'émetteur de la carte';
$_['text_address_yyy']        = 'L\'émetteur de la carte a confirmé que l\'adresse et le code postal correspondent à leur enregistrements';
$_['text_address_yna']        = 'L\'émetteur de la carte a confirmé que l\'adresse correspond à leur enregistrements mais pas le code postal';
$_['text_address_nyz']        = 'L\'émetteur de la carte a confirmé que le code postal correspond à leur enregistrements mais pas l\'adresse';
$_['text_address_nnn']        = 'Ni l\'adresse ni le code postal ne correspondent aux enregistrements de l\'émetteur de la carte';
$_['text_address_ypx']        = 'L\'émetteur de la carte a confirmé que l\'adresse correspond à leur enregistrements. L\'émetteur n\'a pas vérifié le code postal';
$_['text_address_pyx']        = 'L\'émetteur de la carte a confirmé que le code postal correspond à leur enregistrements. L\'émetteur n\'a pas vérifié l\'adresse';
$_['text_address_xxu']        = 'L\'émetteur de la carte n\'a pas vérifié les informations AVS';
$_['text_card_code_verify']   = 'Code de sécurité: ';
$_['text_card_code_m']        = 'Le code de sécurité de la carte correspond';
$_['text_card_code_n']        = 'Le code de sécurité de la carte ne correspond pas';
$_['text_card_code_p']        = 'Non traité';
$_['text_card_code_s']        = 'Le marchand a indiqué que le code de sécurité de la carte n\'est pas présent sur la carte';
$_['text_card_code_u']        = 'L\'émetteur n\'est pas certifié et / ou n\'a pas fourni de clés de cryptage';
$_['text_card_code_x']        = 'Aucune réponse reçue de la part de l\'association des cartes de crédit';
$_['text_card_code_blank']    = 'Une réponse blanche devrait indiquer qu\'aucun code n\'a été envoyé et qu\'il n\'y avait aucune preuve que le code soit présent sur la carte.';
$_['text_card_accepted']      = 'Cartes acceptées: ';
$_['text_card_type_m']        = 'Mastercard';
$_['text_card_type_v']        = 'Visa (Credit/Debit/Electron/Delta)';
$_['text_card_type_c']        = 'Diners';
$_['text_card_type_a']        = 'American Express';
$_['text_card_type_ma']       = 'Maestro';
$_['text_card_new']           = 'Nouvelle carte';
$_['text_response_proc_code'] = 'Code processeur: ';
$_['text_response_ref']       = 'N° de référence: ';

// Error
$_['error_card_number']       = 'Assurez-vous que votre n° de carte soit valide !';
$_['error_card_name']         = 'Assurez-vous que le nom du titulaire de la carte soit valide !';
$_['error_card_cvv']          = 'Assurez-vous que le CVV2 soit valide !';
$_['error_failed']            = 'Impossible de traiter votre paiement, veuillez contacter le marchand';
?>