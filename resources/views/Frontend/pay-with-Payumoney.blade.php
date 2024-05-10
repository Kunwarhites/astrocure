<?php
$MERCHANT_KEY = 'MI9WXr'; // add your id paste kro
$SALT = 'dp7iyywQBr7fPoKW4A5w0sMXmWzonXfD'; // add your id
// $PAYU_BASE_URL = 'https://test.payu.in';
   $PAYU_BASE_URL = "https://secure.payu.in";
$action = '';
$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
// $posted = [];
$posted = [
    'key' => $MERCHANT_KEY,
    'txnid' => $txnid,
    'amount' => '1000.00',
    'productinfo' => 'PHP Project Subscribe',
    'firstname' => 'User',
    'email' => 'user@gmail.com',
    'phone' => '1234567890',  // Add the correct phone number
    'surl' => 'http://example.com/subscribe-response/',
    'furl' => 'http://example.com/subscribe-cancel/',
    'service_provider' => 'payu_paisa',
];

if (empty($posted['txnid'])) {
    $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
    $txnid = $posted['txnid'];
}
$hash = '';
$hashSequence = 'key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10';
if (empty($posted['hash']) && sizeof($posted) > 0) {
    $hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';
    foreach ($hashVarsSeq as $hash_var) {
        $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
        $hash_string .= '|';
    }
    $hash_string .= $SALT;
    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
} elseif (!empty($posted['hash'])) {
    $hash = $posted['hash'];
    $action = $PAYU_BASE_URL . '/_payment';
}
?>
<html>

<head>
    <script>
        var hash = '<?php echo $hash; ?>';

        function submitPayuForm() {
            if (hash == '') {
                return;
            }
            var payuForm = document.forms.payuForm;
            payuForm.submit();
        }
    </script>
</head>

<body onload="submitPayuForm()">
    Processing.....
    <form action='https://secure.payu.in/_payment' method='post'>
        <input type="hidden" name="key" value="dp7iyywQBr7fPoKW4A5w0sMXmWzonXfD" />
        <input type="hidden" name="txnid" value="t6svtqtjRdl4ws" />
        <input type="hidden" name="productinfo" value="iPhone" />
        <input type="hidden" name="amount" value="10" />
        <input type="hidden" name="email" value="test@gmail.com" />
        <input type="hidden" name="firstname" value="Ashish" />
        <input type="hidden" name="lastname" value="Kumar" />
        <input type="hidden" name="surl" value="https://test-payment-middleware.payu.in/simulatorResponse" />
        <input type="hidden" name="furl" value="https://test-payment-middleware.payu.in/simulatorResponse" />
        <input type="hidden" name="phone" value="9988776655" />
        <input type="hidden" name="hash" value="80f1d97f0a536bd195e944a29b9a36f60e79a95160a94511bccfce5dda80b489143249f9a20fc3b76e05007c3aa1991cd8cf0dbfaf41d296728f714a6b64d414" />
        <input type="submit" value="submit"> </form>
</body>

</html>
