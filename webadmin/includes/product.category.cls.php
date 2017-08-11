<?php
include_once("_framework/_zori.list.cls.php");
/*
ALTER TABLE `tblProductCategory` drop FOREIGN KEY `tblProductCategory.strTitle`;
ALTER TABLE `tblProductCategory` ADD CONSTRAINT `tblProductCategory.strTitle` FOREIGN KEY (`refTitleID`) REFERENCES `tblTitle` (`TitleID`) ON UPDATE CASCADE ON DELETE CASCADE;
*/
class ProductCategory extends ZoriList
{
   private $ID = 0;

   public function __construct($DataKey)
   {
      $this->Filters[frSearch]->Type = "varchar";
      $this->Filters[frSearch]->VALUE = "";
      $this->Filters[frSearch]->html->placeholder = "ProductCategory ID, ProductCategory";
      $this->Filters[frSearch]->html->title = "Search on: ProductCategory ID, ProductCategory";

      $this->Filters[frStatus]->Type = "select";
      $this->Filters[frStatus]->VALUE = -1;
      $this->Filters[frStatus]->Control->html->class = "form-control input-sm";
      $this->Filters[frStatus]->sql = "SELECT -1 AS ControlValue, '- All -' AS ControlText
                           UNION ALL
                        SELECT 1 AS ControlValue, 'Active' AS ControlText
                           UNION ALL
                        SELECT 0 AS ControlValue, 'Inactive' AS ControlText
                        ORDER BY ControlText ASC";

      parent::__construct($DataKey);
   }

   public function getList()
   {
      if($this->Filters[frSearch]->VALUE != "")
      {
         $like = "LIKE(". $this->db->qs("%".$this->Filters[frSearch]->html->value."%") .")";
         $Where .= " AND (tblProductCategory.ProductCategoryID $like OR tblProductCategory.strProductCategory $like)";
      }

      if($this->Filters[frStatus]->VALUE != -1)
      {
         $Where .= " AND tblProductCategory.blnActive = ". $this->Filters[frStatus]->html->value;
      }

      $this->ListSQL("
         SELECT ProductCategoryID, strProductCategory AS 'Product Category', blnActive AS Active, strLastUser AS 'Last User', dtLastEdit AS 'Last Edit'
         FROM tblProductCategory
         WHERE 1=1 $Where
         GROUP BY strProductCategory
         ORDER BY strProductCategory ASC",0);

      return $this->renderTable("Product Category List");
   }

   public static function Save(&$ProductCategoryID)
   {
      global $xdb, $SystemSettings;
      $db = new ZoriDatabase("tblProductCategory", $ProductCategoryID, null, 0);

      $db->SetValues($_POST);
      $db->Fields[strLastUser] = $_SESSION[USER]->USERNAME;

      $result = $db->Save();
      if($ProductCategoryID == 0) $ProductCategoryID = $db->ID[ProductCategoryID];

      //print_rr($result);
      if($result->Error == 1){
         return $result->Message;
      }else{
         return "Details Saved.";
      }
   }

  

   public static function Delete($chkSelect)
   {
      global $xdb;
      //print_rr($chkSelect);
      if(count($chkSelect) > 0){
         foreach($chkSelect as $key => $value)
         {
            //$xdb->doQuery("DELETE FROM tblProductCategory WHERE ProductCategoryID = ". $xdb->qs($key));
            $xdb->doQuery("UPDATE tblProductCategory SET blnActive = 0 WHERE ProductCategoryID = ". $xdb->qs($key));
         }
         return "Records Deleted. ";
      }
   }
}
?>