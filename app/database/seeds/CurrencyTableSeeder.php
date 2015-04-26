<?php

class CurrencyTableSeeder extends Seeder {

    public function run() {
        
        Currency::create(array('symbol'  => '$',   'iso_currency' => 'ARS', 'iso_country' => 'ar', 'country' => 'Argentina'));
        
        Currency::create(array('symbol'  => 'Bs',  'iso_currency' => 'BOB', 'iso_country' => 'bo', 'country' => 'Bolivia'));
        
        Currency::create(array('symbol'  => 'R$',  'iso_currency' => 'BRL', 'iso_country' => 'br', 'country' => 'Brasil'));
        
        Currency::create(array('symbol'  => '$',   'iso_currency' => 'BZD', 'iso_country' => 'bz', 'country' => 'Belice'));
        
        Currency::create(array('symbol'  => 'C$',  'iso_currency' => 'CAD', 'iso_country' => 'ca', 'country' => 'Canada'));
        
        Currency::create(array('symbol'  => '$',   'iso_currency' => 'CLP', 'iso_country' => 'cl', 'country' => 'Chile'));
        
        Currency::create(array('symbol'  => '$',   'iso_currency' => 'COP', 'iso_country' => 'co', 'country' => 'Colombia'));
        
        Currency::create(array('symbol'  => '₡',   'iso_currency' => 'CRC', 'iso_country' => 'cr', 'country' => 'Costa Rica'));
        
        Currency::create(array('symbol'  => '$',   'iso_currency' => 'CUC', 'iso_country' => 'cu', 'country' => 'Cuba'));
        
        Currency::create(array('symbol'  => 'S/.', 'iso_currency' => 'ECS', 'iso_country' => 'ec', 'country' => 'Ecuador'));
        
        Currency::create(array('symbol'  => '¢',   'iso_currency' => 'SVC', 'iso_country' => 'sv', 'country' => 'El Salvador'));
        
        Currency::create(array('symbol'  => '$',   'iso_currency' => 'USD', 'iso_country' => 'us', 'country' => 'Estados Unidos de América'));
        
        Currency::create(array('symbol'  => 'Q',   'iso_currency' => 'GTQ', 'iso_country' => 'gt', 'country' => 'Guatemala'));
        
        Currency::create(array('symbol'  => 'L',   'iso_currency' => 'HNL', 'iso_country' => 'hn', 'country' => 'Honduras'));
        
        Currency::create(array('symbol'  => 'G',   'iso_currency' => 'HTG', 'iso_country' => 'ht', 'country' => 'Haití'));
        
        Currency::create(array('symbol'  => '$',   'iso_currency' => 'JMD', 'iso_country' => 'jm', 'country' => 'Jamaica'));
        
        Currency::create(array('symbol'  => '$',   'iso_currency' => 'MXN', 'iso_country' => 'mx', 'country' => 'México'));
        
        Currency::create(array('symbol'  => 'C$',  'iso_currency' => 'NIO', 'iso_country' => 'ni', 'country' => 'Nicaragua'));
        
        Currency::create(array('symbol'  => 'B/.', 'iso_currency' => 'PAB', 'iso_country' => 'pa', 'country' => 'Panamá'));
        
        Currency::create(array('symbol'  => '₲',   'iso_currency' => 'PYG', 'iso_country' => 'py', 'country' => 'Paraguay'));
        
        Currency::create(array('symbol'  => 'S/.', 'iso_currency' => 'PEN', 'iso_country' => 'pe', 'country' => 'Perú'));
        
        Currency::create(array('symbol'  => 'RD$', 'iso_currency' => 'DOP', 'iso_country' => 'do', 'country' => 'República Dominicana'));
        
        Currency::create(array('symbol'  => '$',   'iso_currency' => 'TTD', 'iso_country' => 'tt', 'country' => 'Trinidad & Tobago'));
        
        Currency::create(array('symbol'  => '$',   'iso_currency' => 'UYU', 'iso_country' => 'uy', 'country' => 'Uruguay'));
        
        Currency::create(array('symbol'  => 'Bs.', 'iso_currency' => 'VEF', 'iso_country' => 've', 'country' => 'Venezuela'));
        
    }

}