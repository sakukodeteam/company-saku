 <section class="no-margin">
    <iframe width="100%" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7922.424249344476!2d109.6806036!3d-6.865164499999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7025e9e1696609%3A0x9569729ef67d30a5!2sPanjang+Baru%2C+North+Pekalongan%2C+Pekalongan+City%2C+Central+Java%2C+Indonesia!5e0!3m2!1sen!2s!4v1407405959238"></iframe>
    

</section> -->

    <section id="contact-page" class="container">
        <div class="row-fluid">

            <div class="span8">
                <?php 
                if($this->session->flashdata('notice-success')){
                    echo $this->session->flashdata('notice-success');
                }
                ?>
                <h4>Form Kontak</h4>

                <form id="contact-form" method="post" action="<?php echo site_url('contact/send_message');?>">
                  <div class="row-fluid">
                    <div class="span5">
                        <label>Nama</label>
                        <input type="text" name="name" class="input-block-level" placeholder="Your Name">
                        <label>Email</label>
                        <input type="text" name="email" class="input-block-level" placeholder="Your Email">
                        <label>Url</label>
                        <input type="text" name="url" class="input-block-level" placeholder="Your Url">
                    </div>
                    <div class="span7">
                        <label>Pesan</label>
                        <textarea name="message" id="message" class="input-block-level" rows="8"></textarea>
                    </div>

                </div>
                <div class="notice-error" style="display:none" id="error-contact">
                    
                </div>
                <button type="submit" class="btn btn-primary btn-large pull-right">Kirim Pesan</button>
                <p> </p>

            </form>
            
        </div>

        <div class="span3">
            <h4>Alamat Kami</h4>
            <p>Anda juga bisa menghubungi kami lewat alamat di bawah ini.</p>
            <p>
                <i class="icon-map-marker pull-left"></i> <?php echo company('address'); ?>
            </p>
            <p>
                <i class="icon-envelope"></i> &nbsp;<?php echo company('email'); ?>
            </p>
            <p>
                <i class="icon-phone"></i> &nbsp;<?php echo company('hp'); ?>
            </p>
            <p>
                <i class="icon-globe"></i> &nbsp;<?php echo company('url'); ?>
            </p>
        </div>

    </div>

</section>

<!-- script submit form to send email/message -->
<script>
$(document).ready(function(){
    $("#contact-form").submit(function(event){
        event.preventDefault();
        $("#error-contact").html("");
        $("#error-contact").hide();
        $.post(this.action,$(this).serialize(),function(data){
            if(data.status == false){
                $("#error-contact").html('<i class="icon-times"></i>'+data.msg);
                $("#error-contact").slideDown();
            }else if(data.status == true){
                location.reload();
            }else{
                alert(data.msg);
            }
        },"json")
    });

    //$("#notice-contact").click(function(){$(this).hide()});
});
</script>