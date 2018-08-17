<?php
class Db_Operation
{
	public $Data=array();
	public $DataCount;
	public $DataStr='';
	public $DataId;
	public $menu_html=NULL;
	public $menu_htmlmob=NULL;
	private $Db_Config;
	private $PDO;
	private $Menu=NULL;
	
	function __construct()
	{
		if(ERROR)	error_reporting(E_ALL);
		else	error_reporting(0);		
		require_once("DB_Config.php");
		require_once('Static_Operation.php');
	
		$this->Db_Config=new DB_Config();
		Static_Operation::Data_slash();
		Static_Operation::Data_clean();
	}
	
	public function Dbdestroy()
	{
		$this->Db_Config->Connect=NULL;
	}
	
	public function Insert($Table,$Data)
	{
		$Query="INSERT INTO ".$Table." (";
		$Query.=implode(" , ",array_keys($Data)).") VALUES (  ";
		$i=0;
		$j=1;
		$Data=array_values($Data);	
		while($i<count($Data))
		{
			if($Data[$i]=='NULL' || $Data[$i]=='Now()' )
			{
				$Query.='?,';
			}else
				$Query.="?,";
			$i++;
		}
		$Query=substr($Query,0,-1).')';	

		$result=$this->Db_Config->Connect->prepare($Query);
		while($j<=count($Data))
		{
          $result->bindParam($j,$Data[$j-1]);
          $j++;
		}	
		try{
		if($this->DataCount=$result->execute()>0){
			$this->DataId=$this->Db_Config->Connect->lastInsertId();
			return true;
		}else
			return false;
		}catch(PDOException $e){
			echo 'Connection failed: ' . $e->getMessage();
			}		
	}

public function myquery($Query)
	{
				//echo $Query;//die;
		$this->PDO =$this->Db_Config->Connect->query($Query);
		$this->Data = $this->PDO->fetchAll(PDO::FETCH_ASSOC);
		$this->DataCount=count($this->Data);
		
		if(count($this->Data)>0)	return true;
		else	return false;
					
	}

	public function Update($Table,$Data,$Condition)
	{
		$Query="UPDATE ".$Table." set ";
		foreach($Data as $k=>$v)
			$Query.=$k." = '".$v."' , ";
			
		$Query=substr($Query,0,-2);
		
		for($i=0;$i<count($Condition);$i++)
			$Query.=" ".$Condition[$i][0]." ".$Condition[$i][1]."='".$Condition[$i][2]."'";
		
		//echo $Query;die;
		$this->DataCount=$this->Db_Config->Connect->exec($Query);
		//echo $this->DataCount;
		if($this->DataCount>0)
			return true;
		else
			return false;		
	}
	
	public function Boolean_Update($Table,$Column,$Condition)
	{
		$Query="UPDATE ".$Table." set ".$Column."= NOT ".$Column;
		
		for($i=0;$i<count($Condition);$i++)
			$Query.=" ".$Condition[$i][0]." ".$Condition[$i][1]."='".$Condition[$i][2]."'";
		
		//echo $Query;die;
		$this->DataCount=$this->Db_Config->Connect->exec($Query);
		if($this->DataCount>0)
			return true;
		else
			return false;		
	}
	
	public function Delete($Table,$Condition)
	{
		$Query="DELETE FROM ".$Table;
		for($i=0;$i<count($Condition);$i++)
			$Query.=" ".$Condition[$i][0]." ".$Condition[$i][1]."='".$Condition[$i][2]."'";
		
		//echo $Query;die;
		$this->DataCount=$this->Db_Config->Connect->exec($Query);
		if($this->DataCount>0)
			return true;
		else
			return false;		

	}
	
	public function Fetch($Table,$Column,$Condition,$Condition2=NULL)
	{
		$Query="SELECT ";
		if(empty($Column))
			$Query.="* ";
		else
			$Query.=implode(" , ",$Column);
			
		$Query.=" FROM ".$Table;
			
		for($i=0;$i<count($Condition);$i++)
			$Query.=" ".$Condition[$i][0]." ".$Condition[$i][1]."='".$Condition[$i][2]."'";
			
		if(!empty($Condition2))	
				$Query.=$Condition2;
				
		//echo $Query;die;
			
		$this->PDO =$this->Db_Config->Connect->query($Query);
		$this->Data = $this->PDO->fetchAll(PDO::FETCH_ASSOC);
		//var_dump($this->Data);
		$this->DataCount=count($this->Data);
		if(count($this->Data)>0)	return true;
		else	return false;
					
	}

	public function FetchSingle($Table,$Column,$Condition,$Condition2=NULL)
	{
		$Query="SELECT ".$Column." FROM ".$Table;
			
		for($i=0;$i<count($Condition);$i++)
			$Query.=" ".$Condition[$i][0]." ".$Condition[$i][1]."='".$Condition[$i][2]."'";
		
		if(!empty($Condition2))	
			$Query.=$Condition2;
				
		//echo $Query;//die;
		$this->PDO =$this->Db_Config->Connect->query($Query);
		$this->Data = $this->PDO->fetch(PDO::FETCH_ASSOC);
		//var_dump($this->Data);
		if(count($this->Data))
		{
			$this->DataCount=$this->Data;
			$this->DataStr=$this->Data[$Column];
			return true;
		}else{
			return false;
			}		
	}
	
	public function FetchMenu($Table)
	{
		$this->Fetch($Table,array('menu_id','parent_id'),NULL,' Order by menu_wt');
		$data=$this->Data;
		$this->Fetch($Table,array('menu_id'),array(array('WHERE','parent_id',0)),' Order by menu_wt');
		var_dump($this->Data);
		$this->Menu[0]=$this->Data;
	}

	public function Render_MenuMobile($Table,$parent_id)
	{
		$Query="SELECT * from ".$Table." WHERE parent_id=$parent_id order by menu_wt";
		//echo $Query;
		$this->PDO =$this->Db_Config->Connect->query($Query);
		$Data = $this->PDO->fetchAll(PDO::FETCH_ASSOC);
//var_dump($Data);
		if(empty($Data)) return;
		
		if($parent_id==0)
		{
			$this->menu_htmlmob.='<nav class="phone-menu"><ul><li>';
			$i=1;
			$this->menu_htmlmob.='<a>Home</a><ul>';
			while($i<count($Data))
			{
				$this->Fetch(TABLE_LINK,NULL,array(array('WHERE','link_id',$Data[$i]['menu_link'])));
				//$this->Data;
				$Menupage=$this->Data[0];
				if($Menupage['link_type']==1)
				{
					$href=WEB_ADDRESS.'/'.$Menupage['page_id'];
				}
				if($Menupage['link_type']==2)
				{
					$this->FetchSingle(TABLE_PAGE,'page_name',array(array('WHERE','page_id',$Menupage['page_id'])));
					$href=WEB_ADDRESS.'/'.$this->DataStr.'.html';
				}
				if($Menupage['link_type']==3)
				{
					$href=WEB_ADDRESS.'/'.'index.php?cat=cat_name&cat_id='.$Menupage['page_id'];				
				}
				
				
				$this->menu_htmlmob.="\r\n<li><a href=\"{$href}\">{$Data[$i]['menu_title']}</a>";
				$this->Render_MenuMobile($Table,$Data[$i]['menu_id']);
				$this->menu_htmlmob.="</li>";
				$i++;
			}
			
		}else{
			$i=0;
			$this->menu_htmlmob.='<ul>';
			while($i<count($Data))
			{
				$this->Fetch(TABLE_LINK,NULL,array(array('WHERE','link_id',$Data[$i]['menu_link'])));
				//$this->Data;
				$Menupage=$this->Data[0];
				if($Menupage['link_type']==1)
				{
					$href=WEB_ADDRESS.'/'.$Menupage['page_id'];
				}
				if($Menupage['link_type']==2)
				{
					$this->FetchSingle(TABLE_PAGE,'page_name',array(array('WHERE','page_id',$Menupage['page_id'])));
					$href=WEB_ADDRESS.'/'.$this->DataStr.'.html';
				}
				if($Menupage['link_type']==3)
				{
					$href=WEB_ADDRESS.'/'.'Blog/$Menupage[page_id]';//Blog/category_name				
				}
				
				
				$this->menu_htmlmob.="\r\n<li><a href=\"{$href}\">{$Data[$i]['menu_title']}</a>";
				$this->Render_MenuMobile($Table,$Data[$i]['menu_id']);
				$this->menu_htmlmob.="</li>";
				$i++;
			}
			$this->menu_htmlmob.='</ul>';	
		}
				return $this->menu_htmlmob;

	}

	public function Render_Menu($Table,$parent_id)
	{	
		$Query="SELECT * from ".$Table." WHERE parent_id=$parent_id order by menu_wt";
		//echo $Query;
		$this->PDO =$this->Db_Config->Connect->query($Query);
		$Data = $this->PDO->fetchAll(PDO::FETCH_ASSOC);

		if(empty($Data)) return;
		
		
		if(count($Data)<6 || $parent_id==0){
			
			if($parent_id==0){
				$this->menu_html.="<ul>\r\n";
			}else{
				$this->menu_html.="\r\n<ul>";
			}
				
			$i=0;
			while($i<count($Data)){
				$this->Fetch(TABLE_LINK,NULL,array(array('WHERE','link_id',$Data[$i]['menu_link'])));
				//$this->Data;
				$Menupage=$this->Data[0];
				if($Menupage['link_type']==1)
				{
					$href=WEB_ADDRESS.'/'.$Menupage['page_id'];
				}
				if($Menupage['link_type']==2)
				{
					$this->FetchSingle(TABLE_PAGE,'page_name',array(array('WHERE','page_id',$Menupage['page_id'])));
					$href=WEB_ADDRESS.'/'.$this->DataStr.'.html';
				}
				if($Menupage['link_type']==3)
				{
					$href=WEB_ADDRESS.'/'.'index.php?cat=cat_name&cat_id='.$Menupage['page_id'];				
				}
				
				
				$this->menu_html.="\r\n<li class='menu-item-icon ".$Data[$i]['menu_name']."'><a href=\"{$href}\">{$Data[$i]['menu_title']}</a>";
				$this->Render_Menu($Table,$Data[$i]['menu_id']);
				$this->menu_html.="</li>";
				$i++;
			}
		$this->menu_html.="\r\n</ul>";
		}else{
			$tags=array('Web Design'=>8,'Web Development'=>14,'SEO'=>20,'E-Commerce Solution'=>24);
			$this->menu_html.='<ul class="big-sub-menu"><ul class="clearfix">';
			$i=0;
			foreach($tags as $k=>$v){
			$this->menu_html.='<li>
						<ul>
						<li>
							<a> '.$k.'</a>
								<ul>';
						
					while($i<$v){
						$this->Fetch(TABLE_LINK,NULL,array(array('WHERE','link_id',$Data[$i]['menu_link'])));
						//$this->Data;
						$Menupage=$this->Data[0];
						if($Menupage['link_type']==1)
						{
							$href=WEB_ADDRESS.'/'.$Menupage['page_id'];
						}
						if($Menupage['link_type']==2)
						{
							$this->FetchSingle(TABLE_PAGE,'page_name',array(array('WHERE','page_id',$Menupage['page_id'])));
							$href=WEB_ADDRESS.'/'.$this->DataStr.'.html';
						}
						if($Menupage['link_type']==3)
						{
							$href=WEB_ADDRESS.'/'.'index.php?cat=cat_name&cat_id='.$Menupage['page_id'];				
						}
						
						
						$this->menu_html.="\r\n<li><a href=\"{$href}\">{$Data[$i]['menu_title']}</a>";
						$this->Render_Menu($Table,$Data[$i]['menu_id']);
						$this->menu_html.="</li>";
						$i++;
					}
				
			$this->menu_html.='</ul>
					</li>
				</ul>
			</li>';
				
			}
		$this->menu_html.='</ul>
				</ul>';
		}
		return $this->menu_html;
	}
	

	
	public function Count($Table,$Column,$Condition,$Condition2=NULL)
	{
		$Query="SELECT ";
		if(empty($Column))
			$Query.="* ";
		else
			$Query.=implode(" , ",$Column);
			
		$Query.=" FROM ".$Table;
			
		for($i=0;$i<count($Condition);$i++)
			$Query.=" ".$Condition[$i][0]." ".$Condition[$i][1]."='".$Condition[$i][2]."'";
			
		if(!empty($Condition2))	
				$Query.=$Condition2;
				
		//echo $Query;//die;
			
		$this->PDO =$this->Db_Config->Connect->query($Query);
		$this->DataCount = $this->PDO->rowCount();
		
		
	}
	
	public function Set_Session($Data)
	{
		
	}
	
	public function Check($Table,$ColumnData)
	{
		$Query='Select * From '.$Table.' Where';
		foreach($ColumnData as $k=>$v)
			$Query.=" ".$k."'".$v."'";
			//echo $Query;//die;
		$this->PDO =$this->Db_Config->Connect->query($Query);
		$this->DataCount = $this->Db_Config->Connect->rowCount();
			
		if($this->DataCount>0)
		
			return true;
		else
			return false;
				
	}
	
	private function PasswordHash($Password)
	{
		
		return md5(SALT.$Password);

	}
	
	public function Login($User_name,$Password)
	{

		$Query='Select * from '.TABLE_USER.' WHERE '.'user_name=:user_name AND password =:password';
		$this->PDO = $this->Db_Config->Connect->prepare($Query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$this->PDO->execute(array(':user_name' => $User_name, ':password' => $this->PasswordHash($Password)));
		//$this->PDO = $this->Db_Config->Connect->query($Query);
		$this->Data = $this->PDO->fetchAll(PDO::FETCH_ASSOC);

		$this->DataCount = count($this->Data);
		// echo $this->DataCount;
		// exit;
		if($this->DataCount>0)
		{
			unset($this->Data[0]['password']);
			$_SESSION['USER']=$User_name;
			return true;
		}else
			return false;
	}
	
	private static function Hkey()
	{
		return pack('H*',KEY);
	}
	
	public function Encrypt($String)
	{
		
		$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB), MCRYPT_RAND); //mcrypt_create_iv($iv_size, MCRYPT_RAND)
		
		$ciphertext = base64_encode($iv.mcrypt_encrypt(MCRYPT_BLOWFISH , Db_Operation::Hkey(), $String, MCRYPT_MODE_ECB, $iv));
		
		return $ciphertext;
	}
	
	public function Decrypt($String)
	{
		
		$String=base64_decode($String);
		
		$iv_dec = substr($String, 0, mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB));  //substr($String, 0, $iv_size)
		
		$String = substr($String, mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB));
		
		$plaintext_dec = mcrypt_decrypt(MCRYPT_BLOWFISH, Db_Operation::Hkey(), $String, MCRYPT_MODE_ECB, $iv_dec);
		
		
        return rtrim($plaintext_dec, "\0");		
	}
}
