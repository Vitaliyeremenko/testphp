<h2>Список задач<h2>
        <div class="todolist">
            <label>
                <form action="index.php" method="get">Введите задание<input type="text" id="enter" name="message"></label><input type="submit"><button class="prewiev-btn">Preview</button><a href="/bejeetest/index.php?&sort=state"> SORT STATE</a><a href="/bejeetest/index.php?&sort=name"> SORT NAME</a><a href="/bejeetest/index.php?&sort=mail"> SORT MAIL </a></form>
            <ul class="forlist">
                <?php
                $count = $mysqli->query("SELECT * FROM tasks")->num_rows;
                if($_GET){
                    if ($_GET['page'] < 0){
                        $_GET['page'] = 0;
                    }
                    $page_num = $_GET['page'];
                    $from_row = ($page_num - 1) * 3;
                    $to_row =  3;
                }
                else{
                    $from_row = 0;
                    $to_row = 3;
                }
                $result = $mysqli->query("SELECT * FROM tasks LIMIT $from_row,$to_row");
                while( $row = $result->fetch_assoc() ) {
                    $username = $row['username'];
                    $result_users = $mysqli->query("SELECT * FROM users where username='$username'");
                    $row_user = $result_users->fetch_assoc();
                    ?>
                    <li data-state="<?php echo $row['state']?>" data-id="<?php echo $row['id']?>">
                        <div class="info">
                            <p class="name"><?php echo $row['username']?></p>
                            <p class="mail"><?php echo $row_user['email']?></p>
                            <p class="avatar"><img src="<?php echo $row_user['avatar']?>" alt=""></p>
                        </div>
                        <?php if($_SESSION['login'] == 'admin'){
                            echo "<textarea class=\"task\">". $row['task']."</textarea>";
                            echo "<button class=\"check\">check/uncheck</button>";
                        }
                        else
                        {  echo "<p class=\"task\">". $row['task']."</p>"; }
                        ?>
                    </li>
                    <?php
                }?>
            </ul>
        </div>
        <?php
        $counter = $count%3 ? $count/3 + 1 :$count/3 ;
        for($i=1;$i<= $counter;$i++) {
            echo '<a href="/bejeetest/index.php?&page='.$i.'">'.$i."</a>\n";
            }
        ?>
        <div class="preview">
            <li>

                <?php
                $username = $_SESSION['login'];
                $result_users = $mysqli->query("SELECT * FROM users where username='$username'");
                $row_user = $result_users->fetch_assoc();

                ?>


                <div class="info">
                    <p class="name"><?php echo $row_user['username']?></p>
                    <p class="mail"><?php echo $row_user['email']?></p>
                    <p class="avatar"><img src="<?php echo $row_user['avatar']?><" alt=""></p>
                </div>
                <p class="preview-task"></p>
            </li>
        </div>
