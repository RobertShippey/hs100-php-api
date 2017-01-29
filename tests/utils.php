<?php 

$tests = array( 
	array('{"system":{"set_relay_state":{"state":1}}}', 'AAAAKtDygfiL/5r31e+UtsWg1Iv5nPCR6LfEsNGlwOLYo4HyhueT9tTu36Lfog=='),
	array('{"system":{"set_relay_state":{"state":0}}}', 'AAAAKtDygfiL/5r31e+UtsWg1Iv5nPCR6LfEsNGlwOLYo4HyhueT9tTu3qPeow=='),
	array('{ "system":{ "get_sysinfo":null } }', 'AAAAI9Dw0qHYq9+61/XPtJS20bTAn+yV5o/hh+jK8J7rh+vLtpbr'),
	array('{ "emeter":{ "get_realtime":null } }', 'AAAAJNDw0rfav8uu3P7Ev5+92r/LlOaD4o76k/6buYPtmPSYuMXlmA=='),
	);

foreach ($tests as $t) {

	$encrypted_sample = $t[1];
	$encrypted = base64_encode(tp_encrypt($t[0]));

	if ($encrypted !== $encrypted_sample) {
		print 'NOOOOOOOPE!!!!1 😡';
	}

	$decrypted_sample = $t[0];
	$decrypted = tp_decrypt(base64_decode($t[1]));

	if ($decrypted !== $decrypted_sample) {
		print 'NOOOOOOOPE!!!!1 😡';
	}
}

echo tp_decrypt(tp_encrypt("Hello World.\r\n"));