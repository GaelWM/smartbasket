<?php
   // ini_set('display_errors', '1');
   // error_reporting(E_ALL & ~E_STRICT & ~E_NOTICE & ~E_WARNING);
   
   include_once("_framework/_zori.cls.php");
   include_once("_framework/_zori.details2.cls.php");
   include_once("includes/product.category.cls.php");

   $page = new Zori();
   //print_rr($_REQUEST);//die("uigyrfui");
//events
   switch($Action)
   {
      case "Reload":
         windowLocation("?Action=Edit&ProductCategoryID=$ProductCategoryID");
         break;

      case "Save":
         $Message = ProductCategory::Save($ProductCategoryID);
         break;

      case "Delete":
         $Message = ProductCategory::Delete($_POST[chkSelect]);
         break;
   }
//nav

   switch($Action)
   {
      case "Save":
      case "Edit":
      case "New":
         $page = new ZoriDetails();
         $page->AssimulateTable("tblProductCategory", $ProductCategoryID, "strProductCategory");

         $page->renderControls();
         $page->ContentBootstrap[0]["col-md-6"] = $page->renderTabs($page->ToolBar->Label) . $page->getJsZoriValidateSave($JS);
      break;

      case "Export":
         $page = new ProductCategory("");
         $page->isPageable = 0;
         $page->Content = $page->getList();
         $page->renderExcel($page->Entity->Name);
      break;

      default:
         $page = new ProductCategory(array("ProductCategoryID"));
         $page->isPageable = 1;
         $page->isSortable = 1;
         $page->ContentBootstrap[0]["col-md-10"] = $page->getList();
         break;
   }
   
   $page->Message->Text = $Message;
   $page->Display();
?>

 