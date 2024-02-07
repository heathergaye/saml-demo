<?php

$tenantId = getenv('SAML_AZURE_TENANT_ID');

$config = array(
    'default-sp' => array(
        'saml:SP',
        'entityID' => 'https://live-url-goes-here.samldemo.com/',
        'idp' => "https://sts.windows.net/$tenantId/",
        'privatekey' => 'saml.pem',
        'certificate' => 'saml.crt',
    ),
);
