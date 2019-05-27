<?php if ($this->session->flashdata('success_status')): ?>
    <div class="alert alert-success"><?= $this->session->flashdata('success_status') ?></div>
<?php elseif ($this->session->flashdata('error_status')): ?>
    <div class="alert alert-danger"><?= $this->session->flashdata('error_status') ?></div>
<?php endif ?>

<div class="row">

    <div class="col-md-8">

        <form class="form-horizontal" id="formRoot" action="<?= base_url("marketing/send/single/sms") ?>" method="POST">

            <input type="hidden" name="ji_user_id" value="<?= $this->session->userdata['logged_in']['id'] ?>" />

            <div class="form-group">
                <label class="control-label col-sm-2" for="to_mobile_no">To:</label>
                <div class="col-sm-10">          
                    <input type="text" class="form-control" id="to_mobile_no" name="to_mobile_no" placeholder="Enter mobile no.">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Message:</label>
                <div class="col-sm-10">
                    <textarea cols="30" rows="5" class="form-control" id="message" placeholder="Enter message" name="message"></textarea>
                </div>
            </div>

            <div class="form-group">        
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </div>

        </form>

    </div>

</div>

<script type="text/javascript">
    
    $(document).ready(function () 
    {
    	$("#formRoot").validate();
    });

</script>
