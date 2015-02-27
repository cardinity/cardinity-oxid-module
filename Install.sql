INSERT INTO `oxpayments` (`OXID`, `OXACTIVE`, `OXDESC`, `OXADDSUM`, `OXADDSUMTYPE`, `OXADDSUMRULES`, `OXFROMBONI`, `OXFROMAMOUNT`, `OXTOAMOUNT`, `OXVALDESC`, `OXCHECKED`, `OXDESC_1`, `OXVALDESC_1`, `OXDESC_2`, `OXVALDESC_2`, `OXDESC_3`, `OXVALDESC_3`, `OXLONGDESC`, `OXLONGDESC_1`, `OXLONGDESC_2`, `OXLONGDESC_3`, `OXSORT`, `OXTSPAYMENTID`, `OXTIMESTAMP`) VALUES
('cardinity', 1, 'Cardinity', 0, 'abs', 15, 0, 0, 99999, 'ccnumber__@@ccname__@@ccyear__@@ccmonth__@@ccpruef__@@', 0, '', '', '', '', '', '', '', '', '', '', 0, '', '2015-02-26 07:34:14');

ALTER TABLE  `oxorder` ADD `cardinity_status` TEXT NOT NULL;
ALTER TABLE  `oxorder` ADD `cardinity_payment_type` TEXT NOT NULL;
ALTER TABLE  `oxorder` ADD `cardinity_id` TEXT NOT NULL;
ALTER TABLE  `oxorder` ADD `cardinity_response` TEXT NOT NULL;
ALTER TABLE  `oxorder` ADD `cardinity_refund_response` TEXT NOT NULL;
ALTER TABLE  `oxorder` ADD `cardinity_refund_date` DATETIME NOT NULL
