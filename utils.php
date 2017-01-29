<?php 

function tp_decrypt ( $cypher_text , $first_key = 0xAB ) {
	$header = substr($cypher_text, 0, 4);

	$header_length = unpack('N*', $header)[1];

	$cypher_text = substr($cypher_text, 4);
	$buf = unpack('c*', $cypher_text );

	$key = $first_key;
	$nextKey;
	for ($i = 1; $i < count($buf)+1; $i++) {
		$nextKey = $buf[$i];

		$buf[$i] = $buf[$i] ^ $key;
		$key = $nextKey;
	}

	$array_map = array_map('chr', $buf);
	$clear_text = implode('', $array_map);

	$cypher_length = strlen($clear_text);
	if ($header_length !== $cypher_length) {
		trigger_error("Length in header ({$header_length}) doesn't match actual message length ({$cypher_length}).");
	}

	return $clear_text;
}

function tp_encrypt ( $clear_text , $first_key = 0xAB ) {
	$buf = unpack('c*', $clear_text );

	$key = $first_key;
	for ($i = 1; $i < count($buf)+1; $i++) {
		$buf[$i] = $buf[$i] ^ $key;
		$key = $buf[$i];
	}

	$array_map = array_map('chr', $buf);
	$clear_text = implode('', $array_map);

	$length = strlen($clear_text);
	$header = pack('N*', $length);

	return $header . $clear_text;
}
