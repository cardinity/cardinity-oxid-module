# Cardinity Payment Gateway for Oxid
Cardinity Credit card payment module for your Oxid e-shop

## Deprecation notice

This repository is deprecated.

### Table of Contents  
[<b>How to install? →</b>](#how-to-install)<br>
    [Getting the source](#getting-the-source)  
    [Installation](#installation)  
 [<b>Downloads →</b>](#downloads)<br>
 [<b>Having problems? →</b>](#having-problems)<br>
 [<b>About us →</b>](#aboutus)<br>     
<a name="headers"/>  

## How to install?
Follow the steps below to install the Cardinity Payment Module on your Oxid shop.
### Getting the source
0) Get the source <b>Method 1 - Cloning GIT repository:</b>
1) Change current directory to ```_OXID_INSTALLATION_PATH_/source/modules/```
```$ cd _OXID_INSTALLATION_PATH_/source/modules/```
2) Clone the source
```$ git clone git@github.com:cardinity/cardinity-oxid-module.git```
3) Install vendors using Composer
```$ cd _OXID_INSTALLATION_PATH_/source/modules/cardinity-oxid-module```
```$ php composer.phar install```

<br>

0) Get the source <b>Method 2 - downloading zip:</b>
1) Download the source as ZIP including vendors.
2) Create module directory ```cardinity-oxid-module under _OXID_INSTALLATION_PATH_/source/modules/```
3) Extract ZIP archive and move the contents to ```_OXID_INSTALLATION_PATH_/source/modules/cardinity-oxid-module```

### Installation

1) Execute SQL from ```_OXID_INSTALLATION_PATH_/source/modules/cardinity-oxid-module/Install.sql``` file. SQL file can also be imported via admin panel under ```Admin -> Service -> Tools -> SQL```.
2) Activate the payment module
- Login to Oxid admin area.
- Go to ```Admin -> Extensions -> Modules -> Cardinity.```
- In the overview tab please click ```Activate``` button to activate it.
- Logoff from the admin area.
<i>Note: You may want to disable default "Credit Card" payment method which is shipped with Oxid. Do it under ```Admin -> Shop Settings -> Payment Methods```.</i>
3) Configure payment module
- Login to Oxid admin area.
- Go to ```Admin -> Shop Settings -> Cadinity Config```.
- Enter the necessary Cardinity Parameters required by the payment module.
4) <b>IMPORTANT!</b>Clear ```_OXID_INSTALLATION_PATH_/tmp``` folder contents.
### Downloads
Cardinity Payment Module releases for Oxid can be found here: https://github.com/cardinity/cardinity-oxid-module/releases

### Having problems?  

Feel free to contact us regarding any problems that occurred during integration via info@cardinity.com. We will be more than happy to help.

-----

### About us
Cardinity is a licensed payment institution, active in the European Union, registered on VISA Europe and MasterCard International associations to provide <b>e-commerce credit card processing services</b> for online merchants. We operate not only as a <u>payment gateway</u> but also as an <u>acquiring Bank</u>. With over 10 years of experience in providing reliable online payment services, we continue to grow and improve as a perfect payment service solution for your businesses. Cardinity is certified as PCI-DSS level 1 payment service provider and always assures a secure environment for transactions. We assure a safe and cost-effective, all-in-one online payment solution for e-commerce businesses and sole proprietorships.<br>
#### Our features
• Fast application and boarding procedure.   
• Global payments - accept payments in major currencies with credit and debit cards from customers all around the world.   
• Recurring billing for subscription or membership based sales.  
• One-click payments - let your customers purchase with a single click.   
• Mobile payments. Purchases made anywhere on any mobile device.   
• Payment gateway and free merchant account.   
• PCI DSS level 1 compliance and assured security with our enhanced protection measures.   
• Simple and transparent pricing model. Only pay per transaction and receive all the features for free.
### Get started
<a href="https://cardinity.com/sign-up">Click here</a> to sign-up and start accepting credit and debit card payments on your website or <a href="https://cardinity.com/company/contact-us">here</a> to contact us 

___

#### Keywords
payment gateway, credit card payment, online payment, credit card processing, online payment gateway, cardinity for Oxid.     

  
 [▲ back to top](#Cardinity-Payment-Gateway-for-Oxid)
<!--
**fjundzer/fjundzer** is a ✨ _special_ ✨ repository because its `README.md` (this file) appears on your GitHub profile.
