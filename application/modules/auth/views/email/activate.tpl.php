<html>
<body>
	<h1><?php echo sprintf(lang('email_activate_heading'), $identity);?></h1>
	<p><?php echo sprintf(lang('email_activate_subheading'), anchor(base_url().'index.php/auth/activate/'. $id .'/'. $activation .'/'.$url, lang('email_activate_link')));?></p>
</body>
</html>