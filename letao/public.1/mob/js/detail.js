$(function () {
    var size = -1
    var num = 1
    var rest = 0
    console.log(222);
    //获取 有筛选页面地址传过来的 参数，id
    var id = getParamsByUrl(location.href, 'id');
    console.log(id);
    $.ajax({
        type: "get",
        url: "/product/queryProductDetail",
        data: {
            id: id
        },
        success: function (response) {
            console.log(response);
            if (response) {
                //获取鞋码最大值和最小值
                var start = response.size.split('-')[0]
                var end = response.size.split('-')[1]
                //这里存值，下面调用
                rest = response.num
                //给定一个空数组，下面循环添加
                response.size = [];
                for (var i = start; i <= end; i++) {
                    response.size.push(i);
                }
                var html = template("detailTpl", {
                    data: response
                });
                console.log(html);
                $("#detailBox").html(html);
                var gallery = mui('.mui-slider');
                gallery.slider();
            } else {
                alert(result.message);
            }
        }
    });
    //选择码数
    $('body').on('tap', '.detail-size span', function () {
        $(this).addClass('active').siblings().removeClass('active');
        size = $(this).text();
        console.log(size);
    })
    //添加数量，判断数量的最大值 达到最大值就等于最大值
    $('body').on('tap', '.plus', function () {
        num++;
        if (num > rest) {
            num = rest
        }
        $('.num').val(num);

    })
    //添加数量，判断数量的最小值 达到最小值就等于1
    $('body').on('tap', '.reduce', function () {
        num--;
        if (num < 1) {
            num = 1
        }
        $('.num').val(num);
    })

    //判断是否选择尺码
    $("#addCart").on('click', function () {
        if (size == -1) {
            alert('请选择尺码')
            return
        }

        $.ajax({
            type: "post",
            url: "/cart/addCart",
            data: {
                productId: id,
                num: num,
                size: size
            },
            success: function (response) {
                if (response.error && response.reeor.href == 400) {
                    location.href = "login.html"
                }
                if (response.success) {
                    mui.confirm('添加成功,去购物车看看?', '温馨提示', ['确定', '取消'], function (message) {
                        console.log(message);
                            if (message.index == 0) {
                            location.href = "cart.html"
                            
                        }
                    })
                }
            }
        })
    })
})
