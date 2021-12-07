$(function() {
    // ham khoi tao jquery
    $('.btn-delete-brand').on('click',function(){
        let self = $(this); // chinh la button mh dang thao tac
        let idBrand = self.attr('id');
        if($.isNumeric(idBrand)){
            // xu ly ajax
            $.ajax({
                url: "index.php?c=brand&m=delete",
                type: "POST",
                data: {id: idBrand},
                beforeSend: function(){
                    self.text('Loading ... '); 
                },
                success: function(response) {
                    // response : data ben phia server backend tra ve
                    self.text('Delete');
                    // response === OK || FAIL || ERROR_PARAMS
                    let res = $.trim(response);
                    if(res === 'ERROR_PARAMS' || res === 'FAIL'){
                        alert('Co loi xay ra - vui long thu lai');
                    } else if(res === 'OK') {
                        // an bo dong du lieu vua xoa
                        $('#row-brand-'+idBrand).hide();
                        alert('Xoa thanh cong');
                    }
                }
            })
        } else {
            alert('Co loi xay ra - vui long thu lai');
        }
    });

    // search
    $('.btn-search-brand').on('click', function(){
        let keyWord = $('.keyword-search-brand').val().trim();
        window.location.href = "index.php?c=brand&m=index&s="+keyWord;
    });
})