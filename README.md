# SAML DEMO PROJECT

This project is a demo of SAML authentication using the SimpleSAMLphp library.
It is customised to work on Ironstar hosting, and in a Lando local environment.

For running on a different host, you will need to configure the vendor/simplesamlphp folder to make it publicly accessible.
This will require changes to the nginx/apache configuration, and you may need to adjust the root folder in the response URL.

## Azure configuration
Your Azure admin requires the following information:
* Entity ID - Best practice is to use the domain.
* Response URL - This is of the format https://your-saml-domain.com/simplesaml/module.php/saml/sp/saml2-acs.php/default-sp
  Change the domain, leave the rest of the path as is.

The Azure admin will need to supply you with the following:
* Azure tenant ID. This is a UUID that identifies the Azure account.
* X509 Certificate public key. This is used to sign the SAML request.

## Non-Drupal files.

### .lando.local.yml
Update the environment variables. The same variables must be set on the Ironstar environment.
- SAML_AZURE_TENANT_ID - as supplied by the Azure admin.
- SAML_X509_CERTIFICATE - as supplied by the Azure admin.
- SIMPLESAMLPHP_CONFIG_DIR - the absolute path to the saml folder in this project.

Request SAML_AZURE_TENANT_ID and SAML_X509_CERTIFICATE from the Azure admin responsible for configuring SSO.

### ./saml/ - all contents.
Library that executes the SAML request.
The most up-to-date version of this library may be downloaded from https://simplesamlphp.org/download/.

Customised files and required changes:
* ./saml/config/authsources.php - Change the entityID value to your own domain, same as you supplied to the Azure admin.
* ./saml/config/config.php - This file was copied from the template config, then customisations were added
  to the bottom of the file. Inspect these and change as required.
* ./saml/metadata-config/saml20-idp-remote.php - No changes necessary, but don't overwrite it. If you need to change
  anything, it'll most likely be one of the assignments at the top of the file.
* ./saml/cert/saml.crt and ./saml/cert/saml.pem - Replace these demo files. Per documentation at https://simplesamlphp.org/docs/stable/simplesamlphp-sp#section_1_1,
  use the following command:
  ```openssl req -newkey rsa:3072 -new -x509 -days 3652 -nodes -out saml.crt -keyout saml.pem```

### ./.ironstar/nginx-location.conf
Configures vendor/simplesamlphp folder on Ironstar hosting to permit php methods to be run.
This should just work, but if you have any problems, check that the absolute path to the saml folder is correct.

### ./.lando/nginx-override.conf
Configures vendor/simplesamlphp and saml folders, and permits testing via Lando.
Note: when I first set this up, I couldn't see a way to configure just the location directive (per the Ironstar config)
so copied the entire nginx config file and add the location directive to the end of it. Keep this in mind if you
update the lando configuration; you may need to replace the file and re-append the location directive.

## Drupal configuration

Your microsoft account username and email address must be correctly mapped to Drupal user fields, and incoming fields
might be different across different Azure setups. There may also be additional custom fields that you can map.
Test and troubleshoot the data coming in from Azure after you've successfully logged in, and configure saml settings via
the Drupal admin UI.

## Testing

You can test locally by running Lando using the live domain.
Update lando.local.yml to add the domain as a valid URL, and add the domain to /etc/hosts.

Your Microsoft account permissions will need access to the Azure SSO app before you can test.
If you get an error such as the following, contact the Azure admin to grant access to your account:
```
Your administrator has configured the application {{name}} to block users
unless they are specifically granted ('assigned') access to the application
```

