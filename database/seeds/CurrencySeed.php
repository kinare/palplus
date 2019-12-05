<?php

use Illuminate\Database\Seeder;

class CurrencySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Currency::truncate();
        \App\Currency::insert([
            ['currency' => 'United Arab Emirates Dirham', 'short_description' => 'AED', 'country' => 'United Arab Emirates Dirham', 'rate' => 0],
            ['currency' => 'Afghan Afghani', 'short_description' => 'AFN', 'country' => 'Afghan Afghani', 'rate' => 0],
            ['currency' => 'Albanian Lek', 'short_description' => 'ALL', 'country' => 'Albanian Lek', 'rate' => 0],
            ['currency' => 'Armenian Dram', 'short_description' => 'AMD', 'country' => 'Armenian Dram', 'rate' => 0],
            ['currency' => 'Netherlands Antillean Guilder', 'short_description' => 'ANG', 'country' => 'Netherlands Antillean Guilder', 'rate' => 0],
            ['currency' => 'Angolan Kwanza', 'short_description' => 'AOA', 'country' => 'Angolan Kwanza', 'rate' => 0],
            ['currency' => 'Argentine Peso', 'short_description' => 'ARS', 'country' => 'Argentine Peso', 'rate' => 0],
            ['currency' => 'Australian Dollar', 'short_description' => 'AUD', 'country' => 'Australian Dollar', 'rate' => 0],
            ['currency' => 'Aruban Florin', 'short_description' => 'AWG', 'country' => 'Aruban Florin', 'rate' => 0],
            ['currency' => 'Azerbaijani Manat', 'short_description' => 'AZN', 'country' => 'Azerbaijani Manat', 'rate' => 0],
            ['currency' => 'Bosnia-Herzegovina Convertibl', 'short_description' => 'BAM', 'country' => 'Bosnia-Herzegovina Convertibl', 'rate' => 0],
            ['currency' => 'Barbadian Dollar', 'short_description' => 'BBD', 'country' => 'Barbadian Dollar', 'rate' => 0],
            ['currency' => 'Bangladeshi Taka', 'short_description' => 'BDT', 'country' => 'Bangladeshi Taka', 'rate' => 0],
            ['currency' => 'Bulgarian Lev', 'short_description' => 'BGN', 'country' => 'Bulgarian Lev', 'rate' => 0],
            ['currency' => 'Bahraini Dinar', 'short_description' => 'BHD', 'country' => 'Bahraini Dinar', 'rate' => 0],
            ['currency' => 'Burundian Franc', 'short_description' => 'BIF', 'country' => 'Burundian Franc', 'rate' => 0],
            ['currency' => 'Bermudan Dollar', 'short_description' => 'BMD', 'country' => 'Bermudan Dollar', 'rate' => 0],
            ['currency' => 'Brunei Dollar', 'short_description' => 'BND', 'country' => 'Brunei Dollar', 'rate' => 0],
            ['currency' => 'Bolivian Boliviano', 'short_description' => 'BOB', 'country' => 'Bolivian Boliviano', 'rate' => 0],
            ['currency' => 'Brazilian Real', 'short_description' => 'BRL', 'country' => 'Brazilian Real', 'rate' => 0],
            ['currency' => 'Bahamian Dollar', 'short_description' => 'BSD', 'country' => 'Bahamian Dollar', 'rate' => 0],
            ['currency' => 'Bitcoin', 'short_description' => 'BTC', 'country' => 'Bitcoin', 'rate' => 0],
            ['currency' => 'Bhutanese Ngultrum', 'short_description' => 'BTN', 'country' => 'Bhutanese Ngultrum', 'rate' => 0],
            ['currency' => 'Botswanan Pula', 'short_description' => 'BWP', 'country' => 'Botswanan Pula', 'rate' => 0],
            ['currency' => 'Belarusian Ruble', 'short_description' => 'BYR', 'country' => 'Belarusian Ruble', 'rate' => 0],
            ['currency' => 'Belize Dollar', 'short_description' => 'BZD', 'country' => 'Belize Dollar', 'rate' => 0],
            ['currency' => 'Canadian Dollar', 'short_description' => 'CAD', 'country' => 'Canadian Dollar', 'rate' => 0],
            ['currency' => 'Congolese Franc', 'short_description' => 'CDF', 'country' => 'Congolese Franc', 'rate' => 0],
            ['currency' => 'Swiss Franc', 'short_description' => 'CHF', 'country' => 'Swiss Franc', 'rate' => 0],
            ['currency' => 'Chilean Unit of Account (UF)', 'short_description' => 'CLF', 'country' => 'Chilean Unit of Account (UF)', 'rate' => 0],
            ['currency' => 'Chilean Peso', 'short_description' => 'CLP', 'country' => 'Chilean Peso', 'rate' => 0],
            ['currency' => 'Chinese Yuan', 'short_description' => 'CNY', 'country' => 'Chinese Yuan', 'rate' => 0],
            ['currency' => 'Colombian Peso', 'short_description' => 'COP', 'country' => 'Colombian Peso', 'rate' => 0],
            ['currency' => 'Costa Rican Colón', 'short_description' => 'CRC', 'country' => 'Costa Rican Colón', 'rate' => 0],
            ['currency' => 'Cuban Convertible Peso', 'short_description' => 'CUC', 'country' => 'Cuban Convertible Peso', 'rate' => 0],
            ['currency' => 'Cuban Peso', 'short_description' => 'CUP', 'country' => 'Cuban Peso', 'rate' => 0],
            ['currency' => 'Cape Verdean Escudo', 'short_description' => 'CVE', 'country' => 'Cape Verdean Escudo', 'rate' => 0],
            ['currency' => 'Czech Republic Koruna', 'short_description' => 'CZK', 'country' => 'Czech Republic Koruna', 'rate' => 0],
            ['currency' => 'Djiboutian Franc', 'short_description' => 'DJF', 'country' => 'Djiboutian Franc', 'rate' => 0],
            ['currency' => 'Danish Krone', 'short_description' => 'DKK', 'country' => 'Danish Krone', 'rate' => 0],
            ['currency' => 'Dominican Peso', 'short_description' => 'DOP', 'country' => 'Dominican Peso', 'rate' => 0],
            ['currency' => 'Algerian Dinar', 'short_description' => 'DZD', 'country' => 'Algerian Dinar', 'rate' => 0],
            ['currency' => 'Egyptian Pound', 'short_description' => 'EGP', 'country' => 'Egyptian Pound', 'rate' => 0],
            ['currency' => 'Eritrean Nakfa', 'short_description' => 'ERN', 'country' => 'Eritrean Nakfa', 'rate' => 0],
            ['currency' => 'Ethiopian Birr', 'short_description' => 'ETB', 'country' => 'Ethiopian Birr', 'rate' => 0],
            ['currency' => 'Euro', 'short_description' => 'EUR', 'country' => 'Euro', 'rate' => 0],
            ['currency' => 'Fijian Dollar', 'short_description' => 'FJD', 'country' => 'Fijian Dollar', 'rate' => 0],
            ['currency' => 'Falkland Islands Pound', 'short_description' => 'FKP', 'country' => 'Falkland Islands Pound', 'rate' => 0],
            ['currency' => 'British Pound Sterling', 'short_description' => 'GBP', 'country' => 'British Pound Sterling', 'rate' => 0],
            ['currency' => 'Georgian Lari', 'short_description' => 'GEL', 'country' => 'Georgian Lari', 'rate' => 0],
            ['currency' => 'Guernsey Pound', 'short_description' => 'GGP', 'country' => 'Guernsey Pound', 'rate' => 0],
            ['currency' => 'Ghanaian Cedi', 'short_description' => 'GHS', 'country' => 'Ghanaian Cedi', 'rate' => 0],
            ['currency' => 'Gibraltar Pound', 'short_description' => 'GIP', 'country' => 'Gibraltar Pound', 'rate' => 0],
            ['currency' => 'Gambian Dalasi', 'short_description' => 'GMD', 'country' => 'Gambian Dalasi', 'rate' => 0],
            ['currency' => 'Guinean Franc', 'short_description' => 'GNF', 'country' => 'Guinean Franc', 'rate' => 0],
            ['currency' => 'Guatemalan Quetzal', 'short_description' => 'GTQ', 'country' => 'Guatemalan Quetzal', 'rate' => 0],
            ['currency' => 'Guyanaese Dollar', 'short_description' => 'GYD', 'country' => 'Guyanaese Dollar', 'rate' => 0],
            ['currency' => 'Hong Kong Dollar', 'short_description' => 'HKD', 'country' => 'Hong Kong Dollar', 'rate' => 0],
            ['currency' => 'Honduran Lempira', 'short_description' => 'HNL', 'country' => 'Honduran Lempira', 'rate' => 0],
            ['currency' => 'Croatian Kuna', 'short_description' => 'HRK', 'country' => 'Croatian Kuna', 'rate' => 0],
            ['currency' => 'Haitian Gourde', 'short_description' => 'HTG', 'country' => 'Haitian Gourde', 'rate' => 0],
            ['currency' => 'Hungarian Forint', 'short_description' => 'HUF', 'country' => 'Hungarian Forint', 'rate' => 0],
            ['currency' => 'Indonesian Rupiah', 'short_description' => 'IDR', 'country' => 'Indonesian Rupiah', 'rate' => 0],
            ['currency' => 'Israeli New Sheqel', 'short_description' => 'ILS', 'country' => 'Israeli New Sheqel', 'rate' => 0],
            ['currency' => 'Manx pound', 'short_description' => 'IMP', 'country' => 'Manx pound', 'rate' => 0],
            ['currency' => 'Indian Rupee', 'short_description' => 'INR', 'country' => 'Indian Rupee', 'rate' => 0],
            ['currency' => 'Iraqi Dinar', 'short_description' => 'IQD', 'country' => 'Iraqi Dinar', 'rate' => 0],
            ['currency' => 'Iranian Rial', 'short_description' => 'IRR', 'country' => 'Iranian Rial', 'rate' => 0],
            ['currency' => 'Icelandic Króna', 'short_description' => 'ISK', 'country' => 'Icelandic Króna', 'rate' => 0],
            ['currency' => 'Jersey Pound', 'short_description' => 'JEP', 'country' => 'Jersey Pound', 'rate' => 0],
            ['currency' => 'Jamaican Dollar', 'short_description' => 'JMD', 'country' => 'Jamaican Dollar', 'rate' => 0],
            ['currency' => 'Jordanian Dinar', 'short_description' => 'JOD', 'country' => 'Jordanian Dinar', 'rate' => 0],
            ['currency' => 'Japanese Yen', 'short_description' => 'JPY', 'country' => 'Japanese Yen', 'rate' => 0],
            ['currency' => 'Kenyan Shilling', 'short_description' => 'KES', 'country' => 'Kenyan Shilling', 'rate' => 0],
            ['currency' => 'Kyrgystani Som', 'short_description' => 'KGS', 'country' => 'Kyrgystani Som', 'rate' => 0],
            ['currency' => 'Cambodian Riel', 'short_description' => 'KHR', 'country' => 'Cambodian Riel', 'rate' => 0],
            ['currency' => 'Comorian Franc', 'short_description' => 'KMF', 'country' => 'Comorian Franc', 'rate' => 0],
            ['currency' => 'North Korean Won', 'short_description' => 'KPW', 'country' => 'North Korean Won', 'rate' => 0],
            ['currency' => 'South Korean Won', 'short_description' => 'KRW', 'country' => 'South Korean Won', 'rate' => 0],
            ['currency' => 'Kuwaiti Dinar', 'short_description' => 'KWD', 'country' => 'Kuwaiti Dinar', 'rate' => 0],
            ['currency' => 'Cayman Islands Dollar', 'short_description' => 'KYD', 'country' => 'Cayman Islands Dollar', 'rate' => 0],
            ['currency' => 'Kazakhstani Tenge', 'short_description' => 'KZT', 'country' => 'Kazakhstani Tenge', 'rate' => 0],
            ['currency' => 'Laotian Kip', 'short_description' => 'LAK', 'country' => 'Laotian Kip', 'rate' => 0],
            ['currency' => 'Lebanese Pound', 'short_description' => 'LBP', 'country' => 'Lebanese Pound', 'rate' => 0],
            ['currency' => 'Sri Lankan Rupee', 'short_description' => 'LKR', 'country' => 'Sri Lankan Rupee', 'rate' => 0],
            ['currency' => 'Liberian Dollar', 'short_description' => 'LRD', 'country' => 'Liberian Dollar', 'rate' => 0],
            ['currency' => 'Lesotho Loti', 'short_description' => 'LSL', 'country' => 'Lesotho Loti', 'rate' => 0],
            ['currency' => 'Lithuanian Litas', 'short_description' => 'LTL', 'country' => 'Lithuanian Litas', 'rate' => 0],
            ['currency' => 'Latvian Lats', 'short_description' => 'LVL', 'country' => 'Latvian Lats', 'rate' => 0],
            ['currency' => 'Libyan Dinar', 'short_description' => 'LYD', 'country' => 'Libyan Dinar', 'rate' => 0],
            ['currency' => 'Moroccan Dirham', 'short_description' => 'MAD', 'country' => 'Moroccan Dirham', 'rate' => 0],
            ['currency' => 'Moldovan Leu', 'short_description' => 'MDL', 'country' => 'Moldovan Leu', 'rate' => 0],
            ['currency' => 'Malagasy Ariary', 'short_description' => 'MGA', 'country' => 'Malagasy Ariary', 'rate' => 0],
            ['currency' => 'Macedonian Denar', 'short_description' => 'MKD', 'country' => 'Macedonian Denar', 'rate' => 0],
            ['currency' => 'Myanma Kyat', 'short_description' => 'MMK', 'country' => 'Myanma Kyat', 'rate' => 0],
            ['currency' => 'Mongolian Tugrik', 'short_description' => 'MNT', 'country' => 'Mongolian Tugrik', 'rate' => 0],
            ['currency' => 'Macanese Pataca', 'short_description' => 'MOP', 'country' => 'Macanese Pataca', 'rate' => 0],
            ['currency' => 'Mauritanian Ouguiya', 'short_description' => 'MRO', 'country' => 'Mauritanian Ouguiya', 'rate' => 0],
            ['currency' => 'Mauritian Rupee', 'short_description' => 'MUR', 'country' => 'Mauritian Rupee', 'rate' => 0],
            ['currency' => 'Maldivian Rufiyaa', 'short_description' => 'MVR', 'country' => 'Maldivian Rufiyaa', 'rate' => 0],
            ['currency' => 'Malawian Kwacha', 'short_description' => 'MWK', 'country' => 'Malawian Kwacha', 'rate' => 0],
            ['currency' => 'Mexican Peso', 'short_description' => 'MXN', 'country' => 'Mexican Peso', 'rate' => 0],
            ['currency' => 'Malaysian Ringgit', 'short_description' => 'MYR', 'country' => 'Malaysian Ringgit', 'rate' => 0],
            ['currency' => 'Mozambican Metical', 'short_description' => 'MZN', 'country' => 'Mozambican Metical', 'rate' => 0],
            ['currency' => 'Namibian Dollar', 'short_description' => 'NAD', 'country' => 'Namibian Dollar', 'rate' => 0],
            ['currency' => 'Nigerian Naira', 'short_description' => 'NGN', 'country' => 'Nigerian Naira', 'rate' => 0],
            ['currency' => 'Nicaraguan Córdoba', 'short_description' => 'NIO', 'country' => 'Nicaraguan Córdoba', 'rate' => 0],
            ['currency' => 'Norwegian Krone', 'short_description' => 'NOK', 'country' => 'Norwegian Krone', 'rate' => 0],
            ['currency' => 'Nepalese Rupee', 'short_description' => 'NPR', 'country' => 'Nepalese Rupee', 'rate' => 0],
            ['currency' => 'New Zealand Dollar', 'short_description' => 'NZD', 'country' => 'New Zealand Dollar', 'rate' => 0],
            ['currency' => 'Omani Rial', 'short_description' => 'OMR', 'country' => 'Omani Rial', 'rate' => 0],
            ['currency' => 'Panamanian Balboa', 'short_description' => 'PAB', 'country' => 'Panamanian Balboa', 'rate' => 0],
            ['currency' => 'Peruvian Nuevo Sol', 'short_description' => 'PEN', 'country' => 'Peruvian Nuevo Sol', 'rate' => 0],
            ['currency' => 'Papua New Guinean Kina', 'short_description' => 'PGK', 'country' => 'Papua New Guinean Kina', 'rate' => 0],
            ['currency' => 'Philippine Peso', 'short_description' => 'PHP', 'country' => 'Philippine Peso', 'rate' => 0],
            ['currency' => 'Pakistani Rupee', 'short_description' => 'PKR', 'country' => 'Pakistani Rupee', 'rate' => 0],
            ['currency' => 'Polish Zloty', 'short_description' => 'PLN', 'country' => 'Polish Zloty', 'rate' => 0],
            ['currency' => 'Paraguayan Guarani', 'short_description' => 'PYG', 'country' => 'Paraguayan Guarani', 'rate' => 0],
            ['currency' => 'Qatari Rial', 'short_description' => 'QAR', 'country' => 'Qatari Rial', 'rate' => 0],
            ['currency' => 'Romanian Leu', 'short_description' => 'RON', 'country' => 'Romanian Leu', 'rate' => 0],
            ['currency' => 'Serbian Dinar', 'short_description' => 'RSD', 'country' => 'Serbian Dinar', 'rate' => 0],
            ['currency' => 'Russian Ruble', 'short_description' => 'RUB', 'country' => 'Russian Ruble', 'rate' => 0],
            ['currency' => 'Rwandan Franc', 'short_description' => 'RWF', 'country' => 'Rwandan Franc', 'rate' => 0],
            ['currency' => 'Saudi Riyal', 'short_description' => 'SAR', 'country' => 'Saudi Riyal', 'rate' => 0],
            ['currency' => 'Solomon Islands Dollar', 'short_description' => 'SBD', 'country' => 'Solomon Islands Dollar', 'rate' => 0],
            ['currency' => 'Seychellois Rupee', 'short_description' => 'SCR', 'country' => 'Seychellois Rupee', 'rate' => 0],
            ['currency' => 'Sudanese Pound', 'short_description' => 'SDG', 'country' => 'Sudanese Pound', 'rate' => 0],
            ['currency' => 'Swedish Krona', 'short_description' => 'SEK', 'country' => 'Swedish Krona', 'rate' => 0],
            ['currency' => 'Singapore Dollar', 'short_description' => 'SGD', 'country' => 'Singapore Dollar', 'rate' => 0],
            ['currency' => 'Saint Helena Pound', 'short_description' => 'SHP', 'country' => 'Saint Helena Pound', 'rate' => 0],
            ['currency' => 'Sierra Leonean Leone', 'short_description' => 'SLL', 'country' => 'Sierra Leonean Leone', 'rate' => 0],
            ['currency' => 'Somali Shilling', 'short_description' => 'SOS', 'country' => 'Somali Shilling', 'rate' => 0],
            ['currency' => 'Surinamese Dollar', 'short_description' => 'SRD', 'country' => 'Surinamese Dollar', 'rate' => 0],
            ['currency' => 'São Tomé and Príncipe Dobra', 'short_description' => 'STD', 'country' => 'São Tomé and Príncipe Dobra', 'rate' => 0],
            ['currency' => 'Salvadoran Colón', 'short_description' => 'SVC', 'country' => 'Salvadoran Colón', 'rate' => 0],
            ['currency' => 'Syrian Pound', 'short_description' => 'SYP', 'country' => 'Syrian Pound', 'rate' => 0],
            ['currency' => 'Swazi Lilangeni', 'short_description' => 'SZL', 'country' => 'Swazi Lilangeni', 'rate' => 0],
            ['currency' => 'Thai Baht', 'short_description' => 'THB', 'country' => 'Thai Baht', 'rate' => 0],
            ['currency' => 'Tajikistani Somoni', 'short_description' => 'TJS', 'country' => 'Tajikistani Somoni', 'rate' => 0],
            ['currency' => 'Turkmenistani Manat', 'short_description' => 'TMT', 'country' => 'Turkmenistani Manat', 'rate' => 0],
            ['currency' => 'Tunisian Dinar', 'short_description' => 'TND', 'country' => 'Tunisian Dinar', 'rate' => 0],
            ['currency' => 'Tongan Paʻanga', 'short_description' => 'TOP', 'country' => 'Tongan Paʻanga', 'rate' => 0],
            ['currency' => 'Turkish Lira', 'short_description' => 'TRY', 'country' => 'Turkish Lira', 'rate' => 0],
            ['currency' => 'Trinidad and Tobago Dollar', 'short_description' => 'TTD', 'country' => 'Trinidad and Tobago Dollar', 'rate' => 0],
            ['currency' => 'New Taiwan Dollar', 'short_description' => 'TWD', 'country' => 'New Taiwan Dollar', 'rate' => 0],
            ['currency' => 'Tanzanian Shilling', 'short_description' => 'TZS', 'country' => 'Tanzanian Shilling', 'rate' => 0],
            ['currency' => 'Ukrainian Hryvnia', 'short_description' => 'UAH', 'country' => 'Ukrainian Hryvnia', 'rate' => 0],
            ['currency' => 'Ugandan Shilling', 'short_description' => 'UGX', 'country' => 'Ugandan Shilling', 'rate' => 0],
            ['currency' => 'United States Dollar', 'short_description' => 'USD', 'country' => 'United States Dollar', 'rate' => 0],
            ['currency' => 'Uruguayan Peso', 'short_description' => 'UYU', 'country' => 'Uruguayan Peso', 'rate' => 0],
            ['currency' => 'Uzbekistan Som', 'short_description' => 'UZS', 'country' => 'Uzbekistan Som', 'rate' => 0],
            ['currency' => 'Venezuelan Bolívar Fuerte', 'short_description' => 'VEF', 'country' => 'Venezuelan Bolívar Fuerte', 'rate' => 0],
            ['currency' => 'Vietnamese Dong', 'short_description' => 'VND', 'country' => 'Vietnamese Dong', 'rate' => 0],
            ['currency' => 'Vanuatu Vatu', 'short_description' => 'VUV', 'country' => 'Vanuatu Vatu', 'rate' => 0],
            ['currency' => 'Samoan Tala', 'short_description' => 'WST', 'country' => 'Samoan Tala', 'rate' => 0],
            ['currency' => 'CFA Franc BEAC', 'short_description' => 'XAF', 'country' => 'CFA Franc BEAC', 'rate' => 0],
            ['currency' => 'Silver (troy ounce)', 'short_description' => 'XAG', 'country' => 'Silver (troy ounce)', 'rate' => 0],
            ['currency' => 'Gold (troy ounce)', 'short_description' => 'XAU', 'country' => 'Gold (troy ounce)', 'rate' => 0],
            ['currency' => 'East Caribbean Dollar', 'short_description' => 'XCD', 'country' => 'East Caribbean Dollar', 'rate' => 0],
            ['currency' => 'Special Drawing Rights', 'short_description' => 'XDR', 'country' => 'Special Drawing Rights', 'rate' => 0],
            ['currency' => 'CFA Franc BCEAO', 'short_description' => 'XOF', 'country' => 'CFA Franc BCEAO', 'rate' => 0],
            ['currency' => 'CFP Franc', 'short_description' => 'XPF', 'country' => 'CFP Franc', 'rate' => 0],
            ['currency' => 'Yemeni Rial', 'short_description' => 'YER', 'country' => 'Yemeni Rial', 'rate' => 0],
            ['currency' => 'South African Rand', 'short_description' => 'ZAR', 'country' => 'South African Rand', 'rate' => 0],
            ['currency' => 'Zambian Kwacha (pre-2013)', 'short_description' => 'ZMK', 'country' => 'Zambian Kwacha (pre-2013)', 'rate' => 0],
            ['currency' => 'Zambian Kwacha', 'short_description' => 'ZMW', 'country' => 'Zambian Kwacha', 'rate' => 0],
            ['currency' => 'Zimbabwean Dollar', 'short_description' => 'ZWL', 'country' => 'Zimbabwean Dollar', 'rate' => 0]
        ]);
    }
}
