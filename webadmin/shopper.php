<?php
   // ini_set('display_errors', '1');
   // error_reporting(E_ALL & ~E_STRICT & ~E_NOTICE & ~E_WARNING);
   
   include_once("_framework/_zori.cls.php");
   include_once("_framework/_zori.details2.cls.php");
   include_once("includes/shopper.cls.php");

   $page = new Zori();
   //print_rr($_REQUEST);//die("uigyrfui");
//events
   switch($Action)
   {
      case "Reload":
         windowLocation("?Action=Edit&ShopperID=$ShopperID");
         break;

      case "Save":
         $Message = Shopper::Save($ShopperID);
         break;

      case "Delete":
         $Message = Shopper::Delete($_POST[chkSelect]);
         break;
   }
//nav

   switch($Action)
   {
      case "Save":
      case "Edit":
      case "New":
         $page = new ZoriDetails(array("Details", "Security", "Profile Picture"));
         $page->AssimulateTable("tblShopper", $ShopperID, "strShopper");
         //print_rr($page->Fields);
         $page->Fields["refTitleID"]->Tab =
         $page->Fields["refShoppingListID"]->Tab =
         $page->Fields["strShopper"]->Tab =
         $page->Fields["strName"]->Tab =
         $page->Fields["strSurname"]->Tab =
         $page->Fields["strEmail"]->Tab =
         $page->Fields["strTel"]->Tab =
         $page->Fields["strCell"]->Tab =
         $page->Fields["dtDateRegistered"]->Tab = 
         $page->Fields["txtAddress"]->Tab = "Details";

         $page->Fields["strPassword"]->Type = "password";
         $page->Fields["strPassword"]->Tab = "Security";
         $page->Fields["strPasswordConfirm"] = nCopy($page->Fields["strPassword"]);
         $page->Fields["strPasswordConfirm"]->Label = "Confirm Password";
         $page->Fields["strPasswordConfirm"]->COLUMN_NAME = "strPasswordConfirm";
         $page->Fields["strPasswordConfirm"]->html->name = "strPasswordConfirm";
         $page->Fields["strPasswordConfirm"]->html->id = "strPasswordConfirm";
         $page->Fields["strPasswordConfirm"]->html->onchange = "if($('#strPassword').val() != $('#strPasswordConfirm').val() && $('#strPassword').val() != ''){ alert('Passwords do not match.');}";
         $page->Fields["strPasswordConfirm"]->Order = 20;
         $page->Fields["strPasswordConfirm"]->Tab ="Security";
         
         ## ALL THE FIELDS UNDER Profile Picture TAB
         $page->Fields["Profile:Picture"]->Label = "Profile Picture";
         $page->Fields["Profile:Picture"]->Type="file";
         $page->Fields["Profile:Picture"]->ID =
         $page->Fields["Profile:Picture"]->Name = $ShopperID;
         $page->Fields["Profile:Picture"]->ajaxFunction = "UploadProfilePicture";
         $page->Fields["Profile:Picture"]->strPath = $page->SystemSettings["ProfileImageDirAdmin"];
         $page->Fields["Profile:Picture"]->ajaxParams = "&ShopperID=". $ShopperID;
         $page->Fields["Profile:Picture"]->Tab = "Profile Picture";
         

         $page->renderControls();
         $page->ContentBootstrap[0]["col-md-6"] = $page->renderTabs($page->ToolBar->Label) . $page->getJsZoriValidateSave($JS);
      break;

      case "Export":
         $page = new Shopper("");
         $page->isPageable = 0;
         $page->Content = $page->getList();
         $page->renderExcel($page->Entity->Name);
      break;

      default:
         $page = new Shopper(array("ShopperID"));
         $page->isPageable = 1;
         $page->isSortable = 1;
         $page->ContentBootstrap[0]["col-md-10"] = $page->getList();
         break;
   }
   
   $page->Message->Text = $Message;
   $page->Display();
?>

 