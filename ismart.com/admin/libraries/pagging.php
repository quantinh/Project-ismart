<?php

#Hàm lấy số trang phân trang
function get_pagging($num_page, $page, $base_url = "")
{
    //Thẻ mở danh sách phân trang   
    $str_pagging = "<ul id='list-paging' class='fl-right'>";
    //Nếu số trang hiện tại lớn hơn 1 thì
    if ($page > 1) {
        //trang trc đó prev = số trang hiện tại - 1 để tiến về phía trước  
        $page_prev = $page - 1;
        //Và cập nhập số trang hiện tại bằng số trang đã tính prev như trên cho url thêm kì tự prev trước đó
        $str_pagging .= "<li><a href= \"{$base_url}&page_id={$page_prev}\"><i class='fa fa-angle-left'></i></a></li>";
    }
    //Sử dụng vòng lặp for để chạy qua từng phần tử và kiểm tra giá trị theo thứ tự tăng dần
    for ($i = 1; $i <= $num_page; $i++) {
        $active = "";
        //Nếu i của vòng lặp = chỉ số hiện tại của trang thì thêm class active cho số đó
        if ($i == $page) {
            $active = "class= 'active-num-page'";
        }
        //Và chỉ số hiện tại đk active cũng chính là số page_id trên url tương đương nhau
        $str_pagging .= "<li {$active}><a href= \"{$base_url}&page_id={$i}\">{$i}</a></li>";
    }
    //Nếu chỉ số hiện tại bé hơn tổng số trang đang có thì
    if ($page < $num_page) {
        //Trang tiếp theo khi bấm next sẽ + 1 và thêm kí tự next đằng trc đó
        $page_next = $page + 1;
        //Trang tiếp theo cập nhập url và  bằng chính số trang hiện tại đang ở
        $str_pagging .= "<li><a href= \"{$base_url}&page_id={$page_next}\"><i class='fa fa-angle-right'></i></a></li>";
    }
    //Thẻ đóng danh sách phân trang
    $str_pagging .= "</ul>";
    return $str_pagging;
}

#lấy số trang theo bảng ghi 
function db_num_page($tbl, $record){
    global $conn;
    #Truy vấn số bảng ghi 
    $sql = "SELECT * FROM $tbl";
    #lấy số bảng ghi 
    $num_rows = db_num_rows($sql);
    #Số trang
    $num_page = ceil($num_rows / $record);
    #Danh sách số thứ tự trang 1, 2, 3, 4....
    $list_num_page = array();
    for ($i = 1; $i <= $num_page; $i++) {
        $list_num_page[] = $i;
    }
    return $list_num_page;
}
