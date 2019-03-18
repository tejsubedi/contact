<?php
function writeToFile($file_input = ''){
    global $file_name;
    $fh = fopen($file_name, 'w') or die("can't open file");
    $stringData = makeCSV($file_input);
    fwrite($fh, $stringData);
    fclose($fh);
}

function readFromFile(){
    global $file_name;
    if(!file_exists($file_name)){
        $handle = fopen($file_name,'w+') or die("can't create file");
    }else{
        $handle = fopen($file_name, 'r') or die("can't open file");
    }
    $i = 0;
    $headers = '';
    $file_content = [];

    while (($buffer = fgets($handle, 4096)) !== false) {
        if($i==0){
            $headers = explode(',',$buffer);
        }else{
            $file_row = explode(',',$buffer);
            $file_content[] = make_associative_array($headers,$file_row);
        }
        $i++;
    }
    fclose($handle);
    return $file_content;
}

function makeCSV($file_input){
    $headers='';
    $file_row='';

    foreach($file_input as $inps){
        $headers1 = [];
        $file_row1 = [];

        foreach($inps as $key=>$value){
            $headers1[] = $key;
            $file_row1[] = $value;
        }

        $headers = implode(',',$headers1);
        $file_row .= implode(',',$file_row1)."\n";
    }
    return $headers."\n".rtrim($file_row);
}

/**
 * This function makes csv to associative array.
 * @param $headers
 * @param $file_row
 * @return array
 */
function make_associative_array($headers,$file_row){
    $i = 0;
    $new = [];
    foreach($headers as $hd){
        $new[trim($hd)] = trim($file_row[$i]);
        $i++;
    }
    return $new;
}

function getMaxId(){
    $contact_list = readFromFile();
    $max_id = 0;
    for($i = 0;$i < count($contact_list);$i++){
        if($contact_list[$i]['id'] > $max_id){
            $max_id = $contact_list[$i]['id'];
        }
    }
    return $max_id;
}

function addUser($user = null){
    if($user!=null){
        $contact_list = readFromFile();
        $max_id = getMaxId();
        if(count($contact_list)>0){
            array_unshift_assoc($user, "id",$max_id+1);
            $new_contact_list = $contact_list;
            $new_contact_list[] = $user;
        }else{
            array_unshift_assoc($user, "id",1);
            $new_contact_list[] = $user;
        }
        writeToFile($new_contact_list);
    }
}

function array_unshift_assoc(&$arr, $key, $val){
    $arr = array_reverse($arr, true);
    $arr[$key] = $val;
    $arr = array_reverse($arr, true);
}

function getSearchResult($search_text = null){
    $contact_list = readFromFile();
    $search_result = [];
    if($search_text!=null){
        foreach($contact_list as $user){
            if(stripos($user['first_name'], $search_text)>-1 || stripos($user['last_name'], $search_text)>-1){
                $search_result[] = $user;
            }
        }
    }else{
        $search_result = $contact_list;
    }

    return $search_result;
}


function editUser($edit_user = null){
    if($edit_user!=null){
        $contact_list = readFromFile();

        $new_contact_list = [];

        for($i = 0;$i < count($contact_list);$i++){
            if($contact_list[$i]['id']==$edit_user['id']){
                $new_contact_list[$i] = $edit_user;
            }else{
                $new_contact_list[$i] = $contact_list[$i];
            }
        }

        writeToFile($new_contact_list);
    }
}

function deleteUser($uid = null){
    if($uid!=null){
        $contact_list = readFromFile();
        $new_contact_list = [];
        for($i = 0;$i < count($contact_list);$i++){
            if($contact_list[$i]['id'] == $uid){

            }else{
                $new_contact_list[] = $contact_list[$i];
            }
        }
        writeToFile($new_contact_list);
    }
}

/**
 * Get information for only one user
 * @param int $user_id
 * @return array
 */
function getUserInfo($user_id=0){
    $user_info = array();
    if($user_id>0) {
        $contact_list = readFromFile();
        foreach($contact_list as $user){
            if($user['id']==$user_id){
                $user_info = $user;
                break;
            }
        }
    }
    return $user_info;
}

//function test_input($data) {
//    $data = trim($data);
//    $data = stripslashes($data);
//    $data = htmlspecialchars($data);
//    return $data;
//}
show_source(__FILE__);
?>