<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wisata_model extends CI_Model
{
    //variabel untuk url API
    var $base_url = "http://localhost/json/rest/";
    var $API = array();

    function __construct()
    {
        parent::__construct();
        $this->API['read'] = $this->base_url."read.php";
        $this->API['read_limit'] = $this->base_url."read_limit.php";
        $this->API['create'] = $this->base_url."create.php";
        $this->API['update'] = $this->base_url."update.php";
        $this->API['delete'] = $this->base_url."delete.php";
        $this->API['total_rows'] = $this->base_url."total_rows.php";
    }

    // get all
    function get_all()
    {
        $send = $this->curl($this->API['read'], "GET");
        $data = json_decode($send);
        return $data;
    }
    

    // get data by id
    function get_by_id($id)
    {
        $data = array('id' => $id);
        $send = $this->curl($this->API['read'], "GET", $data);
        $data = json_decode($send);
        return $data[0];
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $data = NULL;
        if($q)
        $data = array('q' => $q);
        $send = $this->curl($this->API['total_rows'], "GET", $data);
        $data = json_decode($send);
        return $data->total_rows;
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $data = array(
            'limit' => $limit,
            'start' => $start,
            'q' => $q
        );
        $send = $this->curl($this->API['read_limit'], "GET", $data);
        $data = json_decode($send);
        return $data;
    }

    // insert data
    function insert($data)
    {
        $this->curl($this->API['create'], "POST", $data);
    }

    // update data
    function update($id, $data)
    {
        $data['id'] = $id;
        $this->curl($this->API['update'], "POST", $data);
    }

    // delete data
    function delete($id)
    {
        $data = array('id' => $id);
        $this->curl($this->API['delete'], "GET", $data);
    }

    //tambahan fungsi curl
    function curl($url, $method, $data = NULL) {
        $params = '';
        $ch = curl_init();
        switch($method) {
            case 'GET':
                if($data) {
                    foreach($data as $key=>$value)
                    $params .= $key.'='.$value.'&';
                    $params = trim($params, '&');
                    curl_setopt($ch, CURLOPT_URL, $url.'?'.$params);
                } else {
                    curl_setopt($ch, CURLOPT_URL, $url);
                }
            break;
            case 'POST':
                foreach($data as $key=>$value)
                $params .= $key.'='.$value.'&';
                $params = trim($params, '&');
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, count($data));
                curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            break;
            default:
            header("HTTP/1.0 405 Method Not Allowed");
        break;
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}
?>
