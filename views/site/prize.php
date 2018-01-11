<?php
use yii\helpers\Html;

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
		<!--<link rel="stylesheet" href="css/farm.css" />
		<link rel="stylesheet" href="css/rule.css" />
		<link rel="stylesheet" href="css/noPrize.css" />
		<link rel="stylesheet" href="css/havePrize.css" />
		<link rel="stylesheet" href="css/swiper-3.4.2.min.css" />-->
	</head>
	<body>
		<div class="farm">
			<?= Html::img('@web/img/锄头.png',['class'=>'hoe']) ?>
			<div id="mcover" onClick="document.getElementById('mcover').style.display='';" style="">
				<img src="img/tishi.png">
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
		<div class="noPrize">
			<div class="unluck">
				<p class="text">还有时间，再玩一次吧~</p>
				<a class="more">再来一次 </a>
			</div>
		</div>
		<!--中间跳转页面-->
		<div class="havePrize">
			<p class="text">抽中微盟优惠劵一张</p>
			<div class="detail">
				<div class="left">
					<span class="dash">20元</span>
					<span class="type">现金券</span>
				</div>
				<div class="right">
					<span class="get1">点击</span>
					<span class="get2">领取></span>
				</div>
			</div>
		</div>
	</body>
	<?=Html::jsFile('@web/js/jquery.min.js')?>
	<?=Html::jsFile('@web/js/swiper-3.4.2.min.js')?>
	<?=Html::jsFile('@web/js/page.js')?>

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
		$(".rule").click(function(){
			$(".actRule").css("display","block");
			
		})
		
	</script>
</html>
