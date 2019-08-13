<?php
/**
 * Created by PhpStorm.
 * User: tejsubedi
 * Date: 2017-12-07
 * Time: 2:24 PM
 */

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

    <div class="data">
        <form action=" " method="get" >
            <input type="text" name="s" value="<?php echo (isset($_GET['s']))?$_GET['s']:''?>">
            <span class="content">
                <button type="submit" value="Search">
                    <span class="content" aria-hidden="true">Search </span>
                </button>
            </span>
            </form>
    </div>
    <br/>
    <div class="data">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th class="text-center">Picture</th>
                <th class="text-center">Title</th>
                <th class="text-center">Name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Actions</th>
            </tr>

            <?php

            if(isset($_GET['s']) && $_GET['s']!=''){
                $contact_list = getSearchResult($_GET['s']);
            }else{
                $contact_list = getSearchResult();
            }
            if(count($contact_list)>0) {
                foreach ($contact_list as $user) {
                    ?>
                    <tr>
                        <td align="center">
                            <?php if(isset($user['picture']) && $user['picture']!='' && file_exists("image/pictures/".$user['picture'])){
                                ?><img width="50" src="image/pictures/<?php echo $user['picture']; ?>" />
                                <?php
                            }else{
                                ?>
                                <img width="50" src="image/pictures/default.png" />
                                <?php
                            }
                            ?>
                        </td>
                        <td><?php echo $user['title']; ?></td>
                        <td><?php echo $user['fname'] . ' ' . $user['lname']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><a href="view_contact.php?id=<?php echo $user['id']; ?>" >View</a> |
                            <a href="edit_contact.php?id=<?php echo $user['id']; ?>"> Edit</a> |
                            <a href="delete_contact.php?id=<?php echo $user['id']; ?>"
                                onclick="return confirm('Are you sure you want to delete this?')"></a></td>
                    </tr>
                    <?php
                }
            }else{
                ?>
                <tr><td colspan="4">No results</td></tr>
                `   `            <?php
            }

            ?>
        </table>
    </div>
</body>

</html>
