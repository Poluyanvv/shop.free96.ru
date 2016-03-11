<?php
/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 04.03.2016
 * Time: 16:54
 */

?>
<div class="container">
    <form method="post" class="form-signin" role="form">
        <h2 class="form-signin-heading">Авторизируйтесь</h2>
            <input type="text" name="login" placeholder="Логин" class="form-control" required autofocus>
            <input type="password" name="password" placeholder="Пароль" class="form-control" required>
        <label class="checkbox">
            <input type="checkbox" name="remember" value="1"/>запомнить меня
        </label>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
    </form>
</div>