<?php
   // ini_set('display_errors', '1');
   // error_reporting(E_ALL & ~E_STRICT & ~E_NOTICE & ~E_WARNING);
   
   include_once("_framework/_zori.cls.php");
   include_once("_framework/_zori.details2.cls.php");
   include_once("includes/picture.cls.php");

   $page = new Zori();
   //print_rr($_REQUEST);//die("uigyrfui");
//events
   switch($Action)
   {
      case "Reload":
         windowLocation("?Action=Edit&PictureID=$PictureID");
         break;

      case "Save":
         $Message = Picture::Save($PictureID);
         break;

      case "Delete":
         $Message = Picture::Delete($PictureID);
         break;
   }
//nav

   switch($Action)
   {
      case "Save":
      case "Edit":
      case "New":
         $page = new ZoriDetails();
         $page->AssimulateTable("tblPicture", $PictureID, "strPicture");

         $page->Fields["strPicture"]->Label = "Picture Name";
         //$page->Fields["intEntityID"]->Type = "label";
         $page->Fields["strPictureLink"]->Label = "Picture";
         $page->Fields["strPictureLink"]->Type="file";
         $page->Fields["strPictureLink"]->ajaxFunction = "UploadPicture";
         $page->Fields["strPictureLink"]->strPath = $page->SystemSettings["PicturesLink"];
         $page->Fields["strPictureLink"]->ajaxParams = "&PictureID=". $PictureID;


         $page->renderControls();
         //print_rr($page->Fields["strPictureLink"]);

         $page->ContentBootstrap[0]["col-md-6"] = $page->renderTabs($page->ToolBar->Label) . $page->getJsZoriValidateSave($JS);
      break;

      case "Export":
         $page = new Picture("");
         $page->isPageable = 0;
         $page->Content = $page->getList();
         $page->renderExcel($page->Entity->Name);
      break;

      default:
         $page = new Picture(array("PictureID"));

         // $js="
         // <script>
         //    $('document').ready(function(){
         //       $('#trigger').click(function(){
         //          $('#myModal').modal('show');
         //          return false;
         //       });
         //    });
         // </script>
         // ";
         // $Modal = "
         // <div id='myModal' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
         //    <img src='".$SystemSettings[PicturesLink]."/$row->strPictureLink' />
         // </div>";

         $arrPic = $page->getList();
         if(count($arrPic) > 0){
         foreach($arrPic as $i => $htmlPic)
         {
            $page->ContentBootstrap[]["col-md-10 card card-width"] = $htmlPic;
         }}
         $page->ToolBar->Label = "All Pictures";
         unset($page->ToolBar->Buttons[btnDelete]);
         unset($page->ToolBar->Buttons[btnExport]);
         break;
   }
   
   $page->Message->Text = $Message;
   $page->Display();
?>

 