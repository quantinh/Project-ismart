<?php

//=>Hàm xử lí cho deleteAction
#Hàm xóa một media bất kì
function delete_media($media_id) 
{
    $result = db_delete('tbl_medias',"`media_id` = '{$media_id}'");
    #Xóa một bảng ghi các thông tin trang trong CSDL
    return $result;
}
