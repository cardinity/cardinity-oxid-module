# Installation steps

Please follow the steps to install the Cardinity Payment Module on your shop.

## 1. Get the source
There are two ways of getting the source: downloading ZIP and cloning git repository.

### Cloning GIT repository
1. Change current directory to `_OXID_INSTALLATION_PATH_/source/modules/`
```bash
$ cd _OXID_INSTALLATION_PATH_/source/modules/
```
2. Clone the source
```bash
$ git clone git@github.com:cardinity/cardinity-oxid-module.git
```

3. Install vendors using [Composer](https://getcomposer.org)
```bash
$ cd _OXID_INSTALLATION_PATH_/source/modules/cardinity-oxid-module
$ php composer.phar install
```

### Downloading ZIP
1. Download the source as [ZIP including vendors](https://github.com/cardinity/cardinity-oxid-module/releases/download/v1.0.1/cardinity-oxid-incl-vendors.zip).
2. Create module directory   `cardinity-oxid-module` under `_OXID_INSTALLATION_PATH_/source/modules/`  
3. Extract ZIP archive and move the contents to `_OXID_INSTALLATION_PATH_/source/modules/cardinity-oxid-module`

## 2. Execute SQL code
Execute SQL from `_OXID_INSTALLATION_PATH_/source/modules/cardinity-oxid-module/Install.sql` file.  
SQL file can be imported via admin panel under `Admin -> Service -> Tools -> SQL`.


## 3. Activate the payment module
1. Login to Oxid admin area.
2. Go to `Admin -> Extensions -> Modules -> Cardinity`.
3. In the overview tab please click __"Activate"__ button to activate it.
4. Logoff from the admin area.

You may want to disable default "Credit Card" payment method which is shipped with Oxid. Do it under `Admin -> Shop Settings -> Payment Methods`.

## 4. Configure payment module
1. Login to Oxid admin area.  
2. Go to `Admin -> Shop Settings -> Cadinity Config`.
3. Enter the necessary Cardinity Parameters required by the payment module.

## 5. Clear cache
__IMPORTANT!__  
Clear `_OXID_INSTALLATION_PATH_/tmp` folder contents.
