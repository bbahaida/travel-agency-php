<?php
    session_start();

    if(!empty($_SESSION['agence']) && $_GET['log'] == 'out'){
        $_SESSION['agence'] = '';
    }
    else if(!empty($_SESSION['agence'])) header("Location: app/index.php");
    else{
        $usernameError = false;
        $passwordError = false;
        if(!empty($_POST['log'])){
            if($_POST['user'] == '') 
                $usernameError = true;
            else if($_POST['pass'] == '') 
                $passwordError = true;
            else if($_POST['user'] == 'admin' && sha1($_POST['pass']) == '45cd1d98a8d35ec6eea2da7746fa5986039fef43')
                header("Location: app/index.php?ag=nktt");
            else if($_POST['user'] == 'admin' && sha1($_POST['pass']) == '28529aefec487bfc9c1acc8339db6029418be966')
                header("Location: app/index.php?ag=ndb");
            else if($_POST['user'] == 'admin' && sha1($_POST['pass']) == '6457caa64f6947f949ef7fea89e9d713da5dcb1a')
                header("Location: app/index.php?ag=alag");
            else if($_POST['user'] == 'admin' && sha1($_POST['pass']) == '959ea3daf0e8531c5753d56999e8adff7f24b077')
                header("Location: app/index.php?ag=rosso");
            else {
                $passwordError = true;
                $file = fopen("log.txt","a+");
                $str = "Username: ".$_POST['user']." password: ".$_POST['pass']." at ".date("Y/m/d H:i:s");
                fputs($file,$str."\r\n");
                fclose($file);
            }
        }
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>Transport</title>
        <link rel="stylesheet" href="app/css/bootstrap.css" />
        <link rel="shortcut icon" href="app/img/trans_logo.ico" type="image/x-icon"/>
        <style>
            body {
                background-color:#CACFD2;
            }
            .cnx {
                margin-top:100px;
            }
            label {
                color:#393d60;
            }
            .log_btn {
                background-color:#007fd9;
            }
            .log_btn:hover {
                background-color:#393d60;
            }
            .in{
                margin-top:4px;
            }
        </style>
    </head>
    <body>

    <div class="container cnx">
        <div class="row">
            <div class="col-xs-4 col-xs-pull-4 col-xs-push-4">
                <img alt="logo" class="img-responsive" src="app/img/trans_logo_2.png" />
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-xs-pull-4 col-xs-push-4">
                <form role="form" method="post" action="">
                    <div class="row in">
                    <div class="form-group <?php if($usernameError) echo 'has-error';?>">
                        <label class="col-xs-4 control-label" for="username">Utilisateur: </label>
                        <div class="col-xs-7">
                            <input type="text" id="user" class="form-control" placeholder="Nom d'utilisateur" name="user" value="<?php if(!empty($_POST['user'])) echo $_POST['user'];?>"/>
                        </div>
                    </div>
                    </div>
                    <div class="row in">
                    <div class="form-group <?php if($passwordError) echo 'has-error';?>">
                        <label class="col-xs-4 control-label" for="password">Mot de pass: </label>
                        <div class="col-xs-7">
                            <input type="password" class="form-control" placeholder="Mot de pass" name="pass" />
                        </div>
                    </div>
                    </div>
                    <div class="row in">
                        <div class="form-group">
                            <div class="col-xs-4  col-xs-push-8">
                                <input type="submit" class="btn btn-primary log_btn" value="Login" name="log" />
                            </div>
                        </div>
                     </div>
                </form>
            </div>
        </div>
    </div>
    <script language="javascript" src="app/js/bootstrap.js"></script>
    </body>
</html>