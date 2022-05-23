<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="section-heading">
                <div class="line-dec"></div>
                <h1>Sign Up</h1>
            </div>
            <form class="user-form" method="post" id="signup" role="form" data-toggle="validator">
                <div class="form-row">
                    <div class="form-group col-md-6 has-feedback">
                        <label for="inputLogin" class="control-label">Login</label>
                        <input name="login" type="text" class="form-control" id="inputLogin" placeholder="Login"
                            value="<?= isset($_SESSION['form_data']['login'])? $_SESSION['form_data']['login'] : '' ?>"
                               required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group col-md-6 has-feedback">
                        <label for="inputEmail" class="control-label">E-mail</label>
                        <input name="email" type="email" class="form-control" id="inputEmail" placeholder="E-mail"
                               value="<?= isset($_SESSION['form_data']['email'])? $_SESSION['form_data']['email'] : '' ?>"
                               data-error="This email address is invalid" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 has-feedback">
                        <label for="inputPassword" class="label-control">Password</label>
                        <input name="password" type="password" class="form-control" id="inputPassword"
                               placeholder="Password" data-minlength="6" data-error="Password minlength is 6 symbols"
                               required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group col-md-6 has-feedback">
                        <label for="inputPasswordConfirm" class="label-control">Confirm password</label>
                        <input name="confirmPassword" type="password" class="form-control" id="inputPasswordConfirm"
                               placeholder="Confirm password" data-error="Confirm password and password are different"
                               data-match="#inputPassword" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="inputName" class="label-control">Name</label>
                    <input name="name" type="text" class="form-control" id="inputName" placeholder="Name"
                           value="<?= isset($_SESSION['form_data']['name'])? $_SESSION['form_data']['name'] : '' ?>"
                           required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group has-feedback">
                    <label for="inputAddress" class="label-control">Address</label>
                    <input name="address" type="text" class="form-control" id="inputAddress" placeholder="Address"
                           value="<?= isset($_SESSION['form_data']['address'])? $_SESSION['form_data']['address'] : '' ?>"
                           required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Sign up</button>
                </div>
            </form>
            <?php if (isset($_SESSION['form_data'])) unset($_SESSION['form_data']); ?>
        </div>
    </div>
</div>
