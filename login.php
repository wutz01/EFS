<!DOCTYPE html>
<html lang="en">

<title>E-FSDP | Login</title>
<?php
    include("include/head.php");
?>
<body style="background-color: #fff">
<div id="">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <a class="navbar-brand" href="index.php" style="padding: 10px 15px;">
                <img src="img/efsdp_logo_mini.png" class="img-responsive" alt="" style="width:32px;height:32px">
            </a>
            <a class="navbar-brand" href="index.php">
                Faculty And Staff Development Program
            </a>
    </nav>  
<div id="page-wrapper">
    <div class="col-xs-10 col-xs-offset-1 col-sm-7 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
        <div class="row">                                                   
            <div class="well" style="padding:12px;">                                    
                <div class="panel panel-default">
                    <div class="panel-body">
                        
                        <div class="row">
                            <center>
                                <img src="img/FAITHLogo.png" class="img-responsive" style="width:500px;height:150px">
                            </center>
                        </div>
                        <hr>
                            <div align="center">
                                <img src="img/avatar.png" id="emppic" class="thumbnail img-responsive imgsize" style="width:150px;height:150px">
                            </div>
                        <hr>
                        <form method="post" action="action/r.php" role="form">                                            
                        <?php
                        if(isset($_GET['login'])){
                            echo "<div class='alert alert-danger'>Login Failed.</div>";
                        }
                        ?>
                            <div class="form-group input-group"> 
                                <span class="input-group-addon borderless"><span class="fa fa-envelope fa-fw"></span></span>
                                <input type="email" name="user" id="email" class="form-control borderless" placeholder="EMAIL ADDRESS" autocomplete="on" required autofocus>                                            
                            </div>                                          
                            <div class="form-group input-group">                                                
                                <span class="input-group-addon borderless"><span class="fa fa-lock fa-fw"></span></span>  
                                <input type="password" name="pass" id="password" class="form-control borderless" placeholder="PASSWORD" autocomplete="off" required>                                            
                            </div>
                            <a href=""><h6 class="text-center"><span class="fa fa-pencil"></span> Sign Up now?</h6></a>
                            <div align="right">                                             
                                <button type="submit" name="login" class="btn btn-success"><span class="fa fa-sign-in"></span>&nbsp;Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>                                          
        </div>
    </div>
</div>
</div>

<?php
    include('include/foot.php');
?>
</body>

</html>