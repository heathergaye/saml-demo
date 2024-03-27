<?php

$tenantId = getenv('SAML_AZURE_TENANT_ID');
$certPath = getenv('SAML_CERT_STORAGE_PATH');

$config = array(
    'default-sp' => array(
        'saml:SP',
        'entityID' => 'https://live-url-goes-here.samldemo.com/',
        'idp' => "https://sts.windows.net/$tenantId/",
        'privatekey' => $certPath . '/saml.pem',
        'certificate' => $certPath . '/saml.crt',
    ),
);
