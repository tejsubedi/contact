<?php

if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['title']) && isset($_POST['id'])){
    $user_info['id'] = $_POST['id'];
    $user_info['title'] = $_POST['title'];
    $user_info['first_name'] = $_POST['first_name'];
    $user_info['last_name'] = $_POST['last_name'];
    $user_info['email'] = $_POST['email'];
    $user_info['cel_number'] = $_POST['cel_number'];
    $user_info['home_Number'] = $_POST['home_Number'];
    $user_info['office_Number'] = $_POST['office_Number'];
    $user_info['site'] = $_POST['site'];
    $user_info['twitter_url'] = $_POST['twitter_url'];
    $user_info['facebook_url'] = $_POST['facebook_url'];
    $user_info['comment'] = $_POST['comment'];

    //print_r($_FILES);

    /*Picture upload starts*/
    $check = getimagesize($_FILES["photo_upload"]["tmp_name"]);
    $extension = pathinfo($_FILES["photo_upload"]["name"],PATHINFO_EXTENSION);
    $target_location = $upload_dir.$user_info['id'].".".$extension;

    if($check !== false) {
        move_uploaded_file($_FILES["photo_upload"]["tmp_name"], $target_location);
        $user_info['picture'] = $user_info['id'].".".$extension;
    }else{
        $user_info['picture'] = "";
    }
    /*Picture upload ends*/

    editUser($user_info);
    header("location:index.php");
}
/*end post code */

if(isset($_GET['id']) && $_GET['id']>0) {
$user_info = getUserInfo($_GET['id']);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Contact</title>

    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
        }
        .content {
            width: 1000px;
            margin: 0 auto;
            padding: 0px 20px 20px;
            background: white;
            border: 2px solid navy;
        }
        h2{
            color navy;
        }
        label{
            width: 10em;
            padding-right: 1em;
            float: left;
        }
        .data input{
            float: left;
            width: 30em;
            height: 2.5em;
            margin-bottom: .5em;
        }
        .buttons input{
            float: left;
            margin-bottom: .5em;
        }
        br{
            clear: left;
        }

    </style>

</head>
<body>
<div class="content">
    <h2>Add Contact</h2>

    <p><a href="index.php">Home </a> </p>

    <form action="edit_contact.php" method="post" enctype="multipart/form-data">
        <div class="data">
            <label for="title">Title:</label>
            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
            <select name ="title" class="form-control" required>
                <option value="Mr.">Mr.</option>
                <option value="Miss.">Miss.</option>
                <option value="Ms.">Ms.</option>
            </select><br/><br/>
        </div>
        <div class="data">
            <label>First Name:</label>
            <input type="text" name="first_name" value="<?php echo $user_info['first_name'];?>"><br/>

            <label>Last Name:</label>
            <input type="text" name="last_name" value="<?php echo $user_info['last_name'];?>"><br/>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $user_info['email'];?>"><br/>

            <label>Cell Number:</label>
            <input type="text" name="cell_number" value="<?php echo $user_info['cel_number'];?>"><br/>

            <label>Home Number:</label>
            <input type="text" name="home_Number" value="<?php echo $user_info['home_Number'];?>"><br/>

            <label>Office Number:</label>
            <input type="text" name="office_Number" value="<?php echo $user_info['office_Number'];?>"><br/>

            <label>Site:</label>
            <input type="text" name="site" value="<?php echo $user_info['site'];?>"><br/>

            <label>Twitter URL:</label>
            <input type="text" name="twitter_url" value="<?php echo $user_info['twitter_url'];?>"><br/>

            <label>Facebook URL:</label>
            <input type="text" name="facebook_url" value="<?php echo $user_info['facebook_url'];?>"><br/>

            <label>Comment:</label>
            <textarea name="comment" rows="10" cols="55" placeholder="comment..."><?php echo $user_info['comment'];?></textarea><br/>

            <label>Picture:</label>
            <input type="file" name="picture"><br/>
            <img src="images/pictures/<?php echo $user_info['picture'];?>" width="300" />

        </div>
        <div class="buttons">
            <label>&nbsp;</label>
            <input type="submit" value="Submit"><br/>
        </div>

    </form>

</div>
</body>
<footer>copy right &copy;Tej Subedi 2017</footer>
</html>
    <?php
}else{
    echo "invalid request";
}
show_source(__FILE__);
?>
