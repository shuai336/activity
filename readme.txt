1.本系统是配合微盟平台使用
2.系统需要商户提供aid client_id client_secret redirect_uri，进行用户授权获取code, 再换取access_token
3.系统需要获取到的access_token openid 发送请求获取微信用户的本公众号关注情况
4.进入系统，系统会主动发送请求获取用户授权并得到code， 拿到code后系统会发送请求获取openid access_token，
  成功拿到openid access_token后，系统判断用户是否已经关注公众号，没有关注则跳转到公众号进行关注，关注则直接跳转到抽奖页面
5.
