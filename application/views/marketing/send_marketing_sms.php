<div class="row">

    <div class="col-md-8">

        <form class="form-horizontal" id="formRoot">

            <input type="hidden" name="ji_user_id" value="<?= $this->session->userdata['logged_in']['id'] ?>" />

            <div class="form-group">
                <label class="control-label col-sm-2" for="to-customer">To:</label>
                <div class="col-sm-10">
                    <select class="form-control required" id="to-customer" name="to_customer">
                        <option value="">Select An Option</option>
                        <option value="0">All users</option>
                        <option value="1">Last 1 month users</option>
                        <option value="2">Last 4 months users</option>
                        <option value="3">Last 6 months users</option>
                        <option value="4">Last 1 year users</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="subject">Subject:</label>
                <div class="col-sm-10">          
                    <input type="text" class="form-control" id="subject" placeholder="Enter subject" name="subject" value="">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="greeting">Greeting:</label>
                <div class="col-sm-10">          
                    <input type="text" class="form-control" id="greeting" placeholder="Enter greeting" name="greeting" value="">
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
                    <button type="button" class="btn btn-primary" onclick="sendSMS()">Send</button>
                </div>
            </div>

        </form>

        <h2>Progress Bar</h2>
        <div class="progress">
            <div class="progress-bar" role="progressbar" id="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
        </div>

    </div>

</div>

<script type="text/javascript">
    
    $(document).ready(function () 
    {
    	$("#formRoot").validate();
        $("#to-customer").select2();
    });

    function sendSMS() {
        // var url      = "<?= base_url("marketing/send/sms") ?>";
        // var subject  = $('#subject').val();
        // var greeting = $('#greeting').val();
        // var message  = $('#message').val();

        // $.post(url, {subject: subject, greeting: greeting, message: message}, function(result) 
        // {
        //     var elem  = document.getElementById("progressbar");   
        //     var width = result.percent;
        //     var id    = setInterval(frame, 100);
        //     function frame() {
        //         if (width >= 100) {
        //             clearInterval(id);
        //         } else {
        //             width++; 
        //             elem.style.width = width + '%';
        //             elem.innerHTML   = width * 1  + '%';
        //         }
        //     }
        // });

        var elem  = document.getElementById("progressbar");   
        var width = 10;
        var id    = setInterval(frame, 100);
        function frame() {
            if (width >= 100) {
                clearInterval(id);
            } else {
                width++; 
                elem.style.width = width + '%';
                elem.innerHTML   = width * 1  + '%';
            }
        }
    }

</script>
