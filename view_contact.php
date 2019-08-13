<?php include('includes/header.php');?>
<?php
if(isset($_GET['id']) && $_GET['id']>0) {
    $user_info = getUserInfo($_GET['id']);
    ?>


    <section class="container" >
        <div class="page-header">
            <div class="jumbotron">
                <h2 class="text-center"><?php echo $user_info['title']." ".$user_info['fname']." ".$user_info['lname'];?></h2>
            </div>
        </div>
        <p><a href="index.php" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home" aria-hidden="true">  Home</a></p>

        <table class="table table-bordered table-striped table-hover">
            <tr >
                <td align="center" rowspan="8"><img class="img-thumbnail" src="images/pictures/<?php echo $user_info['picture'];?>" width="300" /></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><?php echo $user_info['email'];?></td>
            </tr>
            <tr>
                <th>Site:</th>
                <td><?php echo $user_info['site'];?></td>
            </tr>
            <tr>
                <th>Cell Number:</th>
                <td><?php echo $user_info['tel'];?></td>
            </tr>
            <tr>
                <th>Office Number:</th>
                <td><?php echo $user_info['officeTel'];?></td>
            </tr>

            <tr>
                <th>Twitter URL:</th>
                <td><?php echo $user_info['twitUrl'];?></td>
            </tr>
            <tr>
                <th>FaceBook URL:</th>
                <td><?php echo $user_info['fbUrl'];?></td>
            </tr>
            <tr>
                <th>Comment</th>
                <td><?php echo $user_info['message'];?></td>
            </tr>
            <tr>
                <td class="text-center">
                    <a href="edit.php?id=<?php echo $user_info['id']; ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"  aria-hidden="true">  </span>    Edit</a> | <a
                        href="delete.php?id=<?php echo $user_info['id']; ?>" class="btn btn-danger btn-sm"
                        onclick="return confirm('Are you sure you want to delete this?')">Delete  <span class="glyphicon         glyphicon-remove" aria-hidden="true">  </span></a></td>
            </tr>
        </table>

        <?php include('includes/footer.php');?>
        </div>

    </section>
    <?php
}else{
    echo "invalid request";
}
?>
<?php show_source(__FILE__); ?>