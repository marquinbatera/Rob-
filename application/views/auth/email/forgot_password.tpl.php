<!-- <html>
<body>
	<h1><?php echo sprintf(lang('email_forgot_password_heading'), $identity);?></h1>
	<p><?php echo sprintf(lang('email_forgot_password_subheading'), anchor('auth/reset_password/'. $forgotten_password_code, lang('email_forgot_password_link')));?></p>
</body>
</html> -->
<html>
<body style="background-color: #FFF; color: #555555; font-family: Arial, Calibri, Verdana; font-size: 14px; font-weight: normal">
    <div style="width: 600px; border-radius: 4px; background-color: #FFFFFF; border: 1px solid #EEE; margin: 0 auto">
        <div style="display: block; padding: 20px; background-color: #F5F5F5; text-align: center; border-top-left-radius: 4px; border-top-right-radius: 4px; border-bottom: 1px solid #EEE">
        	<div style="display: table-cell; vertical-align: middle">
        	<a href="http://bolsa.turbosite.com.br/robo"><img src="http://bolsa.turbosite.com.br/robo/assets/img/controle.png" style="width: 168px; height: auto" /></a>
        </div>
       		<div style="display: table-cell; vertical-align: middle; padding-left: 268px">
        	<a href="http://bolsa.turbosite.com.br/robo" style="display: inline-block; padding: 6px 12px; font-size: 16px; line-height: 1.42857143; text-align: center; white-space: nowrap; vertical-align: middle; border-radius: 4px; color: #5cb85c; background-color: #FFF; text-decoration: none; display:block; width: 100px; border: 1px solid #EEE;">Login</a>
    	</div>
    	</div>
        <div style="padding: 20px">
            <h1 style="text-align: center; font-weight: normal; color: #5cb85c">Recuperação de senha</h1>
            <p>Olá Usuário,</p>
            <p>Para realizar a troca de senha, por favor clique no link abaixo.</p>
            <p><?php echo sprintf(lang('email_forgot_password_subheading'), anchor('auth/reset_password/'. $forgotten_password_code, lang('email_forgot_password_link')));?></p>
            <!--<p><a href="#" style="display: inline-block; padding: 12px; font-size: 16px; line-height: 1.42857143; text-align: center; white-space: nowrap; vertical-align: middle; border-radius: 4px; color: #fff; background-color: #5cb85c; text-decoration: none; margin: 40px auto; display:block; width: 200px" >Confirm Password Reset</a></p>-->
            <p><strong>Importante:</strong> Se você não conseguir realizar a troca de senha, por favor nos avise <a href="security:contacts@turbosite.com.br/" style="color: #5cb85c">contato@turbosite.com.br</a></p><p>Agradecemos a paciência, equipe Brothes traders!</p>
            Brothers traders Equipe de suporte.<br>
            <a href="mailto:suporte@turbosite.com.br/" style="color: #5cb85c">suporte@turbosite.com.br</a>
        </div>
    </div>
    <p style="text-align: center; font-size: 12px">Adicionar <a href="mailto:contato@turbosite.com.br/" style="color: #5cb85c">contato@turbosite.com.br</a> para sua lista segura de emails.</p>
</body>
</html>
