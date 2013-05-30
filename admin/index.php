<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Administrator</title>
        <link href="css/original/admin.css" rel="stylesheet" type="text/css" />
        <link href="css/smoothness/jquery-ui-1.8.17.custom.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="script/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="script/jquery-ui-1.8.18.custom.min.js"></script>
        <script type="text/javascript" src="script/admin.js"></script>
        <script>
            $(document).ready(function(e) {
                $('#date').datepicker();

            });
        </script>
    </head>

    <body>
        <div class="module-login">
            <div><img src="images/logo.png" /></div>
            <div>CKS 網站管理系管，請輸入管理者帳號及密碼登入。</div>
            <div>
                <form method="post" action="logincheck.php">
                    <table border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <th align="right">帳號</th>
                            <td colspan="2"><input name="id" type="text" size="40" /></td>
                        </tr>
                        <tr>
                            <th align="right">密碼</th>
                            <td colspan="2"><input name="pw" type="password" size="40" /></td>
                        </tr>
                        <tr>
                            <th align="right">驗証</th>
                            <td><input name="imgcode" type="text" size="20" /></td>
                            <td align="right" valign="middle"><img  src="../inc/imgcode.php" alt="" width="90" height="32" /></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right"><input type="submit" value="登入" class="button" /></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="copyright">YOUS © 2012</div>
        </div>
    </body>
</html>