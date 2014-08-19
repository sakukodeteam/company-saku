<?php
$login = array(
    'name'  => 'login',
    'id'    => 'login',
    'value' => set_value('login'),
    'class' => 'form-control'
);
if ($login_by_username AND $login_by_email) {
    $login_label = 'Email or login';
} else if ($login_by_username) {
    $login_label = 'Login';
} else {
    $login_label = 'Email';
}
$password = array(
    'name'  => 'password',
    'id'    => 'password',
    'class' => 'form-control'
);
$remember = array(
    'name'  => 'remember',
    'id'    => 'remember',
    'value' => 1,
    'checked'   => set_value('remember'),
);
$captcha = array(
    'name'  => 'captcha',
    'id'    => 'captcha',
    'maxlength' => 8,
);
?>
<div class="form-box" id="login-box">
            <div class="header">Sign In</div>
            <?php echo form_open($this->uri->uri_string()); ?>
                <div class="body bg-gray">
                    <div class="form-group">
                        <?php echo form_label($login_label, $login['id']); ?>
                        <?php echo form_input($login); ?>
                        <span class="text-danger"><?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></span>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Password', $password['id']); ?>
                        <?php echo form_password($password); ?>
                        <span class="text-danger"><?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></span>
                    </div>   
                    <div class="form-group">
                        <!--captcha-->
                        <?php if ($show_captcha) {
                            if ($use_recaptcha) { ?>
                        <tr>
                            <td colspan="2">
                                <div id="recaptcha_image"></div>
                            </td>
                            <td>
                                <a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a>
                                <div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
                                <div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="recaptcha_only_if_image">Enter the words above</div>
                                <div class="recaptcha_only_if_audio">Enter the numbers you hear</div>
                            </td>
                            <td><input type="text" id="recaptcha_response_field" name="recaptcha_response_field" /></td>
                            <td style="color: red;"><?php echo form_error('recaptcha_response_field'); ?></td>
                            <?php echo $recaptcha_html; ?>
                        </tr>
                        <?php } else { ?>
                        <tr>
                            <td colspan="3">
                                <p>Enter the code exactly as it appears:</p>
                                <?php echo $captcha_html; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo form_label('Confirmation Code', $captcha['id']); ?></td>
                            <td><?php echo form_input($captcha); ?></td>
                            <td style="color: red;"><?php echo form_error($captcha['name']); ?></td>
                        </tr>
                        <?php }
                        } ?>
                    </div>       
                    <div class="form-group">
                        <?php echo form_checkbox($remember); ?> Remember me
                    </div>
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Sign me in</button>  
                    
                    <p><a href="#">I forgot my password</a></p>
                </div>
            </form>
        </div>