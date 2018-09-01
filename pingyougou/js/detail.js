/**
 * Created by Lebron James on 2018/6/7.
 */

window.onload = function () {
    //手机tab特效
    function phoneTab() {
        //获取所有li标签
        var list_item = document.getElementById("list_item");
        var list_item_lis = list_item.children;
        //获取大图片
        var bigBox_img = document.getElementById("bigBox_img");
        //获取大图片标签
        var bigImg = document.getElementById("bigImg");
        for (var i = 0; i < list_item_lis.length; i++) {
            var li = list_item_lis[i];
            li.aaa = i + 1;
            li.onmouseenter = function () {
                bigImg.src = 'upload/iphoneX' + this.aaa + '.jpg';
                bigBox_img.src = 'upload/bigImg' + this.aaa + '.jpg'
                for (var i = 0; i < list_item_lis.length; i++) {
                    var li = list_item_lis[i];
                    li.className = "";
                }
                this.className = "current";
            }
        }
    }

    //放大镜
    function fangDaJing() {
        var product_intro = document.getElementById("product_intro");
        //获取preview_img盒子
        var preview_img = document.getElementById("preview_img");
        //获取小图片
        var bigImg = document.getElementById("bigImg");
        //获取遮盖层
        var mask = document.getElementById("mask");

        //获取大盒子
        var bigBox = document.getElementById("bigBox");

        preview_img.onmouseenter = function () {
            mask.style.display = "block";
            bigBox.style.display = "block";
        }
        preview_img.onmouseleave = function () {
            mask.style.display = "none";
            bigBox.style.display = "none";
        }
        preview_img.onmousemove = function (e) {
            e = e || window.event;
            var maskX = e.pageX - product_intro.offsetLeft;
            var maskY = e.pageY - product_intro.offsetTop;
            maskX = maskX - mask.offsetWidth / 2;
            maskY = maskY - mask.offsetHeight / 2;
            maskX = maskX < 0 ? 0 : maskX;
            maskY = maskY < 0 ? 0 : maskY;

            maskX = maskX > preview_img.offsetWidth - mask.offsetWidth ? preview_img.offsetWidth - mask.offsetWidth : maskX;
            maskY = maskY > preview_img.offsetHeight - mask.offsetHeight ? preview_img.offsetHeight - mask.offsetHeight : maskY;
            mask.style.left = maskX + "px";
            mask.style.top = maskY + "px";

            // mask移动的距离 / mask最大能够移动的距离  = 大图片移动的距离 / 大图片最大能够移动的距离

            // mask最大能够移动的距离
            var maskMax = preview_img.offsetWidth - mask.offsetWidth;
            // 大图片最大能够移动的距离
            var bigImageMax = bigBox_img.offsetWidth - bigBox.offsetWidth;

            var bigImageX = maskX * bigImageMax / maskMax;
            var bigImageY = maskY * bigImageMax / maskMax;

            bigBox_img.style.left = -bigImageX + 'px';
            bigBox_img.style.top = -bigImageY + 'px';
        }
    }

    //tab栏切换
    function fenLeiTab() {
        var tab_list = document.getElementById("tab_list");
        var tab_list_ul = tab_list.children[0];
        var tab_list_lis = tab_list_ul.children;

        var tab_con = document.getElementById("tab_con");
        var tab_con_ul = tab_con.children

        for (var i = 0; i < tab_list_lis.length; i++) {
            var li = tab_list_lis[i];
            li.index = i;
            li.onclick = function () {
                for (var i = 0; i < tab_list_lis.length; i++) {
                    var li = tab_list_lis[i];
                    var ul = tab_con_ul[i]
                    console.log(ul);
                    li.className = li.className.replace("current", "");
                    ul.className = "";
                }
                this.className = this.className + " current";
                console.log(this.index);
                tab_con_ul[this.index].className = "hide";
            }
        }
    }

    //数量添加
    function priceCount() {
        var choose_amount = document.getElementById('choose_amount');
        var iptNum = choose_amount.children[0];
        var add = choose_amount.children[1];
        var reduce = choose_amount.children[2];
        var number = 1;
        add.onclick = function () {
            iptNum.value = ++number;
            if (iptNum.value > 1) {
                reduce.style.cursor = "pointer";
            }
        }

        reduce.onclick = function () {
            if (iptNum.value > 1) {
                iptNum.value = --number;
                if (iptNum.value == 1) {
                    reduce.style.cursor = "not-allowed";
                }
            }
        }

    }

    phoneTab();
    fangDaJing();
    fenLeiTab();
    priceCount();
}