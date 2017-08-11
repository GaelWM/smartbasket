<?php
//20161207 - added function to reset password - maanie
//2017/03/08 - delete the previous uploaded file for a new upload file - neils

//20170327 - added SP ddl reload DeptStatus - pj/r
//20170327 - added Client ddl reload Contact and ClientDetails - R
//20170328 - AddProposal Ajax added - CL //20170328 - Delete Proposal Item Ajax added - CL
//20170328 - ReorderProposalItems Ajax added - CL //20170328 - Move Proposal Item Ajax added - CL
//20170405 - Move Proposal Group Ajax added - CL //20170405 - Move Proposal Widget added - CL
//20170410 - Delete Proposal Group Ajax added - CL //20170410 - AddProposal Group Ajax added - CL
//20170423 - Getting Contact details for Contact quick detail's view on the ticket page. - Gael
//20170423 - Getting Client details for Client quick detail's view on the ticket page. - Gael
//20170506 - Check if Account code is unique - Gael
//20170506 - Getting All contacts of the Client to fill in synchronize the client and contact ddls on the Ticket page. - Gael
//20170508 - Set approval message on the Approved by field when selecting the client in the ddl on the Ticket page. - Gael
//20170509 - Show book signed for client where book signed is requested on the Time page. - Gael
//20170517 - Get all the task details when user select task on the Time page. - Gael
//20170602 - Save ticket details to the session variable. - Gael
//20170602 - check if client has a default contact - Gael
//20170717 - Add Product Dropdown ajax search - CL.
//20170720 - AddProposal Ajax added , modified for Product Bundle- CL 
//20170720 - Move Product Bundle Item Ajax modified from Move Proposal Item- CL
//20170720 - Delete Product Bundle Item Ajax added - CL
//20170807 - Add ajax to handle new calendar  -CL 
//20170807 - Add ajax to update details for crmTime on the calendar -CL 
//20170807 - Add ajax to change calendar date -CL 
//20170807 - Add ajax to delete calendar time entry -CL 
//20170807 - Add ajax to get time details for the calender -CL

include_once("systems.php");
// include_once("includes/proposal.cls.php");
// include_once("includes/product.bundle.cls.php");
// include_once("_framework/_nemo.widget.cls.php");

$type = $_REQUEST['type'];
//print_rr($_SESSION);
switch($type)
{

   case "SendResetEmail": //20161207 - added function to reset password - maanie
      $strOutput = SendResetEmail($_REQUEST['strEmail']);
      break;

   case "UploadProfilePicture":  //2017/01/10 - added upload file implementations - neils
      deleteCurrentFile($type, $_REQUEST["UserID"], $_REQUEST["Path"]);
      //echo checkFileType($_FILES["file"]);
      if (checkFileType($_FILES["file"])){
            //print_rr($_FILES["file"]);
            $strFileName = $_REQUEST["UserID"] ."_". date("y-m-d") ."_". str_replace(" ", "_", $_FILES["file"]["name"]);
            //print_rr($strFileName);

            $result = UploadFileAjax($_FILES["file"], $_REQUEST["Path"], $strFileName);

            if ($result){

               //save
               $xdb->doQuery("UPDATE sysUser SET `Profile:PicturePath` = '$strFileName' WHERE UserID = ".$_REQUEST["UserID"]."", 0);

               echo "File upload successful.";
               //return true;
            } else {
               echo "WARNING: File upload failed. [WHY??]";
               //return false;
            }
            die;
            //$status = User::UpdateProfilePicture($UserID, $strFileName);
            //echo $status;
      }
      else {
         echo 0;
      }

      //steps
      //1st upload the file

      //2nd  update the database for the user.

      //return success, if both succeeded.


      // $strFileName = UploadFileAjax("uploads/", $_FILES["file"]);
      // echo $strFileName;
      //$status = User::UpdateProfilePicture($UserID, $strFileName);
      //echo $status;
      break;

   case "UploadPicture":  //2017/01/10 - added upload file implementations - neils
      //deleteCurrentFile($type, $_REQUEST["PictureID"], $_REQUEST["Path"]);
      //echo checkFileType($_FILES["file"]);
      if (checkFileType($_FILES["file"])){
            //print_rr($_FILES["file"]);
            $strFileName = $_REQUEST["PictureID"] ."_". date("y-m-d") ."_". str_replace(" ", "_", $_FILES["file"]["name"]);
            //print_rr($strFileName);

            $result = UploadFileAjax($_FILES["file"], $_REQUEST["Path"], $strFileName);

            if ($result){

               //save
               if($_REQUEST[PictureID] != NULL){
                  $xdb->doQuery("UPDATE tblPicture SET strPictureLink = '$strFileName' WHERE PictureID = ".$_REQUEST["PictureID"]."", 0);
               }else{
                  //$xdb->doQuery("INSERT INTO tblPicture ( strPictureLink ) VALUES ('$strFileName') WHERE PictureID = ".$_REQUEST["PictureID"]."", 0);
               }
               

               echo "File upload successful.";
               //return true;
            } else {
               echo "WARNING: File upload failed. [WHY??]";
               //return false;
            }
            die;
            //$status = User::UpdateProfilePicture($UserID, $strFileName);
            //echo $status;
      }
      else {
         echo 0;
      }

      //steps
      //1st upload the file

      //2nd  update the database for the user.

      //return success, if both succeeded.


      // $strFileName = UploadFileAjax("uploads/", $_FILES["file"]);
      // echo $strFileName;
      //$status = User::UpdateProfilePicture($UserID, $strFileName);
      //echo $status;
      break;


   case "UploadProduct":  //2017/01/10 - added upload file implementations - neils
      deleteCurrentFile($type, $_REQUEST["ProductID"], $_REQUEST["Path"]); //die;
      if (checkFileType($_FILES["file"])){
            //print_rr($_FILES["file"]);
            $strFileName = $_REQUEST["ProductID"] ."_". date("y-m-d") ."_". str_replace(" ", "_", $_FILES["file"]["name"]);
            // $strFileName = "product_". date("y-m-d") ."_".$_REQUEST["ProductID"]."";
            //print_rr($strFileName);

            //echo "<br>$strFileName"; die;

            $result = UploadFileAjax($_FILES["file"], $_REQUEST["Path"], $strFileName);

            if ($result){

               //save
               $xdb->doQuery("UPDATE crmProduct SET `strFilename` = '$strFileName' WHERE ProductID = ".$_REQUEST["ProductID"]."", 0);

               echo "File upload successful.";
               //return true;
            } else {
               echo "WARNING: File upload failed. [WHY??]";
               //return false;
            }
            die;
      }
      else {
         echo 0;
      }
      break;

   case "UploadDocument":  //2017/01/10 - added upload file implementations - neils
      $result = UploadFileAjax("uploads/", $_FILES["file"]);
            if($result)
      {
         $xdb->doQuery("UPDATE eduTrainingCertificate SET eduTrainingCertificate.strFileName = '$strFileName' WHERE TrainingCertificateID = ".$_REQUEST[TrainingCertificateID]."", 0);
         //return "File upload successful.";
         echo "File upload successful.";
      }else{
         //return "WARNING: File upload failed. [WHY??]";
         echo "WARNING: File upload failed. [WHY??]";
      }
      break;

   case "UploadTrainningCertificate":  //2017/01/10 - added upload file implementations - neils
      deleteCurrentFile($type, $_REQUEST["TrainingCertificateID"], $_REQUEST["Path"]);
      $strFileName = $_REQUEST["TrainingCertificateID"] ."_". date("y-m-d") ."_". str_replace(" ", "_", $_FILES["file"]["name"]);
      $result = UploadFileAjax($_FILES["file"], $_REQUEST["Path"], $strFileName);

      if($result)
      {
         $xdb->doQuery("UPDATE eduTrainingCertificate SET eduTrainingCertificate.strFileName = '$strFileName' WHERE TrainingCertificateID = ".$_REQUEST[TrainingCertificateID]."", 0);
         //return "File upload successful.";
         echo "File upload successful.";
      }else{
         //return "WARNING: File upload failed. [WHY??]";
         echo "WARNING: File upload failed. [WHY??]";
      }

      break;

   // lst Areas Gael
   case "LoadAreas":
      $strOutput = getAreas($_REQUEST[area]);
      echo $strOutput;
      break;

   case "InsertNewArea":
      $strOutput = createArea($_REQUEST[item]);
      echo $strOutput;
      break;

   // Getting Client details for Client quick detail's view on the ticket page. - Gael
   case "getClientDetails":
      $strOutput = getClientDetails($_REQUEST[ClientID]);
      break;

   // Getting Contact details for Contact quick detail's view on the ticket page. - Gael
   case "getContactDetails":
      $strOutput = getContactDetails($_REQUEST[ContactID]);
      break;

   // Getting All contacts of the Client to fill in synchronize the client and contact ddls on the Ticket page. - Gael
   case "getClientContacts":
      $strOutput = getClientContacts($_REQUEST[ClientID]);
      header("Content-type: application/json");
      // print_rr($strOutput);
      echo json_encode($strOutput);
      die;

   //20170802 - Getting Ticket Due Date to default it as new task due date - Rachel
   case "getTicketDueDate":
      $strOutput = getTicketDueDate($_REQUEST[TicketID]);
      header("Content-type: application/json");
      // print_rr($strOutput);
      echo json_encode($strOutput);
      die;

   //20170802 - Setting default Contact for a Client - Rachel
   case "hasDefaultContact":
      $strOutput = hasDefaultContact($_REQUEST[ClientID]);
      header("Content-type: application/json");
       // print_rr($strOutput);
      echo json_encode($strOutput);
      die;

   // Getting All tickets of the Client
   case "getClientTickets":
      $strOutput = getClientTickets($_REQUEST[ClientID]);
      header("Content-type: application/json");
      //print_rr($strOutput);
      echo json_encode($strOutput);
      die;

   // Getting All tasks of the ticket
   case "getTicketTasks":
      $strOutput = getTicketTasks($_REQUEST[TicketID]);
      header("Content-type: application/json");
      //print_rr($strOutput);
      echo json_encode($strOutput);
      die;

   // Set approval message on the Approved by field when selecting the client in the ddl on the Ticket page. - Gael
   case "setApprovalText":
      $strOutput = setApprovalText($_REQUEST[ClientID]);
      header("Content-type: application/json");
      echo json_encode($strOutput);
      die;

   // Show book signed for client where book signed is requested on the Time page. - Gael
   case "showBookSigned":
      $strOutput = showBookSigned($_REQUEST[TicketID]);
      header("Content-type: application/json");
      echo json_encode($strOutput);
      die;

   //20170517 - Get all the task details when user select task on the Time page. - Gael
   case "getTaskDetails":
      $strOutput = getTaskDetails($_REQUEST[TaskID]);
      header("Content-type: application/json");
      echo json_encode($strOutput);
      die;
   
   // Getting CodeFault Details for Task
   case "getCodeFaultDetail":
      $strOutput = getCodeFaultDetail($_REQUEST[CodeFault]);
      header("Content-type: application/json");
      //print_rr($strOutput);
      echo json_encode($strOutput);
      die;   

   // Getting CodeFix Details for Task
   case "getCodeFixDetail":
      $strOutput = getCodeFixDetail($_REQUEST[CodeFix]);
      header("Content-type: application/json");
      //print_rr($strOutput);
      echo json_encode($strOutput);
      die; 

   case "GetEmailTemplate":
      $strOutput = getEmailTemplate($_REQUEST[EmailTemplateID]);
      header("Content-type: application/json");
      //print_rr($strOutput);
      echo json_encode($strOutput);
      die;
   case "getProductJSON":
      $strOutput = getProductJSON($_REQUEST[ProductID]);
      header("Content-type: application/json");
      //print_rr($strOutput);
      echo json_encode($strOutput);
      die;

   case "getDepartmentStatusJSON"://20170327 - added SP ddl reload DeptStatus - pj/r
      $strOutput = getDepartmentStatusJSON($_REQUEST[DepartmentID], $_REQUEST[SalesPersonID]);
      header("Content-type: application/json");
      //print_rr($strOutput);
      echo json_encode($strOutput);
      die;

   case "getContactsJSON"://20170327 - added Client ddl reload Contact and ClientDetails - R
      $strOutput = getContactsJSON($_REQUEST[ClientID]);
      header("Content-type: application/json");
      //print_rr($strOutput);
      echo json_encode($strOutput);
      die;

   case "getClientJSON"://20170327 - added Client ddl reload Contact and ClientDetails - R
      $strOutput = getClientJSON($_REQUEST[ClientID]);
      header("Content-type: application/json");
      //print_rr($strOutput);
      echo json_encode($strOutput);
      die;

   case "ajaxAddProductBundleItem":
      $strOutput = ajaxAddProductBundleItem($_REQUEST[ProductBundleID]);
      header("Content-type: application/json");
      //print_rr($strOutput);
      echo json_encode($strOutput);
      die;

   case "ajaxDeleteProductBundleItem":
      $strOutput = ajaxDeleteProductBundleItem($_REQUEST[ProductBundleItemID]);
      header("Content-type: application/json");
      //print_rr($strOutput);
      echo json_encode($strOutput);
      die;

   case "ajaxMoveProductBundleItem":
      //ajaxMoveProposalItem($ProposalItemID,$NewTargetProposalID, $dblCountofOrderFromTopOfGroup)
      $strOutput = ajaxMoveProductBundleItem($_REQUEST[ProductBundleItemID],$_REQUEST[ProductBundleID],$_REQUEST[dblOrder]);
      header("Content-type: application/json");
      //print_rr($strOutput);
      echo json_encode($strOutput);
      die;

   case "ajaxAddProposalItem":
      $strOutput = ajaxAddProposalItem($_REQUEST[ProposalGroupID]);
      header("Content-type: application/json");
      //print_rr($strOutput);
      echo json_encode($strOutput);
      die;

   case "ajaxDeleteProposalItem":
      $strOutput = ajaxDeleteProposalItem($_REQUEST[ProposalItemID]);
      header("Content-type: application/json");
      //print_rr($strOutput);
      echo json_encode($strOutput);
      die;

   case "ajaxMoveProposalItem":
      //ajaxMoveProposalItem($ProposalItemID,$NewTargetProposalID, $dblCountofOrderFromTopOfGroup)
      $strOutput = ajaxMoveProposalItem($_REQUEST[ProposalItemID],$_REQUEST[ProposalGroupID],$_REQUEST[dblOrder]);
      header("Content-type: application/json");
      //print_rr($strOutput);
      echo json_encode($strOutput);
      die;

   case "ajaxAddProposalGroup":
      $strOutput = ajaxAddProposalGroup($_REQUEST[ProposalID]);
      header("Content-type: application/json");
      //print_rr($strOutput);
      echo json_encode($strOutput);
      die;

   case "ajaxDeleteProposalGroup":
      $strOutput = ajaxDeleteProposalGroup($_REQUEST[ProposalGroupID]);
      header("Content-type: application/json");
      //print_rr($strOutput);
      echo json_encode($strOutput);
      die;

   case "ajaxMoveProposalGroup":
      $strOutput = ajaxMoveProposalGroup($_REQUEST[ProposalGroupID],$_REQUEST[ProposalID],$_REQUEST[dblOrder]);
      header("Content-type: application/json");
      echo json_encode($strOutput);
      die;

   case "ajaxMoveWidget":
      $strOutput = ajaxMoveWidget($_REQUEST[ParentID],$_REQUEST[ChildID],$_REQUEST[Position],$_REQUEST[UserID],$_REQUEST[Page]);
      header("Content-type: application/json");
      //print_rr($strOutput);
      echo json_encode($strOutput);
      die;

   case "getClientName":
      $strOutput = getClientName($_REQUEST[strClient]);
      echo $strOutput;
      die;

   case "getEmail":
      $strOutput = getEmail($_REQUEST[strEmail]);
      echo $strOutput;
      die;

   // Check if Account code is unique - Gael
   case "checkAccountCode":
      $strOutput = checkAccountCode($_REQUEST[strAccountCode]);
      echo $strOutput;
      die;

   case "saveTempTicket":
      $strOutput = saveTempTicket($_REQUEST[arrTicket]);
      echo $strOutput;
      die;

   case "checkDefaultClientContact":
      $strOutput = checkDefaultClientContact($_REQUEST[ClientID]);
      header("Content-type: application/json");
      echo json_encode($strOutput);
      die;

  case "getProductDropdown": //20170717 - Add Product Dropdown ajax search - CL
      $strOutput = getProductDropdown($_REQUEST['strSearchString']);
      header("Content-type: application/json");
      //print_rr($strOutput);
      echo json_encode($strOutput);
      die;
      break;

   //20170807 - Add ajax to handle new calendar  -CL 
   case "ajaxAddScheduleTimeTask":
      $strStartDate = $_REQUEST['strStartDate'].'+'.$_REQUEST['zone'];
      $refTaskID = $_REQUEST['refTaskID'];
      $refUserID = $_REQUEST['refUserID'];
      $blnAllDay = $_REQUEST['blnAllDay'];
      
      $strOutput = ajaxAddScheduleTimeTask($strStartDate,$refUserID,$refTaskID,$blnAllDay);
      header("Content-type: application/json");
      echo json_encode($strOutput);
      die;

//20170807 - Add ajax to update details for crmTime on the calendar -CL 
   case "ajaxUpdateScheduleTimeTask":
      $TimeID = $_REQUEST['TimeID'];
      $lstTask = $_REQUEST['lstTask'];

      $strOutput = ajaxUpdateScheduleTimeTask($TimeID,$lstTask);
      header("Content-type: application/json");
      echo json_encode($strOutput);
      die;
   //20170807 - Add ajax to change calendar date -CL 
   case "ajaxChangeScheduleTimeTask":
      $TimeID = $_REQUEST['TimeID'];
      $refTaskID = $_REQUEST['refTaskID'];
      $strStartDate = $_REQUEST['strStartDate'];
      $strEndDate = $_REQUEST['strEndDate'];
      $blnAllDay = $_REQUEST['blnAllDay'];

      $strOutput = ajaxChangeScheduleTimeTask($TimeID,$strStartDate,$strEndDate,$refTaskID,$blnAllDay);
      header("Content-type: application/json");
      echo json_encode($strOutput);
      die;

   //20170807 - Add ajax to delete calendar time entry -CL 
   case "ajaxDeleteScheduleTimeTask":
      $eventid = $_REQUEST['TimeID'];

      $strOutput = ajaxDeleteScheduleTimeTask($TimeID);
      header("Content-type: application/json");
      echo json_encode($strOutput);
      die;

   //20170807 - Add ajax to get time details for the calender -CL
   case "ajaxGetScheduleTimes":
      $refUserID = $_REQUEST['refUserID'];
      $strOutput = ajaxGetScheduleTimes($refUserID);
      header("Content-type: application/json");
      echo json_encode($strOutput);
      die;
}

if($_REQUEST['header'] == ""){
   header("Content-type: text/xml");
   $strOutput = str_replace("&" , "&amp;" , $strOutput);
}
echo $strOutput;
die;

function getClientName($strClient)
{
   global $xdb, $SystemSettings;

   $result = $xdb->getRowSQL("SELECT strClient FROM crmClient WHERE strClient = ". $xdb->qs($strClient), 0);

   if(isset($result->strClient))
   {
      return 1;
   }
   else
   {
      return 0;
   }
}

function getEmail($strEmail)
{
   global $xdb, $SystemSettings;

   $result = $xdb->getRowSQL("SELECT strEmail FROM crmClient WHERE strEmail = ". $xdb->qs($strEmail), 0);

   if(isset($result->strEmail))
   {
      return 1;
   }
   else
   {
      return 0;
   }
}

function checkAccountCode($strAccountCode)
{
   global $xdb, $SystemSettings;

   $result = $xdb->getRowSQL("SELECT strAccountCode FROM crmClient WHERE strAccountCode = ". $xdb->qs($strAccountCode), 0);

   if(isset($result->strAccountCode)){
      return 1;
   }else{
      return 0;
   }
}


function getDepartmentStatusJSON($DepartmentID=null, $SalesPersonID=null)
{
   global $xdb, $SystemSettings;

   if($DepartmentID == null){//lookup DID from SPID
      $rowSP = $xdb->getRowSQL("SELECT refDepartmentID FROM crmSalesPerson WHERE SalesPersonID = ". $xdb->qs($SalesPersonID), 0);
      $DepartmentID = $rowSP->refDepartmentID;
   }

   $arrJson = array();
   $rst = $xdb->doQuery("SELECT * FROM vieDepartmentStatus
      WHERE DepartmentID = ". $xdb->qs($DepartmentID) ." AND blnActive = 1
      ORDER BY dblOrder, strStatus", 0);
   if($xdb->Rows != 0)
   {
      $arrJson = parseJsonRow($rst);
   }else{
      header("Content-type: text");
      echo "Department has no Statuses [SPID=$SalesPersonID]";
      die();

   }
   //print_rr($arrJson);

   return $arrJson;
}

function getContactsJSON($ClientID=null)
{
   global $xdb, $SystemSettings;

   $arrJson = array();
   $row = $xdb->getRowSQL("SELECT * FROM crmContact
      WHERE refClientID = ". $xdb->qs($ClientID) ." AND blnActive = 1
      ORDER BY strContact", 0);
   if($xdb->Rows != 0)
   {
      $arrJson = parseJsonRow($row);
   }else{
      header("Content-type: text");
      echo "Client has no Contacts [CID=$ClientID]";
      die();
   }

   //print_rr($arrJson);
   return $arrJson;
}

function getClientJSON($ClientID=null)
{
   global $xdb, $SystemSettings;

   $arrJson = array();
   $row = $xdb->getRowSQL("SELECT crmClient.*, strPaymentTerms
      FROM crmClient LEFT JOIN crmPaymentTerms ON (crmClient.refPaymentTermsID = crmPaymentTerms.PaymentTermsID)
      WHERE ClientID = ". $xdb->qs($ClientID) ."
      ORDER BY strClient", 0); /*, crmPaymentTerms.strPaymentTerms*/

   if($xdb->Rows != 0)
   {
      unset($row->encTechnicalNotes);
      $arrJson = parseJsonRow($row);
   }else{
      header("Content-type: text");
      echo "No Client Details found [CID=$ClientID]";
      die();
   }

   //print_rr($arrJson);
   return $arrJson;
}

//2017/03/08 - delete the previous uploaded file for a new upload file - neils
function deleteCurrentFile(&$type, &$ID, &$path)   //or deletePreviouslyUploadedFile()
{
   global $xdb;

   $strFileName = "";
   switch ($type) {
      case "UploadProfilePicture":
         $File = $xdb->getRowSQL("SELECT `Profile:PicturePath` AS 'strFileName' FROM sysUser WHERE UserID = $ID", 0);
         break;

      case "UploadTrainningCertificate":
         $File = $xdb->getRowSQL("SELECT strFileName FROM eduTrainingCertificate WHERE CertificateID = $ID", 0);
         break;

      case "UploadProduct":
         $File = $xdb->getRowSQL("SELECT strFilename AS 'strFileName' FROM crmProduct WHERE ProductID = $ID", 0);
         break;

      case "UploadPicture":
         $File = $xdb->getRowSQL("SELECT strPictureLink  FROM tblPicture WHERE PictureID = $ID", 0);
         break;

      default:
         break;
   }

   // echo "<br><br>$path$File->strFileName<br>";

   // var_dump(file_exists($path.$File->strFileName));
   // var_dump(unlink($path.$File->strFileName));

   if (file_exists($path.$File->strFileName)){
      if (unlink($path.$File->strFileName)){
         return true;
      }
   }

   return false;
}


//2017/01/10 - added upload file implementations - neils
function checkFileType(&$File)
{
   $File["name"];

   $extention = substr($File["name"], -3);
   //note: the best way to do this would probably be to use regular expression
   $arrayImageTypes3 = array("png","jpg","bmp","gif");
   foreach ($arrayImageTypes3 as $key => $value) {
      if ($extention == $value){
         return true;
      }
      else {
         $extention1 = substr($File["name"], -4);  //check for img extention of 4
         if ($extention1 == "jpeg"){
            return true;
         }
      }
   }

   return false;
}

function UploadFileAjax(&$File, $Path, $strFilename)
{
   // echo $Path.$strFilename;
   if (move_uploaded_file($File["tmp_name"], $Path.$strFilename)){
      //return $strFolder.$File["name"];
      return true;
   } else {
      return false;
   }

   return false;
}

//20161207 - added function to reset password - maanie
## PSSWORD RESET PROCEDURE - maanie
function SendResetEmail($strEmail)
{
   global $xdb, $SystemSettings;

   $rst = $xdb->doQuery("SELECT * FROM sysUser WHERE strEmail = '$strEmail'");
   $row = $xdb->num_rows($rst);
   $rowDetails = $xdb->fetch_object($rst);

   if($row == 1)
   {
      include_once("_framework/_nemo.email.cls.php");
      include_once("../dev/_framework/_nemo.password.cls.php");

      ## ADD RECORD TO RESET PASSWORD TABLE
      $np = new NemoPassword();
      $np->createPassword(Obfuscate());
      $np->savePassword($strPasswordType, $rowDetails->UserID, "2010-01-01", 0); // 2010-01-01 = Default Aged date

      ## ADD RECORD TO RESET PASSWORD TABLE
      $nemoEmail = new NemoEmail($strEmail , "" , 0);
      $nemoEmail->LoadEmailTemplate("Reset Password");

      $arrValues[DisplayName] = $rowDetails->strUser;
      $arrValues[Link] = "<a href='".$SystemSettings[BASE_URL]."resetPassword.php?strEmail=$strEmail&ResetKey=$np->hash'>Reset Password</a>";

      $nemoEmail->Substitute($arrValues);

      $nemoEmail->addHeader("FROM", $SystemSettings["SMTP Send As"]);
      $nemoEmail->addHeader("BCC", $SystemSettings["SMTP BCC"]);
      $nemoEmail->Bcc = $SystemSettings["SMTP BCC"];
      $nemoEmail->From = $SystemSettings["SMTP Send As"];

      $nemoEmail->Send();

     /* $xdb->doQuery(" UPDATE sysUser SET strPasswordMD5 = '$ResetKey'
                        WHERE strEmail = '$strEmail'");*/
      return 1;
      ## SEND EMAIL
   }
   else
   {
      return 0;
   }
}

function getAreas($area)
{
   global $xdb,$SystemSettings;

   $rst = $xdb->doQuery("SELECT lstArea FROM crmClient WHERE lstArea LIKE '%$area%'");
   while($row = $xdb->fetch_object($rst))
   {
      $xml .= parseXmlRow($row);
   }
   return "<rows>$xml</rows>";
}

function createArea($area)
{
   global $xdb,$SystemSettings;

   $rst = $xdb->doQuery("INSERT INTO crmClient VALUES WHERE lstArea LIKE '%$area%'");
   while($row = $xdb->fetch_object($rst))
   {
      $xml .= parseXmlRow($row);
   }
      return "<data>$xml</data>";
}

function getEmailTemplate($EmailTemplateID)
{
   global $xdb,$SystemSettings;

   $row = $xdb->getRowSQL("SELECT strSubject, txtBody FROM tblEmailTemplate WHERE EmailTemplateID = $EmailTemplateID");
   //$xml .= parseXmlRow($row);

   //return "<data>$xml</data>";
   if($row)
   {
      return array($row->strSubject,$row->txtBody);
   }
}

function getProductJSON($ProductID)
{
   global $xdb,$SystemSettings;

   $arrJson = array();

   $row = $xdb->getRowSQL("SELECT crmProduct.*, refSupplierID, strClient as strSupplier
      FROM crmProduct INNER JOIN crmClient ON crmProduct.refSupplierID = crmClient.ClientID
      WHERE ProductID = $ProductID ",0);//AND crmProduct.blnActive = 1 AND crmProduct.blnActive = 1 AND strClientType = 'Supplier'
   if($row)
   {
      $arrJson = parseJsonRow($row);
   }

   return $arrJson;

}

//20170720 - Move Product Bundle Item Ajax modified from Move Proposal Item- CL
function ajaxMoveProductBundleItem($ProductBundleItemID, $ProductBundleID, $dblOrder)
{
   global $xdb;

   $row = $xdb->getRowSQL("SELECT * FROM crmProductBundleItem WHERE ProductBundleItemID = ". $xdb->qs($ProductBundleItemID) ." ", 0);
   if($dblOrder > $row->dblOrder && $ProductBundleID == $row->ProductBundleID){
      $sqlOrderPreference = 1;
   }else{
      $sqlOrderPreference = -1;
   }

   //update ProductBundleItem
   $xdb->doQuery("UPDATE crmProductBundleItem
                  SET dblGroupingOrder = $dblOrder, refProductBundleID=". $xdb->qs($ProductBundleID) ."
                  WHERE ProductBundleItemID = ".$xdb->qs($ProductBundleItemID), 0);

   if($dblOrder == 0)
      $posStart = -1;
   else
      $posStart = 0;

   if($xdb->Error == 1){
      header("Content-type: text");
      echo "Unable to Move Product Bundle Item. [PBIID=$ProductBundleItemID][PBID=$ProductBundleID]";
      die();
   }else{
      ProductBundle::reorderProductBundleItems($ProductBundleID, $ProductBundleItemID, $sqlOrderPreference, $posStart);

      //Return new Order
      return array("dblOrder" => $dblOrder);
   }
}


//20170720 - Delete Product Bundle Item Ajax added - CL
function ajaxDeleteProductBundleItem($ProductBundleItemID)
{
   global $xdb;

   $rowProductBundleItem = $xdb->getRowSQL("SELECT crmProductBundleItem.refProductBundleID FROM crmProductBundleItem  
                                       WHERE ProductBundleItemID = ".$xdb->qs($ProductBundleItemID),0);
   $ProductBundleID = $rowProductBundleItem->refProductBundleID;

  $xdb->doQuery("DELETE FROM crmProductBundleItem WHERE ProductBundleItemID = ". $xdb->qs($ProductBundleItemID),0);

   //print_rr($xdb);
   if($xdb->Error == 1){
      header("Content-type: text");
      echo "Unable to delete Proposal Item. [PIID=$ProductBundleItemID]";
      die();
   }else{
      ProductBundle::reorderProductBundleItems($ProductBundleID,$ProductBundleItemID);

      //returning an array with true inside
      return array("blnDeleted" => true);
   }
}

//20170720 - AddProposal Ajax added , modified for Product Bundle- CL 
function ajaxAddProductBundleItem($ProductBundleID)
{
   global $xdb, $SystemSettings;

   $db = new NemoDatabase("crmProductBundleItem", 0, null, 0);

   $db->Fields["refProductBundleID"] = $ProductBundleID;
   $db->Fields["refProductID"] = "NULL";
   $db->Fields["dblUnits"] = 1;
   $db->Fields["strGroupingHeading"] = "";
   $db->Fields["strLastUser"] = $_SESSION[USER]->USERNAME;

   $result = $db->Save(0,0,null,1);

   $ProductBundleItemID = $db->ID[ProductBundleItemID];

   //print_rr($result);
   if($result->Error == 1){
      header("Content-type: text");
      echo "Unable to add Product Bundle Item. [PBID=$ProductBundleID]";
      die();
      //return " ". $result->ErrorMsg." ";
   }else{
      ProductBundle::reorderProductBundleItems($ProductBundleID,$ProductBundleItemID);

      $rowPBI = $xdb->getRowSQL("SELECT crmProductBundleItem.*, 0 as dblUnitCost, 0 as dblCostExternal, 0 as dblMargin, 0 as dblLineTotal, Null as refOriginalSupplierID, 0 as dblDealerCost, crmProduct.dtDateLastUpdated
         FROM crmProduct RIGHT JOIN crmProductBundleItem ON crmProduct.ProductID = crmProductBundleItem.refProductID 
         WHERE crmProductBundleItem.ProductBundleItemID = $ProductBundleItemID",0);

      $piwItem = new ProductBundleItemWidget($ProductBundleItemID, $ArchType="ProductBundleItems", "wcProductBundleGroup_$rowPBI->refProductBundleID",$blnVisable = 0);
      $piwItem->hydrate($rowPBI);
      $piwItem->render();

      //return ParentID as well so that the Item knows the Parents sortable container rather then the entire parent container since we have content in the parent container - CL
      return array("ProductBundleItemID" => $ProductBundleItemID,"ProductBundleItemHTML" => "$piwItem->HTML");
      //return array("ProposalItemID" => $ProposalItemID);
   }
}


//20170328 - AddProposal Ajax added - CL
function ajaxAddProposalItem($ProposalGroupID)
{
   global $xdb, $SystemSettings;

   $db = new NemoDatabase("crmProposalItem", 0, null, 0);

   $db->Fields["refProposalGroupID"] = $ProposalGroupID;
   $db->Fields["refProductID"] = "NULL";
   $db->Fields["refSupplierID"] = "NULL";
   $db->Fields["dtETA"] = "NULL";
   $db->Fields["txtNotes"] = "NULL";
   $db->Fields["percMarkup"] = 0;
   $db->Fields["dblUnits"] = 1;
   $db->Fields["dblOrder"] = 999;
   $db->Fields["strProposalItem"] = "";
   $db->Fields["strLastUser"] = $_SESSION[USER]->USERNAME;

   $result = $db->Save(0,0,null,1);

   $ProposalItemID = $db->ID[ProposalItemID];

   //print_rr($result);
   if($result->Error == 1){
      header("Content-type: text");
      echo "Unable to add Proposal Item. [PGID=$ProposalGroupID]";
      die();
      //return " ". $result->ErrorMsg." ";
   }else{
      Proposal::reorderProposalItems($ProposalGroupID,$ProposalItemID);

      $rowPI = $xdb->getRowSQL("SELECT crmProposalItem.*, dwfProposalItem.dblUnitCost, dwfProposalItem.dblCostExternal, dwfProposalItem.dblMargin, dwfProposalItem.dblLineTotal, crmProduct.refSupplierID as refOriginalSupplierID,crmProduct.dblCost as dblDealerCost, crmProduct.dtDateLastUpdated
         FROM crmProduct RIGHT JOIN (dwfProposalItem INNER JOIN crmProposalItem ON dwfProposalItem.ProposalItemID = crmProposalItem.ProposalItemID) ON crmProduct.ProductID = crmProposalItem.refProductID WHERE crmProposalItem.ProposalItemID = $ProposalItemID",0);

      $piwItem = new ProposalItemWidget($ProposalItemID, $ArchType="ProposalItems", "wcProposalGroup_$rowPI->refProposalGroupID",$blnVisable = 0);
      $piwItem->hydrate($rowPI);
      $piwItem->render();

      //return ParentID as well so that the Item knows the Parents sortable container rather then the entire parent container since we have content in the parent container - CL
      return array("ProposalItemID" => $ProposalItemID,"ProposalItemHTML" => "$piwItem->HTML");
      //return array("ProposalItemID" => $ProposalItemID);
   }
}

//20170328 - Delete Proposal Item Ajax added - CL
function ajaxDeleteProposalItem($ProposalItemID)
{
   global $xdb;

   $rowProposalItem = $xdb->getRowSQL("SELECT crmProposalItem.* FROM crmProposalItem  WHERE ProposalItemID = ".$xdb->qs($ProposalItemID),0);
   $ProposalGroupID = $rowProposalItem->refProposalGroupID;

   $xdb->doQuery("DELETE FROM crmProposalItem WHERE ProposalItemID = ". $xdb->qs($ProposalItemID));

   //print_rr($xdb);
   if($xdb->Error == 1){
      header("Content-type: text");
      echo "Unable to delete Proposal Item. [PIID=$ProposalItemID]";
      die();
   }else{
      Proposal::reorderProposalItems($ProposalGroupID,$ProposalItemID);

      //returning an array with true inside
      return array("blnDeleted" => true);
   }
}

//20170328 - Move Proposal Item Ajax added - CL
//ajaxMoveProposalItem($ProposalItemID,$NewTargetProposalID, $dblCountofOrderFromTopOfGroup)
function ajaxMoveProposalItem($ProposalItemID, $ProposalGroupID, $dblOrder)
{
   global $xdb;

   // echo $ProposalItemID."</ br>";
   // echo $ProposalGroupID."</ br>";
   // echo $dblOrder."</ br>";
   $row = $xdb->getRowSQL("SELECT * FROM crmProposalItem WHERE ProposalItemID = ". $xdb->qs($ProposalItemID) ." ", 0);
   if($dblOrder > $row->dblOrder && $ProposalGroupID == $row->ProposalGroupID){
      $sqlOrderPreference = 1;
   }else{
      $sqlOrderPreference = -1;
   }

   //update ProposalItem
   $xdb->doQuery("UPDATE crmProposalItem
                  SET dblOrder = $dblOrder, refProposalGroupID=". $xdb->qs($ProposalGroupID) ."
                  WHERE ProposalItemID = ".$xdb->qs($ProposalItemID), 0);

   if($dblOrder == 0)
      $posStart = -1;
   else
      $posStart = 0;

   if($xdb->Error == 1){
      header("Content-type: text");
      echo "Unable to Move Proposal Item. [PIID=$ProposalItemID][PGID=$ProposalGroupID]";
      die();
   }else{
      Proposal::reorderProposalItems($ProposalGroupID, $ProposalItemID, $sqlOrderPreference, $posStart);

      //Return new Order
      return array("dblOrder" => $dblOrder);
   }
}

//20170410 - AddProposal Group Ajax added - CL
function ajaxAddProposalGroup($ProposalID)
{
   global $xdb, $SystemSettings;

   $db = new NemoDatabase("crmProposalGroup", 0, null, 0);

   $db->Fields["refProposalID"] = $ProposalID;
   //productID = null
   //eta is null
   //$db->Fields["refProposalGroupID"] = $ProposalGroupID;
   //set max order
   $db->Fields["dblOrder"] = 999;
   $db->Fields["strProposalGroup"] = "";
   $db->Fields["strLastUser"] = $_SESSION[USER]->USERNAME;

   $result = $db->Save(0,0,null,1);

   $ProposalGroupID = $db->ID[ProposalGroupID];

   //print_rr($result);
   if($result->Error == 1){
      header("Content-type: text");
      echo "Unable to add Proposal Item. [PID=$ProposalID]";
      die();
      //return " ". $result->ErrorMsg." ";
   }else{
      Proposal::reorderProposalGroups($ProposalID,$ProposalGroupID);

      //create group widget INNER container for widget items
      $wcProposalGroup = new WidgetController($ID="wcProposalGroup_$ProposalGroupID", $UserID=null, $ArchType="ProposalItems", $Title="");
      $wcProposalGroup->html->ProposalGroupID = $ProposalGroupID;
      //recently added item onDrop/onMove
      $wcProposalGroup->jsFunctions["update"] = ", update: function (event, ui)
         {
            //ui.item.attr('ParentID') <> ui.item.parent().attr('id') // not the same values: old value vs new value (ondrop item.parent changes to the new parent)

            var Parent = $('#'+ this.id);
            var ParentID = this.id; //ui.item.parent().attr('id'); //new parent
            var ChildID = ui.item.attr('id'); //current child

            //update Child.ParentID
            ui.item.attr('ParentID', ParentID);

            var page = document.location.pathname.match(/[^\/]+$/)[0]; //http://stackoverflow.com/questions/13317276/jquery-to-get-the-name-of-the-current-html-file

            //Re-order children in new parent
            var Position = jsReOrderChildren(ParentID, ChildID);
            jsUpdateLabels(ParentID);

            var ProposalGroupID = Parent.attr('ProposalGroupID'); //new ProposalID
            var ProposalItemID = ui.item.attr('ProposalItemID');

            $.ajax({
               type: 'GET',
               url: 'ajaxFunctions.php',
               data: {'type':'ajaxMoveProposalItem','ProposalItemID':ProposalItemID,'ProposalGroupID':ProposalGroupID,'dblOrder':Position},
               success: function(data)
               {
                  if (jQuery.type(data) == 'object')
                  {
                     //recalculate totals for this group and the parent group
                     jsCalculateGroupTotal(ProposalGroupID);
                     jsCalculateGroupTotal($ProposalGroupID);
                  }
                  if(jQuery.type(data) == 'string')
                  {
                     //ajax request successful, but the ajax page return warning
                     new PNotify({
                       title: 'Warning',
                       text: 'Warning: '+ data,
                       type: 'warning',
                       styling: 'bootstrap3'
                       });
                  }
               },
               error: function(xhr, status, error)
               {
                  new PNotify({
                     title: 'Error',
                     text: 'Error occured:'+ xhr.responseText,
                     type: 'error',
                     styling: 'bootstrap3'
                     });
               }
            });

         }";
      $wcProposalGroup->render();

      //create group widget item
      $rowPG = $xdb->getRowSQL("SELECT crmProposalGroup.* , dwfProposalGroup.dblCostExternal, dwfProposalGroup.dblCostBudget FROM crmProposalGroup INNER JOIN dwfProposalGroup ON crmProposalGroup.ProposalGroupID = dwfProposalGroup.ProposalGroupID WHERE crmProposalGroup.ProposalGroupID = $ProposalGroupID",0);
      $pgwGroup = new ProposalGroupWidget($ProposalGroupID, $ArchType="ProposalGroups", $ParentID="pwcProposal_$ProposalID", $rowPG->dblOrder, $ProposalID, $blnVisible=0);
      $pgwGroup->hydrate($rowPG);
      $pgwGroup->nwcProposalGroup->HTML = $wcProposalGroup->HTML;
      $pgwGroup->render();

      return array("ProposalGroupID" => $ProposalGroupID,"ProposalGroupHTML" => "$pgwGroup->HTML");
      //return array("ProposalGroupID" => $ProposalGroupID);
   }
}

//20170410 - Delete Proposal Group Ajax added - CL
function ajaxDeleteProposalGroup($ProposalGroupID)
{
   global $xdb;

   //Delete all items belonging to ProposalGroup
   $xdb->doQuery("DELETE FROM crmProposalItem WHERE refProposalGroupID = ". $xdb->qs($ProposalGroupID),0);

   if($xdb->Error == 1){
      header("Content-type: text");
      echo "Unable to delete Proposal Items. [PGID=$ProposalGroupID]";
      die();
   }

   //Delete ProposalGroup
   $xdb->doQuery("DELETE FROM crmProposalGroup WHERE ProposalGroupID = ". $xdb->qs($ProposalGroupID),0);

   //print_rr($xdb);
   if($xdb->Error == 1){
      header("Content-type: text");
      echo "Unable to delete Proposal Group. [PGID=$ProposalGroupID]";
      die();
   }else{
      Proposal::reorderProposalGroups($ProposalID,$ProposalGroupID);

      //returning an array with true inside
      return array("blnDeleted" => true);
   }
}

//20170405 - Move Proposal Group Ajax added - CL
//ajaxMoveProposalItem($ProposalItemID,$NewTargetProposalID, $dblCountofOrderFromTopOfGroup)
function ajaxMoveProposalGroup($ProposalGroupID, $ProposalID, $dblOrder)
{
   global $xdb;

   $row = $xdb->getRowSQL("SELECT * FROM crmProposalGroup WHERE ProposalGroupID = ". $xdb->qs($ProposalGroupID), 0);
   if($dblOrder > $row->dblOrder){//if position increases then order it last, else order it first
      $sqlOrderPreference = 1;
   }else{
      $sqlOrderPreference = -1;
   }

   //update ProposalItem
   $xdb->doQuery("
      UPDATE crmProposalGroup
      SET dblOrder = ". $xdb->qs($dblOrder) ."
      , refProposalID = ". $xdb->qs($ProposalID) ."
      WHERE ProposalGroupID = ". $xdb->qs($ProposalGroupID), 0); //remove ABS later

   if($dblOrder == 0)
      $posStart = -1;
   else
      $posStart = 0;

   //print_rr($xdb);
   if($xdb->Error == 1){
      header("Content-type: text");
      echo "Unable to Move Proposal Group Item. [PGID=$ProposalGroupID][PID=$ProposalID]";
      die();
   }else{
      Proposal::reorderProposalGroups($ProposalID, $ProposalGroupID, $sqlOrderPreference, $posStart);

      //Return new Order
      return array("dblOrder" => $dblOrder);
   }
}

//20170405 - Move Proposal Widget added - CL
function ajaxMoveWidget($ParentID,$ChildID,$Position,$UserID,$Page)
{
   global $db, $xdb,$DATABASE_SETTINGS; //from system.php

   //ini
   if($UserID == null)
   {
      $WhereUserID = " AND refUserID IS NULL";
   }
   else
   {
     $WhereUserID = " AND refUserID = ".$xdb->qs($UserID);
   }

   $row = $xdb->getRowSQL("SELECT * FROM sysWidget WHERE WidgetID = ". $xdb->qs($ChildID) ." AND strURL = ". $xdb->qs($Page)." $WhereUserID",0);
   if($Position > $row->strPosition && $ParentID == $row->ParentID){
      $sqlOrderPreference = 1;
   }else{
      $sqlOrderPreference = -1;
   }

   //update Widget Items
   $xdb->doQuery("UPDATE sysWidget
      SET strPosition = ". $xdb->qs($Position) ."
      , ParentID = ". $xdb->qs($ParentID) ."
      WHERE WidgetID = ". $xdb->qs($ChildID) ." AND strURL = ". $xdb->qs($Page)." $WhereUserID", 0);

   if($Position == 0)
      $posStart = -1;
   else
      $posStart = 0;

   //print_rr($xdb);
   if($xdb->Error == 1){
      header("Content-type: text");
      echo "Unable to move Widget. [WID=$ChildID]";
      die();
   }else{

      $xdb->doQuery("
         UPDATE sysWidget INNER JOIN
         (SELECT @rownum := @rownum + 1 AS newOrder
               , sysWidget.strPosition, sysWidget.WidgetID, IF(sysWidget.WidgetID = ". $xdb->qs($ChildID) .", $sqlOrderPreference, 0) as blnWidget
            FROM sysWidget, (SELECT @rownum := $posStart) r
            WHERE strURL =". $xdb->qs($Page)." AND ParentID = ". $xdb->qs($ParentID)." $WhereUserID
            ORDER BY sysWidget.strPosition, blnWidget
         ) AS derPG ON derPG.WidgetID = sysWidget.WidgetID

         SET sysWidget.strPosition = derPG.newOrder", 0);

      //Return new Order
      return array("Position" => $Position);
   }
}

function getClientDetails($ClientID)
{
   global $xdb,$SystemSettings;

   $rst = $xdb->doQuery("
      SELECT ClientID, strClient, strTel, strCell, strFax, strEmail
      FROM crmClient
      WHERE crmClient.ClientID = ".$xdb->qs($ClientID)." LIMIT 1");

   while($row = $xdb->fetch_object($rst))
   {
      $xml .= parseXmlRow($row);
   }
   return "<data>$xml</data>";
}

function getContactDetails($ContactID)
{
   global $xdb,$SystemSettings;

   $rst = $xdb->doQuery("
      SELECT ContactID, strContact, lstPosition AS Position, strTel, strCell, strFax, strEmail
      FROM crmContact
      WHERE crmContact.ContactID = ".$xdb->qs($ContactID)." LIMIT 1");

   while($row = $xdb->fetch_object($rst))
   {
      $xml .= parseXmlRow($row);
   }
   return "<data>$xml</data>";
}

function getClientContacts($ClientID)
{
   global $xdb,$SystemSettings;

   $rst = $xdb->doQuery("SELECT ContactID, CONCAT(strName,' ',strSurname) AS strContact FROM crmContact WHERE crmContact.refClientID = ".$xdb->qs($ClientID)." ORDER BY strContact",0);

   while($row = $xdb->fetch_object($rst))
   {
      $arrJson[] = parseJsonRow($row);
   }
   return $arrJson;
}

function getTicketDueDate($TicketID)
{
   global $xdb, $SystemSettings;

   $rst = $xdb->doQuery("SELECT TicketID, dtDueDate FROM crmTicket WHERE TicketID = ".$xdb->qs($TicketID), 0);

   while($row = $xdb->fetch_object($rst))
   {
      $arrJson[] = parseJsonRow($row);
   }
   return $arrJson;
}
function hasDefaultContact($ClientID)
{
   global $xdb, $SystemSettings;

   $rst = $xdb->doQuery("SELECT blnDefaultClientContact FROM crmContact WHERE refClientID = ".qs($ClientID),0);

   $blnHasDefault = false;

   while($row = $xdb->fetch_object($rst))
   {
      if($row->blnDefaultClientContact == 1)
      {
         $blnHasDefault = true;
      }
   }

   return $blnHasDefault;

}

function getClientTickets($ClientID)
{
   global $xdb,$SystemSettings;

   $rst = $xdb->doQuery("SELECT TicketID, strTicket FROM crmTicket WHERE refClientID = ".$xdb->qs($ClientID)." ORDER BY strTicket",0);

   while($row = $xdb->fetch_object($rst))
   {
      $arrJson[] = parseJsonRow($row);
   }
   return $arrJson;
}

function getTicketTasks($TicketID)
{
   global $xdb,$SystemSettings;

   $rst = $xdb->doQuery("SELECT TaskID, lstTask FROM crmTask WHERE refTicketID = ".$xdb->qs($TicketID)." ORDER BY lstTask",0);

   while($row = $xdb->fetch_object($rst))
   {
      $arrJson[] = parseJsonRow($row);
   }
   return $arrJson;
}

function setApprovalText($ClientID)
{
   global $xdb,$SystemSettings;

   $rst = $xdb->doQuery("SELECT ClientID, strClient, blnRequiresAuthorisation FROM crmClient WHERE ClientID = ".$xdb->qs($ClientID)." LIMIT 1",0);

   while($row = $xdb->fetch_object($rst))
   {
      $arrJson[] = parseJsonRow($row);
   }
   return $arrJson;
}

function showBookSigned($TicketID)
{
   global $xdb,$SystemSettings;

   $rst = $xdb->doQuery("SELECT ClientID, blnSignBook FROM crmClient INNER JOIN crmTicket ON crmClient.ClientID = crmTicket.refClientID WHERE crmTicket.TicketID = ".$xdb->qs($TicketID)." LIMIT 1",0);

   while($row = $xdb->fetch_object($rst))
   {
      $arrJson[] = parseJsonRow($row);
   }
   return $arrJson;
}

function getTaskDetails($TaskID)
{
   global $xdb,$SystemSettings;

   $rst = $xdb->doQuery("SELECT crmTime.refTaskID, crmTask.refTicketID, crmContact.refClientID, crmContact.refClientID
      , crmClient.blnSignBook, crmTicket.strTicketTitle, crmClient.strClient, crmContact.strContact
      FROM (((crmTime RIGHT JOIN crmTask ON crmTime.refTaskID = crmTask.TaskID) INNER JOIN crmTicket ON crmTask.refTicketID = crmTicket.TicketID) LEFT JOIN crmContact ON crmTicket.refContactID = crmContact.ContactID) LEFT JOIN crmClient ON crmTicket.refClientID = crmClient.ClientID
      WHERE (((crmTime.refTaskID)=".qs($TaskID)."))
      GROUP BY crmTime.refTaskID
      ",0);

   while($row = $xdb->fetch_object($rst))
   {
      $arrJson[] = parseJsonRow($row);
   }
   return $arrJson;
}

function getCodeFaultDetail($CodeFault)
{
   global $xdb,$SystemSettings;

   $rst = $xdb->doQuery("SELECT strDescription FROM crmCodeFault WHERE CodeFaultID = ".qs($CodeFault),0);

   while($row = $xdb->fetch_object($rst))
   {
      $arrJson[] = parseJsonRow($row);
   }
   return $arrJson;
}

function getCodeFixDetail($CodeFix)
{
   global $xdb,$SystemSettings;

   $rst = $xdb->doQuery("SELECT strDescription FROM crmCodeFix WHERE CodeFixID = ".qs($CodeFix),0);

   while($row = $xdb->fetch_object($rst))
   {
      $arrJson[] = parseJsonRow($row);
   }
   return $arrJson;
}

//20170602 - Save ticket details to the session variable. - Gael
function saveTempTicket($Ticket)
{
   unset($_SESSION[Ticket]);
   $_SESSION[Ticket] = json_decode($Ticket);
}

//20170602 - check if client has a default contact - Gael
function checkDefaultClientContact($ClientID)
{
   global $xdb, $SystemSettings;

   $rst = $xdb->doQuery("SELECT crmContact.blnDefaultClientContact FROM crmContact WHERE refClientID = ".qs($ClientID), 0);

   while($row = $xdb->fetch_object($rst))
   {
      $arrJson[] = parseJsonRow($row);
   }
   return $arrJson;
}

//20170717 - Add Product Dropdown ajax search - CL
function getProductDropdown($strSearchString)
{
   global $xdb,$SystemSettings;

   $like = "LIKE('". qs("%".$strSearchString."%'") .")";

   $rst = $xdb->doQuery("
                        SELECT ProductID AS id, CONCAT ( strProduct, '(', strSKU, ')') AS text , strProductCategory as label
                        FROM crmProduct INNER JOIN crmProductCategory ON crmProduct.refProductCategoryID = crmProductCategory.ProductCategoryID
                        WHERE  (crmProduct.strSKU $like OR crmProduct.strProduct $like OR crmProductCategory.strProductCategory $like)
                        AND crmProduct.blnActive = 1",0);
   
   while($row = $xdb->fetch_object($rst))
   {
      $arrJson->items[] = parseJsonRow($row);
   }
   return $arrJson;
}

//20170807 - Add ajax to handle new calendar  -CL 
function ajaxAddScheduleTimeTask($strStartDate, $refUserID, $refTaskID, $allDay)
{
   global $xdb;

   $db = new NemoDatabase("crmTime", 0, null, 0);

   $db->Fields["refUserID"] = $refUserID;
   $db->Fields["refTaskID"] = $refTaskID;
   $db->Fields["strStartDate"] = $strStartDate;
   $db->Fields["strEndDate"] = $strStartDate;
   $db->Fields["blnAllDay"] = $allDay;

   $result = $db->Save(0,0,null,1);

   $lastid = $db->ID[TimeID];

   //print_rr($result);
   if($result->Error == 1){
      return array('status'=>'failed');
   }
   else {
      return array('status'=>'success','TimeID'=>$lastid);
   }
}

//20170807 - Add ajax to update details for crmTime on the calendar -CL 
function ajaxUpdateScheduleTimeTask($TimeID, $lstTask)
{
   global $xdb;

   $result = $xdb->doQuery("UPDATE crmTask INNER JOIN crmTime SET crmTask.lstTask='$lstTask' where crmTime.TimeID ='$TimeID'");
   if($result->Error != 1){
      return array('status'=>'success');
   }
   else{
      return array('status'=>'failed');
   }
}

//20170807 - Add ajax to change calendar date -CL 
function ajaxChangeScheduleTimeTask($TimeID,$strStartDate,$strEndDate,$refTaskID,$blnAllDay)
{
   global $xdb;

   $result = $xdb->doQuery("UPDATE crmTime SET refTaskID='$refTaskID', strStartDate = '$strStartDate', strEndDate = '$strEndDate', blnAllDay = '$blnAllDay' where TimeID='$TimeID'");
   if($result->Error != 1){
      return array('status'=>'success');
   }
   else{
      return array('status'=>'failed');
   }
}

//20170807 - Add ajax to delete calendar time entry -CL 
function ajaxDeleteScheduleTimeTask($TimeID)
{
   global $xdb;

   $result = $xdb->doQuery("DELETE FROM crmTime where TimeID='$TimeID'");
   if($result->Error != 1){
      return array('status'=>'success');
   }
   else{
      return array('status'=>'failed');
   }
}

//20170807 - Add ajax to get time details for the calender -CL
function ajaxGetScheduleTimes($refUserID = null)
{
   global $xdb;

   if($refUserID != null)
   {
      $Where = "AND crmTime.refUserID = $refUserID";
   }

   $arrTasks = array();
   $rst = $xdb->doQuery("SELECT crmTime.TimeID, crmTime.refUserID, crmTime.refTaskID, crmTime.strStartDate, crmTime.strEndDate, crmTime.blnAllDay, crmTask.lstTask 
                           FROM crmTime INNER JOIN crmTask ON crmTime.refTaskID = crmTask.TaskID
                           WHERE 1=1 $Where", 0);
   while($row = $xdb->fetch_object($rst))
   {
      //note: id, start, end, allDay are named fields part of the fullCalender framework - cl
      $protoTask = array();
      $protoTask['id'] = $row->TimeID;
      $protoTask['lstTask'] = $row->lstTask;
      $protoTask['start'] = $row->strStartDate;
      $protoTask['end'] = $row->strEndDate;
      $protoTask['refUserID'] = $row->refUserID;
      $protoTask['refTaskID'] = $row->refTaskID;

      //$blnAllDay = ($row->blnAllDay == "true") ? true : false;
      $blnAllDay = ($row->blnAllDay == "1") ? true : false;
      $protoTask['allDay'] = $blnAllDay;

      array_push($arrTasks, $protoTask);
   }
   return $arrTasks;
}



//20170328 - ReorderProposalItems Ajax added - CL
//moved to Proposal cls
// function ajaxReorderProposalItems($ProposalGroupID, $dblMovedProposalItemID)
// {
//    global $xdb;

//    $dblOrderOutput = 0;
//    $arrPreLoadOrder = array();
//    $arrOrder = array();

//    //add dummy item 0 to array so we can just remove it when the arrays are merged rather then having to add +1 to each key
//    $arrPreLoadOrder[0][0] = 0;

//    //get items for groupID
//    $rowMaxItem = $xdb->getRowSQL("SELECT count(ProposalItemID) as dblMaxOrder FROM crmProposalItem WHERE refProposalGroupID = ".$xdb->qs($ProposalGroupID)."",0);

//    $rst = $xdb->doQuery("SELECT crmProposalItem.*
//                FROM crmProposalItem
//                WHERE refProposalGroupID = ".$xdb->qs($ProposalGroupID)."
//                ORDER BY dblOrder",0);

//    //preload an array as we get it from the db with the right order numbers
//    while($row = $xdb->fetch_object($rst))
//    {
//       //if the ProposalID matches the Currently Moved Proposal ID, then make it the first in the nested array
//       if($row->ProposalItemID == $dblMovedProposalItemID)
//       {
//          $dblOrder = $row->dblOrder;
//          //determine if this is supposed to come before or after current order number
//          //this only happens on the highest total order amount so we check for that

//          if($rowMaxItem->dblMaxOrder == $row->dblOrder)
//          {
//             $dblOrder = $row->dblOrder+1;
//          }

//          $arrPreLoadOrder[$dblOrder][-1] = $row->ProposalItemID;

//       }
//       else//add item in slot 2, there will only be one
//       {
//          $arrPreLoadOrder[$row->dblOrder][] = $row->ProposalItemID;
//       }
//    }

//    // print_rr($arrPreLoadOrder);

//    //sort array Outer
//    //ksort($arrPreLoadOrder,SORT_DESC);
//    //print_rr($arrPreLoadOrder);

//    //sort array Inner
//    foreach ($arrPreLoadOrder as $dblGroupOrder => &$rowGroup) {
//          ksort($rowGroup,SORT_DESC);
//    }
//    //print_rr($arrPreLoadOrder);

//    //array reduce merges a multi-array into a single array and recreates the keys
//    $arrOrder = array_reduce($arrPreLoadOrder, 'array_merge', array());
//    //print_rr($arrOrder);

//    unset($arrOrder[0]);

//    //now we save the new order for each item
//    foreach($arrOrder as $dblOrder => $ProposalItemID)
//    {
//       //if the order matches the Moved proposalItemID then we want to output this
//       if($ProposalItemID == $dblMovedProposalItemID)
//       {
//          $dblOrderOutput = $dblOrder;
//       }
//       $xdb->doQuery("UPDATE crmProposalItem SET dblOrder = $dblOrder WHERE ProposalItemID = $ProposalItemID",0);
//    }

//    return $dblOrderOutput;
// }

?>