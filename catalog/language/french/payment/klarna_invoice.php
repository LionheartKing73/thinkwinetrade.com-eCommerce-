<?php
// Text
$_['text_title']          = 'Facturation Klarna - Payer en 14 jours';
$_['text_terms_fee']      = '<span id="klarna_invoice_toc"></span> (+%s)<script type="text/javascript">var terms = new Klarna.Terms.Invoice({el: \'klarna_invoice_toc\', eid: \'%s\', country: \'%s\', charge: %s});</script>';
$_['text_terms_no_fee']   = '<span id="klarna_invoice_toc"></span><script type="text/javascript">var terms = new Klarna.Terms.Invoice({el: \'klarna_invoice_toc\', eid: \'%s\', country: \'%s\'});</script>';
$_['text_additional']     = 'Facturation Klarna requiert des informations supplémentaires avant de pouvoir traiter votre commande.';
$_['text_male']           = 'Homme';
$_['text_female']         = 'Femme';
$_['text_year']           = 'Année';
$_['text_month']          = 'Mois';
$_['text_day']            = 'Jour';
$_['text_comment']        = 'N° de facture Klarna: %s. ' . "\n" . '%s/%s: %.4f';

// Entry
$_['entry_gender']        = 'Sexe';
$_['entry_pno']           = 'N° sécurité sociale';
$_['entry_dob']           = 'Date de naissance';
$_['entry_phone_no']      = 'N° téléphone';
$_['entry_street']        = 'Rue';
$_['entry_house_no']      = 'N° domicile';
$_['entry_house_ext']     = 'Ext. domicile';
$_['entry_company']       = 'N° enregistrement société';

// Help
$_['help_pno']             = 'Veuillez entrer ici votre numéro de Sécurité Sociale.';
$_['help_phone_no']        = 'Veuillez entrer votre numéro de téléphone.';
$_['help_street']          = 'Notez que la livraison ne peut s\'effectuer qu\'à l\'adresse enregistrée lors d\'un paiement avec Klarna.';
$_['help_house_no']        = 'Veuillez entrer votre numéro de domicile.';
$_['help_house_ext']       = 'Veuillez entrer ici votre extension domicile. Ex: A, B, C, Rouge, Bleu, etc...';
$_['help_company']         = 'Veuillez entrer votre numéro d\'enregistrement société';

// Error
$_['error_deu_terms']     = 'Vous devez accepter la politique de confidentialité de Klarna (Datenschutz)';
$_['error_address_match'] = 'Les adresses de livraison et de facturation doivent correspondre si vous voulez utiliser les paiements Klarna';
$_['error_network']       = 'Une erreur est survenue lors de la connexion à Klarna. Veuillez réessayer ultérieurement.';
?>