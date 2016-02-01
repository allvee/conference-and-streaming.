<?php

class ClientIpAddr {
    //Determine if an ip is in a net.
    //E.G. 120.120.120.120 in 120.120.0.0/16
    public static function isIpInNetMask($ip, $net, $mask) {
        $lnet = ip2long($net);
        $lip = ip2long($ip);
        $binnet = str_pad( decbin($lnet),32,"0",STR_PAD_LEFT);
        $firstpart = substr($binnet,0,$mask);
        $binip = str_pad( decbin($lip),32,"0",STR_PAD_LEFT);
        $firstip = substr($binip,0,$mask);
        return(strcmp($firstpart,$firstip)==0);
    }

    // $subnet - 120.120.0.0/16
    public static function isIpInNet($ip, $subnet) {
        list($net, $mask) = explode("/", $subnet);
        return ClientIpAddr::isIpInNetMask($ip, $net, $mask);
    }

    //This function check if a ip is in an array of nets (ip and mask)
    public static function isIpInNetworks($ip, $networks) {
        foreach ($networks as $subnet) {
            if (ClientIpAddr::isIpInNet($ip, $subnet))
                return true;
        }
        return false;
    }

    public static function isIpLocal($ip) {
        //List of the private ips described in the RFC.
        $ip_private_list = array(
            "10.0.0.0/8",
            "172.16.0.0/12",
            "192.168.0.0/16",
            "127.0.0.0/8",
        );
        return ClientIpAddr::isIpInNetworks($ip, $ip_private_list);
    }

    public static function isClientBehindProxy() {
        if (isset($_SERVER['HTTP_VIA']) || isset($_SERVER['HTTP_X_FORWARDED']) ||
            isset($_SERVER['HTTP_X_FORWARDED_FOR']) || isset($_SERVER['HTTP_CLIENT_IP']))
            return true;
        return false;
    }

    // return Proxy Ip Address, false if no proxy
    public static function getClientProxyIpAddr() {
        if (ClientIpAddr::isClientBehindProxy())
            return @$_SERVER['REMOTE_ADDR'];
        return false;
    }

    // returns array of forwarded IP addresses
    public static function getProxyForwardedIpAddresses() {
        $addrs = array();
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $addrs = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        for ($i = 0; $i < sizeof($addrs); $i ++) {
            $addrs[$i] = trim($addrs[$i]);
        }
        if (isset($_SERVER['REMOTE_ADDR']))
            $addrs[] = $_SERVER['REMOTE_ADDR'];
        return $addrs;
    }

    // try to return real Client Ip Address
    public static function getClientIpAddr() {
        if (!ClientIpAddr::isClientBehindProxy())
            return $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
        $addrs = ClientIpAddr::getProxyForwardedIpAddresses();
        foreach ($addrs as $ip) {
            if ($ip && ClientIpAddr::isValidIpAddr($ip) && !ClientIpAddr::isIpLocal($ip))
                return $ip;
        }
        return false;
    }

    public static function isValidIpAddr($ip) {
        $a_octets = explode('.', $ip);
        if (4 != sizeof($a_octets))
            return false;
        foreach ($a_octets as $octet)
        {
            if (! is_numeric($octet) || $octet < 0 || $octet > 255)
                return false;
        }
        return true;
    }
}


