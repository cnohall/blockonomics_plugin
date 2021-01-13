<?php

function bitcoin_address_finder(){
    add_menu_page( 'Bitcoin Address Finder', 'Bitcoin Address Finder', 'manage_options', 'bitcoin-address-finder', 'use_effect' );
}

function use_effect(){
    if(isset($contents)){
        echo '<h1>'.$context.'<h1>';
    }
    ?>
    <h1>Hello World Tjugotre!</h1>
    <form method='post' action=''>
    Bitcoin address:<input type='name' name='address'>
    <input type='submit' name='SubmitButton'>
    </form>
    <?php
    if(isset($_POST['SubmitButton'])){ //check if form was submitted
        echo 'submitted ';
        $address = $_POST['address']; //get input text
        $content = '{"addr":"1JJ5taVeiHcD6DXNkLLfocbHcE9Nzio1qV, 13A1W4jLPP75pzvn2qJ5KyyqG3qPSpb9jM"}';
        // $content = '{"addr":"'.$address.'"}';
        $api_key = get_option("blockonomics_api_key");
        $url = 'https://www.blockonomics.co/api/searchhistory';

        $options = array( 
            'http' => array(
                'header'  => 'Authorization: Bearer '.$api_key,
                'method'  => 'POST',
                'content' => $content,
                'ignore_errors' => true
            )   
        );  


        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $object = json_decode ($result, true);
        if(isset($object)){
            // echo 'Results for '.$address.': '.$result.'<br/>';
            echo 'Results for '.$content.': '.$object.'<br/>';
            echo 'Pending1: '. $object['history'][0]['value'].'<br/>';
            echo 'History1: '. $object['history'][1]['value'].'<br/>';
            echo 'Pending2: '. $object['history'][0].'<br/>';
            echo 'History2: '. $object['history'][1].'<br/>';
            echo 'Pending3: '. $object['history'][2].'<br/>';
            echo 'History4: '. $object['history'][3].'<br/>';
            echo $object->pending.'<br/>';
            echo $object->history.'<br/>';
            echo 'Pending3: '.$object['$pending'].'<br/>';
            echo 'History3: '.$object['$history'].'<br/>';
        } else {
            echo 'Result not done yet'.$content;
        }
    }    
}