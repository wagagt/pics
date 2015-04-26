<?php

class UsersTableSeeder extends Seeder {

    public function run() {
        
        User::create(array(
            'fbid' => '447762952043323',   
            'name' => 'Ricardo Rodas',   
            'first_name' => 'Ricardo',   
            'last_name' => 'Rodas',   
            'email' => 'atta.spam@gmail.com',   
            'gender' => 'male',   
            'picture' => 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpf1/v/t1.0-1/c8.0.50.50/p50x50/549269_166378710181750_1654471822_n.jpg?oh=a57a59ff833219fb9c8453d3da271e70&oe=55B602E5&__gda__=1434685006_7086fe0d38fdbfc82ae2b9e3e5ea0be4',   
        ));
        
        User::create(array(
            'fbid' => '1549780752',   
            'name' => 'Wilver Gonzalez',   
            'first_name' => 'Wilver',   
            'last_name' => 'Gonzalez',   
            'email' => 'wagagt@gmail.com',   
            'gender' => 'male',   
            'picture' => 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xap1/v/t1.0-1/p50x50/11029557_10206041135137988_8430330652274599057_n.jpg?oh=b70188d0274ee0dd216b6228d60d4214&oe=5576D842&__gda__=1434564167_c68ae7b24db0f8fcaf823b4faecbcb0f',   
        ));
        
        User::create(array(
            'fbid' => '749562122',   
            'name' => 'Attakinsky Blanco',   
            'first_name' => 'Attakinsky',   
            'last_name' => 'Blanco',   
            'email' => 'joseblanco77@gmail.com',   
            'gender' => 'male',   
            'picture' => 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xft1/v/t1.0-1/p50x50/10460360_10152729092932123_2424948698687633161_n.jpg?oh=28e8a2375d3eb89359edd4d3e01d2cfb&amp;oe=55ACF31E&amp;__gda__=1438430807_4afaccc65eba6690b11df698ab7f0c20',   
        ));
        
    }
    
}