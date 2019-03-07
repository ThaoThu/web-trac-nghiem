$(document).ready(function () {

    $('#btn_brows_question').click(function (event) {
        event.preventDefault();

        var total_question = $('#post_so_luong_cau_hoi').val();
        var total_quest_select = 0;


        var content_val = $('#txt_cau_hoi').val();

        if (content_val.length > 0) {
            var _tmp = content_val.split(',');

            if (total_question < _tmp.length) {
                alert("Số lượng câu hỏi đã vượt quá giới hạn tối đa " + total_question);
                return;
            }
            else
            if (total_question == _tmp.length) {
                alert("Số lượng câu hỏi đã chọn đủ, nếu muốn thay đổi câu hỏi bạn cần xóa ID câu hỏi trước. ");
                return;
            }
            else
            {
                //chưa chọn đủ
                total_quest_select = total_question - _tmp.length;
            }
        } else {
            total_quest_select = total_question;
        }

        var monhoc = $('select[name="txt_ma_mon"]').val();
        window.open(window.location.protocol + "//" + window.location.host +_base_url+ "?controller=admin-test&&action=list-ch&ma_mh="+monhoc,"popupWindow", "width=800,height=500,scrollbars=yes");
    });

});