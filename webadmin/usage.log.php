<?php
   ini_set('display_errors', '1');
   error_reporting(E_ALL & ~E_STRICT & ~E_NOTICE & ~E_WARNING);

   
   include_once("_framework/_zori.cls.php");
   include_once("_framework/_zori.details2.cls.php");
   include_once("includes/usage.log.cls.php");

   $page = new Zori();

//events
   switch($Action)
   {
      case "Reload":
         windowLocation("?Action=Edit&LoginID=$LoginID");
         break;

      case "Delete":
         $Message = UsageLog::Delete($_POST[chkSelect]);
         break;
   }
//nav
   switch($Action)
   {
      case "Save":
      case "Edit":
      case "New":
         $page = new ZoriDetails();
         $page->AssimulateTable("sysLogin", $LoginID, "strUsername");
         //print_rr($page->Fields);
         $page->renderControls();
         $page->ContentBootstrap[0]["col-md-6"] = $page->renderTable($page->ToolBar->Label) . $page->getJsZoriValidateSave();
      break;

      default:
         $page = new UsageLog(array("LoginID"));

         $page->isPageable = 1;
         $page->ContentBootstrap[0]["col-md-10"] = $page->getList();
         break;
   }

   $page->Message->Text = $Message;
   $page->Display();
?>

 