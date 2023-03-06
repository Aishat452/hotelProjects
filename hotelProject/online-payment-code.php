<!-- //// begins flutterwave payment code //// -->
<?php
    $payAmount = 50;
    $email = "chrisgraham2625@gmail.com";
    $phone = "+23491234667789";
    $ref = "EBR".rand(10000,99999).time();
?>
<link rel="stylesheet" href="assets/css/">

<!-- Starts HEre -->
<small>Pay online with your debit card</small>
<input type="submit" class="btn-success btn" style="cursor:pointer;" value="Pay Now" id="submit" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function(event) {
        document.getElementById('submit').addEventListener('click', function() {

            var flw_ref = "",
                chargeResponse = "",
                trxref = "FDKHGK" + Math.random(),
                API_publicKey = "FLWPUBK_TEST-83af4504f6370dc6576a13be3875e79b-X"; 
                //Always change flutterwave public key to your own key

            //   ENTER ALL ESSENTIAL VARIABLES
            // var amount_ea = "50000";
            var amount_ea = <?php echo $payAmount; ?>;
            var email_ea = <?php echo (json_encode($email)); ?>;
            var phone_ea = <?php echo (json_encode($phone)); ?>;
            var ref_ea = <?php echo (json_encode($ref)); ?>;

            getpaidSetup({
                PBFPubKey: API_publicKey,
                customer_email: email_ea,
                amount: amount_ea,
                customer_phone: phone_ea,
                currency: "NGN",
                txref: ref_ea,
                meta: [{
                    metaname: "EA-NG",
                    metavalue: "NG"
                }],
                onclose: function(response) {},
                callback: function(response) {
                    txref = response.data.txRef, chargeResponse = response.data.chargeResponseCode;
                    if (chargeResponse == "00" || chargeResponse == "0") {
                        //   if payment failed
                        window.location = "payment-failed";
                    } else {
                        //when successful
                        window.location = "payment-success?id=2&amount=2000&ref=sijoxaskxmaoncpo";
                    }
                }
            });
        });
    });
</script>
<!-- END OF PAYMENT SCRIPT -->