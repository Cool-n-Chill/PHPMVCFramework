<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="section-heading">
                <div class="line-dec"></div>
                <?php if (empty($_SESSION['user_info'])): ?>
                <h1>Log In</h1>
                <?php else: ?>
                <p><?=$_SESSION['user_info']['name']?>, successfully logged in.</p>
                <?php endif; ?>
            </div>
            <?php if (empty($_SESSION['user_info'])): ?>
            <form class="user-form" method="post" id="login" role="form" data-toggle="validator">
                <div class="form-row">
                    <div class="form-group col-md-6 has-feedback">
                        <label for="inputLogin" class="control-label">Login</label>
                        <input name="login" type="text" class="form-control" id="inputLogin" placeholder="Login"
                               value="<?= isset($_SESSION['form_data']['login'])? $_SESSION['form_data']['login'] : '' ?>"
                               required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group col-md-6 has-feedback">
                        <label for="inputPassword" class="control-label">Password</label>
                        <input name="password" type="password" class="form-control" id="inputPassword" placeholder="Password" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                </div>
                <a class="form-link" href="<?=PATH?>/user/signup">New around here? Sign up</a>
                <a class="form-link" href="#">Forgot password?</a>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Log in</button>
                </div>
            </form>
            <?php endif; ?>
        </div>
    </div>
</div>
