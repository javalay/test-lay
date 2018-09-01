/**
 * Created by Lebron James on 2018/6/7.
 */
//搜索框特效
window.onload = function () {
    function iptText() {
        var ipt = document.getElementById("ipt");
        var flag = true;
        ipt.onfocus = function () {
            if (ipt.value === "苹果电脑" && flag == true) {
                ipt.value = "";
                flag = false;
                console.log(ipt.value);
                console.log(flag);
            }
        }
        ipt.onblur = function () {
            if (this.value === "" && flag == false) {
                this.value = "苹果电脑"
                flag = true;
                console.log(ipt.value);
                console.log(flag);
            }
        }
    }

    iptText();

    var focus = document.getElementById("focus");
    var imgWidth = focus.offsetWidth
    var arrow_l = focus.children[0];
    var arrow_r = focus.children[1];
    var focus_ul = focus.children[2];
    var focus_ul_lis = focus_ul.children
    var focus_ol = focus.children[3];
    var timerId = null;
    var count = focus_ul.children.length;
    for (var i = 0; i < focus_ul_lis.length; i++) {

        var li = document.createElement("li");
        focus_ol.appendChild(li);
        li.onclick = liClick;
        li.setAttribute('index', i);
        focus_ol.children[0].className = 'current';
    }
    function liClick() {
        for (var i = 0; i < focus_ol.children.length; i++) {
            var li = focus_ol.children[i];
            li.className = "";
        }
        this.className = "current";

        // 获取自定义属性
        var liIndex = parseInt(this.getAttribute('index'));
        animate(focus_ul, -liIndex * imgWidth);

        // 全局变量index  和 li中的index保持一致
        index = liIndex;
    }

    var index = 0; // 第一张图片的索引
    arrow_r.onclick = function () {
        // 判断是否是克隆的第一张图片，如果是克隆的第一张图片，此时修改ul的坐标，显示真正的第一张图片
        if (index === count) {
            focus_ul.style.left = '0px';
            index = 0;
        }

        index++;
        if (index < count) {
            focus_ol.children[index].click();
        } else {
            animate(focus_ul, -index * imgWidth);
            for (var i = 0; i < focus_ol.children.length; i++) {
                var li = focus_ol.children[i];
                li.className = '';
            }
            focus_ol.children[0].className = 'current';
        }
    }

    arrow_l.onclick = function () {
        // 如果当前是第一张图片，此时要偷偷的切换到最后一张图片的位置（克隆的第一张图片）
        if (index === 0) {
            index = count;
            focus_ul.style.left = -index * imgWidth + 'px';
        }

        index--;
        focus_ol.children[index].click();

    }

    // 无缝滚动
    // 获取ul中的第一个li
    var firstLi = focus_ul.children[0];

    var cloneLi = firstLi.cloneNode(true);
    focus_ul.appendChild(cloneLi);


    // 5 自动切换图片
    var timerId = setInterval(function () {
        // 切换到下一张图片
        arrow_r.click();
    }, 2000);


    focus.onmouseenter = function () {

        // 清除定时器
        clearInterval(timerId);
    }

    focus.onmouseleave = function () {
        // 重新开启定时器
        timerId = setInterval(function () {
            arrow_r.click();
        }, 2000);
    }
}

