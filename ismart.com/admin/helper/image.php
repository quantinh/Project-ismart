<?php

#Hàm xóa file hình ảnh
function delete_image($url)
{
    #Nếu đường dẫn tồn tại thì trả kq
    if (@unlink($url)) {
        return true;
    }
    return false;
}

#Hàm tải file ảnh lên
function upload_image($dir, $type)
{
    #Thư mục gốc để tải lên
    $upload_dir = $dir;
    #Đường dẫn của file sau khi tải lên
    $upload_file = $upload_dir . $_FILES['file']['name'];
    #Kiểm tra file có tồn tại không ?
    if (file_exists($upload_file)) {
        #Tạo tên file: tên file. đuôi mở rộng
        $file_name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
        #Tên file mới + đuôi (copy)
        $new_file_name = $file_name . '-copy.';
        #Tên đường dẫn mới = Tên file cũ + đuôi copy + kiểu file
        $new_upload_file = $upload_dir . $new_file_name . $type;
        $k = 1;
        #Chạy vòng lặp kiểm tra đường dẫn mới có tồn tại file đã copy hay ko ?
        while (file_exists($new_upload_file)) {
            #Tên đó đã sử dụng đổi tiếp theo k lần
            $new_file_name = $file_name . "copy - ({$k}).";
            #Sau mỗi vòng lặp tăng 1 đơn vị 1,2,...sau đuôi copy
            $k++;
            #Đường dẫn có file mới tải lên
            $new_upload_file = $upload_dir . $new_file_name . $type;
        }
        #Đường dẫn cuả file hiện tại cập nhập = đường dẫn file mới tải lên
        $upload_file = $new_upload_file;
        // echo $new_upload_file;
    }
    if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
        return $upload_file;
    }
    return false;
}

