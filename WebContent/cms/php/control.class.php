<?php
	class CmsControl
	{
		private $currentDirectory;
		public $session;
		public $cms;		
		public $data;
		public $error;
							
		function __construct($currentDirectory) {
			$this->currentDirectory = $currentDirectory;
			$this->cms = new CMS($currentDirectory);
			$this->session = new CmsSession($currentDirectory);
		}	

		function Process()
		{	
			if (isset($_GET['authenticate'])) {				
				$this->session->Login();
				if (!$this->session->Authenticated()) {
					header("Location: ".$_SERVER['SCRIPT_NAME'].$_SERVER['PATH_INFO']."?login&error");
					return;
				}
			}

			if (isset($_GET['demo'])) {	
				$this->session->demo = true;
			}
			
			if (isset($_GET['logout'])){
				$this->session->Logout();
				header("Location: ".$_SERVER['SCRIPT_NAME'].$_SERVER['PATH_INFO']);
				return;
			}			

			if (isset($_GET['save'])){
				if ($this->session->Authenticated()) {
					$page = new CmsPage($this->currentDirectory); 
					$this->data = $page->Save($_SERVER['PATH_INFO']);

					if ($this->data) {
						header("Location: ".$_SERVER['SCRIPT_NAME'].$_SERVER['PATH_INFO']."?msg=page+saved");
					} else {
						header("Location: ".$_SERVER['SCRIPT_NAME'].$_SERVER['PATH_INFO']."?".urlencode($page->errorMessage));
					}
				}
				return;
			}	

			if (isset($_GET['template']) & isset($_GET['id'])){
				if ($this->session->Authenticated()) {
					$page = new CmsPage($this->currentDirectory); 
					$this->data = $page->SetTemplate($_GET['id'], $_GET['template']);

					if ($this->data) {
						header("Location: ".$_SERVER['SCRIPT_NAME'].$_SERVER['PATH_INFO']."?msg=template+changed+to+".$_GET['template']);
					} else {
						header("Location: ".$_SERVER['SCRIPT_NAME'].$_SERVER['PATH_INFO']."?".urlencode($page->errorMessage));
					}
				}
				return;
			}			
						
			if ($this->session->Authenticated()) {
				setcookie("cms_fullname", $this->session->user->Fullname(), 0, "/", $_SERVER['SERVER_NAME']); 
				$this->cms->fullname = $this->session->user->Fullname();
			}

		
			switch ($_SERVER['PATH_INFO']) {
				case "/_json/users":
					if ($this->session->Authenticated()) {
						$user = new CmsUser($this->currentDirectory); 
						$this->data = $user->View();
						$this->json();
					} else {
						$this->data = false;
						$this->json();
					}
					break;	
							
				case "/_json/pages":
					$page = new CmsPage($this->currentDirectory); 
					$this->data = $page->View($_GET['path']);
					$this->json();
					break;	
					
				case "/_json/pages/paths":
					$page = new CmsPage($this->currentDirectory); 
					$this->data = $page->ViewPaths();
					$this->json();
					break;
						
				case "/_json/pages/pathtree":
					$page = new CmsPage($this->currentDirectory); 
					$this->data = $this->TreeView("Pages", $page->ViewPaths());
					$this->json();
					break;
					
				case "/_cms/page/new":
					if ($this->session->Authenticated()) {
						$page = new CmsPage($this->currentDirectory); 
						$this->data = $page->Create();
						
						if ($this->data) {
							header("Location: ".$_SERVER['SCRIPT_NAME'].$this->data."?msg=page+created&editmode");
						} else {
							header("Location: ".$_SERVER['HTTP_REFERER']."?msg=error+page_not+created");
						}
					}
					break;	
					
				case "/_cms/pages/delete":
					if ($this->session->Authenticated()) {
						$page = new CmsPage($this->currentDirectory); 
						$this->data = $page->Delete($_GET["id"]);
						if ($this->data) {
							echo "<div id=\"cms-status-message\">Delete action completed.</div>";
						} else {
							echo "<div id=\"cms-error-message\">".$page->errorMessage."</div>";
						}
					}				
					break;	

				case "/_cms/page/set/homepage":
					if ($this->session->Authenticated()) {
						$page = new CmsPage($this->currentDirectory); 
						$this->data = $page->SetHomepage($_GET["id"]);
						if ($this->data) {
							echo "<div id=\"cms-status-message\">Homepage set</div>";
						} else {
							echo "<div id=\"cms-error-message\">".$page->errorMessage."</div>";
						}
					}				
					break;

				case "/_cms/linkcheck":	
					$data = array();
					$data["url"] = $_GET['url'];
					$data["status"]	= $this->LinkResponse($_GET['url']);
					$this->data = $data;
					$this->json();
					break;

				case "/_cms/user/new":
					if ($this->session->Authenticated()) {
						$user = new CmsUser($this->currentDirectory); 
						$this->data = $user->Create();
						if ($this->data) {
							echo "<div id=\"cms-status-message\">New user created.</div>";
						} else {
							echo "<div id=\"cms-error-message\">".$user->errorMessage."</div>";
						}
					}				
					break;

				case "/_json/user/exists":
					if ($this->session->Authenticated()) {
						$user = new CmsUser($this->currentDirectory); 
						$this->data = $user->Exists($_GET['user']);
						$this->json();
					}				
					break;
					
				case "/_cms/users/delete":
					if ($this->session->Authenticated()) {
						$user = new CmsUser($this->currentDirectory); 
						$this->data = $user->Delete($_GET["id"]);
						if ($this->data) {
							echo "<div id=\"cms-status-message\">Delete action completed.</div>";
						} else {
							echo "<div id=\"cms-error-message\">".$page->errorMessage."</div>";
						}
					}				
					break;	
																				
				case "/_json/files":
					$file = new CmsFile($this->currentDirectory); 
					$this->data = $file->View($_GET['path'], $_GET['filetype']);
					$this->json();
					break;
															
				case "/_json/files/paths":
					$file = new CmsFile($this->currentDirectory); 
					$this->data = $file->ViewPaths($_GET['term'], "", "10");
					$this->json();
					break;	
					
				case "/_json/files/pathtree":
					$file = new CmsFile($this->currentDirectory); 
					if ($_GET['filetype'] == "") {
						$label = "Files";
					} else {
						$label = ucwords($_GET['filetype']);
					}
					$this->data = $this->TreeView($label, $file->ViewPaths("", $_GET['filetype'], ""));
					$this->json();
					break;
											
				case "/_json/files/categories":
					$file = new CmsFile($this->currentDirectory); 
					$this->data = $file->ViewCategories($_GET['term']);
					$this->json();
					break;	
																				
				case "/_cms/file/new":
					if ($this->session->Authenticated()) {
						$file = new CmsFile($this->currentDirectory); 
						$this->data = $file->Save();
						
						if ($this->data) {
							echo "<div id=\"cms-status-message\">".$this->data."</div>";
						} else {
							echo "<div id=\"cms-error-message\">".$file->errorMessage."</div>";
						}
					}
					break;
						
				case "/_cms/files/delete":
					if ($this->session->Authenticated()) {
						$file = new CmsFile($this->currentDirectory); 
						$this->data = $file->Delete($_GET['id']);
						if ($this->data) {
							echo "<div id=\"cms-status-message\">".$this->data."</div>";
						} else {
							echo "<div id=\"cms-error-message\">".$file->errorMessage."</div>";
						}						
					}	
					break;	
					
				case "/_cms/spelling/check":
					$spell = new CmsSpell($this->currentDirectory);
					$this->data = $spell->Check($_REQUEST['words']);
					$this->json();
					break;

				case "/_cms/html/tidy":
					$tidy  = new CmsTidy($this->currentDirectory);
					$this->data = $tidy->Repair($_REQUEST["html"], $_REQUEST["options"]);
					$this->json();
					break;
																					
				default:		
					//Load standard page
					$page = new CmsPage($this->currentDirectory); 
					$this->data = $page->Load($_SERVER['PATH_INFO']);
					
					if ($this->data) { 
						$this->cms->id = $this->data->id;
						include(CMS_TEMPLATE_PATH."/".$this->data->template.".dwt.php");
					} else {
						include(CMS_TEMPLATE_PATH."/error.dwt.php");
					}
					break;
			}
		}

		function CmsScript()
		{					
			if (isset($_GET['login'])) {
				$this->cms->ControlScript();
				return;
			}
			
			if ($this->session->Authenticated()) {
				$this->cms->ControlScript();
			}

			if ($this->session->Demo()) {
				$this->cms->demoMode = true;
				$this->cms->ControlScript();
			}
		}
		
		function CmsControls()
		{					
			if (isset($_GET['login'])) {
				$this->cms->LoginDialog();
				return;
			}
			
			if ($this->session->Authenticated()) {
				$this->cms->ControlRibbon();
			}

			if ($this->session->Demo()) {
				$this->cms->demoMode = true;
				$this->cms->ControlRibbon();
			}
		}
		
		function json()
		{
			header('Content-type: application/json');
			echo json_encode($this->data);
		}
		
		function TreeView($label, $paths) {
			$tree = new CmsTreeNode($label);
			$tree->state = "open";
			$tree->attr["id"] = "root"; 
			
			foreach($paths as $p) {
				$this->AddTreeViewNodes($tree, $p->path);
			}
			
			return $tree;
		}
	
		function AddTreeViewNodes($parent, $path)
		{
				$p = trim($path, "/");
				$pn = substr($p, 0, strpos($p, "/"));
				if ($pn == "") {
					$pn = $p;
					$cn = "";
				} else {
					$cn = substr($p, strpos($p, "/"));				
				}
				$i = $parent->index($pn);
				if ($i === false) {	
					$child = $parent->addNode($pn);
				} else {
					$child = $parent->children[$i];
				}
				if ($cn != "") {
					$this->AddTreeViewNodes($child, $cn);	
				}				
		}
		
		function LinkResponse($url, $timeout = 30) {
			$curl = curl_init();
			$opts = array(CURLOPT_RETURNTRANSFER => true,
			              CURLOPT_URL => $url,
                          CURLOPT_NOBODY => true,               
                          CURLOPT_TIMEOUT => $timeout);
                          
			curl_setopt_array($curl, $opts); 
			curl_exec($curl);
			$data = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			curl_close($curl);
			
			return $data;
		}
	}
?>
