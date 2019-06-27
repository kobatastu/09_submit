<div class="jumbotron">
    <div class="container">
            <a class="btn" class="btn btn-primary btn-lg" role="button" href="mypage.php">マイページ</a>　
            <?php if($_SESSION["kanri_flg"]=="1"){ ?>
            <a class="btn" class="btn btn-primary btn-lg" role="button" href="user_make.php">ユーザー登録</a>　
            <a class="btn" class="btn btn-primary btn-lg" role="button" href="user_select.php">ユーザー一覧</a>　
            <?php } ?>
            <a class="btn" class="btn btn-primary btn-lg" role="button" href="logout.php">ログアウト</a>
    </div>
</div>

