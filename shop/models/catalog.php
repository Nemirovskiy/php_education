<?
// получаем все фотографии
$sql = "select * from `product`";
$res = mysqli_query($connect,$sql);
while($img = mysqli_fetch_array($res)){
   $product[]= $img; 
}