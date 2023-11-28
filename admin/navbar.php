<div class="navbar navbar-fixed-top navbar-inverse">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <span class="brand" href="#">ALS LMS ADMIN Panel</span>
            <div class="nav-collapse collapse">
                <ul class="nav pull-right">
                    <?php
                    $query = mysqli_query($conn, "select * from users where user_id = '$session_id'") or die(mysqli_error($conn));
                    $row = mysqli_fetch_array($query);
                    ?>
                    <li class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user icon-large"></i>
                            <?php echo $row ? $row['firstname'] . " " . $row['lastname'] : 'Admin'; ?>
                            <i class="caret"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <?php if ($row) : ?>
                                <li>
                                    <a tabindex="-1" href="#">Profile</a>
                                </li>
                                <li class="divider"></li>
                            <?php endif; ?>
                            <li>
                                <a tabindex="-1" href="logout.php"><i class="icon-signout"></i>&nbsp;Log Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
