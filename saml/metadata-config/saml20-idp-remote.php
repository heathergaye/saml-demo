<?php

$tenantId = getenv('SAML_AZURE_TENANT_ID');
$entityId = "https://sts.windows.net/$tenantId/";
$location = "https://login.microsoftonline.com/$tenantId/saml2";

/**
 * SAML 2.0 remote IdP metadata for SimpleSAMLphp.
 *
 * Remember to remove the IdPs you don't use from this file.
 *
 * See: https://simplesamlphp.org/docs/stable/simplesamlphp-reference-idp-remote
 */

$metadata[$entityId] = array (
  'entityid' => $entityId,
  'contacts' =>
    array (
    ),
  'metadata-set' => 'saml20-idp-remote',
  'SingleSignOnService' =>
    array (
      0 =>
        array (
          'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
          'Location' => $location,
        ),
      1 =>
        array (
          'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
          'Location' => $location,
        ),
    ),
  'SingleLogoutService' =>
    array (
      0 =>
        array (
          'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
          'Location' => $location,
        ),
    ),
  'ArtifactResolutionService' =>
    array (
    ),
  'NameIDFormats' =>
    array (
    ),
  'keys' =>
    array (
      0 =>
        array (
          'encryption' => false,
          'signing' => true,
          'type' => 'X509Certificate',
          'X509Certificate' => getenv('SAML_X509_CERTIFICATE'),
        ),
    ),
);
