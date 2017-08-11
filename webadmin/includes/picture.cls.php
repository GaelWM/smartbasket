<?php
include_once("_framework/_zori.list.cls.php");
/*
ALTER TABLE `tblPicture` drop FOREIGN KEY `tblPicture.strPictureCategory`;
ALTER TABLE `tblPicture` ADD CONSTRAINT `tblPicture.strPictureCategory` FOREIGN KEY (`refPictureCategoryID`) REFERENCES `tblPictureCategory` (`PictureCategoryID`) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE `tblPicture` drop FOREIGN KEY `tblPicture.strStore`;
ALTER TABLE `tblPicture` ADD CONSTRAINT `tblPicture.strStore` FOREIGN KEY (`refStoreID`) REFERENCES `tblStore` (`StoreID`) ON UPDATE CASCADE ON DELETE CASCADE;
*/
class Picture extends ZoriList
{
   private $ID = 0;

   public function __construct($DataKey)
   {
      $this->Filters[frSearch]->Type = "varchar";
      $this->Filters[frSearch]->VALUE = "";
      $this->Filters[frSearch]->html->placeholder = "Picture";
      $this->Filters[frSearch]->html->title = "Search on: Picture";

      $this->Filters[frCategory]->Type = "select";
      $this->Filters[frCategory]->VALUE = "";
      $this->Filters[frCategory]->html->class = "form-control input-sm";
      $this->Filters[frCategory]->sql = " 
         SELECT '' AS ControlValue, '- All -' AS ControlText
      UNION ALL
         SELECT 'Store' AS ControlValue, 'Store' AS ControlText
      UNION ALL
         SELECT 'Product' AS ControlValue, 'Product' AS ControlText
      ORDER BY ControlText ASC";

      parent::__construct($DataKey);
   }

   public function getList()
   {
      global $xdb, $SystemSettings,$SP;

      if($this->Filters[frSearch]->VALUE != "")
      {
         $like = "LIKE(". $this->db->qs("%".$this->Filters[frSearch]->html->value."%") .")";
         $Where .= " AND (tblPicture.PictureID $like OR tblPicture.strPicture $like )";
      }

      if($this->Filters[frCategory]->VALUE != "")
      {
         $Where .= " AND tblPicture.strCategory = '".$this->Filters[frCategory]->html->value."'";
      }

      $rst = $xdb->doQuery(" SELECT * FROM tblPicture WHERE 1=1 $Where GROUP BY strPicture ORDER BY strPicture ASC");
      while($row = $xdb->fetch($rst))
      {
         $i++;
         $onclickEdit="onclick=\"window.location.href='?Action=Edit&PictureID=$row->PictureID'\" ";
         $onclickDelete="onclick=\"window.location.href='?Action=Delete&PictureID=$row->PictureID'\" ";
         $strContentItem[$i] .= "
            <div class='panel-body' id='PIC_".$row->strCategory."_".$row->intEntityID."'>
            <a href='#' id='trigger'><img class='card-img-top' style='height:175px; width:270px;' src='".$SystemSettings[PicturesLink]."/$row->strPictureLink' alt='$row->strPicture'></a>
               <div class='card-block'>
                  <h4 class='card-title'>$row->strPicture
                  <small class='pull-right'><a $onclickDelete style='color:red; padding-left:5px; cursor:pointer;' href='#'>Delete</a></small>
                  <small class='pull-right'><a $onclickEdit style='padding-left:5px; cursor:pointer;' href='#'>Edit</a></small></h4>
                  <p class='card-text'>Category: <b>$row->strCategory</b></p>
               </div>
               <div class='card-footer'>
                  <small class='text-muted'>Last updated on $row->dtLastEdit</small>
               </div>
            </div>
         ";
      }
      return $strContentItem;
   }

   public static function Save(&$PictureID)
   {
      global $xdb, $SystemSettings;
      $db = new ZoriDatabase("tblPicture", $PictureID, null, 0);

      $db->SetValues($_POST);
      $db->Fields[strLastUser] = $_SESSION[USER]->USERNAME;

      $result = $db->Save();
      if($PictureID == 0) $PictureID = $db->ID[PictureID];

      //print_rr($result);
      if($result->Error == 1){
         return $result->Message;
      }else{
         return "Details Saved.";
      }
   }

   public static function Delete($PictureID)
   {
      global $xdb;
      $xdb->doQuery("DELETE FROM tblPicture WHERE PictureID = ". $xdb->qs($PictureID));
      //$xdb->doQuery("UPDATE tblPicture SET blnActive = 0 WHERE PictureID = ". $xdb->qs($key));
      return "Records Deleted. ";
   }
}
?>