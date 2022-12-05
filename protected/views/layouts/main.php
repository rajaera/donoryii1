<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<table style="width:100%;">
			<tr>
				<td style="width: 10%;padding-left:10px;"><?php echo CHtml::image("images/main-logo.jpg", Yii::app()->name, array('style' => 'width:60px;height:60px;'));?></td>
				<td><div style="font-size:1.2em;"><?php  echo CHtml::encode(Yii::app()->name);?></div></td>
			</tr>
		</table>		
	</div><!-- header -->
	<div>
		<?php
		foreach (Yii::app()->user->getFlashes() as $key => $message) {
			echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
		}
		?>
	</div>	
	
	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> The Children of Light Organization.<br/>
		All Rights Reserved.<br/>
		Developed by <a href="mailto:rajaera@gmail.com">Eranga Perera</a>.<br>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
