<?php

    require "connection.php";
    require "helper.php";

    /**
     * =============== Request Method ===============
     */
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $path_request = $_POST["request"];
    } else if ($_SERVER["REQUEST_METHOD"] === "GET") {
        $path_request = $_GET["request"];
    }

    /**
     * =============== Request Find ===============
     */
    switch ($path_request) {
        case "get_data":
            get_data();
            break;
        case "update_data" : 
            update_data();
            break;
    }

    /**
     * =============== Request Function ===============
     */
    // Get Sorting
    function get_data($data_id = 1){
        global $connect;
    
        $result = (object) [
            "status"    => false,
            "result"    => null
        ];
    
        $query_getdata = mysqli_query($connect, "SELECT * FROM data ORDER BY id ASC");
    
        if (mysqli_num_rows($query_getdata) > 0) {
            $data = [];
            $sorting = [];
            
            $get_sorting = mysqli_query($connect, "SELECT * FROM data_sort WHERE data_id = $data_id");
            if(mysqli_num_rows($get_sorting) > 0){
                while ($row = mysqli_fetch_assoc($get_sorting)) {
                    $sorting[] = json_decode($row["data"], true);
                }
            }
    
            while ($row = mysqli_fetch_assoc($query_getdata)) {
                $data[] = $row;
            }
    
            $result = (object) [
                "status"    => true,
                "result"    => $data,
                "sorting"   => $sorting
            ];
        }
        
        header("content-type: application/json");
        Helper::output_json($result);
    }
    

    // Update Sorting
    function update_data(){
        global $connect;
        $result = (object) [
            "status" => false,
            "result" => "Failed process"
        ];
    
        $data_id    = $_POST["data_id"];
        $data       = $_POST["data"];
    
        $check_data = mysqli_query($connect, "SELECT * FROM data_sort WHERE data_id = '$data_id'");
    
        if(mysqli_num_rows($check_data) > 0){
            $update_data = mysqli_query($connect, "UPDATE data_sort SET data = '" . json_encode($data) . "' WHERE data_id = '$data_id'");
            if($update_data){
                $result = (object) [
                    "status" => true,
                    "result" => "Update successful"
                ];
            } else {
                $result = (object) [
                    "status" => false,
                    "result" => "Failed to update"
                ];
            }
        } else {
            $save_data = mysqli_query($connect, "INSERT INTO data_sort (data_id, data) VALUES ('$data_id', '" . json_encode($data) . "')");
            if($save_data){
                $result = (object) [
                    "status" => true,
                    "result" => "Save successful"
                ];
            } else {
                $result = (object) [
                    "status" => false,
                    "result" => "Failed to save"
                ];
            }
        }
    
        Helper::output_json($result);
    }
    
