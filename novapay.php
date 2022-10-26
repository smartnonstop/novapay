<?php


$url = 'https://api-qecom.novapay.ua/v1';
$merchant_id = "1";
$private_key = <<<EOD
-----BEGIN RSA PRIVATE KEY-----
MIIEowIBAAKCAQEA7YQwYDqNbDIbUXZL2HYvZX6wi59DgsMlYjwpoSgHvn0RTnWl
/uR2sIJ9tquYh5Ya+TtUhzrc0N6mZPTLUuyK4qKq2NJaG2Xdr2M5LhMjF46llWkD
qMW/CcMdVTTE4b1FxOOXURNmZ7nWCchuiVU9nm0K5qYAQpPJFzwg9uDljYgcMp3N
9L1WaiyzIqJqL4R9L39j2t4yOUb4m44xyjujGViHm5lQBNklkOcsxMlb0T3AVNcA
+KckSl32TdvvmSx9BwzK4SDqQAR8MtKA4hbeA3KGCflRlJKv5KcCpPOOzaoUlaTN
OLmJIhl0/VjpsKqLNMQOyRSkpRVCFhgp6sO/ewIDAQABAoIBAEBaqbTZCIqBRQ+c
as56rzrjybf67hLXByEHxgvJSdfeETtd+x0GD/ahVKiS8+AA1swivDNrynq5aQI/
pXuRZcwkYQAgdpOn1Rn5W3vVaZOvbcP+0SQAeFOPzznP82xqmSXQuKYaCIwgORMr
gG+rbeeoCeUWo0lmu3yVKSVbKDdhXQqQB0EiC1rZoEKr9iKOAS5Hvi7pU/bxpH3a
xEGh8ov8E89UtubiIL+LhqsN5dVgowWiaPbA945z497VgjAu+/I2jQ6HhuyPNhK1
SMa0LExXN5xmzF3WJ8ofVMS/hJbLYWgidfUi+MYCgm3W1YtpnNFBKDiDa83cEWqo
r5/GJYECgYEA9w9yXkAsUe3c3Qw1lGSZJNzSlbwCKA4wMaiLhsZWfyLrkzzQnY+t
tu+5Tfa3EU3bLof3juwSBSVwYcb3ZJWGeVURYQwO3ZirZQ3xxEQTI5FTCuJRPMsf
8oiq6NxgZrK3NdtmtecH6+IvrO/J3UPKc8a+iop3zR2tTU4rs2jAbMECgYEA9hxV
yAGXZavNHfrqIn9NCZLySaYrMKSZj36xCcksHK7do77OmsqAp8wQuxYIPoABNO/8
bd2ry33b8Zd3dv5iRI3GMmmrxQ7yDviKeUptKKBZsm9CWEcGnmNOia+ZyJbRl9Fp
jnrtUNOCQxwz144eTAKLV2JUD6Kgfr1ee1EDbzsCgYEA7Q0zLV/hppLWUno+hq2n
i4kdvXHxl8FVWLBhf+WaZM56voGhoSyU/2wwnq/Uo5PSdGkdjVLRT4LGu+qOwUH/
DzgiPr21HcY43fNtQGYY/w2XYmAYln5HnwynAFtDXAaqZ9CmUm7kWN5j5EkHpXhA
LqpJdOC7ZmHNQNl6cOBXkYECgYA7Qi9VbSyrCmblJRljHQvLllpIaX5UxA1Fg9fU
5197uI8dckAE/WVlAbm1kmSByAiCWpaJTaqj4LYowbO+LxoyL4DdepwlYqfd+vI8
qjMGaTWvxSJQZyms0XSDqoh4x/fHemDUMb0ajRL8XboN2OZqnuI2NDLRYPMMEUTC
pIsTKQKBgGqbsr+cn+Ny2cPO8KCx1y6WWrT2X5k286rjAMGxNNG/aNqejpTixAaJ
dA8rov0FcJ03MOhw69XYxkVGpLqWhtMjiWSYuHJBSspvp0QcD9nQykXDLfO7FeeA
p8WexL0FZSkNlkMbcpMI6U0g51cwacZeGA3qXoKWzWfz2Brmom90
-----END RSA PRIVATE KEY-----
EOD;


$data = "{
	\"merchant_id\": \"".$merchant_id."\",
	\"client_first_name\": \"Василий\",
	\"client_last_name\": \"Степанов\",
	\"client_patronymic\": \"Иванович\",
	\"client_phone\": \"+380504456245\",
	\"client_email\": \"vasya125@gmail.com\",
	\"callback_url\": \"https://youtube.com\",
	\"success_url\": \"https://google.com\",
	\"fail_url\": \"https://facebook.com\"
}";


$binary_signature = "";

openssl_sign($data, $binary_signature, $private_key, OPENSSL_ALGO_SHA1);


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url.'/session');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: application/json", "x-sign: $binary_signature"));
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$response = curl_exec($ch);
curl_close($ch);



var_dump($response);


