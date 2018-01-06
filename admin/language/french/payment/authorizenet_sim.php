<?php
// Heading
$_['heading_title']         = 'Authorize.Net (SIM)';

// Text
$_['text_payment']          = 'Paiement';
$_['text_success']          = 'Succès: Vous avez modifié les détails de paiement par Authorize.Net (SIM) !';
$_['text_edit']             = 'Modifier le paiement par Authorize.Net (SIM)';
$_['text_authorizenet_sim'] = '<a onclick="window.open(\'http://reseller.authorize.net/application/?id=5561142\');"><img src="view/image/payment/authorizenet.png" alt="Authorize.Net" title="Authorize.Net" style="border: 1px solid #EEEEEE;" /></a>';

// Entry
$_['entry_merchant']        = 'ID Marchand';
$_['entry_key']             = 'Clé de transaction';
$_['entry_callback']        = 'URL de réponse du relai';
$_['entry_md5']             = 'Valeur du hachage MD5';
$_['entry_test']            = 'Mode test';
$_['entry_total']           = 'Total';
$_['entry_order_status']    = 'État de commande';
$_['entry_geo_zone']        = 'Zone géographique';
$_['entry_status']          = 'Statut';
$_['entry_sort_order']      = 'Classement';

// Help
$_['help_callback']         = 'Veuillez vous connecter au site <a href="https://secure.authorize.net" target="_blank" class="txtLink">https://secure.authorize.net</a> et entrer les ajustements nécessaires.';
$_['help_md5']              = 'Le hachage MD5 vous permet d\'authentifier qu\'une réponse de transaction soit reçue en toute sécurité depuis from Authorize.Net. Veuillez vous connecter à <a href="https://secure.authorize.net" target="_blank" class="txtLink">https://secure.authorize.net</a> et le positionner (facultatif).';
$_['help_total']            = 'Le total à l\'encaissement que la commande doit atteindre avant que ce mode de paiement devienne actif.';

// Error
$_['error_permission']      = 'Attention: Vous n\'avez pas les droits nécessaires pour modifier le paiement par Authorize.Net (SIM)!';
$_['error_merchant']        = 'ID Marchand requis !';
$_['error_key']             = 'Clé de transaction requise !';
?>