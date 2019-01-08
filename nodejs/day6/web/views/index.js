$(function(){
    //查询英雄列表请求
    function getHeroList(){
        $.ajax({
            type: "get",
            url: "http://127.0.0.1:5000/getahero",
            success: function (response) {
                console.log(response)
                var str=template('row',response)
                $("#tbd").html(str)
            }
        });
    }
    getHeroList()
    //添加英雄按钮
    $('#add').on('click', function() {
      $('.ui.modal').modal('show')
    })
    // 初始化下拉框的样式
    $('.ui.dropdown').dropdown()
    //确定添加英雄操作
    $('#btnAdd').on('click', function() {
        var form=$('form').serialize()
        $.ajax({
            type: "post",
            url: "http://127.0.0.1:5000/addhero",
            data: form,
            success: function (response) {
                console.log(response)
                if(response===200){
                    getHeroList()
                    }
            }
        });
    })
    //软删除操作
    $('#tbd').on('click','.del',function(){
        var id=$(this).data('id')
        // alert(id)
        $.ajax({
            type: "get",
            url: "http://127.0.0.1:5000/del/"+id,
            dataType: 'json',
            success: function (response) {
                console.log(response)
                if(response===200){
                getHeroList()
                }
            }
        });
    })
    //软添加操作
    $('#tbd').on('click','.alte',function(){
        var id=$(this).data('id')
        // alert(id)
        $.ajax({
            type: "get",
            url: "http://127.0.0.1:5000/alte/"+id,
            dataType: 'json',
            success: function (response) {
                console.log(response)
                if(response===200){
                getHeroList()
                }
            }
        });
    })
})