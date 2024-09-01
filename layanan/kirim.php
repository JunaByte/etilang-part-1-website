<?php 
$url = 'https://fcm.googleapis.com/fcm/send';
$msg = array
(
	'body'  => "Maaf! Pengaduan anda ditolak",
	'title'     => "Pemberitahuan",
	'sound'     => 'default'
);
$fields = array
(
	'registration_ids'  => 'eeg8oWIvT9-v8UtBzMhiF6:APA91bEjPQ89_jWZo0MXmA-a0DNjZl7GhTqY6f0ogD1GHqYmhkFBvw6QWSGORIBcYa468TTASnJDO4aOPRmEqnL4VLw5m0px_pQwfxAX-51m5XftG9mhZb9y6cDi0Ks1vOa5AFymfpp9',
	'notification'          => $msg
);
$headers = array(
	'Authorization:key =AAAAu2kdeoA:APA91bFgy7K5SlbLU5NHy-nstXKNDJm5e2ijgohuL_cBYzmf0P9usipAaYXqC71VBB7sXAXH8_lARnICyVfWpDIEoLHmTGADqQcMkYOE2A1pYoGnmMuyjqG7YK7G-zJTPJGMqywEYpHP',
	'Content-Type: application/json'
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
$result = curl_exec($ch);
if ($result === FALSE) {
	die('Curl failed: ' . curl_error($ch));
}
curl_close($ch);

return $result;
?>