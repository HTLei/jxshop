<?php
$config = array (	
		//应用ID,您的APPID。*******
		'app_id' => "2016091600527533",

		//商户私钥**********
		'merchant_private_key' => "MIIEogIBAAKCAQEAm2+EgtHLVWl7JTvVf9VLGwe/SSC5P8oZjfHUzjhZhEkp8u7JtNaHbeufnWwi2ayvsRe+wxFJXa6t8fIbOUKggaJVup5fYmnyzp5GTwdGmF1lS2pBPRYvVQWnuAGy+FmFdzvoDLmcaizD9+vPx06YbxKQTVlPF1mU9CVT9k1FwXXn9lVYWmGb94wo0G1jAYk0AFdetQRkxksu59TBYYKYFPTaqLP3qHwTFWdMM/ysxxydEHoJyOhEF89QUq9SN3NT2bfex1XCD21JE4yzfDKwTwQD+ns6iZsKDJcPsIZ1WpVQnTughiGkWUuF3kjRQ9cU9TwUSFk8W2rgL1SZC+SWaQIDAQABAoIBABXWIeCbBpzWN8WwVTsjROzkNrxYS44pn1NwsPvTsMfD24/UeiPcq6QGoSLliTPZbclMU7Fl4U+29Zry714o/RGZM8AG9dGGnuTmGWyK0iEfpdZldArX7ghcxgY0vubi9Lwef2giP1YvOcy/pS4T3ZhlHD6xmEnofOObxuLoUi9uX/im7EunZQYXhPsn9bcE9V4LY8r/iVZUa5uVyIzAnLN3GezXkabpQrMdDfSXu74NVut1X7RwwGYM+xMybK1H0TsCy31Nq40dst3H+u2X1Aqv15sJA4o2S7CVjUf//2YodPqq+PUXyc05lUVjPS6BmAJkA506ko8I54jOtrkGsY0CgYEAzVxZtwz3H9pQ3IpONOKN47Kdx0TizgY0JbrwAbAN8p2Wx2o8R0iDYcfZUSbYb3Qmep1JdI/Nk4xpQuYdCoYqq/dH9qDLjh2bS5hTYGWzbsrSc6KIGE8Xexsec+ua4dB8ombmvpma0t3hn56CHLD8LVDpDHgOS1WMyfLAq7DuITcCgYEAwcOVAOhTamquWkvvRp4kiaMmAeuMUpqr2X1gwUp9TxL/Rv2Vu3vHYKFksDzyZ17/rCVFrqt0CAY684hj56mYjY7a1KgUHpGNerOPnIE4HP6CvwDuTrXON6OcUFGwVznpNrQC3k62gbWZQ+WeURg92SfspxLTIs3+mlFstRz5VV8CgYANcVgmFWEv4picdyk7aQEkwJJ3ctjt55YOSjhfw+iF0y8Firy7ZdHD2tMs7sAIO7AxIo6mZKtuVyikym9oOvQcIanCSTBJ80IxJp1+l+mw/PHdw+vou3SsCFBsAiY3VfByqQ29uExcNU4JptSZkDRRuxQmTs2QvN7kcVGPa5uK7QKBgEYL+nXVhzJVVqp2AQ46ZWMMg9T13kiOecmqNawqzZokd/yl99dLLAyWy9uabNdJ1Iva/ZHjkZLFDdK0X8mD2g5yslFmYb+bRtYwy538aNiyeXmrUHtL5jze/MdcgK9H1DNeaBsNwZSqnbmZ7N3MMa+razYK7CEM7xnCjdX7n3dpAoGATIhskb2oCOQ+ODJQL/J8q2diNwj8rw/T+VesFdwQeVDRaWfN/1LyG6QxIAR2dvSj22i4KP7Je1dh5oj9uTaoB5uNyjPgtdZgL/AJV/LVo3IWLLiC+nRS3RkJfXT9NLyMUs7YvAm0V+F3DAmkwghsX8yC9reWKrpYEAQPxItbmvw=",
		
		//异步通知地址
		'notify_url' => "http://外网可访问网关地址/alipay.trade.page.pay-PHP-UTF-8/notify_url.php",

		//同步跳转
		'return_url' => "http://外网可访问网关地址/alipay.trade.page.pay-PHP-UTF-8/return_url.php",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关*******
//		'gatewayUrl' => "https://openapi.alipay.com/gateway.do",
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。*********
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA2sLjrtbDLaq49ZdRURe/k0kBUnIBH3IGZqyNAFzeRns50/dXoofLcaeBwBMGmnWnR56SXnc1HfoR2E9nmCe9sH0xlxVb0SnFlfvILc7kDs2D6bv2oMnaf5f3gFxps4RYH0bMp+9uCDcgtF8PvYy3jjLWejfrP7GdJuTRlqYeOkefXENgBOQ6xrOeLW58ixmPO3ozkRXYsjVCjfoHVoiVZ1GqEK/1YpL9r0JIboJagStiIdZeqooPShKGFCYphCcGNiRjif4uR3wOaXahnrS8LJdewBEB3Y2mFVspZ7x3iHPIYdro2d/QUugYyeD4lLJHwXkaU9+mcikJYV4kaWCPUQIDAQAB",
);