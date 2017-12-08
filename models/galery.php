<?
// получаем все фотографии
$sql = "select * from `galery` ORDER BY `count` DESC";
$res = mysqli_query($connect,$sql);
while($img = mysqli_fetch_array($res)){
   $images[]= $img; 
}