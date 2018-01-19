<?php
use yii\helpers\Html;
use yii\helpers\Url;

	$touxiang="";
	$name="wangshanshan";
	$people ="12311";
	$times="";
	$place ="";
$this->context->layout = false;

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" /> 
		<meta http-equiv="cache-control" content="no-cache" /> 
		<meta content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport" /> 
		<meta content="telephone=yes" name="format-detection" /> 
		<meta content="email=no" name="format-detection" /> 
		<title>农场</title>
		<?=Html::cssFile('@web/css/farm.css')?>
		<?=Html::cssFile('@web/css/rule.css')?>
		<?=Html::cssFile('@web/css/noPrize.css')?>
		<?=Html::cssFile('@web/css/havePrize.css')?>
		<?=Html::cssFile('@web/css/swiper-3.4.2.min.css')?>
		<?=Html::cssFile('@web/css/animate.min.css')?>
		<!--<link rel="stylesheet" href="css/farm.css" />
		<link rel="stylesheet" href="css/rule.css" />
		<link rel="stylesheet" href="css/noPrize.css" />
		<link rel="stylesheet" href="css/havePrize.css" />
		<link rel="stylesheet" href="css/swiper-3.4.2.min.css" />-->
		<style>
			#form{
				position: absolute;
				display: none;
				top: 49%;
				width: 100%;
				height: 100px;
				line-height: 100px;
				text-align: center;
				background: rgba(2555,255,255,.7);
			}
			#sub{
				height: 35px;
				display: inline-block;
				width: 17%;
			}
		</style>
	</head>
	<body>
		<div class="farm">
			<?= Html::img('@web/img/锄头.png',['class'=>'hoe']) ?>
			<div id="mcover" onClick="document.getElementById('mcover').style.display='';" style="">
<!--				--><?//= Html::img('@web/img/tishi.png') ?>
				<?= Html::img($head_imgurl) ?>
			</div>
			<div class="header">
				<div class="left">
					<div class="touxiang">
						<?= Html::img('@web/img/touxiang.png') ?>
					</div>
					<div class="xinxi">
						<p class="name"><?php echo $user_name ?></p>
						<input placeholder="编辑个性签名" class="sign"></input>
					</div>
				</div>
				<div class="right">
					<div class="rule">
						<?= Html::img('@web/img/rule.png') ?>
					</div>
					<div class="share" onClick="document.getElementById('mcover').style.display='block';">
						<?= Html::img('@web/img/share.png') ?>
					</div>
				</div>
			</div>
			<div class="place">
				<div class="row">
					<div class="pice"><?= Html::img('@web/img/flower.png') ?></div>
					<div class="pice"><?= Html::img('@web/img/flower.png') ?></div>
					<div class="pice"><?= Html::img('@web/img/flower.png') ?></div>
				</div>
				<div class="row">
					<div class="pice"><?= Html::img('@web/img/flower.png') ?></div>
					<div class="pice"><?= Html::img('@web/img/flower.png') ?></div>
					<div class="pice"><?= Html::img('@web/img/flower.png') ?></div>
				</div>
				<div class="row">
					<div class="pice"><?= Html::img('@web/img/flower.png') ?></div>
					<div class="pice"><?= Html::img('@web/img/flower.png') ?></div>
					<div class="pice"><?= Html::img('@web/img/flower.png') ?></div>
				</div>
			</div>
			<div class="joinNum">
				<span class="num"><?php echo $user_count ?></span>
				<span class="times"><?php echo $rest_time ?></span>
			</div>
			<div class="joinName">
				<p class="title">
					<span>地区</span>
					<span>网名</span>
					<span>奖项</span>
				</p>
				<div class="swiper-container">
				  <div class="swiper-wrapper">
					  <?php foreach ($prize_to_user as $prize):?>
					<div class="swiper-slide" >
				    	<p>
							<span > <?= Html:: encode($prize["region"])?></span >
							<span > <?= Html:: encode($prize["username"])?></span >
							<span id = "phone" > <?= Html:: encode($prize["prize_name"])?></span >
						</p >
				    </div >
					  <?php endforeach; ?>
				    <!--<div class="swiper-slide">
				    	<p>
							<span>保定</span>
							<span>你是谁的我</span>
							<span>10844738369</span>
						</p>
				    </div>
				    <div class="swiper-slide">
				    	<p>
							<span>地区</span>
							<span>网名</span>
							<span>974824982972</span>
						</p>
				    </div>
				    <div class="swiper-slide">
				    	<p>
							<span>地区</span>
							<span>网名</span>
							<span>18909876543</span>
						</p>
				    </div>-->
				  </div>
				</div>
			</div>
		</div>
		<!--活动规则-->
		<div class="actRule">
			<p class="time">
				<span>活动时间：即日起至1月22日</span>
			</p>
			<p class="type">
				<span>进入辽宁电信公众平台，点击菜单栏翼优惠中选择“0元拿神器”，或回复关键字“砍价”，即可参与活动。</span>
			</p>
			<p class="require">
				<span>每人仅限一次兑奖机会，兑换成功后恢复原价；奖品数量有限，先到先得。</span>
			</p>
			<p class="prize">
				<span>iPhone5C+iFree互联网专属卡</span>
			</p>
			<p class="tip">
				<span>1.本次活动支持任何分享方式。但不允许作弊，一经发现，取消参与资格。</span>
				<span>2.奖品发放时间：在活动结束后7个工作日内发放。</span>
				<span>3.本次活动的iPhone5c为大陆行货未拆封版，iFree卡为0套餐、0合约，前六个月免费接打电话的互联网专属卡。</span>
				<span>4.客服电话：024-31003672</span>
				<span>5.本活动最终解释权归辽宁电信所有</span>
			</p>
		</div>
		<!--没中奖页面-->
		<div class="noPrize animated zoomIn" id="noPrize">
			<div class="unluck">
				<p class="text">还有时间，再玩一次吧~</p>
				<a class="more">再来一次 </a>
			</div>
		</div>
		<!--中间跳转页面-->
		<div class="havePrize animated zoomIn" id="havaPrize">
			<p class="text">抽中微盟优惠劵一张</p>
			<div class="detail">
				<div class="left">
					<span class="dash" id="dash">20元</span>
					<span class="type" id="type">现金券</span>
				</div>
				<div class="right">
					<span class="get1">点击</span>
					<span class="get2">领取></span>
				</div>
			</div>
			<!--填写手机号-->
			<form id="form" class="form" action="<?= Url::toRoute('/site/phone') ?>" method="post" onsubmit="return check_number()">
				<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
				<label style="font-size: 18px">请输入手机号</label>
				<input name="mobile" id="mobile" style="height: 30px;" type="text" />
				<input  id="sub" type="submit" value="完成" >
			</form>
		</div>

	</body>
	<?=Html::jsFile('@web/js/jquery.min.js')?>
	<?=Html::jsFile('@web/js/swiper-3.4.2.min.js')?>
	<?=Html::jsFile('@web/js/swiper.animate1.0.2.min.js')?>
	<!--<script type="text/javascript" src="js/jquery.min.js" ></script>
	<script type="text/javascript" src="js/swiper-3.4.2.min.js" ></script>
	<script type="text/javascript" src="js/page.js" ></script>-->
	<script> 
		var mySwiper = new Swiper('.swiper-container',{
			autoplay: 5000,//可选选项，自动滑动
			direction : 'vertical',
			height: 22,
			loop: true,
		});
		/*锄头锄地效果*/
		$(".place").mouseover(function(){
			$(".farm .hoe").css("display","inline-block");
		})
		$(".place").mouseout(function(){
			$(".farm .hoe").css("display","none");
		})
		$('.place .pice').on('click',function () {
			console.log($(this).offset().top,$(this).offset().left);
			$(".hoe").css({
				"top":$(this).offset().top-21,
				"left":$(this).offset().left+90
			});
			$(".farm .hoe").addClass('ani');
			$(this).children().addClass("anii");
//        $(this).removeClass('ani')
			setTimeout(function () {
				$('.farm .hoe').removeClass('ani')
				$(this).children().removeClass("anii");
				get_prize();
			},500)
		});
		/*验证手机号码*/
		function check_number(){
			var num = $("#mobile").val();
			if (num == "") {
				alert("手机号码不能为空！");
				document.getElementById("mobile").focus;
				return false;
			}else if(!num.match(/^0?(13[0-9]|15[012356789]|18[012346789]|14[57]|17[678]|170[059]|14[57]|166|19[89])[0-9]{8}$/)){
				alert("手机号码格式不正确！");
				document.getElementById("mobile").focus;
				return false;
			}else{
				$("#havaPrize form").hide();
				alert("领取成功");
				$("#havaPrize").hide();
				return true;
			}

		}
		/*抽奖*/
		function get_prize() {
			$.ajax({
				type: 'GET',
				url: '<?= Url::toRoute('/site/get-prize') ?>',
				data: {},
				dataType: "json",
				cache: false,
				success: function (data) {
					$(".joinNum .times").html(data.rest_time);
					if(data.prize_name=="没中奖"){
						$("#noPrize").show();
					}else if(data.prize_name=="没次数"){
						alert("您今日的次数已经用完");
					}else if (data.prize_name == "10元代金券") {
							$("#havaPrize").show();
							$("#text").text("抽中微盟代金券一张");
							$("#dash").text("10元");
							$("#havaPrize .right").click(function () {
								alert("领取成功");
//								$("#havaPrize").hide();
								window.location.reload();
							})

						} else if (data.prize_name == "50元代金券") {
							$("#havaPrize").show();
						$("#text").text("抽中微盟代金券一张");
						$("#dash").text("50元");
							$("#havaPrize .right").click(function () {
								alert("领取成功");
//								$("#havaPrize").hide();
								window.location.reload();
							});

						} else if (data.prize_name == "300元代金券") {
							$("#havaPrize").show();
						$("#text").html("抽中微盟代金券一张");
						$("#dash").text("300元");
							$("#havaPrize .right").click(function () {
								alert("领取成功");
//								$("#havaPrize").hide();
								window.location.reload();
							});

						} else if (data.prize_name == "手机流量") {
							$("#havaPrize").show();
							$("#text").text("抽中流量代金券一张");
							$("#dash").text("30M");
							$("#type").text("流量券");
							$("#havaPrize .right").click(function () {
								if(data.phone == 0){
									$("#havaPrize form").show();
								}else {
									$("#havaPrize form").hide();
									alert("领取成功");
//									$("#havaPrize").hide();
									window.location.reload();
								}
							})
						} else if (data.prize_name == "三七粉（罐装）") {
							$("#havaPrize").show();
							$("#havePrize .text").text("抽中一罐三七粉");
							$("#havePrize .detail .left .dash").text("三七粉");
							$("#havePrize .detail .left .type").text("一罐");
							$("#havaPrize .right").click(function () {
								alert("领取成功");
//								$("#havaPrize").hide();
								window.location.reload();
							})
						}
				},
				error: function (data) {
					console.log('error');
				}
			});
		}
		/*规则展示*/
		$(".rule").click(function(){
			$(".actRule").css("display","block");
			$(".actRule").click(function () {
				$(this).hide();
			})
		})
		/*未中奖再来一次跳转*/
		$("#noPrize .more").click(function(){
			$(this).parent().parent().css("display","none");
		})

		/*获取流量接口*/


	</script>
</html>
