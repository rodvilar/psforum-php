<?php 
	require_once('conf.php');
	header('Cache-Control: no-cache, must-revalidate');
	header('Expires: Mon, 10 Jul 2000 02:00:00 GMT');
	header('Content-type: application/json');
	
	$title=isset($_POST['title'])? rawurldecode($_POST['title']): false;
	$message=isset($_POST['message'])? rawurldecode($_POST['message']): false;
	$tags=isset($_POST['tags'])? rawurldecode($_POST['tags']): false;
	$cat=isset($_POST['cat'])? rawurldecode($_POST['cat']): false;
	$web=isset($_POST['web'])? $_POST['web']: false;
	/*if($web!=13){
		$respon['status']=0;
		$respon['m']='<div class=\'error\'>Se perdieron parametros</div>';
		echo json_encode($respon);
		die();
	}*/
	if($web==1){
		$respon['status']=0;
		$respon['m']='<div class=\'error\'>Saltando server local de pruebas</div>';
		echo json_encode($respon);
		die();
	}
	if(!$title || !$message || !$tags || !$cat || !$web){
		$respon['status']=0;
		$respon['m']='<div class=\'error\'>Se perdieron parametros</div>';
		echo json_encode($respon);
		die();
	}else{
		try{
			$result=$db->prepare("SELECT url,user,password,web_id,musica,juegos,descargas,cine,tutoriales,libros FROM website LEFT JOIN slots on website.id=slots.web_id WHERE website.id=:id LIMIT 1");
			$result->bindParam(':id',$web, PDO::PARAM_INT);
			$result->execute();
			$result=$result->fetch(PDO::FETCH_ASSOC);
			if(!empty($result)){
				$category=$result[$cat];
				if($category==0){
					$respon['status']=0;
					$respon['m']='<div class=\'error\'>Saltandose foro</div>';
					echo json_encode($respon);
					die();
				}
				$urlWebsite=$result['url'];
				$username=$result['user'];
				$password=$result['password'];
				if($curl->login($urlWebsite, $username, $password)){
					if($params=$curl->readParams($urlWebsite, $username, $password)){
						$sc=$params['sc'];
						$sequm=$params['seqnum'];
						if($curl->preview($urlWebsite, $message)){
							$post_data['tags']=$tags;
							$post_data['categorias']=$category;
							$post_data['additional_options']=0;
							$post_data['sc']=$sc;
							$post_data['seqnum']=$sequm;
							$post_data['topic']='';
							$post_data['subject']=$title;
							$post_data['message']=$message;
							if($curl->post($urlWebsite, $post_data)){
								$respon['status']=1;
								$respon['m']='<div class=\'ok\'>Agregado post a '.$urlWebsite.'</div>';
								echo json_encode($respon);
								die();
							}else{
								$respon['status']=0;
								$respon['m']='<div class=\'error\'>Error al postear</div>';
								echo json_encode($respon);
								die();
							}
						
						}else{
								$respon['status']=0;
								$respon['m']='<div class=\'error\'>Error En preview</div>';
								echo json_encode($respon);
								die();
						}
					}else{
								$respon['status']=0;
								$respon['m']='<div class=\'error\'>Error leyendo parametros</div>';
								echo json_encode($respon);
								die();
						}
				
				}else{
								$respon['status']=0;
								$respon['m']='<div class=\'error\'>Error en login</div>';
								echo json_encode($respon);
								die();
						}
			}
			
		}catch(PDOException $e){
			$respon['status']=0;
			$respon['m']='<div class=\'error\'>'.$e->getMessage().'</div>';
			echo json_encode($respon);
			die();
		
		}
	
	
	}