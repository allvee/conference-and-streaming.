<?php

include('client_ip_addr.php');

function curlRequest($method, $url, array $vars)
{
    $encoded = http_build_query($vars, null, '&');
    if($method == "GET")
        $url .= $encoded;
  
    
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_PORT, 80);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

    switch(strtoupper($method))
    {
        case "GET":
            curl_setopt($curl, CURLOPT_HTTPGET, TRUE);
            break;
        case "POST":
            curl_setopt($curl, CURLOPT_POST, TRUE);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $encoded);
            break;
    }

    if(FALSE === ($result = curl_exec($curl))) $curlError = curl_error($curl);

    $responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if($responseCode != 200) {
        return $responseCode;
    }

    curl_close($curl);
    return $result;

}

function encrypt_json($string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = '23DE2213AD7087B8BA98082B384006EDBB40D74269F0A554';
    $secret_iv = 'CAA15947783CD929040E6AA2AD3CEC1F';

// hash
    $key = hash('sha256', $secret_key);

// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);


    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($output);

    return $output;
}

function decrypt_json($string) {

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = '23DE2213AD7087B8BA98082B384006EDBB40D74269F0A554';
    $secret_iv = 'CAA15947783CD929040E6AA2AD3CEC1F';

    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);

    return $output;
}

/*
 * Performs a 'mysql_real_escape_string' on the entire array/string
 */
function SecureData($data, $connection)
{
    if (is_array($data)) {
        foreach ($data as $key => $val) {
            if (!is_array($data[$key])) {
                $data[$key] = mysql_real_escape_string($data[$key], $connection);
            }
        }
    } else {
        $data = mysql_real_escape_string($data, $connection);
    }
    return $data;
}

/*
 * Adds a record to the database based on the array key names
 */
function generateInsertQuery($vars, $table, $connection, $exclude = ''){
    // Catch Exclusions
    if($exclude == ''){
        $exclude = array();
    }
    array_push($exclude, 'MAX_FILE_SIZE'); // Automatically exclude this one
    // Prepare Variables
    $vars = SecureData($vars, $connection);
    $query = "INSERT INTO `{$table}` SET ";
    foreach($vars as $key=>$value){
        if(in_array($key, $exclude)){
            continue;
        }
        //$query .= '`' . $key . '` = "' . $value . '", ';
        $query .= "`{$key}` = '{$value}', ";
    }
    $query = substr($query, 0, -2);
    return $query;
}

function write_activity_log_data($connection, $data)
{
    $client_ip = ClientIpAddr::getClientIpAddr();
    $data['origin'] =  $client_ip;
    $data['created_date'] = date('Y-m-d H:i:s');
    $exclude = array();
    $InsertQuery = generateInsertQuery($data, 'activity_log', $connection, $exclude);
    // echo $InsertQuery;
    //exit;
    Sql_exec($connection, $InsertQuery);
    // return true;
}