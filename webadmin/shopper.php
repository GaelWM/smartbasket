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
         $page = new ZoriDetails();
         $page->AssimulateTable("tblShopper", $ShopperID, "strShopper");
         //print_rr($page->Fields);

         ## ALL THE FIELDS UNDER Profile Picture TAB
         $page->Fields["Profile:PicturePath"]->Label = "Profile Picture";
         $page->Fields["Profile:PicturePath"]->Type="file";
         $page->Fields["Profile:PicturePath"]->ID =
         $page->Fields["Profile:PicturePath"]->Name = $ShopperID;
         $page->Fields["Profile:PicturePath"]->ajaxFunction = "UploadProfilePicture";
         $page->Fields["Profile:PicturePath"]->strPath = $page->SystemSettings["ProfileImageDirAdmin"];
         $page->Fields["Profile:PicturePath"]->ajaxParams = "&ShopperID=". $ShopperID;
         $page->Fields["strPassword"]->Type = "hidden";
         

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

 