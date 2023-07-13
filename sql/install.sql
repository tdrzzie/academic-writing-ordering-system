CREATE TABLE IF NOT EXISTS `#__aclevels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(80) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `#__aclevels` (`id`, `level`, `amount`) VALUES
	(1, 'High School', 1.00),
	(2, 'College', 2.00),
	(3, 'Undergraduate', 3.00),
	(4, 'Master', 4.00),
	(5, 'PhD', 5.00);



CREATE TABLE IF NOT EXISTS `#__country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nicename` varchar(80) NOT NULL,
  `country_iso2` char(2) NOT NULL,
  `country_iso3` char(3) NOT NULL,
  `currency_iso3` char(3) NOT NULL,
  `currency_country_name` varchar(80) NOT NULL,
  `currency_name` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=latin1;


INSERT INTO `#__country` (`id`, `nicename`, `country_iso2`, `country_iso3`, `currency_iso3`, `currency_country_name`, `currency_name`) VALUES
	(1, 'Afghanistan', 'AF', 'AFG', 'AFN', 'AFGHANISTAN', 'Afghani'),
	(2, 'Albania', 'AL', 'ALB', 'ALL', 'ALBANIA', 'Lek'),
	(3, 'Algeria', 'DZ', 'DZA', 'DZD', 'ALGERIA', 'Algerian Dinar'),
	(4, 'American Samoa', 'AS', 'ASM', 'USD', 'AMERICAN SAMOA', 'US Dollar'),
	(5, 'Andorra', 'AD', 'AND', 'EUR', 'ANDORRA', 'Euro'),
	(6, 'Angola', 'AO', 'AGO', 'AOA', 'ANGOLA', 'Kwanza'),
	(7, 'Anguilla', 'AI', 'AIA', 'XCD', 'ANGUILLA', 'East Caribbean Dollar'),
	(8, 'Antarctica', 'AQ', 'ATA', 'non', 'ANTARCTICA', 'No universal currency'),
	(9, 'Antigua and Barbuda', 'AG', 'ATG', 'XCD', 'ANTIGUA AND BARBUDA', 'East Caribbean Dollar'),
	(10, 'Argentina', 'AR', 'ARG', 'ARS', 'ARGENTINA', 'Argentine Peso'),
	(11, 'Armenia', 'AM', 'ARM', 'AMD', 'ARMENIA', 'Armenian Dram'),
	(12, 'Aruba', 'AW', 'ABW', 'AWG', 'ARUBA', 'Aruban Florin'),
	(13, 'Australia', 'AU', 'AUS', 'AUD', 'AUSTRALIA', 'Australian Dollar'),
	(14, 'Austria', 'AT', 'AUT', 'EUR', 'AUSTRIA', 'Euro'),
	(15, 'Azerbaijan', 'AZ', 'AZE', 'AZN', 'AZERBAIJAN', 'Azerbaijanian Manat'),
	(16, 'Bahamas', 'BS', 'BHS', 'BSD', 'BAHAMAS', 'Bahamian Dollar'),
	(17, 'Bahrain', 'BH', 'BHR', 'BHD', 'BAHRAIN', 'Bahraini Dinar'),
	(18, 'Bangladesh', 'BD', 'BGD', 'BDT', 'BANGLADESH', 'Taka'),
	(19, 'Barbados', 'BB', 'BRB', 'BBD', 'BARBADOS', 'Barbados Dollar'),
	(20, 'Belarus', 'BY', 'BLR', 'BYR', 'BELARUS', 'Belarussian Ruble'),
	(21, 'Belgium', 'BE', 'BEL', 'EUR', 'BELGIUM', 'Euro'),
	(22, 'Belize', 'BZ', 'BLZ', 'BZD', 'BELIZE', 'Belize Dollar'),
	(23, 'Benin', 'BJ', 'BEN', 'XOF', 'BENIN', 'CFA Franc BCEAO'),
	(24, 'Bermuda', 'BM', 'BMU', 'BMD', 'BERMUDA', 'Bermudian Dollar'),
	(25, 'Bhutan', 'BT', 'BTN', 'INR', 'BHUTAN', 'Indian Rupee'),
	(26, 'Bolivia - Plurinational State of', 'BO', 'BOL', 'BOB', 'BOLIVIA - PLURINATIONAL STATE OF', 'Boliviano'),
	(27, 'Bonaire - Sint Eustatius and Saba', 'BQ', 'BES', 'USD', 'BONAIRE - SINT EUSTATIUS AND SABA', 'US Dollar'),
	(28, 'Bosnia and Herzegovina', 'BA', 'BIH', 'BAM', 'BOSNIA AND HERZEGOVINA', 'Convertible Mark'),
	(29, 'Botswana', 'BW', 'BWA', 'BWP', 'BOTSWANA', 'Pula'),
	(30, 'Bouvet Island', 'BV', 'BVT', 'NOK', 'BOUVET ISLAND', 'Norwegian Krone'),
	(31, 'Brazil', 'BR', 'BRA', 'BRL', 'BRAZIL', 'Brazilian Real'),
	(32, 'British Indian Ocean Territory', 'IO', 'IOT', 'USD', 'BRITISH INDIAN OCEAN TERRITORY', 'US Dollar'),
	(33, 'Brunei Darussalam', 'BN', 'BRN', 'BND', 'BRUNEI DARUSSALAM', 'Brunei Dollar'),
	(34, 'Bulgaria', 'BG', 'BGR', 'BGN', 'BULGARIA', 'Bulgarian Lev'),
	(35, 'Burkina Faso', 'BF', 'BFA', 'XOF', 'BURKINA FASO', 'CFA Franc BCEAO'),
	(36, 'Burundi', 'BI', 'BDI', 'BIF', 'BURUNDI', 'Burundi Franc'),
	(37, 'Cambodia', 'KH', 'KHM', 'KHR', 'CAMBODIA', 'Riel'),
	(38, 'Cameroon', 'CM', 'CMR', 'XAF', 'CAMEROON', 'CFA Franc BEAC'),
	(39, 'Canada', 'CA', 'CAN', 'CAD', 'CANADA', 'Canadian Dollar'),
	(40, 'Cape Verde', 'CV', 'CPV', 'CVE', 'CABO VERDE', 'Cabo Verde Escudo'),
	(41, 'Cayman Islands', 'KY', 'CYM', 'KYD', 'CAYMAN ISLANDS', 'Cayman Islands Dollar'),
	(42, 'Central African Republic', 'CF', 'CAF', 'XAF', 'CENTRAL AFRICAN REPUBLIC', 'CFA Franc BEAC'),
	(43, 'Chad', 'TD', 'TCD', 'XAF', 'CHAD', 'CFA Franc BEAC'),
	(44, 'Chile', 'CL', 'CHL', 'CLP', 'CHILE', 'Chilean Peso'),
	(45, 'China', 'CN', 'CHN', 'CNY', 'CHINA', 'Yuan Renminbi'),
	(46, 'Christmas Island', 'CX', 'CXR', 'AUD', 'CHRISTMAS ISLAND', 'Australian Dollar'),
	(47, 'Cocos (Keeling) Islands', 'CC', 'CCK', 'AUD', 'COCOS (KEELING) ISLANDS', 'Australian Dollar'),
	(48, 'Colombia', 'CO', 'COL', 'COP', 'COLOMBIA', 'Colombian Peso'),
	(49, 'Comoros', 'KM', 'COM', 'KMF', 'COMOROS', 'Comoro Franc'),
	(50, 'Congo', 'CG', 'COG', 'XAF', 'CONGO', 'CFA Franc BEAC'),
	(51, 'Congo-the Democratic Republic of the', 'CD', 'COD', 'non', 'none', 'none'),
	(52, 'Cook Islands', 'CK', 'COK', 'NZD', 'COOK ISLANDS', 'New Zealand Dollar'),
	(53, 'Costa Rica', 'CR', 'CRI', 'CRC', 'COSTA RICA', 'Costa Rican Colon'),
	(54, 'Croatia', 'HR', 'HRV', 'HRK', 'CROATIA', 'Croatian Kuna'),
	(55, 'Cuba', 'CU', 'CUB', 'CUP', 'CUBA', 'Cuban Peso'),
	(56, 'CuraÃ§ao', 'CW', 'CUW', 'ANG', 'CURAÃ‡AO', 'Netherlands Antillean Guilder'),
	(57, 'Cyprus', 'CY', 'CYP', 'EUR', 'CYPRUS', 'Euro'),
	(58, 'Czech Republic', 'CZ', 'CZE', 'CZK', 'CZECH REPUBLIC', 'Czech Koruna'),
	(59, 'CÃ´te dIvoire', 'CI', 'CIV', 'XOF', 'CÃ"TE DIVOIRE', 'CFA Franc BCEAO'),
	(60, 'Denmark', 'DK', 'DNK', 'DKK', 'DENMARK', 'Danish Krone'),
	(61, 'Djibouti', 'DJ', 'DJI', 'DJF', 'DJIBOUTI', 'Djibouti Franc'),
	(62, 'Dominica', 'DM', 'DMA', 'XCD', 'DOMINICA', 'East Caribbean Dollar'),
	(63, 'Dominican Republic', 'DO', 'DOM', 'DOP', 'DOMINICAN REPUBLIC', 'Dominican Peso'),
	(64, 'Ecuador', 'EC', 'ECU', 'USD', 'ECUADOR', 'US Dollar'),
	(65, 'Egypt', 'EG', 'EGY', 'EGP', 'EGYPT', 'Egyptian Pound'),
	(66, 'El Salvador', 'SV', 'SLV', 'USD', 'EL SALVADOR', 'US Dollar'),
	(67, 'Equatorial Guinea', 'GQ', 'GNQ', 'XAF', 'EQUATORIAL GUINEA', 'CFA Franc BEAC'),
	(68, 'Eritrea', 'ER', 'ERI', 'ERN', 'ERITREA', 'Nakfa'),
	(69, 'Estonia', 'EE', 'EST', 'EUR', 'ESTONIA', 'Euro'),
	(70, 'Ethiopia', 'ET', 'ETH', 'ETB', 'ETHIOPIA', 'Ethiopian Birr'),
	(71, 'Falkland Islands (Malvinas)', 'FK', 'FLK', 'FKP', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands Pound'),
	(72, 'Faroe Islands', 'FO', 'FRO', 'DKK', 'FAROE ISLANDS', 'Danish Krone'),
	(73, 'Fiji', 'FJ', 'FJI', 'FJD', 'FIJI', 'Fiji Dollar'),
	(74, 'Finland', 'FI', 'FIN', 'EUR', 'FINLAND', 'Euro'),
	(75, 'France', 'FR', 'FRA', 'EUR', 'FRANCE', 'Euro'),
	(76, 'French Guiana', 'GF', 'GUF', 'EUR', 'FRENCH GUIANA', 'Euro'),
	(77, 'French Polynesia', 'PF', 'PYF', 'XPF', 'FRENCH POLYNESIA', 'CFP Franc'),
	(78, 'French Southern Territories', 'TF', 'ATF', 'EUR', 'FRENCH SOUTHERN TERRITORIES', 'Euro'),
	(79, 'Gabon', 'GA', 'GAB', 'XAF', 'GABON', 'CFA Franc BEAC'),
	(80, 'Gambia', 'GM', 'GMB', 'GMD', 'GAMBIA', 'Dalasi'),
	(81, 'Georgia', 'GE', 'GEO', 'GEL', 'GEORGIA', 'Lari'),
	(82, 'Germany', 'DE', 'DEU', 'EUR', 'GERMANY', 'Euro'),
	(83, 'Ghana', 'GH', 'GHA', 'GHS', 'GHANA', 'Ghana Cedi'),
	(84, 'Gibraltar', 'GI', 'GIB', 'GIP', 'GIBRALTAR', 'Gibraltar Pound'),
	(85, 'Greece', 'GR', 'GRC', 'EUR', 'GREECE', 'Euro'),
	(86, 'Greenland', 'GL', 'GRL', 'DKK', 'GREENLAND', 'Danish Krone'),
	(87, 'Grenada', 'GD', 'GRD', 'XCD', 'GRENADA', 'East Caribbean Dollar'),
	(88, 'Guadeloupe', 'GP', 'GLP', 'EUR', 'GUADELOUPE', 'Euro'),
	(89, 'Guam', 'GU', 'GUM', 'USD', 'GUAM', 'US Dollar'),
	(90, 'Guatemala', 'GT', 'GTM', 'GTQ', 'GUATEMALA', 'Quetzal'),
	(91, 'Guernsey', 'GG', 'GGY', 'GBP', 'GUERNSEY', 'Pound Sterling'),
	(92, 'Guinea', 'GN', 'GIN', 'GNF', 'GUINEA', 'Guinea Franc'),
	(93, 'Guinea-Bissau', 'GW', 'GNB', 'XOF', 'GUINEA-BISSAU', 'CFA Franc BCEAO'),
	(94, 'Guyana', 'GY', 'GUY', 'GYD', 'GUYANA', 'Guyana Dollar'),
	(95, 'Haiti', 'HT', 'HTI', 'USD', 'HAITI', 'US Dollar'),
	(96, 'Heard Island and McDonald Islands', 'HM', 'HMD', 'AUD', 'HEARD ISLAND AND McDONALD ISLANDS', 'Australian Dollar'),
	(97, 'Holy See (Vatican City State)', 'VA', 'VAT', 'EUR', 'HOLY SEE (VATICAN CITY STATE)', 'Euro'),
	(98, 'Honduras', 'HN', 'HND', 'HNL', 'HONDURAS', 'Lempira'),
	(99, 'Hong Kong', 'HK', 'HKG', 'HKD', 'HONG KONG', 'Hong Kong Dollar'),
	(100, 'Hungary', 'HU', 'HUN', 'HUF', 'HUNGARY', 'Forint'),
	(101, 'Iceland', 'IS', 'ISL', 'ISK', 'ICELAND', 'Iceland Krona'),
	(102, 'India', 'IN', 'IND', 'INR', 'INDIA', 'Indian Rupee'),
	(103, 'Indonesia', 'ID', 'IDN', 'IDR', 'INDONESIA', 'Rupiah'),
	(104, 'Iran - Islamic Republic of', 'IR', 'IRN', 'IRR', 'IRAN - ISLAMIC REPUBLIC OF', 'Iranian Rial'),
	(105, 'Iraq', 'IQ', 'IRQ', 'IQD', 'IRAQ', 'Iraqi Dinar'),
	(106, 'Ireland', 'IE', 'IRL', 'EUR', 'IRELAND', 'Euro'),
	(107, 'Isle of Man', 'IM', 'IMN', 'GBP', 'ISLE OF MAN', 'Pound Sterling'),
	(108, 'Israel', 'IL', 'ISR', 'ILS', 'ISRAEL', 'New Israeli Sheqel'),
	(109, 'Italy', 'IT', 'ITA', 'EUR', 'ITALY', 'Euro'),
	(110, 'Jamaica', 'JM', 'JAM', 'JMD', 'JAMAICA', 'Jamaican Dollar'),
	(111, 'Japan', 'JP', 'JPN', 'JPY', 'JAPAN', 'Yen'),
	(112, 'Jersey', 'JE', 'JEY', 'GBP', 'JERSEY', 'Pound Sterling'),
	(113, 'Jordan', 'JO', 'JOR', 'JOD', 'JORDAN', 'Jordanian Dinar'),
	(114, 'Kazakhstan', 'KZ', 'KAZ', 'KZT', 'KAZAKHSTAN', 'Tenge'),
	(115, 'Kenya', 'KE', 'KEN', 'KES', 'KENYA', 'Kenyan Shilling'),
	(116, 'Kiribati', 'KI', 'KIR', 'AUD', 'KIRIBATI', 'Australian Dollar'),
	(117, 'Korea - Democratic Peoples Republic of', 'KP', 'PRK', 'KPW', 'KOREA - DEMOCRATIC PEOPLES REPUBLIC OF', 'North Korean Won'),
	(118, 'Korea - Republic of', 'KR', 'KOR', 'KRW', 'KOREA - REPUBLIC OF', 'Won'),
	(119, 'Kuwait', 'KW', 'KWT', 'KWD', 'KUWAIT', 'Kuwaiti Dinar'),
	(120, 'Kyrgyzstan', 'KG', 'KGZ', 'KGS', 'KYRGYZSTAN', 'Som'),
	(121, 'Lao Peoples Democratic Republic', 'LA', 'LAO', 'LAK', 'LAO PEOPLES DEMOCRATIC REPUBLIC', 'Kip'),
	(122, 'Latvia', 'LV', 'LVA', 'EUR', 'LATVIA', 'Euro'),
	(123, 'Lebanon', 'LB', 'LBN', 'LBP', 'LEBANON', 'Lebanese Pound'),
	(124, 'Lesotho', 'LS', 'LSO', 'ZAR', 'LESOTHO', 'Rand'),
	(125, 'Liberia', 'LR', 'LBR', 'LRD', 'LIBERIA', 'Liberian Dollar'),
	(126, 'Libya', 'LY', 'LBY', 'LYD', 'LIBYA', 'Libyan Dinar'),
	(127, 'Liechtenstein', 'LI', 'LIE', 'CHF', 'LIECHTENSTEIN', 'Swiss Franc'),
	(128, 'Lithuania', 'LT', 'LTU', 'EUR', 'LITHUANIA', 'Euro'),
	(129, 'Luxembourg', 'LU', 'LUX', 'EUR', 'LUXEMBOURG', 'Euro'),
	(130, 'Macao', 'MO', 'MAC', 'MOP', 'MACAO', 'Pataca'),
	(131, 'Macedonia - the Former Yugoslav Republic of', 'MK', 'MKD', 'MKD', 'MACEDONIA - THE FORMER YUGOSLAV REPUBLIC OF', 'Denar'),
	(132, 'Madagascar', 'MG', 'MDG', 'MGA', 'MADAGASCAR', 'Malagasy Ariary'),
	(133, 'Malawi', 'MW', 'MWI', 'MWK', 'MALAWI', 'Kwacha'),
	(134, 'Malaysia', 'MY', 'MYS', 'MYR', 'MALAYSIA', 'Malaysian Ringgit'),
	(135, 'Maldives', 'MV', 'MDV', 'MVR', 'MALDIVES', 'Rufiyaa'),
	(136, 'Mali', 'ML', 'MLI', 'XOF', 'MALI', 'CFA Franc BCEAO'),
	(137, 'Malta', 'MT', 'MLT', 'EUR', 'MALTA', 'Euro'),
	(138, 'Marshall Islands', 'MH', 'MHL', 'USD', 'MARSHALL ISLANDS', 'US Dollar'),
	(139, 'Martinique', 'MQ', 'MTQ', 'EUR', 'MARTINIQUE', 'Euro'),
	(140, 'Mauritania', 'MR', 'MRT', 'MRO', 'MAURITANIA', 'Ouguiya'),
	(141, 'Mauritius', 'MU', 'MUS', 'MUR', 'MAURITIUS', 'Mauritius Rupee'),
	(142, 'Mayotte', 'YT', 'MYT', 'EUR', 'MAYOTTE', 'Euro'),
	(143, 'Mexico', 'MX', 'MEX', 'MXN', 'MEXICO', 'Mexican Peso'),
	(144, 'Micronesia - Federated States of', 'FM', 'FSM', 'USD', 'MICRONESIA - FEDERATED STATES OF', 'US Dollar'),
	(145, 'Moldova - Republic of', 'MD', 'MDA', 'MDL', 'MOLDOVA - REPUBLIC OF', 'Moldovan Leu'),
	(146, 'Monaco', 'MC', 'MCO', 'EUR', 'MONACO', 'Euro'),
	(147, 'Mongolia', 'MN', 'MNG', 'MNT', 'MONGOLIA', 'Tugrik'),
	(148, 'Montenegro', 'ME', 'MNE', 'EUR', 'MONTENEGRO', 'Euro'),
	(149, 'Montserrat', 'MS', 'MSR', 'XCD', 'MONTSERRAT', 'East Caribbean Dollar'),
	(150, 'Morocco', 'MA', 'MAR', 'MAD', 'MOROCCO', 'Moroccan Dirham'),
	(151, 'Mozambique', 'MZ', 'MOZ', 'MZN', 'MOZAMBIQUE', 'Mozambique Metical'),
	(152, 'Myanmar', 'MM', 'MMR', 'MMK', 'MYANMAR', 'Kyat'),
	(153, 'Namibia', 'NA', 'NAM', 'ZAR', 'NAMIBIA', 'Rand'),
	(154, 'Nauru', 'NR', 'NRU', 'AUD', 'NAURU', 'Australian Dollar'),
	(155, 'Nepal', 'NP', 'NPL', 'NPR', 'NEPAL', 'Nepalese Rupee'),
	(156, 'Netherlands', 'NL', 'NLD', 'EUR', 'NETHERLANDS', 'Euro'),
	(157, 'New Caledonia', 'NC', 'NCL', 'XPF', 'NEW CALEDONIA', 'CFP Franc'),
	(158, 'New Zealand', 'NZ', 'NZL', 'NZD', 'NEW ZEALAND', 'New Zealand Dollar'),
	(159, 'Nicaragua', 'NI', 'NIC', 'NIO', 'NICARAGUA', 'Cordoba Oro'),
	(160, 'Niger', 'NE', 'NER', 'XOF', 'NIGER', 'CFA Franc BCEAO'),
	(161, 'Nigeria', 'NG', 'NGA', 'NGN', 'NIGERIA', 'Naira'),
	(162, 'Niue', 'NU', 'NIU', 'NZD', 'NIUE', 'New Zealand Dollar'),
	(163, 'Norfolk Island', 'NF', 'NFK', 'AUD', 'NORFOLK ISLAND', 'Australian Dollar'),
	(164, 'Northern Mariana Islands', 'MP', 'MNP', 'USD', 'NORTHERN MARIANA ISLANDS', 'US Dollar'),
	(165, 'Norway', 'NO', 'NOR', 'NOK', 'NORWAY', 'Norwegian Krone'),
	(166, 'Oman', 'OM', 'OMN', 'OMR', 'OMAN', 'Rial Omani'),
	(167, 'Pakistan', 'PK', 'PAK', 'PKR', 'PAKISTAN', 'Pakistan Rupee'),
	(168, 'Palau', 'PW', 'PLW', 'USD', 'PALAU', 'US Dollar'),
	(169, 'Palestine - State of', 'PS', 'PSE', 'non', 'PALESTINE - STATE OF', 'No universal currency'),
	(170, 'Panama', 'PA', 'PAN', 'USD', 'PANAMA', 'US Dollar'),
	(171, 'Papua New Guinea', 'PG', 'PNG', 'PGK', 'PAPUA NEW GUINEA', 'Kina'),
	(172, 'Paraguay', 'PY', 'PRY', 'PYG', 'PARAGUAY', 'Guarani'),
	(173, 'Peru', 'PE', 'PER', 'PEN', 'PERU', 'Nuevo Sol'),
	(174, 'Philippines', 'PH', 'PHL', 'PHP', 'PHILIPPINES', 'Philippine Peso'),
	(175, 'Pitcairn', 'PN', 'PCN', 'NZD', 'PITCAIRN', 'New Zealand Dollar'),
	(176, 'Poland', 'PL', 'POL', 'PLN', 'POLAND', 'Zloty'),
	(177, 'Portugal', 'PT', 'PRT', 'EUR', 'PORTUGAL', 'Euro'),
	(178, 'Puerto Rico', 'PR', 'PRI', 'USD', 'PUERTO RICO', 'US Dollar'),
	(179, 'Qatar', 'QA', 'QAT', 'QAR', 'QATAR', 'Qatari Rial'),
	(180, 'Romania', 'RO', 'ROU', 'RON', 'ROMANIA', 'New Romanian Leu'),
	(181, 'Russian Federation', 'RU', 'RUS', 'RUB', 'RUSSIAN FEDERATION', 'Russian Ruble'),
	(182, 'Rwanda', 'RW', 'RWA', 'RWF', 'RWANDA', 'Rwanda Franc'),
	(183, 'RÃ©union', 'RE', 'REU', 'EUR', 'RÃ‰UNION', 'Euro'),
	(184, 'Saint BarthÃ©lemy', 'BL', 'BLM', 'EUR', 'SAINT BARTHÃ‰LEMY', 'Euro'),
	(185, 'Saint Helena - Ascension and Tristan da Cunha', 'SH', 'SHN', 'SHP', 'SAINT HELENA - ASCENSION AND TRISTAN DA CUNHA', 'Saint Helena Pound'),
	(186, 'Saint Kitts and Nevis', 'KN', 'KNA', 'XCD', 'SAINT KITTS AND NEVIS', 'East Caribbean Dollar'),
	(187, 'Saint Lucia', 'LC', 'LCA', 'XCD', 'SAINT LUCIA', 'East Caribbean Dollar'),
	(188, 'Saint Martin (French part)', 'MF', 'MAF', 'EUR', 'SAINT MARTIN (FRENCH PART)', 'Euro'),
	(189, 'Saint Pierre and Miquelon', 'PM', 'SPM', 'EUR', 'SAINT PIERRE AND MIQUELON', 'Euro'),
	(190, 'Saint Vincent and the Grenadines', 'VC', 'VCT', 'XCD', 'SAINT VINCENT AND THE GRENADINES', 'East Caribbean Dollar'),
	(191, 'Samoa', 'WS', 'WSM', 'WST', 'SAMOA', 'Tala'),
	(192, 'San Marino', 'SM', 'SMR', 'EUR', 'SAN MARINO', 'Euro'),
	(193, 'Sao Tome and Principe', 'ST', 'STP', 'STD', 'SAO TOME AND PRINCIPE', 'Dobra'),
	(194, 'Saudi Arabia', 'SA', 'SAU', 'SAR', 'SAUDI ARABIA', 'Saudi Riyal'),
	(195, 'Senegal', 'SN', 'SEN', 'XOF', 'SENEGAL', 'CFA Franc BCEAO'),
	(196, 'Serbia', 'RS', 'SRB', 'RSD', 'SERBIA', 'Serbian Dinar'),
	(197, 'Seychelles', 'SC', 'SYC', 'SCR', 'SEYCHELLES', 'Seychelles Rupee'),
	(198, 'Sierra Leone', 'SL', 'SLE', 'SLL', 'SIERRA LEONE', 'Leone'),
	(199, 'Singapore', 'SG', 'SGP', 'SGD', 'SINGAPORE', 'Singapore Dollar'),
	(200, 'Sint Maarten (Dutch part)', 'SX', 'SXM', 'ANG', 'SINT MAARTEN (DUTCH PART)', 'Netherlands Antillean Guilder'),
	(201, 'Slovakia', 'SK', 'SVK', 'EUR', 'SLOVAKIA', 'Euro'),
	(202, 'Slovenia', 'SI', 'SVN', 'EUR', 'SLOVENIA', 'Euro'),
	(203, 'Solomon Islands', 'SB', 'SLB', 'SBD', 'SOLOMON ISLANDS', 'Solomon Islands Dollar'),
	(204, 'Somalia', 'SO', 'SOM', 'SOS', 'SOMALIA', 'Somali Shilling'),
	(205, 'South Africa', 'ZA', 'ZAF', 'ZAR', 'SOUTH AFRICA', 'Rand'),
	(206, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', 'non', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'No universal currency'),
	(207, 'South Sudan', 'SS', 'SSD', 'SSP', 'SOUTH SUDAN', 'South Sudanese Pound'),
	(208, 'Spain', 'ES', 'ESP', 'EUR', 'SPAIN', 'Euro'),
	(209, 'Sri Lanka', 'LK', 'LKA', 'LKR', 'SRI LANKA', 'Sri Lanka Rupee'),
	(210, 'Sudan', 'SD', 'SDN', 'SDG', 'SUDAN', 'Sudanese Pound'),
	(211, 'Suriname', 'SR', 'SUR', 'SRD', 'SURINAME', 'Surinam Dollar'),
	(212, 'Svalbard and Jan Mayen', 'SJ', 'SJM', 'NOK', 'SVALBARD AND JAN MAYEN', 'Norwegian Krone'),
	(213, 'Swaziland', 'SZ', 'SWZ', 'SZL', 'SWAZILAND', 'Lilangeni'),
	(214, 'Sweden', 'SE', 'SWE', 'SEK', 'SWEDEN', 'Swedish Krona'),
	(215, 'Switzerland', 'CH', 'CHE', 'CHF', 'SWITZERLAND', 'Swiss Franc'),
	(216, 'Syrian Arab Republic', 'SY', 'SYR', 'SYP', 'SYRIAN ARAB REPUBLIC', 'Syrian Pound'),
	(217, 'Taiwan - Province of China', 'TW', 'TWN', 'TWD', 'TAIWAN - PROVINCE OF CHINA', 'New Taiwan Dollar'),
	(218, 'Tajikistan', 'TJ', 'TJK', 'TJS', 'TAJIKISTAN', 'Somoni'),
	(219, 'Tanzania - United Republic of', 'TZ', 'TZA', 'TZS', 'TANZANIA - UNITED REPUBLIC OF', 'Tanzanian Shilling'),
	(220, 'Thailand', 'TH', 'THA', 'THB', 'THAILAND', 'Baht'),
	(221, 'Timor-Leste', 'TL', 'TLS', 'USD', 'TIMOR-LESTE', 'US Dollar'),
	(222, 'Togo', 'TG', 'TGO', 'XOF', 'TOGO', 'CFA Franc BCEAO'),
	(223, 'Tokelau', 'TK', 'TKL', 'NZD', 'TOKELAU', 'New Zealand Dollar'),
	(224, 'Tonga', 'TO', 'TON', 'TOP', 'TONGA', 'Paanga'),
	(225, 'Trinidad and Tobago', 'TT', 'TTO', 'TTD', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago Dollar'),
	(226, 'Tunisia', 'TN', 'TUN', 'TND', 'TUNISIA', 'Tunisian Dinar'),
	(227, 'Turkey', 'TR', 'TUR', 'TRY', 'TURKEY', 'Turkish Lira'),
	(228, 'Turkmenistan', 'TM', 'TKM', 'TMT', 'TURKMENISTAN', 'Turkmenistan New Manat'),
	(229, 'Turks and Caicos Islands', 'TC', 'TCA', 'USD', 'TURKS AND CAICOS ISLANDS', 'US Dollar'),
	(230, 'Tuvalu', 'TV', 'TUV', 'AUD', 'TUVALU', 'Australian Dollar'),
	(231, 'Uganda', 'UG', 'UGA', 'UGX', 'UGANDA', 'Uganda Shilling'),
	(232, 'Ukraine', 'UA', 'UKR', 'UAH', 'UKRAINE', 'Hryvnia'),
	(233, 'United Arab Emirates', 'AE', 'ARE', 'AED', 'UNITED ARAB EMIRATES', 'UAE Dirham'),
	(234, 'United Kingdom', 'GB', 'GBR', 'GBP', 'UNITED KINGDOM', 'Pound Sterling'),
	(235, 'United States', 'US', 'USA', 'USD', 'UNITED STATES', 'US Dollar'),
	(236, 'United States Minor Outlying Islands', 'UM', 'UMI', 'USD', 'UNITED STATES MINOR OUTLYING ISLANDS', 'US Dollar'),
	(237, 'Uruguay', 'UY', 'URY', 'UYU', 'URUGUAY', 'Peso Uruguayo'),
	(238, 'Uzbekistan', 'UZ', 'UZB', 'UZS', 'UZBEKISTAN', 'Uzbekistan Sum'),
	(239, 'Vanuatu', 'VU', 'VUT', 'VUV', 'VANUATU', 'Vatu'),
	(240, 'Venezuela -  Bolivarian Republic of', 'VE', 'VEN', 'VEF', 'VENEZUELA - BOLIVARIAN REPUBLIC OF', 'Bolivar'),
	(241, 'Viet Nam', 'VN', 'VNM', 'VND', 'VIET NAM', 'Dong'),
	(242, 'Virgin Islands - British', 'VG', 'VGB', 'USD', 'VIRGIN ISLANDS (BRITISH)', 'US Dollar'),
	(243, 'Virgin Islands - U.S.', 'VI', 'VIR', 'USD', 'VIRGIN ISLANDS (U.S.)', 'US Dollar'),
	(244, 'Wallis and Futuna', 'WF', 'WLF', 'XPF', 'WALLIS AND FUTUNA', 'CFP Franc'),
	(245, 'Western Sahara', 'EH', 'ESH', 'MAD', 'WESTERN SAHARA', 'Moroccan Dirham'),
	(246, 'Yemen', 'YE', 'YEM', 'YER', 'YEMEN', 'Yemeni Rial'),
	(247, 'Zambia', 'ZM', 'ZMB', 'ZMW', 'ZAMBIA', 'Zambian Kwacha'),
	(248, 'Zimbabwe', 'ZW', 'ZWE', 'ZWL', 'ZIMBABWE', 'Zimbabwe Dollar'),
	(249, 'Ã…land Islands', 'AX', 'ALA', 'EUR', 'Ã…LAND ISLANDS', 'Euro');



CREATE TABLE IF NOT EXISTS `#__doctypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(80) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

INSERT INTO `#__doctypes` (`id`, `type`, `amount`) VALUES
	(1, 'Essay', 1.00),
	(2, 'Term Paper', 1.00),
	(3, 'Research Paper', 1.00),
	(4, 'Coursework', 1.00),
	(5, 'Book Report', 1.00),
	(6, 'Book Review', 1.00),
	(7, 'Movie Review', 1.00),
	(8, 'Dissertation', 1.00),
	(9, 'Thesis', 1.00),
	(10, 'Thesis Proposal', 1.00),
	(11, 'Research Proposal', 1.00),
	(12, 'Dissertation Chapter - Abstract', 1.00),
	(13, 'Dissertation Chapter - Introduction Chapter', 1.00),
	(14, 'Dissertation Chapter - Literature Review', 1.00),
	(15, 'Dissertation Chapter - Methodology', 1.00),
	(16, 'Dissertation Chapter - Results', 1.00),
	(17, 'Dissertation Chapter - Discussion', 1.00),
	(18, 'Dissertation Services - Editing', 1.00),
	(19, 'Dissertation Services - Proofreading', 1.00),
	(20, 'Formatting', 1.00),
	(21, 'Admission Services - Admission Essay', 1.00),
	(22, 'Admission Services - Scholarship Essay', 1.00),
	(23, 'Admission Services - Personal Statement', 1.00),
	(24, 'Admission Services - Editing', 1.00),
	(25, 'Editing', 1.00),
	(26, 'Proofreading', 1.00),
	(27, 'Case Study', 1.00),
	(28, 'Lab Report', 1.00),
	(29, 'Speech Presentation', 1.00),
	(30, 'Math Problem', 1.00),
	(31, 'Article', 1.00),
	(32, 'Article Critique', 1.00),
	(33, 'Annotated Bibliography', 1.00),
	(34, 'Reaction Paper', 1.00),
	(35, 'PowerPoint Presentation', 1.00),
	(36, 'Statistics Project', 1.00),
	(37, 'Multiple Choice Questions (None-Time-Framed)', 1.00),
	(38, 'Other (Not listed)', 1.00);

CREATE TABLE IF NOT EXISTS `#__subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(80) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;


INSERT INTO `#__subjects` (`id`, `subject`, `amount`) VALUES
	(1, 'Art', 2.00),
	(2, '&nbsp;&nbsp;Architecture', 2.00),
	(3, '&nbsp;&nbsp;Dance', 2.00),
	(4, '&nbsp;&nbsp;Design Analysis', 2.00),
	(5, '&nbsp;&nbsp;Drama', 2.00),
	(6, '&nbsp;&nbsp;Movies', 2.00),
	(7, '&nbsp;&nbsp;Music', 2.00),
	(8, '&nbsp;&nbsp;Paintings', 2.00),
	(9, '&nbsp;&nbsp;Theatre', 2.00),
	(10, 'Biology', 2.00),
	(11, 'Business', 2.00),
	(12, 'Chemistry', 2.00),
	(13, 'Communications and Media', 2.00),
	(14, '&nbsp;&nbsp;Advertising', 2.00),
	(15, '&nbsp;&nbsp;Communication Strategies', 2.00),
	(16, '&nbsp;&nbsp;Journalism', 2.00),
	(17, '&nbsp;&nbsp;Public Relations', 2.00),
	(18, 'Creative writing', 2.00),
	(19, 'Economics', 2.00),
	(20, '&nbsp;&nbsp;Accounting', 2.00),
	(21, '&nbsp;&nbsp;Case Study', 2.00),
	(22, '&nbsp;&nbsp;Company Analysis', 2.00),
	(23, '&nbsp;&nbsp;E-Commerce', 2.00),
	(24, '&nbsp;&nbsp;Finance', 2.00),
	(25, '&nbsp;&nbsp;Investment', 2.00),
	(26, '&nbsp;&nbsp;Logistics', 2.00),
	(27, '&nbsp;&nbsp;Trade', 2.00),
	(28, 'Education', 2.00),
	(29, '&nbsp;&nbsp;Application Essay', 2.00),
	(30, '&nbsp;&nbsp;Education Theories', 2.00),
	(31, '&nbsp;&nbsp;Pedagogy', 2.00),
	(32, '&nbsp;&nbsp;Teacher\'s Career', 2.00),
	(33, 'Engineering', 2.00),
	(34, 'English', 2.00),
	(35, 'Ethics', 2.00),
	(36, 'History', 2.00),
	(37, '&nbsp;&nbsp;African-American Studies', 2.00),
	(38, '&nbsp;&nbsp;American History', 2.00),
	(39, '&nbsp;&nbsp;Asian Studies', 2.00),
	(40, '&nbsp;&nbsp;Canadian Studies', 2.00),
	(41, '&nbsp;&nbsp;East European Studies', 2.00),
	(42, '&nbsp;&nbsp;Holocaust', 2.00),
	(43, '&nbsp;&nbsp;Latin-American Studies', 2.00),
	(44, '&nbsp;&nbsp;Native-American Studies', 2.00),
	(45, '&nbsp;&nbsp;West European Studies', 2.00),
	(46, 'Law', 2.00),
	(47, '&nbsp;&nbsp;Criminology', 2.00),
	(48, '&nbsp;&nbsp;Legal Issues', 2.00),
	(49, 'Linguistics', 2.00),
	(50, 'Literature', 2.00),
	(51, '&nbsp;&nbsp;American Literature', 2.00),
	(52, '&nbsp;&nbsp;Antique Literature', 2.00),
	(53, '&nbsp;&nbsp;Asian Literature', 2.00),
	(54, '&nbsp;&nbsp;English Literature', 2.00),
	(55, '&nbsp;&nbsp;Shakespeare Studies', 2.00),
	(56, 'Management', 2.00),
	(57, 'Marketing', 2.00),
	(58, 'Mathematics', 2.00),
	(59, 'Medicine and Health', 2.00),
	(60, '&nbsp;&nbsp;Alternative Medicine', 2.00),
	(61, '&nbsp;&nbsp;Healthcare', 2.00),
	(62, '&nbsp;&nbsp;Nursing', 2.00),
	(63, '&nbsp;&nbsp;Nutrition', 2.00),
	(64, '&nbsp;&nbsp;Pharmacology', 2.00),
	(65, '&nbsp;&nbsp;Sport', 2.00),
	(66, 'Nature', 2.00),
	(67, '&nbsp;&nbsp;Agricultural Studies', 2.00),
	(68, '&nbsp;&nbsp;Anthropology', 2.00),
	(69, '&nbsp;&nbsp;Astronomy', 2.00),
	(70, '&nbsp;&nbsp;Environmental Issues', 2.00),
	(71, '&nbsp;&nbsp;Geography', 2.00),
	(72, '&nbsp;&nbsp;Geology', 2.00),
	(73, 'Philosophy', 2.00),
	(74, 'Physics', 2.00),
	(75, 'Political Science', 2.00),
	(76, 'Psychology', 2.00),
	(77, 'Religion and Theology', 2.00),
	(78, 'Sociology', 2.00),
	(79, 'Technology', 2.00),
	(80, '&nbsp;&nbsp;Aeronautics', 2.00),
	(81, '&nbsp;&nbsp;Aviation', 2.00),
	(82, '&nbsp;&nbsp;Computer Science', 2.00),
	(83, '&nbsp;&nbsp;Internet', 2.00),
	(84, '&nbsp;&nbsp;IT Management', 2.00),
	(85, '&nbsp;&nbsp;Web Design', 2.00),
	(86, 'Tourism', 2.00);

CREATE TABLE IF NOT EXISTS `#__urgency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` int(11) NOT NULL,
  `marker` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `#__urgency` (`id`, `time`, `marker`, `amount`) VALUES
	(1, 8, 'hours', 0.30),
	(2, 24, 'hours', 1.00),
	(3, 48, 'hours', 2.00),
	(4, 3, 'days', 3.00),
	(5, 5, 'days', 5.00),
	(6, 7, 'days', 7.00),
	(7, 14, 'days', 14.00);


CREATE TABLE IF NOT EXISTS `#__coupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) DEFAULT NULL,
  `instructions` mediumtext,
  `code` varchar(50) NOT NULL,
  `min_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` varchar(50) NOT NULL DEFAULT 'ACTIVE',
  `dateadded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

